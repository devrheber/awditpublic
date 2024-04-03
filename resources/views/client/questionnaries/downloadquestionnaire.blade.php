
<div class="observation question_wp">
   <div class="latest_cl">
      <div class="sm_title">Questions</div>
      <div class="folder_wr">
         @php
            $i=1;
            $questions = $questionnaire->questionsname($questionnaire->questions);

         @endphp
         @foreach($questions as $question)
            <div class="card">
               <div class="card-header bg-info text-white">
                  <h3 class="float-left">{{$i++}}. {{$question->name}}</h3>
                     <div id ="sqdetails{{$question->id}}">
                        <br>
                           <p> <strong>Question based on : </strong>{{ $question->based_on}} </p>
                           <p><strong>Objective : </strong>{{$question->objective}}</p>
                           <p><strong>Requeriment :</strong>
                              @foreach($question->questionrequirement as $requirement)
                                 @if ($loop->last) {{$requirement->requirements}} @else{{$requirement->requirements}},@endif
                              @endforeach
                     </div>
               </div>
               @php
                  $answer = getAnswerData($supplier,$questionnaire->id,$question->id,$location);
               @endphp
               @if($answer)
                     <div class="card-body">

                        <table class="table">
                           <tr>
                              <th> Answer Type: </th>
                              <td> @if($answer->apply == 1)
                                 No Apply
                              @else
                                 @if($answer->answer_type ==1 ) Yes @else No @endif
                              @endif</td>
                              <th> Observation:</th>
                              <td>{{$answer->observation}} </td>
                              @if($answer->answer_attach_doc_id != NUll)
                              <th>Attach File:</th>
                              <td><label for="lb1"><a href="{{ asset('document/supplier/answers').'/'.$answer->answerAttachDoc->attach_doc}}"> {{ $answer->answerAttachDoc->attach_doc}}</a></label></td>
                           @endif
                           </tr>
                        </table>
                     </div>
                  @else
                  <div class="card-body showcardbody" style="display:none" id="quesbody{{$question->id}}">
                     <strong>Answer Submit :</strong>  No
                        <div class="check_option">
                           <label class="checkbox_ps">
                              <div class="checkbx">
                                 <input type="radio" value="1" name ="answer_type" checked>
                                 <span class="checkmark"></span> Yes
                              </div>
                           </label>
                           <label class="checkbox_ps">
                              <div class="checkbx">
                                 <input type="radio" value ="0" name="answer_type">
                                 <span class="checkmark"></span> No
                              </div>
                           </label>
                           <label class="checkbox_ps">
                              <div class="checkbx">
                                 <input type="checkbox"  name="no_apply">
                                 <span class="checkmark"></span> No Apply
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
                  </div>
               @endif

            </div>
            <br>
         @endforeach
      </div>
   </div>
</div>
