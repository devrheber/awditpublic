@extends('supplier.layouts.app')

@section('title','List of Location') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message.Location Data') }}
                    <a href="{{ route('supplier.location.create')}}" class ="btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="Create Location"> 
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
                                <th> {{ __('message.Location Name')}}</th>
                                <th> {{ __('message.Address')}} </th>
                                <th> {{ __('message.Location Category')}}</th>
                                <th> {{ __('message.Location Size')}}</th>
                                <th> {{ __('message.Maturity Level')}}</th>
                                <th> {{ __('message.Security Department')}}</th>   
                                <th> {{ __('message.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  
                                $i =1 ; 
                                $data;
                            @endphp
                            @foreach($locations as $location)
                            <tr>
                                <td> {{ $i++ }}</td>
                                <td> {{ $location->location_name}}</td>
                                <td> {{ $location->getFullAddress()}} </td>
                                <td> {{ $location->category->title}}</td>
                                <td> {{ $location->size->value}}</td>
                                <td> 
                                    {{ $location->locationmaturity->level_name }}
                                </td>
                                <td> @if($location->security ==1) Yes @else No @endif  </td>
                                <td>
                                    <a href="{{ route('supplier.location.edit' ,$location->id)}}" class ="btn btn-primary"
                                        data-toggle="tooltip" data-placement="bottom" title="Edit Location"
                                    >
                                        <i class ="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('supplier.location.delete',$location->id)}}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class ="btn btn-danger"
                                            data-toggle="tooltip" data-placement="bottom" title="Delete Location"
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
