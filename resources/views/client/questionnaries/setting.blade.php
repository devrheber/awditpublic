@extends('layouts.app')

@section('title','questionnarie setting')

@section('content')

<div class="container">
   @if($qpermission!= NULL)
   {{ status()}}
   <div class="row que_setting_pg_new mb-4" >
      <div class="col-md-4">
         <form action="{{ route('client.questionnaire.store.setting')}}" method="post">
            @csrf
            <div class="left_que_setting_pg_new">
               <input type="hidden" name="questionary_id" value="{{$questionnaire->id}}">
               <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
               <div class="row">
                  <div class="col-md-9">
                     <span><strong>status</strong></span>
                     <p> if you disable this option, the following option automatically disabled. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox"  name ="status" id ="status" @if($questionnaire->status == 1) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>
                  <div class="col-md-9 status" >
                     <span>Status %  </span>
                     <p> Shows/hides the status of the questionnaire:% of answered questions,% attached documents and% of observations. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name ="q_status" id="q_status" @if($questionnaire->quePermission->q_status == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 status">
                     <span> Level</span>
                     <p> Shows/hides the level obtained by the supplier after completing the questionnaire and reviewed by the client. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_level"  id="level" @if($questionnaire->quePermission->q_level == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 status">
                     <span> Apply/No apply</span>
                     <p> Shows/hide whether o not the questionnaire applies to the provider (information chosen by the customer). </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_apply_or_not"  id="applyornot" @if($questionnaire->quePermission->q_apply_or_not == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-9">
                     <span><strong>Results</strong></span>
                     <p> if you disable this option, the following option automatically disabled. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_results" id="results" @if($qpermission->q_results == 1) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>
                  <div class="col-md-9 results">
                     <span>Questions</span>
                     <p> Shows/hide the preview of the questions once the questionnaire has been completed by the provider. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_questions" id="questions" @if($questionnaire->quePermission->q_questions == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 results">
                     <span> Answer </span>
                     <p> Shows/hide the preview of the answers once the questionnaire has been completed by the provider. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_answers" id="answer" @if($questionnaire->quePermission->q_answers == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 results">
                     <span> Doc. Attached and observations </span>
                     <p>  Shows/hide the attached documents and observations added in the questionnaire by the client. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_docs" id="docs" @if($questionnaire->quePermission->q_docs == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 results">
                     <span> Acces to doc. Attached </span>
                     <p> Shows/hide access to attached documents by the client. (requires the previous point to be active). </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_access_doc" id="accessdoc" @if($questionnaire->quePermission->q_access_doc == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-9">
                     <span><strong>Other files</strong></span>
                     <p> if you disable this option, the following option automatically disabled. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_other_file" id="otherfile" @if($questionnaire->quePermission->q_other_file == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 otherfile">
                     <span> Add and edit folders </span>
                     <p> Shows/hide the option to add and edit folders in the section. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_add_edit_folder" id="addeditfolder" @if($questionnaire->quePermission->q_add_edit_folder == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 otherfile">
                     <span> Add file </span>
                     <p> Shows/hide the option to add files in the section. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_add_file" id="addfile" @if($questionnaire->quePermission->q_add_file == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>

                  <div class="col-md-9 otherfile">
                     <span> Download files </span>
                     <p> Shows/hide the option to download files in the section. </p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_download_fie" id="download" @if($questionnaire->quePermission->q_download_fie == 1 ) checked @endif>
                        <span class="slider round"></span>
                      </label>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-9">
                     <span><strong>Observations</strong></span>
                     <p> Shows/hide added observations.</p>
                  </div>
                  <div class="col-md-3">
                     <label class="switch">
                        <input type="checkbox" name="q_observation" @if($questionnaire->quePermission->q_observation == 1 ) checked @endif id="observation">
                        <span class="slider round"></span>
                      </label>
                  </div>
               </div>
            </div>
      </div>

      <div class="col-md-8 ">
            <div class="right_que_setting_pg_new">
               <!-- graph details start -->
               <div class="row left_info_graph ">
                  <div class="col-md-6 status_section @if($qpermission->status==0) d-none @endif">
                     <figure class="pie-chart">
                        <h2>High</h2>
                        <figcaption>
                           % status<span style="color:#ffc850"></span><br>
                           % level<span style="color:#ef5350"></span><br>
                           % apply or not<span style="color:#b03459"></span>
                        </figcaption>
                     </figure>
                  </div>
                  <div class="col-md-6 result_section @if($qpermission->q_results==0) d-none @endif">
                     <figure class="pie-chart1">
                        <figcaption>
                           Ideal<span style="color:#ffc850"></span><br>
                           Real<span style="color:#ef5350"></span>
                        </figcaption>
                     </figure>
                  </div>
               </div>
               <!-- graph details end -->

               <!-- questionnaires approval section start -->
               <div class="observation question_wp question_section @if($qpermission->q_questions==0) d-none @endif">
                  <div class="latest_cl">
                     <div class="sm_title">Questions</div>
                     <div class="folder_wr">
                        <div class="fld_list d-flex">
                           <table class ="table" >
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                        <div class="observation_section answer_section @if($qpermission->q_answers==0) d-none @endif">
                           <div class="attach_file bg ">
                              <label style="width: 100%;"> answers </label>
                           </div>
                        </div>
                        <div class="observation_section doc_section @if($qpermission->q_docs==0) d-none @endif">
                           <div class="attach_file bg ">
                              <label style="width: 100%;"> Doc. Attached and observations </label>
                           </div>
                        </div>
                        <div class="observation_section doc_ob_section @if($qpermission->q_access_doc==0) d-none @endif">
                           <div class="attach_file bg ">
                              <label style="width: 100%;"> Acces to doc. Attached </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- questionnaires section end -->

               <!--  directory and file  section start-->
               <div class="add_fold_sec folder_section @if($qpermission->q_other_file==0) d-none @endif">
                  <div class="latest_cl">
                     <div class="sm_title">Other Files</div>
                     <div class="add_head d-flex justify-content-space">
                     <a href="javascript:void(0)" class="bg_btn view_btn add_fold_btn"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                        <a href="javascript:void(0)" class="all_down_txt download_section ">All download <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                     </div>
                     <div class="folder_pop add_fold_bx" style="display: none;">
                        <a href="javascript:void(0)" data-toggle="modal" class="add_folder_section @if($qpermission->q_add_edit_folder==0) d-none @endif" data-target="#add_nw_fldr">Folder</a>
                        <a href="javascript:void(0)" data-toggle="modal" class="file_section @if($qpermission->q_add_file==0) d-none @endif" data-target="#new_file_pop">File</a>
                     </div>
                     <div class="folder_wr">

                        <div class="fld_list d-flex justify-content-space">
                           <a href="javascript:void(0)" class="fld_name"><i class="fa fa-plus" aria-hidden="true"></i> directory name </a>
                           <div class="rgt">
                              <a href="#" class="all_down_txt download_section @if($qpermission->q_download_fie==0) d-none @endif">All download <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                              <a href="javascript:void(0)" class="dots dot_btn"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                              <div class="folder_pop dot_pop_bx" style="display: none;">
                                    <a href="javascript:void(0)" data-value ="#" class="editfolderbtn" >Edit</a>
                                    <a href="#"  data-value ="#" class="deletefolderbtn" > Delete</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- directories and file section end -->

               <!-- Observation section start-->
               <div class="observation ob_section @if($qpermission->q_observation==0) d-none @endif">
                  <div class="latest_cl">
                     <div class="sm_title">Observations</div>
                        <div class="folder_wr">
                           results            <div class="fld_list d-flex">
                              <a href="javascript:void(0)" class="fld_name user_name">full name </a>
                              <a href="javascript:void(0)" class="fld_name crd"> date</a>
                              <a href="javascript:void(0)" class="fld_name tm">time</a>
                           <div class="txt">observation</div>
                        </div>
                     </div>
                     <div class="input_pp">
                        <input type="text" id="address" class="form-control" placeholder="Write text...." autocomplete="off">
                        <span class="search_btn_wrp">
                           <button href="javascript:void(0)" class="bg_btn view_btn" type ="button">Send</button>
                        </span>
                     </div>
                  </div>
               </div>

               <!-- observation section end -->

               <br>
               <div class="row">
                  <div class="col-md-2 offset-md-10">
                     <button class="btn btn-info" type="submit"> save </button>
                  </div>
               </div>

            </div>
         </form>
      </div>
   </div>
   @else
      <div class="text-danger justify-center">
         {{ $questionnaire->name }}  is not assign to anyone.
      </div>
   @endif()
</div>

@endsection

@section('script')
<script>
$(document).ready(function(){
   $('#status').on('change',function(){
      if(this.checked == false){
         $('.status').css('color','gray');
         $(this).prop('checked', this.checked);
         $('#q_status').attr("disabled", 'disabled').prop('checked', this.checked);
         $('#level').attr("disabled", 'disabled').prop('checked', this.checked);
         $('#applyornot').attr("disabled", 'disabled').prop('checked', this.checked);
      }
      else
      {
         $('.status').css('color','black');
         $(this).prop('checked', this.checked);
         $('#q_status').removeAttr("disabled", 'disabled').prop('checked', this.checked);
         $('#level').removeAttr("disabled", 'disabled').prop('checked', this.checked);
         $('#applyornot').removeAttr("disabled", 'disabled').prop('checked', this.checked);
      }
   });

   $('#results').on('change',function(){
      if(this.checked == false){
         $('.results').css('color','gray');
         $(this).prop('checked', this.checked);
         $('#questions').prop('checked', this.checked).attr("disabled", 'disabled');
         $('#answer').prop('checked', this.checked).attr("disabled", 'disabled');
         $('#docs').prop('checked', this.checked).attr("disabled", 'disabled');
         $('#accessdoc').prop('checked', this.checked).attr("disabled", 'disabled');
      }
      else
      {
         $('.results').css('color','black');
         $(this).prop('checked', this.checked);
         $('#questions').prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#answer').prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#docs').prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#accessdoc').prop('checked', this.checked).removeAttr("disabled", 'disabled');
      }
   });
   $('#otherfile').on('change',function(){
      if(this.checked == false){
         $('.otherfile').css('color','gray');
         $(this).prop('checked', this.checked);
         $('#addeditfolder').prop('checked', this.checked).attr("disabled", 'disabled');
         $('#addfile').prop('checked', this.checked).attr("disabled", 'disabled');
         $('#download').prop('checked', this.checked).attr("disabled", 'disabled');
      }
      else
      {
         $('.otherfile').css('color','black');
         $(this).prop('checked', this.checked);
         $(this).prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#addeditfolder').prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#addfile').prop('checked', this.checked).removeAttr("disabled", 'disabled');
         $('#download').prop('checked', this.checked).removeAttr("disabled", 'disabled')  ;
      }
   });


   $('#observation, #answer, #status, #q_status, #level, #applyornot, #results, #questions, #docs, #accessdoc, #otherfile, #addeditfolder, #addfile, #download').on('change',function(){
      var permission_name = $(this).attr('name');
      if($(this).prop('checked') == true){
         var value= 1;
      }else{
         var value= 0;
      }
      var qid = "{{$questionnaire->id}}";
      var action = "{{route('client.questionnaire.change.status',':id')}}";
      action= action.replace(':id',qid);
      $.ajax({
         type :"post",
         url :action,
         data:{
            '_token':"{{csrf_token()}}",
            'permission':permission_name,
            'value':value,
         },
         success:function(response){
            console.log(response.data);
            if(response.success == 1)
            {
               if(response.data.status == 1){
                  $('.status_section').removeClass('d-none');
               }else{
                  $('.status_section').addClass('d-none');
               }
               if(response.data.q_status == 1){
                  $('.ob_section').removeClass('d-none');
               }else{
                  $('.ob_section').addClass('d-none');
               }
               if(response.data.q_level == 1){
                  $('.ob_section').removeClass('d-none');
               }else{
                  $('.ob_section').addClass('d-none');
               }
               if(response.data.q_apply_or_not	 == 1){
                  $('.ob_section').removeClass('d-none');
               }else{
                  $('.ob_section').addClass('d-none');
               }
               if(response.data.q_results == 1){
                  $('.result_section').removeClass('d-none');
               }else{
                  $('.result_section').addClass('d-none');
               }
               if(response.data.q_questions == 1){
                  $('.question_section').removeClass('d-none');
               }else{
                  $('.question_section').addClass('d-none');
               }
               if(response.data.q_answers == 1){
                  $('.answer_section').removeClass('d-none');
               }else{
                  $('.answer_section').addClass('d-none');
               }
               if(response.data.q_docs	 == 1){
                  $('.doc_section').removeClass('d-none');
               }else{
                  $('.doc_section').addClass('d-none');
               }
               if(response.data.q_access_doc == 1){
                  $('.doc_ob_section').removeClass('d-none');
               }else{
                  $('.doc_ob_section').addClass('d-none');
               }
               if(response.data.q_other_file == 1){
                  $('.folder_section').removeClass('d-none');
               }else{
                  $('.folder_section').addClass('d-none');
               }
               if(response.data.q_add_edit_folder == 1){
                  $('.add_folder_section').removeClass('d-none');
               }else{
                  $('.add_folder_section').addClass('d-none');
               }
               if(response.data.q_add_file == 1){
                  $('.file_section').removeClass('d-none');
               }else{
                  $('.file_section').addClass('d-none');
               }
               if(response.data.q_download_fie == 1){
                  $('.download_section').removeClass('d-none');
               }else{
                  $('.download_section').addClass('d-none');
               }
               if(response.data.q_observation == 1){
                  $('.ob_section').removeClass('d-none');
               }else{
                  $('.ob_section').addClass('d-none');
               }
            }
         },
      });
   });
});
</script>
@endsection
