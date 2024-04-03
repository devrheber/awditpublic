@extends('admin.layouts.app')

@section('title','Company Maturity list') 

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Company Maturity')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Company Maturity List')}}</a></li>
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
                                    <a href="{{ route('admin.maturity.create') }}" class ="mb-6 btn-floating waves-effect waves-light red accent-2 tooltipped" data-tooltip="{{ __('message.Add Maturity')}}">  <i class="material-icons">add</i></a>
                                    @if(session()->has('success'))
                                    <div class="card-alert card gradient-45deg-green-teal">
                                        <div class="card-content white-text">
                                            <p>
                                                <i class="material-icons">check</i> 
                                                SUCCESS : {{ session('success')}}.
                                            </p>
                                        </div>
                                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="scroll-vert-hor" class="display nowrap dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Matutity Name')}} </th>
                                                        <td>{{ __('message.Matutity Description')}}</td>
                                                        <th> {{ __('message.Created By')}} </th>
                                                        <th> {{ __('message.Created Date')}} </th>
                                                        <th> {{ __('message.Action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php  $i =1 ;@endphp
                                                    @foreach($maturitylists as $list)
                                                    <tr>
                                                        <td> {{ $i++ }}</td>
                                                        <td> {{ $list->level_name }}</td>
                                                        <th> {{ $list->description }}</th>
                                                        <td> {{ $list->creator->username }}</td>
                                                        <td> {{date("d M, Y",strtotime($list->created_at))}} </td>
                                                        <td>
                                                            <a href="{{ route('admin.maturity.edit',$list->id) }}" class ="mb-6 btn-floating waves-effect waves-light cyan tooltipped" data-tooltip="{{ __('message.Edit Company Maturity')}}" >
                                                            <i class="material-icons">edit</i>
                                                            </a>
                                                            <form id ="delete-form" action="{{ route('admin.maturity.delete', $list->id)}}" method ="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class ="mb-6 btn-floating waves-effect waves-light red accent-2 tooltipped" data-tooltip="{{ __('message.Delete Maturity')}}"
                                                                    onclick="confirm('are you sure to delete this record..??')">
                                                                    <i class="material-icons">delete</i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> {{ __('message.Serial Number')}} </th>
                                                        <th> {{ __('message.Matutity Name')}} </th>
                                                        <td>{{ __('message.Matutity Description')}}</td>
                                                        <th> {{ __('message.Created By')}} </th>
                                                        <th> {{ __('message.Created Date')}} </th>
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
