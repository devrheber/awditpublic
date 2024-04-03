@extends('supplier.layouts.app')

@section('title','sent invitation details')
@section('css')
@endsection
@section('content')
    <div style="padding-left: 80px">
        <div class="global_wrapper">

   <div class="supplier-info-wrapper">
        <p>
           <span class="float-left">  <strong>Location:</strong> {{ $assignQues->location->location_name}} </span>
           <span><strong>Completed:</strong> 100% </span>
           <span class="float-right">  <strong>Level:</strong> Active/Pending </span>
        </p>

        {{-- progress bar start --}}
        <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                 25%
             </div>
        </div>
        <br>
        {{-- progress bar end --}}

        {{status()}}

        {{-- chart of the questionnaire module start --}}
        <div class="row left_info_graph">
            @if($qPermission->status == 1)
                <div class="col-md-6">
                   <div class="new_que_chart1">
                      <canvas id="answerpiechart"> </canvas>
                   </div>
                </div>
            @endif
            @if($qPermission->q_results == 1)
                <div class="col-md-6">
                    <div class="new_que_chart1">
                      <canvas id="idealvsreal"> </canvas>
                    </div>
                </div>
            @endif
        </div>
      {{-- chart of the questionnaire module end --}}
   </div>
{{-- chart Progres bar section end --}}

   <x-view-profile-edit-card title="{{ __('message.questions') }}" dataTarget="" :showBorderBottom="false"
                             class="no-padding" noIconOrButton="true" id="last-peding-check">
       <div class="col-12">
           <div class="row">
               <div class="col-12">
                   @php
                       $i=1;
                       $questions = $questionnaire->paginateQuestionData($questionnaire->questions,3);
                   @endphp
                   @foreach($questions as $question)
                       <div class="card">
                           <div class="card-header bg-info text-white">
                               <h5 class="float-left">{{$i++}}. {{$question->name}}</h5> &nbsp;
                               {{-- <h5 class="float-right">{{$question->questionvalue->value}}</h5> --}}
                               <span class="question_detail" data-value="{{$question->id}}">({{ __('message.show_requirement') }})</span>
                               <br>
                               <div id ="sqdetails{{$question->id}}" style="display: none;">
                                   <br>
                                   <p><strong>{{ __('message.question_based_on') }}: </strong>{{ $question->based_on}} </p>
                                   <p><strong>{{ __('message.objective') }}: </strong>{{$question->objective}}</p>
                                   <p><strong>{{ __('message.requirement') }}:</strong>
                                       @foreach($question->questionrequirement as $requirement)
                                           @if ($loop->last) {{$requirement->requirements}} @else{{$requirement->requirements}},@endif
                                   @endforeach
                               </div>
                               @if(!checkAnswerExitOrNot(getuser()->id,$questionnaire->id,$question->id,$assignQues->location_id))
                                   <button class="btn btn-secondary float-right addans" data-value="{{$question->id}}" id="question{{$question->id}}">{{ __('message.add_answer') }}</button>
                               @endif
                           </div>
                           @php
                               $answer = getAnswerData(getuser()->id,$questionnaire->id,$question->id,$assignQues->location_id);
                           @endphp
                           @if($answer)
                               <div class="card-body">
                                   <table class="table">
                                       <tr>
                                           <th>{{ __('message.answer_type') }}:</th>
                                           <td>
                                               @if($answer->apply == 1)
                                                   {{ __('message.no_apply') }}
                                               @else
                                                   @if($answer->answer_type ==1 ) {{ __('message.yes') }} @else {{ __('message.no') }} @endif
                                               @endif
                                           </td>
                                           <th> {{ __('message.observation') }}:</th>
                                           <td>{{$answer->observation}} </td>
                                           @if($answer->answer_attach_doc_id != NUll)
                                               <th>{{ __('message.attached_file') }}:</th>
                                               <td><label for="lb1"><a href="{{ asset('document/supplier/answers').'/'.$answer->answerAttachDoc->attach_doc}}"> {{ $answer->answerAttachDoc->attach_doc}}</a></label></td>
                                           @endif
                                       </tr>
                                       @if($answer->client_observation !=NULL)
                                           <tr>
                                               <td>
                                                   <span> {{date('d/m/Y',strtotime($answer->clientObservation->created_at))}} </span>
                                                   <span> {{date('h:i:s',strtotime($answer->clientObservation->created_at))}}</span																																																																																																																																																																																																																																								>
                                               </td>
                                               <td>
                                                   <div class="txt">{{ $answer->clientObservation->observation}}</div>
                                               </td>
                                               <td>
                                                   <div class="txt">
                                                       <a href="{{ asset('client/answers/documents').'/'.getuser()->id.'/'.$answer->clientObservation->file_name}}" target="_blank">{{$answer->clientObservation->file_name}}</a>
                                                   </div>
                                               </td>
                                           </tr>
                                       @endif
                                   </table>
                               </div>
                           @else
                               <div class="card-body showcardbody" style="display:none" id="quesbody{{$question->id}}">
                                   <strong>Answer Submit :</strong>  {{ __('message.no') }}
                                   <form action="{{ route('supplier.questionnaire.answer')}}" class="answerform" method="post" enctype="multipart/form-data" >
                                       @csrf
                                       <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                                       <input type="hidden" name="question_id" value="{{$question->id}}">
                                       <input type="hidden" name="location_id" value= "{{ $assignQues->location_id }}">
                                       <div class="check_option">
                                           <label class="checkbox_ps">
                                               <div class="checkbx">
                                                   <input type="radio" value="1" name ="answer_type" checked>
                                                   <span class="checkmark"></span> {{ __('message.yes') }}
                                               </div>
                                           </label>
                                           <label class="checkbox_ps">
                                               <div class="checkbx">
                                                   <input type="radio" value ="0" name="answer_type">
                                                   <span class="checkmark"></span> {{ __('message.no_apply') }}
                                               </div>
                                           </label>
                                           <label class="checkbox_ps">
                                               <div class="checkbx">
                                                   <input type="radio" value ="2" name="answer_type">
                                                   <span class="checkmark"></span> {{ __('message.no') }}
                                               </div>
                                           </label>
                                       </div>
                                       <div class="attach_file bg mb-3">
                                           <label for="fileupload{{$question->id}}">Attached doc.</label>
                                           <input type="file" id="fileupload{{$question->id}}" data="{{ $question->id}}" name="attach_doc" class="file_input">
                                           <label for="file_name1" class="file_nm"><b></b></label>
                                           <i class="fa fa-times" aria-hidden="true"></i>
                                       </div>
                                       <div class="input_pp">
                                           <input type="text" name="observation" required class="form-control" placeholder="Observations" autocomplete="off">
                                           <span class="search_btn_wrp">
                                             <button type="submit" class="bg_btn view_btn">Upload</button>
                                          </span>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       </div>
                       <br>
                   @endforeach
                   {{ $questions->links()}}
               </div>
           </div>
       </div>
   </x-view-profile-edit-card>

	{{-- 	Add  file and folder section start --}}
	@if($qPermission->q_other_file == 1)
        <x-view-profile-edit-card title="{{ __('message.other_files') }}" dataTarget="" :showBorderBottom="false" class="no-padding my-4" noIconOrButton="true">
            <div class="col-12 mb-4">
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
                                                        <a href="{{ route('supplier.download.file', ['id' => Auth::user()->id, 'name' => basename($folder['path'])]) }}?path={{ $folder['path'] }}"
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
                                                                    <a href="{{ route('supplier.single.file', $file['id']) }}"
                                                                       class="btn btn-info">{{ __('message.download') }}</a>
                                                                    <a href="{{ route('supplier.delete.file', $file['id']) }}}"
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
	@endif

	@if($qPermission->q_observation == 1)
        <x-view-profile-edit-card title="{{ __('message.observations') }}" dataTarget="" :showBorderBottom="false" class="no-padding my-4" noIconOrButton="true">
            <div class="col-12 mb-4">
                <div class="row my-4">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('message.user')  }}</th>
                                    <th>{{ __('message.date')  }}</th>
                                    <th>{{ __('message.time')  }}</th>
                                    <th>{{ __('message.observation')  }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($observations as $observation)
                                    <tr>
                                        <td>{{ $observation->supplier->getSupplierFullName() }}</td>
                                        <td>{{ date('d/m/Y',strtotime($observation->created_at)) }}</td>
                                        <td>{{ date('h:i:s',strtotime($observation->created_at)) }}</td>
                                        <td>{{ $observation->observation }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </x-view-profile-edit-card>
	@endif

   <br>
        </div>
    </div>


<!-- New Folder -->
 <div class="modal fade add_nw_fldr" id="add_nw_fldr">
	<div class="modal-dialog modal-dialog-centered">
     	<div class="modal-content">
        	<!-- Modal body -->
        	<div class="modal-body">
        		<h4 class="modal-title">{{ __('message.new_folder') }}</h4>
				<form action="{{route('supplier.create.folder')}}" method ="POST">
          			<div class="input_pp">
						@csrf
	          			<input type="text" name="foldername" id="foldername" class="form-control" placeholder="{{ __('message.folder_name') }}" autocomplete="off">
        			</div>
        			<div class="action_wrap">
						<div class="li_itm">
							<a href="javascript:void(0)" data-dismiss="modal" class="bg_btn view_btn">{{ __('message.Cancel') }}</a>
						</div>
						<div class="li_itm">
							<button type ="submit" class="bg_btn view_btn">{{ __('message.save') }}</button>
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
				<form action="{{route('suppler.upload.file')}}" method ="post" enctype="multipart/form-data">
					@csrf
					<input type="file" name="file" id="fileupload" class="d-none"/>
					<label for="fileupload" class="bg_btn view_btn btn_block" style ="width:100%;">{{ __('message.upload_file') }}</label>
					<!-- <a href="javascript:void(0)" >update file</a> -->
					<div class="attach_file">
						<label for="comp_logo_input" id="attach_doc">{{ __('message.attached_file') }}</label>
						<span><i class="fa fa-times float-right" id="remove_btn" aria-hidden="true"></i></span>
					</div>
					@error('file')
						<span class="text-danger"> {{ $message }} </span>
					@enderror
					<div class="step_one">
						<select  name="foldername" class="form-control selecttwodropdown" id="choose_folder" data-width="100%" data-minimum-results-for-search="Infinity">
							@foreach($directories as $directory)
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

<!-- Edit Folder -->
<div class="modal fade add_nw_fldr edit_folder" id="edit_folder_pop">
    <div class="modal-dialog modal-dialog-centered">
      	<div class="modal-content">
        	<!-- Modal body -->
        	<div class="modal-body">
        		<h4 class="modal-title">Edit Folder</h4>
				<form action="{{ route('supplier.rename.folder')}}" method ="post">
					@csrf
					<input type="hidden" name="directory" id="directoryName">
					<div class="input_pp">
						<input type="text" name="newname" id="address" class="form-control" placeholder="Folder name" autocomplete="off">
					</div>
					<div class="action_wrap">
						<div class="li_itm">
							<button type ="button" data-dismiss="modal" class="bg_btn view_btn">Cancel</button>
						</div>
						<div class="li_itm">
							<button type ="submit" class="bg_btn view_btn">Save</button>
						</div>
					</div>
				</form>
        	</div>
      	</div>
    </div>
</div>

<!-- delete folder modal -->
<div class="modal fade add_nw_fldr edit_folder" id="deletefoldermodal">
    <div class="modal-dialog modal-dialog-centered">
      	<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
        		<h4 class="modal-title">{{ __('message.delete') }} {{ __('message.folder') }}</h4>
				<form action="{{ route('supplier.delete.folder')}}" method ="post">
					@csrf
					<input type="hidden" name="dirname" id ="dirname" >
					<p> {{ __('message.message_delete_folder') }}</p>
					<div class="action_wrap">
						<div class="li_itm">
							<button type="button" class="btn btn-secondary bg_btn view_btn" data-dismiss="modal">{{ __('message.Cancel') }}</button>
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

@endsection

@section('script')
<script>
$(document).ready(function(){
    $('#fileupload').change(function(){
        $('#attach_doc').text(this.files[0].name);
    });

    $('#remove_btn').click(function(){
        $("#fileupload").val(null);
        $('#attach_doc').text('Attached field')
    });

    $('.editfolderbtn').click(function(e){
        e.preventDefault();
        let value = $(this).attr('data-value');
        $('#edit_folder_pop').modal('show');
        $('#directoryName').val(value);
    });

    $('.deletefolderbtn').click(function(e){
        e.preventDefault();
        let value = $(this).attr('data-value');
        $('#deletefoldermodal').modal('show');
        $('#dirname').val(value);
    });

});
</script>
<script>
    $(document).ready(function(){
       $('.addans').click(function(){
          var id= $(this).attr('data-value');
          $('#quesbody'+id).toggle('show');
       });
       $('.question_detail').click(function(){
          var id= $(this).attr('data-value');
          $('#sqdetails'+id).toggle('show');
       });
    });
</script>

{{-- answers chart --}}
<script>
@if($qPermission->q_status ==1)
    const chartdata = {
        @if($qPermission->q_status ==0)
            labels: ['Answer','Observation','Attcahc Doc' ,'No Apply'],
        @elseif($qPermission->q_level ==0)
            labels: ['Answer','Observation','Attcahc Doc' ,'No Apply'],
        @elseif($qPermission->q_apply_or_not ==0)
            labels: ['Answer','Observation','Attcahc Doc' ,'No Apply'],
        @else
            labels: ['Answer','Observation','Attcahc Doc' ,'No Apply'],
        @endif

        datasets: [{
            data: [{{$perAnswer}},{{$perObservation}},{{$perAttachDoc}},{{$perApplyAnswer}}],
            backgroundColor: [
                'rgb(60, 179, 113)',
                'rgb(255, 99, 132)',
                'rgb(30, 172, 170)',
                'rgb(221, 99, 75)',
            ],
            hoverOffset: 4
        }],
    };
@endif
const chartconfig = {
    type: 'polarArea',
    data: chartdata,
    option:{
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
		labels: ['Real','Ideal'],
		datasets: [{
			data: [{{$realresult}},{{$ideasresult}}],
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
		option:{
			responsive: true,
			 plugins: {
				legend: {
					position: 'top',
				},
			}
		},
	};
	var sectionid = document.getElementById('answerpiechart');
	var myChart = new Chart(idealvsreal, piechartconfig);
</script>
@endsection
