<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\ClientObservationRequest;
use App\Http\Requests\Client\InviteSupplierRequest;
use App\Http\Requests\Client\TicketRequest;
use App\Mail\NewSupplierInvitationMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Supplier;
use App\Models\CompanySector;
use App\Models\Invitation;
use App\Models\SupplierLocation;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\CompanySize;
use App\Models\FileUpload;
use App\Models\CompanyMaturity;
use App\Models\ClientTicket;
use App\Models\Answer;
use App\Models\AssignQuestionary;
use App\Models\Questionnaire;
use App\Models\SupplierTicket;
use App\Models\ClientObservation;
use App\Models\TicketAttachDoc;
use App\Models\QuestionnairePermission;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use File;
use App\Models\QuestionnaireReminder;

class ClientSupplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // supplier page  view
    public function index()
    {
        $user = auth()->user();

        $suppliers = Supplier::where('invited_by',$user->id)
                                ->orderBy('created_at','DESC')
                                ->get();

        $pendingsupplier = Invitation::where('sender_id',$user->id)->where('status',0)->orWhere('status',2)->get();
        $deletesupplier = Supplier::onlyTrashed()->with('location', 'userDelete:id,first_name,last_name')
                                    ->where('invited_by', $user->id)
                                    ->take(5)
                                    ->get();

        $totalsentrequest =  Invitation::where('sender_id',$user->id)->get();
        if($totalsentrequest->count()>0){
            $total = ($suppliers->count()*100)/($totalsentrequest->count());
        }else{ $total = 0;}

        $firstinvitation = Invitation::where('sender_id',$user->id)->where('status',0)->where('invitation_time',1)->get();
        if($firstinvitation->count()>0){
        $first = ($firstinvitation->count()*100)/($totalsentrequest->count());
        }else{$first = 0;}

        $secondinvitation = Invitation::where('sender_id',$user->id)->where('status',0)->where('invitation_time',2)->get();
        if($secondinvitation->count()>0)
        {
            $second = ($secondinvitation->count()*100)/($totalsentrequest->count());
        }else{ $second = 0;}

        $thirdinvitation = Invitation::where('sender_id',$user->id)->where('status',0)->where('invitation_time',3)->get();
        if($thirdinvitation->count()>0)
        {
            $third = ($thirdinvitation->count()*100)/($totalsentrequest->count());
        }else{ $third = 0;}

        $locations = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('suppliers.invited_by',$user->id)->get();
        if($locations->count()>0){
            $biglocation = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('supplier_location.size_id',1)->where('suppliers.invited_by',$user->id)->get();
            $big = ($biglocation->count()*100)/($locations->count());
            $mediumlocation = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('supplier_location.size_id',2)->where('suppliers.invited_by',$user->id)->get();
            $medium = ($mediumlocation->count()*100)/($locations->count());
            $smalllocation = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('supplier_location.size_id',3)->where('suppliers.invited_by',$user->id)->get();
            $small = ($smalllocation    ->count()*100)/($locations->count());
            $microlocation = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('supplier_location.size_id',4)->where('suppliers.invited_by',$user->id)->get();
            $micro = ($microlocation->count()*100)/($locations->count());
            $security = Supplier::join('supplier_location','supplier_location.supplier_id','=','suppliers.id')->where('supplier_location.security',1)->where('suppliers.invited_by',$user->id)->get();
            $sec = ($security->count()*100)/($locations->count());
        }
        else{
            $big =0;
            $medium =0;
            $small =0;
            $micro =0;
            $sec =0;
        }

        $suppliersLocationCount = Supplier::query()->count();

        $categories = CompanySector::get();
        $dataGraphCategorySection = [];

        $companiesCategories = [];
        $cont = 0;

        foreach ($categories as $category) {
            $percentage = ($category->locations->count() / $suppliersLocationCount) * 100;
            $companiesCategories[$cont]['category'] = __("message.$category->title");
            $companiesCategories[$cont]['total_locations'] = $category->locations->count();
            $companiesCategories[$cont]['total_companies'] = $percentage;
            $dataGraphCategorySection[] = $percentage;
            $dataGraphCategoryLegend[] = __("message.$category->title");

            $cont++;
        }

        $categories = CompanySector::get();
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $sizes = CompanySize::get();
        $maturities = CompanyMaturity::get();
        return view('client.supplier.supplier',compact(
                'suppliers','pendingsupplier','deletesupplier',
                'locations','total','first','second',
                'third','big','medium','small','micro','sec',
                'categories','countries','states','cities','sizes','maturities',
                'dataGraphCategorySection', 'companiesCategories', 'dataGraphCategoryLegend'
            ));

    }

    public function getPaginate(Request $request)
    {
        $page = $request->page ?? 1;
        $resultCount = $request->perPage ?? 5;
        $user = auth()->user();

        if ($resultCount == 'all') {
            $suppliers = Supplier::query()->with('location.category:id,title', 'location.size:id,value',
                'location.locationmaturity:id,level_name')
                ->where('invited_by', $user->id)
                ->orderBy('created_at', 'DESC')
                ->get();

            return ['data' => $suppliers, 'current_page' => 1, 'per_page' => count($suppliers),
                'total' => count($suppliers),
                'next_page_url' => null,
                'prev_page_url' => null];
        } else {
            $suppliers = Supplier::query()->with('location.category:id,title', 'location.size:id,value',
                'location.locationmaturity:id,level_name')
                ->where('invited_by', $user->id)
                ->orderBy('created_at','DESC')
                ->paginate($resultCount, ['*'], 'page', $page);

            return $suppliers;
        }
    }

    public function getPaginatePending(Request $request)
    {
        $page = $request->page ?? 1;
        $resultCount = $request->perPage ?? 5;
        $user = auth()->user();

        if ($resultCount == 'all') {
            $pendingsupplier = Invitation::where('sender_id',$user->id)->where('status',0)->orWhere('status',2)->get();

            return ['data' => $pendingsupplier, 'current_page' => 1, 'per_page' => count($pendingsupplier),
                'total' => count($pendingsupplier),
                'next_page_url' => null,
                'prev_page_url' => null];
        } else {
            $pendingsupplier = Invitation::where('sender_id',$user->id)
                ->where('status',0)
                ->orWhere('status',2)
                ->paginate($resultCount, ['*'], 'page', $page);

            return $pendingsupplier;
        }
    }

    public function getPaginateDelete(Request $request)
    {
        $page = $request->page ?? 1;
        $resultCount = $request->perPage ?? 5;
        $user = auth()->user();

        if ($resultCount == 'all') {
            $deletesupplier = Supplier::onlyTrashed()->with('location', 'userDelete:id,first_name,last_name')
                ->where('invited_by', $user->id)
                ->get();

            return ['data' => $deletesupplier, 'current_page' => 1, 'per_page' => count($deletesupplier),
                'total' => count($deletesupplier),
                'next_page_url' => null,
                'prev_page_url' => null];
        } else {
            $deletesupplier = Supplier::onlyTrashed()->with('location', 'userDelete:id,first_name,last_name')
                                        ->where('invited_by', $user->id)
                                        ->paginate($resultCount, ['*'], 'page', $page);

            return $deletesupplier;
        }
    }

    // supplier details page
    public function supplierDetails($id)
    {
        $user = Auth::user();
        $supplier= Supplier::find($id);
        $suppliers = Supplier::where('invited_by',$user->id)
                ->where('first_time_login',1)
                ->get();

        $locations = SupplierLocation::where('supplier_id',$supplier->id)->get();
        $path = 'client/'.$user->id.'/supplier/'.$supplier->id;
        $directories = Storage::allDirectories($path);

        $path2 = storage_path("app/{$path}");
        $relativePath = Storage::disk('local')->path('');

        $dataFiles = [];
        if (is_dir($path2)) {
            $carpetas = scandir($path2);
            $carpetas = array_diff($carpetas, ['.', '..']);

            foreach ($carpetas as $carpeta) {
                $rutaCarpeta = $path2 . '/' . $carpeta;

                if (is_dir($rutaCarpeta)) {
                    $archivosCarpeta = scandir($rutaCarpeta);
                    $archivosCarpeta = array_values(array_diff($archivosCarpeta, ['.', '..']));

                    $files = array();
                    $contFiles = 0;
                    foreach ($archivosCarpeta as $archivo) {
                        $pathFind = "$path/$carpeta/$archivo";

                        $fileList = FileUpload::where('client_id', $user->id)
                            ->where('supplier_id', $supplier->id)
                            ->where('uploaded_by', 1)
                            ->where('filename', $pathFind)
                            ->first();

                        $files[$contFiles]['id'] = $fileList->id;
                        $files[$contFiles]['created_at'] = date('d-m-Y', strtotime($fileList->created_at));
                        $files[$contFiles]['original_file_name'] = $fileList->original_file_name;
                        $files[$contFiles]['observation'] = $fileList->observation;
                        $files[$contFiles]['file_raw_name'] = $archivo;
                        $files[$contFiles]['path'] = $pathFind;

                        $contFiles++;
                    }

                    $dataFiles[$carpeta] = [
                        'tipo' => 'carpeta',
                        'name' => $carpeta,
                        'random' => Str::random(8),
                        'path' => "$path/$carpeta",
                        'archivos' => $files,
                    ];
                }
            }
        }

        $fileList = FileUpload::where('client_id',$user->id)
                ->where('supplier_id',$supplier->id)
                ->where('uploaded_by',1)
                ->get();
        $assignquestionnaires = AssignQuestionary::where('client_id',$user->id)
                ->where('supplier_id',$supplier->id)
                ->paginate(5);
        $updatedata = AssignQuestionary::where('client_id',$user->id)
                ->where('answer_status',1)
                ->update(['is_checked'=>1]);
        $answers = Answer::where('respondent_id',$supplier->id)
                ->get();
        $observations = ClientObservation::where(['client_id'=>$user->id,'supplier_id'=>$supplier->id])
                ->orderBy('created_at','DESC')
                ->get();


//        ---------------------------Chart code---------------------
        $ideasresult =0;
        $totalquestion = 0;
        $answeredquestion = 0;
        $assignQues = AssignQuestionary::where('supplier_id',$supplier->id)
                ->where(function($query) {
                    if (request()->has('current_location') && request()->current_location != null) {
                        $query->where('location_id', request()->current_location);
                    }
                })
                ->get();
        $questionnaireyIds = array();
        $location_ids = array();

        foreach($assignQues as $val)
        {
            $questionnaire = Questionnaire::findOrFail($val->questionnaire_id);
            if($questionnaire->questions != NULL)
            {
                $totalquestion += count(explode(',',$questionnaire->questions));
                $questionnaireyIds[]=$val->questionnaire_id;
                $location_ids[]=$val->location_id;
            }
        }

        if (request()->has('current_location') && request()->current_location != null) {
            $location_ids = array();
            $location_ids[] = request()->current_location;
        }

        $ans = Answer::query()->where('respondent_id',$supplier->id)
                ->whereIn('questionnaire_id',$questionnaireyIds)
                ->whereIn('location_id',$location_ids);

        $answers = $ans->get();
        $answeredquestion = 0;
        $answeredObservation = 0;
        $answeredattachdoc = 0;
        $applyAnswer = 0;
        $totalValue = 0;
        $totalYes =0;

        foreach($answers as $val)
        {
            if($val->answer_type == 1)
            {
                $answeredquestion +=1;
            }

            if($val->observation!="")
            {
                $answeredObservation +=1;
            }

            if(!empty($val->answer_attach_doc_id))
            {
                $answeredattachdoc+=1;
            }

            if($val->apply==1)
            {
                $applyAnswer+=1;
            }

            $totalValue += $val->question->questionvalue->value;
            if($val->answer_type==1)
            {
                $totalYes += $val->question->questionvalue->value;
            }
        }
        if($totalquestion!=0){
            $perAnswer = round(($answeredquestion*100)/($totalquestion));
            $perObservation = round(($answeredObservation*100)/($totalquestion));
            $perAttachDoc = round(($answeredattachdoc*100)/($totalquestion));
            $perApplyAnswer = round(($applyAnswer*100)/$totalquestion);
        }else{
            $perAnswer = 0;
            $perObservation = 0;
            $perAttachDoc = 0;
            $perApplyAnswer = 0;
        }

        // ideas vs real

        if($totalValue !=0)
        {
            $realresult = round((100*$totalYes)/($totalValue));
            $ideasresult =round(100-$realresult);
        }
        else{
            $realresult = 0;
            $ideasresult =round(100-$realresult);
        }

        return view('client.supplier.supplierdetails',
            compact(
                'supplier','suppliers','directories','fileList',
                'assignquestionnaires','answers','observations', 'dataFiles',
                'locations','perAnswer','perObservation','perAttachDoc','perApplyAnswer','realresult','ideasresult',
            ));
    }

    public function reInvitation($supplier)
    {
        $provider = Supplier::onlyTrashed()->find($supplier);
        $provider->restore();

        $invitation = Invitation::where('email', $provider->email)->first();
        $invitation->status = 0;
        $invitation->invitation_time = 2;
        $invitation->second_send_date = Carbon::now();
        $invitation->second_expired_date = Carbon::now()->addWeekdays(15);
        $invitation->save();

        Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));

        return back()->with('success','Invitation is resent successfully...');
    }

    //  send the invitation again
    public function reSendInvitatin($id)
    {
        $invitation = Invitation::find($id);
        Mail::to($invitation->email)->send(new NewSupplierInvitationMail($invitation));
        return back()->with('success','Invitation is resent successfully...');
    }

    // suppler create
    public function createSupplier()
    {
        return view('client.supplier.create');
    }

    public function changeStatus($str,$id)
    {
        // dd($id);
        $supplier = Supplier::find($id);
        // dd($supplier);
        $message="";
        if($str == 'blocked')
        {
            $supplier->status = 0;
            $supplier->save();
            $message = "Supplier Block Successfully";
        }
        elseif($str == 'unblocked')
        {
            $supplier->status = 1;
            $supplier->save();
            $message = "Supplier Unblock Successfully";
        }
        return redirect()->route('client.supplier.list')->with('success',$message);
    }

    // delete the supplier
    public function destory($id)
    {
        $supplier = Supplier::find($id);
        $supplier->user_delete = auth()->user()->id;
        $supplier->save();
        $supplier->delete();
//        $supplier_location  = SupplierLocation::where('supplier_id',$id)->delete();
        $answer  = Answer::where('respondent_id',$id)->delete();
        $assign_questionary  = AssignQuestionary::where('supplier_id',$id)->delete();
        $client_ticket  = ClientTicket::where('receiver_id',$id)->delete();
        $supplier_ticket  = SupplierTicket::where('sender_id',$id)->delete();
//        $invitation  = Invitation::where('email',$supplier->email)->delete();

        return back()->with('error','Supplier Data deleted successfully..');
    }

    // location filter
    public function locationFilter(Request $request)
    {

        $locations = SupplierLocation::with('country')
                ->with('state')
                ->with('city')
                ->with('category')
                ->with('size')
                ->with('locationmaturity')
                ->join('suppliers','suppliers.id','=','supplier_location.supplier_id')
                ->where('supplier_location.status',1)
                ->where('suppliers.invited_by',getUser()->id);

        if($request->with_search_drp!='' && $request->with_search_drp!='All')
        {
            $locations->where('supplier_id',$request->with_search_drp);
        }

        if($request->MoSMif != NULL && $request->MoSMif!='All')
        {
            $suppliers = QuestionnaireReminder::
                 where('client_id',getUser()->id)
                ->where('status',$request->MoSMif)
                ->OrderBy('created_at','DESC')
                ->get();

            $supplier_ids = array();
            foreach($suppliers as $val)
            {
                $supplier_ids[] = $val->supplier_id;
            }
            $locations->whereIn('supplier_id',$supplier_ids);
        }

        if($request->country_id !=  NULL)
        {
            if($request->country_id !="all")
            {
                $locations->Where('country_id', $request->country_id);
            }
        }
        if($request->state_id !=  NULL)
        {
            if($request->state_id !="all")
                $locations->Where('state_id',$request->state_id);
        }
        if($request->city_id!= NULL)
        {
            if($request->city_id !="all")
                $locations->Where('city_id', $request->city_id);
        }
        if($request->sector!= NULL)
        {
            if($request->sector !="all")
                $locations->Where('category_id',$request->sector);
        }
        if($request->size != NULL)
        {
            if($request->size !="all")
                $locations->Where('size_id',$request->size);
        }
        if($request->maturity!= NULL)
        {
            if($request->maturity !="all")
                $locations->Where('maturity', $request->maturity);
        }
        if($request->security!= NULL)
        {
            if($request->security !="all")
                $locations->Where('security', $request->security);
        }
        if($request->date!= NUll)
        {
            if($request->date !="all")
                $locations->whereDate('supplier_location.created_at',date('Y-m-d',strtotime($request->date)));
        }
        $locations =$locations->get();

        return $locations;
    }


    // directory structure at client side
    // create folder
    public function createFolder(Request $request)
    {
        $user = Auth::user();
        $foldername = strtolower($request->foldername);
        $supplierid = $request->supplierid;
        // dd($request);
        if (!Storage::exists('client/'.$user->id.'/supplier/'.$supplierid.'/'.$foldername))
        {
            Storage::makeDirectory('client/'.$user->id.'/supplier/'.$supplierid.'/'.$foldername);
            return back()->with('success','Folder has been created successfully...!!');
        }
        return back()->with('error','Folder is already exist...!!');
    }


    // upload the file
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:1024',
        ]);

        $file =$request->file('file');
        $foldername = $request->foldername;
        if($file =$request->file('file')){
            $path = $request->file('file')->store($foldername);
        }
        $fileuplaod = FileUpload::create([
            'filename'=>$path,
            'foldername'=>$request->foldername,
            'observation'=>$request->observation,
            'client_id'=>Auth::user()->id,
            'original_file_name'=>$file->getClientOriginalName(),
            'supplier_id'=>$request->supplier_id,
            'uploaded_by'=>1,
       ]);
       return back()->with('success','File uploaded successfully');
    }

    // rename the directory
    public function renameFolder(Request $request)
    {
        $user = Auth::user();
        $oldname = $request->directory;
        $supplierid = $request->supplierid;
        $newname = $request->newname;
        $innerpath = 'client/'.$user->id.'/supplier/'.$supplierid.'/';
        if (Storage::exists($oldname))
        {
            // dd(basename($oldname));
            $path = "storage/app/";
            rename($path.$oldname,$path.$innerpath.$newname);
            $oldDirectoriesFile = FileUpload::where('foldername',$oldname)->get();
            foreach($oldDirectoriesFile as $files)
            {
                $files->foldername = $innerpath.$newname;
                $files->filename = $innerpath.$newname.'/'.basename($files->filename);
                $files->update();
            }
            return back()->with('success','Folder has been renamed successfully...!!');
        }
        return back()->with('error','Folder is already exist...!!');
    }

    // delete directory
    public function deleteDirectory(Request $request)
    {
        $user = Auth::user();
        $supplierid = $request->supplierid;
        $dir = $request->dirname;
        $files = $files = Storage::allFiles($dir);
        if(count($files) > 0)
        {
            $file = json_encode($files);
            Storage::delete($file);
        }
        Storage::deleteDirectory($dir);
        $oldDirectoriesFile = FileUpload::where('foldername',$dir)->delete();
        return back()->with('success','Folder deleted successfully..!!');
    }

    // download all the file
//    public function downloadAllFile(Request $request)
    public function downloadAllFile($id,$name,Request $request)
    {
        $data = array();
        $id = $request->id;

        $user =  Auth::user();
        $filesPath = storage_path('app/');
        $filesPath .= $request->path;

        $fileName = 'zipstorage/';
        $fileName .= $request->name.'.zip';
        $zip = new ZipArchive;

        if($zip->open(base_path($fileName), ZipArchive::CREATE) === TRUE | ZipArchive::OVERWRITE === TRUE)
        {
            $files = File::files($filesPath);
            foreach ($files as $key => $value)
            {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
        }
        $zip->close();
//        if($zip->close())
//        {
//            return response()->download(base_path($fileName));
//        }

        if(file_exists(base_path($fileName)))
        {
            return response()->download(base_path($fileName));
//            $data['filedata'] = base_path($fileName);
//            $data['msg']='success';
        }
        else
        {
            return back()->with('error',' Zip file is not exit...');
//            $data['msg']='Zip file is not exit';

        }
        return $data;

    }

    // download the single file
    public function downloadSingleFile($id)
    {
        $file = FileUpload::findOrFail($id);

        return Storage::download($file->filename);
    }

    // delete the particular file from  the folder
    public function deleteSingleFile($id)
    {
        $file = FileUpload::findOrFail($id);
        $file->delete();
        $delete = Storage::delete($file->filename);
        return back()->with('success','File deleted successfully');
    }

    // accept the supplier answer
    public function acceptAnswer($id,$value)
    {
        $answer = Answer::findOrFail($id);
        $ans_val = $answer->question->questionvalue->value;
        if($answer->is_approved == 0)
        {
            $answer->is_approved = $value;
            if($value ==1 ){
                $answer->answer_value = $ans_val;
            }
            $answer->update();
            if($value == 1)
            {
                $type="success";
                $message = "Answer is Approved successfully";


                $questionary_id  =$answer->questionnaire_id;
                $sup_id = $answer->respondent_id;
                $loc_id  = $answer->location_id;
                $answer = Answer::countPending($questionary_id,$sup_id,$loc_id);
                $questionnaires = AssignQuestionary::where([
                    'client_id'=>Auth::user()->id,
                    'supplier_id'=>$sup_id,
                    'questionnaire_id'=>$questionary_id,
                    'location_id'=>$loc_id,
                ])->get()->first();
                $score = $questionnaires->questionnaire_value;
                foreach($answer as $value)
                {
                    if($value->is_approved == 1)
                    {
                        $score += $value->question->questionvalue->value;
                    }
                }
                $questionnaires = AssignQuestionary::where([
                    'client_id'=>Auth::user()->id,
                    'supplier_id'=>$sup_id,
                    'questionnaire_id'=>$questionary_id,
                    'location_id'=>$loc_id,
                ])->get()->first();
                $questionnaires->questionnaire_value = $score;
                $questionnaires->is_approved = 1;
                $questionnaires->approved_date = date('Y-m-d h:i:s');
                $questionnaires->update();
            }
            else{
                $type="error";
                $message = "Answer is rejected successfully";
            }
            return back()->with($type,$message);
        }
    }

    // upload the  answer folder
    public function uploadAnsFile(Request $request)
    {
        // dd($request);
        $request->validate([
            'answer_file' => 'required|max:1024',
        ]);

        $file =$request->file('answer_file');
        $path = 'images/client/ansfile';
        if(isset($request->answer_file))
        {
            $file = $request->answer_file;
            $docname = 'IMG_'.date('Ymdhis').'.' . $file->getClientOriginalExtension();
            $mainfile = $request->file('file');
            $file->move($path,$docname);
        }
        $fileuplaod = FileUpload::create([
            'filename'=>$docname,
            'foldername'=>$path,
            'observation'=>$request->observation,
            'client_id'=>Auth::user()->id,
            'original_file_name'=>$file->getClientOriginalName(),
            'supplier_id'=>$request->supplier_id,
            'uploaded_by'=>1,
        ]);
        $answer = Answer::findOrFail($request->answer_id);
        $answer->file_upload_id = $fileuplaod->id;
        $answer->update();
        return back()->with('success','File uploaded successfully');
    }

    // upload the answer observation from the client side
    public function uploadAnsObservation(Request $request)
    {
        $answer = Answer::findOrFail($request->answer_id);
        $answer->client_observation = $request->observation;
        $answer->update();
        return back()->with('success','Observation updated successfully');
    }


    // client add the observation to the supplier
    public function clientObservation(ClientObservationRequest $request)
    {
        // dd($request);
        $observation = clientObservation::create([
            'client_id' => Auth::user()->id,
            'supplier_id'=>$request->supplier_id,
            'observation'=>$request->observation,
            'status'=>1,
        ]);
        return back()->with('success','Observation added successfully');
    }

    // delete the pending supplier
    public function deleteInvitation($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();
        return back()->with('success','invitation deleted  successfully...!!');
    }

    public function sendObservation(Request $request)
    {
        $splr = Supplier::find($request->sid);
        $locations  = SupplierLocation::where('supplier_id',$splr->id)->get();
        $user = User::find(Auth::user()->id);
        $suppliers = Supplier::where('invited_by',$user->id)->get();
        $questionnaires = Questionnaire::where('created_by',$user->id)->get();
        $observation = $request->observation;
        return view('client.supplier.sendticket',compact('splr','locations','user','suppliers','questionnaires','observation'));
    }
    public function sentTicket(Request $request)
    {
        $userid = Auth::user()->id;
		$location = SupplierLocation::findOrFail($request->location);
		$supplier = Supplier::findOrFail($location->supplier_id);

        // attach  doc  exist or not
        if (isset($request->attach_doc)) {
            $uploadedImage =$request->attach_doc;
            $imageName = 'DOC'.$userid.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/document/client/tickets');
            $uploadedImage->move($destinationPath, $imageName);

                $attachdoc = TicketAttachDoc::create([
                        'attach_doc_name'=>$imageName,
                        'uploaded_by'=>1,
                        'status'=>1,
                ]);
                $docid = $attachdoc->id;
            }
            else{
                    $docid = null;
            }


            //  questionnaire exit or not
            $questionnaires = $request->questionnaire;
            if($questionnaires!= NUll)
            {
                foreach($questionnaires as $questionary)
                {
                    $assignment = AssignQuestionary::where([
                            'client_id'=>$userid,
                            'supplier_id'=>$supplier->id,
                            'location_id'=>$request->location,
                            'questionnaire_id'=>$questionary,
                    ])->get()->count();
                    if($assignment == 0)
                    {
                            $assignQuestionnaires = AssignQuestionary::create([
                                    'client_id'=>$userid,
                                    'supplier_id'=>$supplier->id,
                                    'location_id'=>$request->location,
                                    'questionnaire_id'=>$questionary,
                                    'answer_status'=>0,
                            ]);
                            $qpermission = QuestionnairePermission::create([
                                    'user_id'=>$userid,
                                    'questionnaire_id'=>$questionary,
                            ]);
                    }else{
                        $qgroup = Questionnaire::findOrFail($questionary);
                        return redirect()->route('client.ticket.new')->with('error', $qgroup->name.'questionnaires are already assign.');
                    }
                }
                $array = implode(",",$request->questionnaire);
            }
		else{
                    $array = null;
		}

        // store new ticket doc
        $clientticket = ClientTicket::create([
                'sender_id'=>Auth::user()->id,
                'receiver_id'=>$supplier->id,
                'ticket_number'=>uniqid(),
                'ticket_type'=>$request->ticket_type,
                'location_id'=>$request->location,
                'name'=>$request->name,
                'questionnaire_id'=>$array,
                'description'=>$request->description,
                'attach_doc_id'=>$docid,
                'answer_status'=>0,
                'status'=>1,
        ]);
        return redirect()->route('client.ticket.new')->with('success',trans('Ticket has been sent successfully..!!'));
    }

}
