@extends('layouts.app')   

@section('title','Role-permission')

@section('content')
<div class="container">
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
         <h2>Role</h2>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Role</li>
            </ol>
          </div>
        </div>
      </div>
</section>
@if(session('status'))
<div class="alert alert-success"id ="messagediv" role="alert"> 
  {{ session('status') }}
</div>
@endif
@can('create role')
<a href ="{{ route('roles.create')}}" class="btn btn-primary" > Create Role</a>    
@endcan    
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>user Id</th> 
        <th>user's Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @php $i=1;@endphp
      @foreach($roles as $role)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$role->name}}</td>
          <td>
            <a href="{{route('roles.show', $role->id)}}" data-toggle="tooltip" data-placement="bottom" title ="Show roles" class="mr-3 float-left btn btn-secondary">
              <i class="fa fa-eye"></i>
            </a>
            {{-- @if($role->name == "client" || $role->id == 1 ) 
            @else --}}
            {{-- @can('update role') --}}
            <a href="{{route('roles.edit', $role->id ) }}"  data-toggle="tooltip" data-placement="bottom" title ="Edit user role" class="mr-3 float-left btn btn-primary">
               <i class="fa fa-pencil"></i>
            </a>
            {{-- @endcan --}}
            {{-- @can('delete role') --}}
            <form  class ="float-left" action="{{ route('roles.destroy', $role->id )}}" method= "POST">
              @csrf 
              @method('DELETE')
              <button type="submit" data-toggle="tooltip" onclick="return confirm('are you sure, you want to delete...?')" data-placement="bottom" title = "delete user role" id ="deleterole" name ="{{$role->id}}" class="btn btn-danger" data-toggle="modal" data-target="#deleteuserrole">
                <i class="fa fa-trash"></i>
              </button>
            </form>
            {{-- @endcan --}}
            {{-- @endif --}}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>  
  </div>
  </div>

  <div class="modal fade" id="adduserrole"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter The Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text"  id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter the name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group ">
              <table class="table table-striped">
               
                  @foreach($permissions as $peram)
                    <tr>
                      <td>
                        <input type="checkbox" name="rolename[]"  value="{{$peram->id}}" >
                     </td>
                     <td>
                      {{$peram->name}}
                     </td>
                    </tr>
                  @endforeach
                
              </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success ">Add</button>
    </form>
      </div>
    </div>
  </div>

@endsection