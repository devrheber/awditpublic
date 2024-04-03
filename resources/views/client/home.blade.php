@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header dash_main_title">{{ __('message.Dashboard') }}</div>

                <div class="card-body">
                    {{ status() }}
                    {{ __('message.You are logged in!') }}
                </div>
            </div>
            <div class="client_dashboard_set">
                <div class="row">
                    <div class="col-md-3">
                        <a href="#">
                            <div class="dash_box_set">
                                <div class="left_dash_box">
                                    <i class="fa fa-user"></i>
                                    <p>Clients</p>
                                </div>
                                <div class="right_dash_box">
                                    <span>0</span>
                                    <p>New</p>
                                    <p>10</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="dash_box_set">
                                <div class="left_dash_box">
                                    <i class="fa fa-users"></i>
                                    <p>{{ __('message.suppliers') }}</p>
                                </div>
                                <div class="right_dash_box">
                                    <span>{{ $suppliers->where('created_at',date('d-m-y'))->count()}}</span>
                                    <p>New</p>
                                    <p>{{ $suppliers->count()}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="dash_box_set">
                                <div class="left_dash_box">
                                    <i class="fa fa-list"></i>
                                    <p>Questionaries</p>
                                </div>
                                <div class="right_dash_box">
                                    <span>{{ $questionnaire->where('created_at',date('d-m-y'))->count() }}</span>
                                    <p>Growth</p>
                                    <p>{{ $questionnaire->count()}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#">
                            <div class="dash_box_set">
                                <div class="left_dash_box">
                                    <i class="fa fa-map-marker"></i>
                                    <p>Location</p>
                                </div>
                                <div class="right_dash_box">
                                    <span>0</span>
                                    <p>Today</p>
                                    <p>{{ $location->count()}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
