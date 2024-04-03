<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Supplier;
use App\Models\Question;
use App\Models\ClientTicket;
use App\Models\AnswerAttachDoc;
use App\Models\Answer;
use App\Models\FileUpload;
use App\Models\AssignQuestionary;
use App\Models\ClientObservation;
use App\Models\QuestionnaireReminder;
use App\Models\ClientAnswerObservation;
use App\Models\QuestionnairePermission;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;


class SupplierQuestionnaireController extends Controller
{
    public function __construct()
    {
            return $this->middleware('auth:supplier');
    }
    public function index()
    {
        $user= Auth::user();
        $supplier = Supplier::find($user);
        $questionnaires = ClientTicket::where('receiver_id',$user->id)->whereNotNull('questionnaire_id')->get();
        $answers = Answer::where('respondent_id',$user->id)->get();
        $directories =  Storage::allDirectories('supplier/'.$user->id.'/');
        $fileList =FileUpload::where('client_id',$user->invited_by)->where('supplier_id',$user->id)->where('uploaded_by',2)->get();
        $assignQuestionnaires =  AssignQuestionary::where('supplier_id',$user->id)->orderby('created_at')->paginate();
        $observations = ClientObservation::where(['client_id'=>$user->invited_by,'supplier_id'=>$user->id])->orderBy('created_at','DESC')->get();

        return view('supplier.questionnaire.index',compact('user','questionnaires','answers','directories','fileList','assignQuestionnaires','observations'));
    }

    public function questionnaireDetails($id)
    {
        $user = getUser()->id;
        $ideasresult =0;
        $supplier = Supplier::find($user);
        $assignQues = AssignQuestionary::findOrFail($id);
        $questionnaire = Questionnaire::findOrFail($assignQues->questionnaire_id);

        if($questionnaire->questions != NULL)
        {
            $totalquestion = count(explode(',',$questionnaire->questions));
        }
        else
        {
            $totalquestion = 0;
        }

        $path = 'supplier/'.$user;
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

                        $fileList = FileUpload::where('supplier_id',$supplier->id)
                            ->where('uploaded_by',2)
                            ->where('filename', $pathFind)
                            ->first();

                        if ($fileList != null) {
                            $files[$contFiles]['id'] = $fileList->id;
                            $files[$contFiles]['created_at'] = date('d-m-Y', strtotime($fileList->created_at));
                            $files[$contFiles]['original_file_name'] = $fileList->original_file_name;
                            $files[$contFiles]['observation'] = $fileList->observation;
                            $files[$contFiles]['file_raw_name'] = $archivo;
                            $files[$contFiles]['path'] = $pathFind;

                            $contFiles++;
                        }
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

        $directories =  Storage::allDirectories('supplier/'.$user.'/');
        $fileList =FileUpload::where('client_id',$supplier->invited_by)->where('supplier_id',$user)->where('uploaded_by',2)->get();
        $observations = ClientObservation::where(['client_id'=>$supplier->invited_by,'supplier_id'=>$user])->orderBy('created_at','DESC')->get();
        $ans = Answer::where('respondent_id',$user)->where('questionnaire_id',$questionnaire->id)->where('location_id',$assignQues->location_id);
        $answers = $ans->get();

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

//        $answeredquestion = $ans->where('answer_type',1)->get();
//
//        $answeredObservation = $ans->whereNotNull('observation')->get();
//        $answeredattachdoc = $ans->whereNotNull('answer_attach_doc_id')->get();
//        $applyAnswer = $ans->where('apply',1)->get();

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
//        $realansresult = Answer::where('respondent_id',$user)
//                ->where('questionnaire_id',$questionnaire->id)
//                ->where('location_id',$assignQues->location_id)
//                ->where('answer_type','!=',2)->get();
//        $totalValue = 0;
//        $totalYes =0;
//
//        foreach($realansresult as $result)
//        {
//            $totalValue += $result->question->questionvalue->value;
//            if($result->answer_type==1)
//            {
//                $totalYes += $result->question->questionvalue->value;
//            }
//        }

        if($totalValue !=0)
        {
            $realresult = round((100*$totalYes)/($totalValue));
            $ideasresult =round(100-$realresult);
        }
        else{
            $realresult = 0;
            $ideasresult =round(100-$realresult);
        }

        $qPermission =  QuestionnairePermission::where(['user_id'=>$supplier->invited_by,'questionnaire_id'=>$questionnaire->id])->first();

        return view('supplier.questionnaire.questionnairedetails',  compact('user','questionnaire','answers',
            'directories','fileList','assignQues',
            'observations','perAnswer','perObservation','qPermission',
            'perAttachDoc','perApplyAnswer','realresult','ideasresult', 'dataFiles'));
    }
    public function submitAnswer(Request $request)
    {

        $user = Auth::user();
        $answer = Answer::where('respondent_id',$user->id)->where('question_id',$request->question_id)->where('questionnaire_id',$request->questionnaire_id)->get();
        if($answer->count() == 0)
        {
            $clientid = Auth::user()->suppliercreator->id;
            if(isset($request->attach_doc)) {
                $uploadedImage =$request->attach_doc;
                $imageName = 'DOC'.$user->id.'_'.date('Ymdhis').'.' . $uploadedImage->getClientOriginalExtension();
                $destinationPath = public_path('/document/supplier/answers');
                $uploadedImage->move($destinationPath, $imageName);

                $attachdoc = AnswerAttachDoc::create([
                    'attach_doc'=>$imageName,
                    'status'=>1,
                ]);

                $docid = $attachdoc->id;
            }
            else{ $docid = null;}
            if($request->answer_type == 2){
                $noapply =1;
            }else{
                $noapply =0;
            }
            $answer = Answer::create([
                'client_id'=>$user->invited_by,
                'respondent_id'=>$user->id,
                'questionnaire_id'=>$request->questionnaire_id,
                'question_id'=>$request->question_id,
                'answer_type'=>$request->answer_type,
                'apply' =>$noapply,
                'location_id'=>$request->location_id,
                'answer_attach_doc_id'=>$docid,
                'observation'=>$request->observation,
                'status'=>1,
            ]);
            $questionnaire  =  Questionnaire::findOrFail($request->questionnaire_id);
            $exportedquestionid = explode(",",$questionnaire->questions);
            $qqids = $request->questionnaire_id;
            $loc_id = $request->location_id;
            $answer = Answer::countPending($qqids,$user->id,$loc_id);
            $temp =1;
            foreach($answer as $data)
            {
                if($data->apply == 0)
                {
                    $temp = 0;
                    break;
                }

            }
            foreach ($answer as $key => $value)
            {
                    $questionids[] = $value['question_id'];
            }
            $dupes = array_diff($exportedquestionid,$questionids);
            if(empty($dupes))
            {
                $ansdata= AssignQuestionary::where([
                    'client_id'=>$clientid,
                    'supplier_id'=>$user->id,
                    'questionnaire_id'=>$questionnaire->id,
                    'location_id'=>$request->location_id,
                ])->get()->first();
                        $ansdata->answer_status = 1 ;
                $ansdata->is_applied = $temp;
                        $ansdata->update();
                $reminerupdate = QuestionnaireReminder::where([
                    'client_id'=>$clientid,
                    'supplier_id'=>$user->id,
                    'questionnaire_id'=>$questionnaire->id,
                    'location_id'=>$request->location_id,
                ])->update(['status'=>1]);
            }
            return back()->with('success',trans('message.Data saved successfully'));
        }
        return back()->with('error',trans('message.answer is already done.'));
    }


    public function createFolder(Request $request)
    {
        $user = Auth::user();
        $foldername = strtolower($request->foldername);
        if (!Storage::exists('supplier/'.$user->id.'/'.$foldername))
        {
            Storage::makeDirectory('supplier/'.$user->id.'/'.$foldername);
            return back()->with('success','Folder has been created successfully...!!');
        }
        return back()->with('error','Folder is already exist...!!');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:1024',
        ]);

        $user = Auth::user();
        $file =$request->file('file');
        $foldername = $request->foldername;

        if($file =$request->file('file'))
        {
            $path = $request->file('file')->store($foldername);
        }

        $fileuplaod = FileUpload::create([
            'filename'=>$path,
            'foldername'=>$request->foldername,
            'observation'=>$request->observation,
            'client_id'=>$user->invited_by,
            'original_file_name'=>$file->getClientOriginalName(),
            'supplier_id'=>$user->id,
            'uploaded_by'=>2,
       ]);

       return back()->with('success','File uploaded successfully');
    }

    public function renameFolder(Request $request)
    {
        $user = Auth::user();
        $oldname = $request->directory;
        $newname = $request->newname;
        $innerpath = 'supplier/'.$user->id.'/';
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

    public function deleteDirectory(Request $request)
    {
        $user = Auth::user();
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


//        $user =  Auth::user();
//        $path = 'client/'.$user->id.'/supplier/'.$id.'/'.$name ;
//        $files = Storage::allFiles($path);
//        if((count($files) > 0 ))
//        {
//            foreach($files as $file)
//            {
//                return Storage::download($file);
//            }
//            back()->with('success','data has been download successfully...!!');
//        }
//        return back()->with('error','No any file  available ...!!');
    }

    public function downloadSingleFile($id)
    {
        $file = FileUpload::findOrFail($id);
        return Storage::download($file->filename);
    }

    public function deleteSingleFile($id)
    {
        $file = FileUpload::findOrFail($id);
        $file->delete();
        $delete = Storage::delete($file->filename);
        return back()->with('success','File deleted successfully');
    }



}
