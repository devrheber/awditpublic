@extends('supplier.layouts.app')

@section('title','sent invitation details')
@section('content')
    <div style="padding-left: 80px">
        <div class="global_wrapper">
            <x-view-profile-edit-card title="{{ __('message.assinged_questionniares') }}" dataTarget="" :showBorderBottom="false" class="no-padding" noIconOrButton="true"
                                      extraClasses="justify-content-between w-100 flex-wrap">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            @if($assignQuestionnaires->count()>0)
                                <table class="table datatable">
                                    <thead class="bg-info text-light">
                                    <tr>
                                        <th> No.</th>
                                        <th> Questionnaires Name</th>
                                        <th> Total Question </th>
                                        <th> Location Name </th>
                                        <th> Answer Status </th>
                                        <th> Approval Status </th>
                                        <th> Assigned Date </th>

                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($assignQuestionnaires as $questionnaire)
                                        <tr>
                                            <td> {{ $i++ }}</td>
                                            <td> {{ $questionnaire->questionnaire->name}}</td>
                                            <td> {{ count(explode(',',$questionnaire->questionnaire->questions))}}</td>
                                            <td> {{ $questionnaire->location->location_name}}</td>
                                            <td> {{ checkAnsStatus($questionnaire->answer_status) }}</td>
                                            <td> {{ ansApprovalStatus($questionnaire->is_approved)}}</td>
                                            <td> {{ date('d-M-Y',strtotime($questionnaire->created_at))}}</td>
                                            <td> <a href="{{route('supplier.questionary.details',$questionnaire->id)}}" class="btn btn-info text-light"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center"> No any questionnaires assigned.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </x-view-profile-edit-card>
        </div>
    </div>
@endsection
