@extends('admin.layouts.app')

@section('title','Client List') 

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Client List')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Client List')}}</a></li>
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
                                    <a href="{{ route('admin.client.create') }}" class ="mb-6 btn-floating waves-effect waves-light red accent-2 tooltipped" data-tooltip="{{ __('message.Create Client')}}">  <i class="material-icons">add</i></a>
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
                                                        <th> {{ __('message.Client Name')}}</th>
                                                        <th> {{ __('message.Client Email')}} </th>
                                                        <th> {{ __('message.Job Title')}}</th>
                                                        <th> {{ __('message.Join Date')}} </th>
                                                        <th> {{ __('message.Action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php  $i =1 ;@endphp
                                                    @foreach($userlists as $userlist)
                                                    <tr>
                                                        <td> {{ $i++ }}</td>
                                                        <td> {{ $userlist->first_name }}  {{ $userlist->last_name }}</td>
                                                        <td> {{ $userlist->email }}</td>
                                                        <td> {{ $userlist->job_title }}</td>
                                                        <td> {{date("d M, Y",strtotime($userlist->created_at))}} </td>
                                                        <td>
                                                            <!-- @if($userlist->status == 1)
                                                            <a href="{{ route('admin.change.status',['status'=>'block','id'=>$userlist->id])}}" 
                                                                                        class ="btn btn-danger" data-placement="bottom" data-toggle="tooltip" title="{{ __('message.Block Client') }} " >
                                                                <i class ="fa fa-ban"></i>
                                                            </a>
                                                                                    @elseif($userlist->status == 0)
                                                                <a href="{{ route('admin.change.status',['status'=>'unblock','id'=>$userlist->id])}}" 
                                                                                        class ="btn btn-primary" data-placement="bottom" data-toggle="tooltip" title="{{ __('message.Unblock Client') }}" >
                                                            <i class ="fa fa-unlock"></i>
                                                            </a>
                                                                                    @endif -->
                                                            <a data-position="bottom" data-tooltip="{{__('message.View Supplier List')}}" href="{{ route('admin.client.supplier.list', $userlist->id)}}" class ="mb-6 btn-floating waves-effect waves-light cyan tooltipped"> 
                                                                <i class="material-icons">visibility</i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Client Name')}}</th>
                                                        <th> {{ __('message.Client Email')}} </th>
                                                        <th> {{ __('message.Job Title')}}</th>
                                                        <th> {{ __('message.Join Date')}} </th>
                                                        <th> {{ __('message.Action')}}</th>
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