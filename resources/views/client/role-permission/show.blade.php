@extends('layouts.app')   

@section('title','Role-permission')

@section('content')
<div claas="container">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h2>Role</h2>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Show Rolee</li>
            </ol>
          </div>
        </div>
      </div>
</section>
  <div class="card">
    <div class="card-header r">
          <h5 class="float-left"> Pemission of {{ $roles->name}}</h5>
          <a href="{{route('roles.index')}}" class ="btn btn-primary float-right">back to Role</a>
    </div>  
    <div class="card-body register-card-body">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Permission</th>
            <th> Allow</th>
          </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
        <tr>
          <td> {{ $permission->name}}</td>
          <td>
            <div class="form-check float-left">
              @foreach($rolehaspermission as $rolepermission)
                @if($rolepermission->permission_id == $permission->id)  
                <i class="fa fa-check" style ="color:green" aria-hidden="true"></i>
                @endif 
              @endforeach
            </div>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
