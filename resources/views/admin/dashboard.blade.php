@extends('admin.layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __('message.Dashboard') }}</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">{{__('message.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('message.Dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="card-stats" class="pt-0">
    <div class="row">
        <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">perm_identity</i>
                            <p>Clients</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$client->where('created_at',date('d-m-y'))->count()}}</h5>
                            <p class="no-margin">New</p>
                            <p>{{ $client->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">people_outline</i>
                            <p>Suppliers</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$supplier->where('created_at',date('d-m-y'))->count()}}</h5>
                            <p class="no-margin">New</p>
                            <p>{{ $supplier->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">question_answer</i>
                            <p>Questionnarie</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$questionnarie->where('created_at',date('d-m-y'))->count()}}</h5>
                            <p class="no-margin">Growth</p>
                            <p>{{ $questionnarie->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                <div class="padding-4">
                    <div class="row">
                        <div class="col s7 m7">
                            <i class="material-icons background-round mt-5">location_on</i>
                            <p>Location</p>
                        </div>
                        <div class="col s5 m5 right-align">
                            <h5 class="mb-0 white-text">{{$location->where('created_at',date('d-m-y'))->count()}}</h5>
                            <p class="no-margin">Today</p>
                            <p>{{ $location->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Responsive Table</h4>
                    <div class="row">
                        <div class="col s12">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th data-field="id">Name</th>
                                        <th data-field="name">Item Name</th>
                                        <th data-field="price">Item Price</th>
                                        <th data-field="total">Total</th>
                                        <th data-field="status">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                        <td>$1.87</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                        <td>$1.87</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                        <td>$1.87</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                        <td>$1.87</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Alvin</td>
                                        <td>Eclair</td>
                                        <td>$0.87</td>
                                        <td>$1.87</td>
                                        <td>Yes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>                    -->
@endsection
