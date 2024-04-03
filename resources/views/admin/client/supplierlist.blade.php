@extends('admin.layouts.app')

@section('title','Supplier List') 

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Supplier List')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Supplier List')}}</a></li>
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
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Supplier Name')}}</th>
                                                        <th> {{ __('message.Supplier Email')}} </th>
                                                        <th> {{ __('message.Job Title')}}</th>
                                                        <th> {{ __('message.Join Date')}} </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php  $i =1 ;@endphp
                                                    @foreach($supplierlists as $supplier)
                                                    <tr>
                                                        <td> {{ $i++ }}</td>
                                                        <td> {{ $supplier->getSupplierFullName()}}</td>
                                                        <td> {{ $supplier->email }}</td>
                                                        <td> {{ $supplier->job_title }}</td>
                                                        <td> {{date("d M, Y",strtotime($supplier->created_at))}} </td> 
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Supplier Name')}}</th>
                                                        <th> {{ __('message.Supplier Email')}} </th>
                                                        <th> {{ __('message.Job Title')}}</th>
                                                        <th> {{ __('message.Join Date')}} </th>
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

