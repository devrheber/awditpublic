@extends('admin.layouts.app')   

@section('title','Create Company')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Create Company')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.client.list')}}">{{__('message.Client List')}}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Create Client')}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div id="input-fields" class="card card-tabs">
                            <div class="card-content">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col s12 m6 l10">
                                            <h4 class="card-title">{{ __('message.Create Client') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                @if (session('success'))
                                <div class="card-alert card gradient-45deg-green-teal">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">check</i> 
                                            SUCCESS : {{ session('success')}}.
                                        </p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="card-alert card gradient-45deg-red-pink">
                                    <div class="card-content white-text">
                                        <p>
                                            <i class="material-icons">error</i> 
                                            DANGER : {{ session('error')}}
                                        </p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                <div id="view-input-fields">
                                    <div class="row">
                                        <div class="col s12">
                                            <form action="{{ route('admin.client.store') }}" method="post">
                                                @csrf
                                                <div class="col s12">
                                                    <div class="input-field col s12">
														<label for="username"> {{ __('message.UserName') }} </label>
														<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus>
														@error('username')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
                                                    </div>
                                                </div>

												<div class="col s12">
                                                    <div class="input-field col s12">
														<label for="email"> {{ __('message.E-Mail Address') }} </label>
														<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
														@error('email')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>
												</div>

												<div class="col s12">
                                                    <div class="input-field col s12">
														<label for="password"> {{ __('message.Password') }} </label>
														<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
														@error('password')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
                                                        
                                                    </div>
                                                </div>
												<div class="col s12">
                                                    <div class="input-field col s12">
														<label for="password-confirm"> {{ __('message.Confirm Password') }} </label>
														<input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary "> {{ __('message.Register') }} </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
