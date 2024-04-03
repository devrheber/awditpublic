@extends('layouts.app')

@section('title','Edit Pending Client')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5> Edit Pending client Role</h5>
        </div>
        <div class="card-body register-card-body">
            <form action="{{ route('client.update.pending.client',$pendingclient->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{$pendingclient->email}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_userrole">Select Role:</label>
                            <select class="form-control selecttwodropdown" name="role" id="edit_userrole">
                            @foreach ($userroles as $role)
                                <option value="{{ $role->id}}" @if($pendingclient->user_role_id == $role->id)selected @endif> {{ $role->name}} </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary brand-secondary-color">submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection