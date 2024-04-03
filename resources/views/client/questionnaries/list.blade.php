@extends('layouts.app')

@section('title','view questionnarie')
@section('css')
<style>
.fa-cog,
.fa-eye,
.fa-download{
   background: #2D2A78;
   padding: 10px;
   border-radius: 10px;
   color: #fff;
}
</style>
@endsection

@section('content')
<div class="container">
   <div class="row view_profile_table">
      <div class="col-md-12">
         <h2>All MoSMiF</h2>
      </div>
   </div>
   <div class="row view_profile_table_inner">
      <div class="col-md-12">
         @if($questionnaires->count() > 0)
         <table class="table datatable" >
            <thead>
               <tr>
                  <th scope="col">Questionnaire Title</th>
                  <th scope="col">Total Question </th>
                  <th scope="col">created By</th>
                  <th scope="col">created Date</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
            @foreach($questionnaires as $questionary)
               <tr>
                  <td>{{$questionary->name}}</td>
                  <td>{{ count(explode(',',$questionary  ->questions))}}</td>
                  <td>{{$questionary->user->full_name}}</td>
                  <td>{{date('Y-m-d',strtotime($questionary->created_at))}}</td>
                  <td>
                     <a href="{{ route('client.questionnarie.show',$questionary->id)}}" title="View"><i class="fa fa-eye"></i></a>
                     <a href="{{ route('client.questionnarie.edit',$questionary->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                     <a href="{{ route('client.questionnaire.setting',$questionary->id)}}" titl="Setting"><i class="fa fa-cog"></i></a>
                     <a href="{{ route('client.import.questionnaire',$questionary->id)}}" title="Import"><i class="fa fa-download"></i></a>
                     <a href="{{ route('client.questionnarie.delete',$questionary->id)}}" onclick="return confirm('are you sure to delete this questionnaire...??')" class="cancel_question">
                        <i class="fa fa-trash"></i>
                     </a>
                  </td>
               </tr>
            @endforeach
            </tbody>
         </table>
         @else
            No any pending client role is available
         @endif
      </div>
   </div>
</div

@endsection
