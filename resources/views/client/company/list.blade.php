@extends('layouts.app')

@section('title','List Company') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message.Company Data') }}</div>
                <div class ="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($companies->count()>0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> {{ __('message.Company Name')}}</th>
                                <th> {{ __('message.CIF')}} </th>
                                <th> {{ __('message.Address')}} </th>
                                <th> {{ __('message.Company Sector')}}</th>
                                <th> {{ __('message.Company Size')}}</th>
                                <th> {{ __('message.Maturity Level')}}</th>
                                <th> {{ __('message.Security Department')}}</th>   
                                <th> {{ __('message.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach($companies as $company)
                            <tr>
                                
                                <td> {{ $company->name}}</td>
                                <td> {{ $company->cif}}</td>
                                <td> {{ $company->getFullAddress()}}</td>
                                <td>
                                    @foreach($company->companySector as $comsector)
                                       {{ $comsector->title }}
                                    @endforeach
                                    
                                <td> {{ $company->companySize->value }}</td>
                                <td> {{ $company->companyMaturity->level_name }}</td>
                                <td>  @if($company->security_department == 1 ) Yes @else  No @endif</td>
                                <td>
                                    <a href="{{ route('client.company.edit',$company->id)}}" class ="btn btn-primary "><i class ="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        {{ __('message.Company data are not avilable.')}}
                        <a href=""></a>
                        {{ __('message.To Create new Company Data')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection
