@extends('supplier.layouts.app')

@section('content')
    <div class="global_box"> {{ status() }}
        {{ __('message.You are logged in!') }}</div>
@endsection
