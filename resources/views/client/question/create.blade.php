@extends('layouts.app')

@section('title','Create question')

@section('content')

<div class="create_question_page">
    <div class="question_sec">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="head_bg">
                    <h4><i class="fa fa-plus" aria-hidden="true"></i> {{ __('message.add_new_question') }}</h4>
                    {{status()}}
                    {{-- <div class="alert alert-success d-none" id ="successmsg"></div> --}}
                </div>

                <form action="{{ route('client.question.store')}}" method ="POST">
                    @csrf
                    <input type="hidden" name ="qid" value ={{$qid}}>
                    <div class="latest_cl">
                        <div class="sm_title">{{ __('message.new_question') }}</div>
                            <div class="input_pp">
                                <input type="text" id ="question" required name ="question" class="form-control @error('question') is-invalid @enderror" value ="{{@old('question')}}" placeholder="{{ __('message.question') }}" autocomplete="off" >
                                @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input_pp">
                                <input type="text" id ="observation" required name ="observation" class="form-control @error('observation') is-invalid @enderror" value ="{{@old('observation')}}"  placeholder="{{ __('message.observations') }}" autocomplete="off">
                                @error('observation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input_pp">
                                <input type="text" id ="based_on" required  name ="based_on" class="form-control @error('based_on') is-invalid @enderror" value ="{{@old('based_on')}}" placeholder="{{ __('message.question_based_on') }}" autocomplete="off">
                                @error('based_on')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="input_pp">
                                <input type="text" id ="objective" required  name ="objective" class="form-control @error('objective') is-invalid @enderror" value ="{{@old('objective')}}" placeholder="{{ __('message.objective') }}" autocomplete="off">
                                @error('objective')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input_pp">
                                <input type="text" id ="requirements"  required name ="requirements[]" class="form-control @error('requirements') is-invalid @enderror" value= "{{ old('requirements.0')}}" placeholder="{{ __('message.requirement') }}" autocomplete="off">
                                @error('requirements`')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="add_new_requirements"></div>

                            <a href="javascript:void(0)" class="link add_rqrm_btn requirements_btn" ><i class="fa fa-plus" aria-hidden="true"></i> {{ __('message.add_requirement') }}</a>

                            <div class="no_apply">
                                <label class="checkbox_ps">
                                    <div class="checkbx">
                                    <input type="checkbox" name ="apply">
                                    <span class="checkmark"></span> {{ __('message.no_apply') }}
                                    </div>
                                </label>

                            </div>
                            <br>
                            <p>{{ __('message.message_question_answer') }}</p>
                            <br>
                            <div class="row">
                                <div class="col-12 mb-2 step_one">
                                    <select name="question_value" class="form-control select2_pp" data-width="100%" data-minimum-results-for-search="Infinity">
                                        @foreach($questionvalue as $qvalue)
                                            <option value="{{ $qvalue->id }}">{{ $qvalue->value}}({{$qvalue->description}})</option>
                                        @endforeach
                                    </select>
                                    @error('question_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 step_one">
                                    <select  id ="question_group" name="question_group"  class="form-control select2_pp"  data-minimum-results-for-search="Infinity" placeholder=" ">
                                        <option>{{ __('message.group') }}</option>
                                        @foreach($questiongroup as $qgroup)
                                            <option value="{{ $qgroup->id }}">{{ $qgroup->group_name}}</option>
                                        @endforeach
                                        <option value="new"> {{ __('message.add_new_group') }}</option>
                                    </select>
                                    @error('question_group')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="group_wrp">
                                <div class="step_one">

                                </div>
                                <div class="step_one">

                                </div>
                            </div>
                            <div class="action_wrap">
                                <div class="li_itm">
                                    <a role="button" href="{{route('client.questionnarie.edit',$qid)}}" class="bg_btn view_btn">{{ __('message.back') }}</a>
                                </div>
                                <div class="li_itm">
                                    <button type="submit" class="bg_btn view_btn">{{ __('message.add') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Add New Group -->
<div class="modal fade add_nw_fldr add_nw_group" id="add_nw_group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
            <h4 class="modal-title">New Group</h4>
            <form action="{{route('client.questionnariegroup.store')}}" id ="group_form" method="post">
                @csrf
                <div class="input_pp">
                    <input type="text" class="form-control" id ="group_name" name ="group_name" placeholder= "Add group name..." autocomplete="off">
                </div>
                <div class="text-danger"id ="group_name_error"></div>
                <div class="action_wrap">
                    <div class="li_itm">
                            <a href="javascript:void(0)" id="cle_group_btn" data-dismiss="modal" class="bg_btn view_btn">Cancel</a>
                    </div>
                    <div class="li_itm">

                        <button type="text" class="bg_btn view_btn">Save</button>
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
    $('#question_group').on('change',function(){
        if($(this).val() =="new")
        {
            $('#add_nw_group').modal('show');
        }
    });
    $('.requirements_btn').on('click',function(){

        var string = '<div class="input_pp">'+
                        '<input type="text" id ="requirements" name ="requirements[]" class="form-control" placeholder="Enter the Question requirements" autocomplete="off">'+
                    '</div>';
        $('.add_new_requirements').append(string);

    });
    $('#group_form').submit(function(e){
        e.preventDefault();
        var action = $(this).attr('action');
        var name = $('#group_name').val();
        $.ajax({
            type :"POST",
            url : action,
            data:{
                "_token":"{{ csrf_token()}}",
                "group_name":name,
            },
            success:function(data){

                if(data.success ==1)
                {
                    $('#successmsg').text(data.message);
                }
                $('#add_nw_group').modal('hide');
                $('#successmsg').removeClass('d-none');
                var string = '<option value="'+ data.data.id+'">'+data.data.group_name+'</option>';
                $('#question_group').append(string);
            },
            error:function(data)
            {
                console.log(data.responseJSON);
                var error = data.responseJSON.errors.group_name[0];
                $('#group_name_error').text(error);
                $('#add_nw_group').modal('show');

            }

        });
    });
   $('#cle_group_btn').click(function(e){
       e.preventDefault();
    $('#group_form').trigger('reset');
    $('#group_name_error').text("");
    $('#add_nw_group').modal('hide');

   });
});
</script>

<script type="text/javascript">
@error('group_name')
$(document).ready(function(){
    $('#add_nw_group').modal('show');
});
@enderror
</script>

@endsection


