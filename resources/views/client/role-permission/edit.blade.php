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
              <li class="breadcrumb-item active">Role</li>
            </ol>
          </div>
        </div>
      </div>
</section>

{{ status() }}
  <div class="card">
    <div class="card-header">
      <h5 class ="float-left"> Edit Role</h5>
      <a href="{{route('roles.index')}}" class ="btn btn-primary float-right">back to Role</a>
    </div>
    <div class="card-body register-card-body">
      <form method="POST" action="{{ route('roles.update',$role->id) }}">
        @csrf
        @method('PUT')
          <div class="form-group">
            <label for="coupon">Role Name:</label>
            <input type="text" name ="name"id ="name" class="form-control" placeholder ="Enter the Role Name" value ={{$role->name}}>
            @error('name')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Permission </th>
                <th>All <input type="checkbox" name ="all" class="all" id="all"> </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($permissions as $permission)
              <tr>
                <td> {{ $permission->name}}</td>
                <td>
                  <input type="checkbox" class ="permission" id="{{ $permission->id }}" @foreach($rolehaspermission as $rolepermission) @if($rolepermission->permission_id == $permission->id) checked @endif @endforeach  name="permission[]" value="{{$permission->id}}">
                </td>		
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="form-group">
            <button class ="btn btn-primary" type="submit"> update</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>  
$(document).ready(function(){
  $(".all").change(function() {
		  $(".permission").prop( "checked", $(this).prop('checked'));
  });
});
</script>
@endsection
