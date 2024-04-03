@extends('layouts.app')

@section('title', 'supplier')

@section('content')
    <div style="padding-left: 80px">
        <div class="global_wrapper">
            <div class="supplier-info-wrapper">
                <a href="{{ route('client.supplier.index') }}" class="back_btn d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-1 mr-2" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    {{ __('message.back') }}
                </a>
                {{ status() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="left_info-title">
                            <h3>{{ $supplier->first_name }}</h3>
                            <p><strong>CIF:</strong> {{ $supplier->suppliercreator->company->cif }}</p>
                        </div>
                    </div>
                    <div class="col-md-9 right-info-drp step_one">
                        <select class="selecttwodropdown" id="supplier_opt_list">
                            @foreach ($suppliers as $sup)
                                <option value="{{ $sup->id }}" @if ($sup->id == $supplier->id) selected @endif>
                                    {{ $sup->getSupplierFullName() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <x-view-profile-edit-card title='' dataTarget="" :showBorderBottom="false" noIconOrButton="true">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>{{ __('message.location') }}</th>
                                        <th>{{ __('message.Supplier Name') }}</th>
                                        <th>Email</th>
                                        <th>{{ __('message.checked') }}</th>
                                        <th>{{ __('message.info') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($locations as $location)
                                    <tr class="sub-container">
                                        <td>{{ $location->location_name }}</td>
                                        <td>{{ $location->locationcreator->getSupplierFullName() }}</td>
                                        <td>{{ $location->locationcreator->email }}</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="check" id="{{ $location->id }}" {{ request()->current_location == $location->id ? 'checked' : '' }} class="check_lock">
                                                {{ __('message.checked') }}
                                            </label>
                                        </td>
                                        <td>
                                            @if(request()->current_location == $location->id)
                                                <button type="button" class="btn btn-sm exploder btn-danger">
                                                    <i class="fa fa-minus"> Información</i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-success exploder">
                                                    <i class="fa fa-plus"> {{ __('message.info') }}</i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="explode {{ request()->current_location == $location->id ? 'show' : 'hide' }}">
                                        <td colspan="5" style="background: #F5F5F5; border-radius: 5px; {{ request()->current_location == $location->id ? '' : 'display: none' }};">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <img src="{{ asset('images/supplier/location') . '/' . $location->location_image }}"
                                                         alt="" width="100px" height="auto">
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><strong>{{ __('message.owner_name') }}:</strong> {{ $location->locationcreator->getSupplierFullName() }}</p>
                                                    <p><strong>Email:</strong> {{ $location->locationcreator->email }}</p>
                                                    <p><strong>Nº MF:</strong> {{ $location->totalQuestionnaires($location->id, $location->supplier_id)->count() }}</p>
                                                    <p><strong>{{ __('message.maturity_level')  }}:</strong> {{ $location->totalQuestionnaires($location->id, $location->supplier_id)->sum('questionnaire_value') }}</p>
                                                    <p><strong>{{ __('message.approved') }}:</strong> {{ $location->totalQuestionnaires($location->id, $location->supplier_id)->where('is_approved', 1)->count() }}</p>
                                                    <p><strong>{{ __('message.Registerd Date') }}:</strong> {{ date('d/m/Y', strtotime($location->locationcreator->created_at)) }}</p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <table class="table table-sm" style="background: transparent !important">
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.Country') }}</strong></td>
                                                            <td class="pt-0">{{ $location->country->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.Address') }}</strong></td>
                                                            <td class="pt-0">{{ $location->getFullAddress() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.company_sector') }}</strong></td>
                                                            <td class="pt-0">{{ $location->category->title }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.company_size') }}</strong></td>
                                                            <td class="pt-0">{{ $location->size->value }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.maturity_level')  }}</strong></td>
                                                            <td class="pt-0">{{ $location->locationmaturity->level_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pt-0"><strong>{{ __('message.security_department')  }}</strong></td>
                                                            <td class="pt-0">{{ $location->secutity == 1 ? __('message.yes') : __('message.no') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </x-view-profile-edit-card>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 p-0 row justify-content-end">
                        <div class="col-12 p-0 col-md-2">
                            <div class="form-group">
                                <label>{{ __('message.locations') }}</label>
                                <select id="slc_location" class="form-control">
                                    <option value="">{{ __('message.all_locations') }}</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ request()->current_location == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="inner_summary_graph">
                            <div>
                                <canvas id="answerpiechart"> </canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="inner_summary_graph">
                            <div class="">
                                <canvas id="idealvsreal"> </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <x-view-profile-edit-card title="{{ __('message.questions') }}" class="no-padding" dataTarget="" :showBorderBottom="false" noIconOrButton="true">
                            <div class="col-12">
                                <div class="row my-4">
                                    <div class="col-12">
                                        @if($assignquestionnaires->count() > 0)
                                            <div class="accordion" id="accordionQuestionnaires">
                                                @foreach($assignquestionnaires as $questionnaire)
                                                    @foreach($questionnaire->questionnaireData($questionnaire->questionnaire_id) as $questionnary)
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                                            data-toggle="collapse" data-target="#collapseTwo"
                                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                                        {{ $questionnary->name}}
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionQuestionnaires">
                                                                <div class="card-body">
                                                                    <table class="table table-bordered table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center">{{ __('message.question') }}</th>
                                                                                <th class="text-center">{{ __('message.answer') }}</th>
                                                                                <th class="text-center">{{ __('message.Status') }}</th>
                                                                                <th class="text-center">{{ __('message.observation') }}</th>
                                                                                <th class="text-center">{{ __("message.info") }}</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($questionnary->questionsname($questionnary->questions) as $question)
                                                                                <tr>
                                                                                    <td>{{ $question->name}}</td>
                                                                                    @foreach($answers as $answer)
                                                                                        @if($answer->question_id ==  $question->id)
                                                                                            @if($answer->respondent_id == $supplier->id  &&
                                                                                                $answer->questionnaire_id == $questionnary->id &&
                                                                                                $answer->question_id == $question->id &&
                                                                                                $answer->location_id == $questionnaire->location_id)
                                                                                                <td class="text-center">
                                                                                                    @if($answer->apply == 1)
                                                                                                        {{ __('message.No Apply') }}
                                                                                                    @else
                                                                                                        @if($answer->answer_type ==1 ) {{ __('message.yes') }} @else {{ __('message.no') }} @endif
                                                                                                    @endif
                                                                                                </td>
                                                                                                @if($answer->answer_attach_doc_id != NUll)
                                                                                                    <td class="text-center">
                                                                                                        <label for="lb1"><a href="{{ asset('public/document/supplier/answers').'/'.$answer->answerAttachDoc->attach_doc}}"> {{ $answer->answerAttachDoc->attach_doc}}</a></label>
                                                                                                    </td>
                                                                                                @endif
                                                                                                <td>
                                                                                                    @if($answer->is_approved == 0)
                                                                                                        <a href="{{ route('client.accept.answer',['id'=>$answer->id,'value'=>1])}}" class="text-success"><i class ="fa fa-check"></i></a>&nbsp;
                                                                                                        <a href="{{ route('client.accept.answer',['id'=>$answer->id,'value'=>2])}}" class="text-danger"><i class="fa fa-times"></i></a>
                                                                                                    @elseif($answer->is_approved == 1) {{ __('message.approved') }}
                                                                                                    @else {{ __('message.reject') }}
                                                                                                    @endif
                                                                                                </td>
                                                                                                <td>{{ $answer->observation }}</td>
                                                                                                <td>
                                                                                                    {{-- exploder --}}
                                                                                                    <button type="button" class="btn btn-info  add_info_btn" >
                                                                                                        <i class="fa fa-plus"> {{ __('message.info') }}</i>
                                                                                                    </button>

                                                                                                    <div class="folder_pop add_info_menu" style="display: none;">
                                                                                                        <a href="javascript:void(0)" data-toggle="modal" id="{{ $answer->id}}" class="file_menu">{{ __('message.file') }}</a>
                                                                                                        <a href="javascript:void(0)" data-toggle="modal" id="{{ $answer->id}}" class="obs_menu">{{ __('message.observation') }}</a>
                                                                                                    </div>
                                                                                                </td>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                </tr>
                                                                                @if($answer->client_observation != NULL)
                                                                                    <tr class="table-info">
                                                                                        <th>Usuario</th>
                                                                                        <th>{{ __('message.date') }}</th>
                                                                                        <th>{{ __('message.observation') }}</th>
                                                                                        <th>{{ __('message.file') }}</th>
                                                                                        <th>{{ __('message.Action') }}</th>
                                                                                    </tr>
                                                                                    <tr class="table-info">
                                                                                        <td>{{ getUser()->getFullName()}}</td>
                                                                                        <td>{{ date('d/m/Y h:i:s',strtotime($answer->clientObservation->created_at)) }}</td>
                                                                                        <td>{{ $answer->clientObservation->observation}}</td>
                                                                                        <td>
                                                                                            <a href="{{ asset('public/client/answers/documents').'/'.getuser()->id.'/'.$answer->clientObservation->file_name}}" target="_blank">
                                                                                                {{$answer->clientObservation->file_name}}
                                                                                            </a>
                                                                                        </td>
                                                                                        <td>
                                                                                            <a href="{{ route('client.ans.observation.delete',$answer->client_observation)}}" class="btn btn-info" onclick="return confirm('are You sure to delete this record...??')">{{ __('message.delete') }}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </x-view-profile-edit-card>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <x-view-profile-edit-card title="{{ __('message.other_files') }}" dataTarget="" :showBorderBottom="false" class="no-padding mb-4" noIconOrButton="true">
                            <div class="col-12">
                                <div class="row my-4">
                                    <div class="col-12">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                {{ __('message.add') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#add_nw_fldr">{{ __('message.folder') }}</a>
                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#new_file_pop">{{ __('message.file') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion" id="accordionFiles">
                                            @foreach($dataFiles as $folder)
                                                <div class="card">
                                                    <div class="card-header" id="headingFolder{{$folder['random']}}">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left" type="button"
                                                                    data-toggle="collapse" data-target="#collapseFolder{{$folder['random']}}"
                                                                    aria-expanded="false" aria-controls="collapseFolder{{$folder['random']}}">
                                                                {{ $folder['name'] }} (<i>{{ __('message.folder') }}</i>)
                                                            </button>
                                                        </h2>
                                                    </div>

                                                    <div id="collapseFolder{{$folder['random']}}" class="collapse" aria-labelledby="headingFolder{{$folder['random']}}" data-parent="#accordionFiles">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <div>
                                                                        <a href="{{ route('client.supplier.download.file', ['id' => $supplier->id, 'name' => basename($folder['path'])]) }}?path={{ $folder['path'] }}"
                                                                           class="all_down_txt">
                                                                            {{ __('message.add_download') }} <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:void(0)" class="dots dot_btn">
                                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                        </a>
                                                                        <div class="folder_pop dot_pop_bx" style="display: none;">
                                                                            <a href="javascript:void(0)" data-value="{{ $folder['path'] }}" class="editfolderbtn">{{ __('message.edit') }}</a>
                                                                            <a href="#" data-value="{{ $folder['path'] }}" class="deletefolderbtn"> {{ __('message.delete') }}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="li_itm"><i class="fa fa-file-text" aria-hidden="true"></i></th>
                                                                                <th class="li_itm"> {{ __('message.date') }}</th>
                                                                                <th class="li_itm"> {{ __('message.doc_name') }} </th>
                                                                                <th class="li_itm"> {{ __('message.observation') }} </th>
                                                                                <th class="li_itm"> {{ __('message.Action') }} </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($folder['archivos'] as $file)
                                                                                <tr>
                                                                                    <td> <i class="fa fa-file-text" aria-hidden="true"></i> </td>
                                                                                    <td>{{ $file['created_at'] }}</td>
                                                                                    <td>{{ $file['original_file_name'] }}</td>
                                                                                    <td>{{ $file['observation'] }}</td>
                                                                                    <td>
                                                                                        <a href="{{ route('client.supplier.single.file', $file['id']) }}"
                                                                                           class="btn btn-info">{{ __('message.download') }}</a>
                                                                                        <a href="{{ route('client.supplier.delete.file', $file['id']) }}}"
                                                                                           onclick="return confirm('are you sure delete this record..??')"
                                                                                           class="btn btn-info">{{ __('message.delete') }}</a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-view-profile-edit-card>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-12">
                        <x-view-profile-edit-card title="{{ __('message.observations') }}" dataTarget="" :showBorderBottom="false" class="no-padding mb-4" noIconOrButton="true">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('message.Supplier') }}</th>
                                                    <th>{{ __('message.date') }}</th>
                                                    <th>{{ __('message.time') }}</th>
                                                    <th>{{ __('message.observation') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($observations as $observation)
                                                    <tr>
                                                        <td>{{ $observation->supplier->getSupplierFullName() }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($observation->created_at)) }}</td>
                                                        <td>{{ date('h:i:s', strtotime($observation->created_at)) }}</td>
                                                        <td>{{ $observation->observation }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ route('client.add.observation') }}" method="post">
                                            @csrf
                                            <div class="input_pp">
                                                <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                                                <input type="text" name="observation" id="observation" class="form-control"
                                                       placeholder="Write text...." autocomplete="off" required>
                                                <input type="hidden" name="location" id="observation-location">
                                                <span class="search_btn_wrp">
                                                <button class="bg_btn view_btn" type="submit">{{ __('message.send') }}</button>
                                            </span>
                                            </div>
                                            @error('observation')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                            @enderror
                                        </form>
                                    </div>

                                    <div class="rw my-4">
                                        <div class="action_wrap">

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="li_itm mr-2">
                                            <a href="javascript:void(0)" class="bg_btn view_btn">{{ __('message.checked') }}</a>
                                        </div>
                                        <div class="li_itm">
                                            <button id="sendticket" class="bg_btn view_btn">{{ __('message.send') }} Ticket</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-view-profile-edit-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- New Folder -->
    <div class="modal fade add_nw_fldr" id="add_nw_fldr">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">{{ __('message.new_folder') }}</h4>
                    <form action="{{ route('client.create.folder') }}" method="POST">
                        <div class="input_pp">
                            @csrf
                            <input type="hidden" name="supplierid" value="{{ $supplier->id }}">
                            <input type="text" name="foldername" id="foldername" class="form-control"
                                placeholder="{{ __('message.folder_name') }}" autocomplete="off">
                        </div>
                        <div class="action_wrap">
                            <div class="li_itm">
                                <a href="javascript:void(0)" data-dismiss="modal" class="bg_btn view_btn">{{ __('message.Cancel') }}</a>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="bg_btn view_btn">{{ __('message.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- File Popup -->
    <div class="modal fade add_nw_fldr new_file_pop" id="new_file_pop">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">{{ __('message.new_file') }}</h4>
                    <form action="{{ route('admin.upload.file') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="fileupload" class="d-none" />
                        <label for="fileupload" class="bg_btn view_btn btn_block" style="width:100%;">{{ __('message.upload_file') }}</label>
                        <!-- <a href="javascript:void(0)" >update file</a> -->
                        <div class="attach_file">
                            <input type="hidden" name="supplier_id" class="file_nm" value="{{ $supplier->id }}">
                            <label for="comp_logo_input" id="attach_doc">{{ __('message.attached_file') }}</label>
                            <span><i class="fa fa-times float-right" id="remove_btn" aria-hidden="true"></i></span>
                        </div>
                        @error('file')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                        <div class="step_one">
                            <select name="foldername" class="form-control selecttwodropdown" id="choose_folder"
                                data-width="100%" data-minimum-results-for-search="Infinity">
                                @foreach ($directories as $directory)
                                    <option value="{{ $directory }}">{{ basename($directory) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input_pp">
                            <!-- <input type="text" name="address" id="address" class="form-control" placeholder="Folder name" autocomplete="off"> -->
                            <textarea class="form-control" name="observation" placeholder="{{ __('message.observation') }}"></textarea>
                        </div>
                        <div class="action_wrap">
                            <div class="li_itm">
                                <a href="javascript:void(0)" data-dismiss="modal" class="bg_btn view_btn">{{ __('message.Cancel') }}</a>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="bg_btn view_btn">{{ __('message.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- client answer observation file modal start --}}
    <div class="modal fade add_nw_fldr new_file_pop" id="cli_add_file">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">Add File</h4>
                    <form action="{{ route('client.ans.add.file') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cli_answer_file" id="ans_file" class="d-none" />
                        <label for="ans_file" class="bg_btn view_btn btn_block" style="width:100%;">update file</label>
                        <div class="attach_file">
                            <input type="hidden" name="supplier_id" class="file_nm" value="{{ $supplier->id }}">
                            <input type="hidden" name="answer_id" id="ans_ans_id" value="{{ @old('answer_id') }}">
                            <label class="float-left" id="attach_doc_name">Attached field</label>
                            <span><i class="fa fa-times float-right" id="remove_ans_file_btn"
                                    aria-hidden="true"></i></span>
                        </div>
                        @error('cli_answer_file')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                        <div class="input_pp">
                            <textarea class="form-control" name="observation" placeholder="Observations....">{{ @old('observation') }}</textarea>
                        </div>
                        <div class="action_wrap">
                            <div class="li_itm">
                                <a href="javascript:void(0)" data-dismiss="modal" class="bg_btn view_btn">Cancel</a>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="bg_btn view_btn"> Save </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- client answer observation file modal end --}}


    {{-- client add answer observation file modal start --}}
    <div class="modal fade add_nw_fldr new_file_pop" id="cli_add_obs">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">Add observation</h4>
                    <form action="{{ route('client.ans.add.observation') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="answerid" id="obser_ans_id" value="{{ @old('answerid') }}">
                        <div class="input_pp">
                            <textarea class="form-control" name="cli_observation" placeholder="Observations...."></textarea>
                        </div>
                        @error('cli_observation')
                            <span class="text-danger"> <strong> {{ $message }} </strong> </span>
                        @enderror
                        <div class="action_wrap">
                            <div class="li_itm">
                                <a href="javascript:void(0)" data-dismiss="modal" class="bg_btn view_btn">Cancel</a>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="bg_btn view_btn"> Save </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- client add answer observation file modal start --}}

    <!-- Edit Folder -->
    <div class="modal fade add_nw_fldr edit_folder" id="edit_folder_pop">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">Edit Folder</h4>
                    <form action="{{ route('client.rename.folder') }}" method="post">
                        @csrf
                        <input type="hidden" name="directory" id="directoryName">
                        <input type="hidden" name="supplierid" value="{{ $supplier->id }}">
                        <div class="input_pp">
                            <input type="text" name="newname" id="address" class="form-control"
                                placeholder="Folder name" autocomplete="off">
                        </div>
                        <div class="action_wrap">
                            <div class="li_itm">
                                <button type="button" data-dismiss="modal" class="bg_btn view_btn">Cancel</button>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="bg_btn view_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- delete modal -->
    <div class="modal fade add_nw_fldr edit_folder" id="deletefoldermodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <h4 class="modal-title">{{ __('message.delete') }} {{ __('message.folder') }}</h4>
                    <form action="{{ route('client.delete.folder') }}" method="post">
                        @csrf
                        <input type="hidden" name="dirname" id="dirname">
                        <input type="hidden" name="supplierid" value="{{ $supplier->id }}">
                        <p>{{ __('message.message_delete_folder') }}</p>
                        <div class="action_wrap">
                            <div class="li_itm">
                                <button type="button" class="btn btn-secondary bg_btn view_btn"
                                    data-dismiss="modal">{{ __('message.Cancel') }}</button>
                            </div>
                            <div class="li_itm">
                                <button type="submit" class="btn btn-danger bg_btn view_btn">{{ __('message.delete') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('client.send.ticket.observation') }}" id="ticketform" method="get" class="d-none">
        @csrf
        <input type="hidden" name="sid" id="supplier_id">
        <input type="hidden" name="observation" id="formobservation">
    </form>
    <script>
        function allDownload(id, name, paths) {
            jQuery.ajax({
                url: '{{ URL::to('download-file') }}',
                type: "GET",
                data: '&id=' + id + '&name=' + name + '&path=' + paths,
                success: function(res) {
                    if (res.msg == 'success') {
                        alert(res.filedata);
                        //                    window.location.href = res.filedata;
                    }
                },
            });
        }
    </script>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).click(function(e) {
            $('#fileupload').change(function() {
                $('#attach_doc').text(this.files[0].name);
            });
            $('#remove_btn').click(function() {
                $("#fileupload").val(null);
                $('#attach_doc').text('Attached field')
            });
            $('#ans_file').change(function() {
                $('#attach_doc_name').text(this.files[0].name);
            });
            $('#remove_ans_file_btn').click(function() {
                $("#ans_file").val(null);
                $('#attach_doc_name').text('Attached field')
            });
            $('.editfolderbtn').click(function(e) {
                e.preventDefault();
                let value = $(this).attr('data-value');
                $('#edit_folder_pop').modal('show');
                $('#directoryName').val(value);
            });
            $('.deletefolderbtn').click(function() {
                e.preventDefault();
                let value = $(this).attr('data-value');
                $('#deletefoldermodal').modal('show');
                $('#dirname').val(value);
            });

            $('#supplier_opt_list').change(function() {
                let value = $(this).val();
                //                alert(value);
                url = "{{ route('client.supplier.details', ':value') }}"

                //                $("<a>").prop({
                //                    target: "_blank",
                //                    href: url,
                //        })[0].click();
                window.location.href = url.replace(':value', value);
            });
        });
    </script>
    <script type="text/javascript">
        @if ($errors->has('file'))
            $('#new_file_pop').modal('show');
        @endif
        @if ($errors->has('cli_observation'))
            $('#cli_add_obs').modal('show');
        @endif
        @if ($errors->has('cli_answer_file'))
            $('#cli_add_file').modal('show');
        @endif
    </script>

    <script type="text/javascript">
        $(".exploder").click(function() {
            $(this).toggleClass("btn-success btn-danger");
            $(this).children("i").toggleClass("fa fa-plus fa fa-minus");
            $(this).closest("tr").next("tr").toggleClass("hide");
            if ($(this).closest("tr").next("tr").hasClass("hide")) {
                $(this).closest("tr").next("tr").children("td").slideUp();
            } else {
                $(this).closest("tr").next("tr").children("td").slideDown(350);
            }
        });
    </script>
    {{-- send ticket scripting start --}}
    <script>
        $('#sendticket').click(function() {
            var sid = "{{ $supplier->id }}";
            var observation = $('#observation').val();
            $('#supplier_id').val(sid);
            $('#formobservation').val(observation);
            $('#ticketform').submit();
        });
    </script>
    {{-- send ticket scripting end --}}

    {{--  script for the add the info to the  supplier answers --}}
    <script>
        $(document).ready(function() {
            $('.add_info_btn').click(function() {
                $(this).next().slideToggle('slow');
                return false;
            });
            $('.file_menu').click(function(e) {
                val = $(this).attr('id');
                $('#ans_ans_id').val(val);
                $('#cli_add_file').modal('show');
            });
            $('.obs_menu').click(function(e) {
                val = $(this).attr('id');
                $('#obser_ans_id').val(val);
                $('#cli_add_obs').modal('show');
            });
        });
    </script>
    {{-- end --}}


    {{-- answers chart --}}
    <script>
        const chartdata = {

            labels: ['Answer', 'Observation', 'Attcahc Doc'],
            datasets: [{
                data: [{{ $perAnswer }}, {{ $perObservation }}, {{ $perAttachDoc }}],
                backgroundColor: [
                    'rgb(60, 179, 113)',
                    'rgb(255, 99, 132)',
                    'rgb(30, 172, 170)',
                    //            'rgb(221, 99, 75)',
                ],
                hoverOffset: 4
            }],
        };

        const chartconfig = {
            type: 'polarArea',
            data: chartdata,
            option: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Polar Area Chart'
                    }
                }
            },
        };
        var sectionid = document.getElementById('answerpiechart');
        var myChart = new Chart(sectionid, chartconfig);
    </script>

    {{-- ideal vs real chart --}}
    <script>
        const data = {
            labels: ['Real', 'Ideal'],
            datasets: [{
                data: [{{ $realresult }}, {{ $ideasresult }}],
                backgroundColor: [
                    'rgb(60, 179, 113)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }],
        };
        const piechartconfig = {
            type: 'pie',
            data: data,
            option: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        };
        var sectionid = document.getElementById('idealvsreal');
        var myChart = new Chart(sectionid, piechartconfig);

        $('#slc_location').change(function() {
            // Obtén el nuevo valor seleccionado
            var selectedLocation = $(this).val();

            // Actualiza la URL según la lógica
            if (selectedLocation === '') {
                // Si se selecciona la opción por defecto, quita el parámetro
                window.history.pushState({}, document.title, window.location.pathname);
            } else {
                // Agrega o actualiza el parámetro con el nuevo valor
                var newUrl = updateQueryStringParameter(window.location.href, 'current_location', selectedLocation);
                window.history.pushState({}, document.title, newUrl);
            }

            // Recarga la página
            location.reload();
        });

        // Función para agregar o actualizar un parámetro en la URL
        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }
    </script>
@endsection
