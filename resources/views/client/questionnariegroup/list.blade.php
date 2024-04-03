@extends('layouts.app')

@section('title','Questionnarie Group List') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message.Questionnarie Data') }}
                    <a href="{{ route('client.questionnariegroup.create')}}" class ="btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('message.Create Questionnarie Group')}}"> 
                        <i class="fa fa-plus"></i> 
                    </a>
                </div>
                <div class ="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> {{ __('message.Serial Number')}} </th>
                                <th> {{ __('message.Group Name')}}</th>
                                <th> {{ __('message.Total Questionnarie')}} </th>
                                <th> {{ __('message.Status')}} </th>
                                <th> {{ __('message.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  
                                $i =1 ; 
                                $data;
                            @endphp
                            @foreach($questionnaries as $questionnary)
                            <tr>
                                <td> {{ $i++ }}</td>
                                <td> {{ $questionnary->group_name}} </td>
                                <td> {{ $questionnary->name}} </td>
                                <td>  @if($questionnary->status == 1 ) Yes @else  No @endif</td>
                                <td>
                                    <a href="{{ route('client.questionnariegroup.edit',$questionnary->id)}}" class ="btn btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title=" {{ __('message.Edit Questionnarie Group')}}">
                                            <i class ="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('client.questionnarie.index')}}" class ="btn btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title="{{ __('message.Add QUestionnaries')}}">
                                            <i class ="fa fa-plus"></i>    
                                    </a>
                                    <form action ="{{ route('client.questionnariegroup.delete', $questionnary->id )}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class ="btn btn-danger" 
                                            data-toggle="tooltip" data-placement="bottom" title="{{ __('message.Delete Questionnarie Group')}}"
                                            onclick=" return confirm('are you sure to delete this record..??')">
                                            <i class ="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection
