@extends('layouts.app')

@section('title','Create questionnarie Group')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('message.Create Questionnarie Group') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success')}}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('success')}}
                        </div>
                    @endif
                    <form action="{{ route('client.questionnariegroup.store')}}" method ="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('message.Questionnarie Group Name')}}</label>
                            <input type="text" id ="group_name" name ="group_name" class="form-control @error('group_name') is-invalid @enderror" value ="{{@old('group_name')}}" placeholder="Enter the questionnarie group name">
                            @error('group_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div><button type="submit" class="btn btn-primary"> {{ __('message.Submit')}} </button>
                    </form>
                        
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('script')

@endsection
