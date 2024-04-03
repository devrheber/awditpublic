@extends('admin.layouts.app')   

@section('title','List roles')

@section('content')
<div class="row">
   <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
      <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
         <div class="container">
            <div class="row">
               <div class="col s10 m6 l6">
                  <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('Permisssion')}}</span></h5>
                  <ol class="breadcrumbs mb-0">
                     <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('roles.index')}}">{{__('Roles')}}</a></li>
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
                                                     <th> {{ __('Serial Number')}} </th>
                                                     <th> {{ __('Permission Name')}}</th>
                                                     <th> {{ __('Permission Status')}}</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 @php  $i =1 ;@endphp
                                                 @foreach($permissions as $permission)
                                                 <tr>
                                                     <td> {{ $i++ }}</td>
                                                     <td> {{ $permission->name }} </td>
                                                     <td> @if($permission->status == 1)  Active  @else Inactive @endif </td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                             <tfoot>
                                                <tr>
                                                   <th> {{ __('Serial Number')}} </th>
                                                   <th> {{ __('Permission Name')}}</th>
                                                   <th> {{ __('permission Status')}}</th>
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
</div>

@endsection