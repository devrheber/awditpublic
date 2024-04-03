@extends('admin.layouts.app')

@section('title','Questionnaire List') 

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Questionnaire List</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#"></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                    <tr>
                                                        <th> {{ __('Questionnaire Name')}} </th>
                                                        <th> {{ __('Created By')}}</th>
                                                        <th> {{ __('created Date')}}</th>
                                                        <th> {{ __('message.Status')}} </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($questionnaires as $questionnaire)
                                                      <tr>
                                                         <td>{{$questionnaire->name}}</td>
                                                         <td>{{$questionnaire->user->full_name}}</td>
                                                         <td>{{$questionnaire->created_at}}</td>
                                                         <td>
                                                            @if($questionnaire->status == 1) 
                                                               Active
                                                            @else
                                                               Inactive
                                                            @endif
                                                         </td>
                                                         <td> 
                                                            <a href="{{ route('admin.questionnaire.details',$questionnaire->id) }}" class ="mb-6 btn-floating waves-effect waves-light cyan tooltipped" data-tooltip="{{ __('Questionnaire Details')}}" >
                                                               <i class="material-icons">eye</i>
                                                           </a>
                                                         </td>
                                                      </tr>
                                                   @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> {{ __('Questionnaire')}} </th>
                                                        <th> {{ __('Created By')}}</th>
                                                        <th> {{ __('Created Date')}}</th>
                                                        <th> {{ __('message.Status')}} </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="content-overlay"></div>
    </div>
</div>

@endsection
