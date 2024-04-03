@extends('admin.layouts.app')

@section('title','Questionnaire List') 

@section('content')

<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Question Value')}}</span></h5>
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
                                                        <th>Country Name</th>
                                                        <th>Short Name</th>
                                                        <th>Phone Code</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach($countries as $country)
                                                      <tr>
                                                         <td>{{$country->name}}</td>
                                                         <td>{{$country->sortname}} </td>
                                                         <td>{{$country->phonecode}}</td>
                                                         <td></td>
                                                      </tr>
                                                   @endforeach
                                                </tbody>
                                                <tfoot>
                                                   <tr>
                                                      <th>Country Name</th>
                                                      <th>Short Name</th>
                                                      <th>Phone Code</th>
                                                      <th>Action</th>
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
