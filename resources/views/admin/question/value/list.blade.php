@extends('admin.layouts.app')

@section('title','Question Value List ') 

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Question Value')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Question Value')}}</a></li>
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
                                    <a href="{{ route('admin.questionvalue.create') }}" class ="mb-6 btn-floating waves-effect waves-light red accent-2 tooltipped" data-tooltip="{{ __('message.Add Question Value')}}">  <i class="material-icons">add</i></a>
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
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Question Value')}}</th>
                                                        <th> {{ __('message.Description')}}</th>
                                                        <th> {{ __('message.Status')}} </th>
                                                        <th> {{ __('message.Created Date')}}</th>
                                                        <th> {{ __('message.Action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php  $i =1 ;@endphp
                                                    @foreach($questionvalues as $qvalue)
                                                    <tr>
                                                        <td> {{ $i++ }}</td>
                                                        <td> {{ $qvalue->value }}  </td>
                                                        <td> {{ $qvalue->description}}</td>
                                                        <td> @if($qvalue->status == 1)  Active  @else Inactive @endif </td>
                                                        <td> {{date("d M, Y",strtotime($qvalue->created_at))}} </td>
                                                        <td>
                                                            <a href="{{ route('admin.questionvalue.edit',$qvalue->id) }}" class ="mb-6 btn-floating waves-effect waves-light cyan tooltipped" data-tooltip="{{ __('message.Edit Question Value')}}" >
                                                                <i class="material-icons">edit</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Question Value')}}</th>
                                                        <th> {{ __('message.Description')}}</th>
                                                        <th> {{ __('message.Status')}} </th>
                                                        <th> {{ __('message.Created Date')}}</th>
                                                        <th> {{ __('message.Action')}}</th>
                                                    </tr>
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
