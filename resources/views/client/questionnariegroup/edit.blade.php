@extends('layouts.app')

@section('title','Edit questionnarie Group')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('message.Edit Questionnarie Group') }}</div>

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
                    <form action="{{ route('client.questionnariegroup.update',$questionnaries->id)}}" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>{{ __('message.Questionnaries Group Name')}}</label>
                            <input type="text" id ="group_name" name ="group_name" class="form-control @error('group_name') is-invalid @enderror" value ="{{ $questionnaries->group_name }}" placeholder="Enter the questionnarie name">
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
