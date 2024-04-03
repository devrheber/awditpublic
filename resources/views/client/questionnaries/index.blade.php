@extends('layouts.app')
@section('title', 'Questionnarie List')
@section('content')
    <div style="padding-left: 80px">
        <div class="global_wrapper">
            <div class="supplier-info-wrapper questionnaire-main">
                <x-title-section title='APPS' section="{{ __('message.questionnaires') }}" subtitle="{{ __('message.questionnaires') }}" />
                {{-- filter header disply start --}}
                @include('client.filter_header')
                {{-- filter header disply end --}}
                {{-- filter output section start --}}
                <br>
                {{-- filter output section end --}}
                <div class="w-100">
                    {{-- variable section start --}}
                    <x-view-profile-edit-card title="" dataTarget="" :showBorderBottom="false" noIconOrButton="true"
                        extraClasses="justify-content-between w-100  flex-wrap">
                        <div class="col-lg-3 col-md-6 col-sm-12 mt-2 mb-2">
                            <x-suppliers-mini-card title="{{ __('message.questionnaire') }}s" icon="questionnaires" color="#3BD0AC"
                                value="{{ $totalmosmif->count() }}">
                            </x-suppliers-mini-card>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                            <x-suppliers-mini-card title="{{ __('message.pending') }}" icon="pending" color="#F7AC00" value="{{ $checkToPending->count() }}">
                            </x-suppliers-mini-card>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                            <x-suppliers-mini-card title="{{ __('message.questionnaire') }}s" icon="questionnaires" color="#0384FF"
                                value="{{ round($totalCompletedMosmif) }}%">
                            </x-suppliers-mini-card>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
                            <x-suppliers-mini-card title="{{ __('message.no_apply') }}" icon="no apply" color="#F95800" value="{{ round($totalpernoapply) }}%">
                            </x-suppliers-mini-card>
                        </div>
                    </x-view-profile-edit-card>
                    {{-- variable section end --}}
                    {{-- chart section  start --}}
                    <div class="row left_info_graph">
                        <div class="col-md-6">
                            <div class="legend-container">
                                <div class=""></div>
                                <div class="legends">
                                    <x-legend-circle color="#61CD00" text="{{ __('message.high') }}" />
                                    <x-legend-circle color="#2ABDFE" text="{{ __('message.normal') }}" />
                                    <x-legend-circle color="#F6AC00" text="{{ __('message.low') }}" />
                                    <x-legend-circle color="#DB1B1C" text="{{ __('message.no_done') }}" />
                                </div>
                            </div>
                            <div class="inner_summary_graph " style="padding: 5rem">
                                <canvas id="answerpiechart"> </canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="legend-container">
                                <div class=""></div>
                                <div class="legends">
                                    <x-legend-circle color="#3BD1AC" text='real' />
                                    <x-legend-circle color="#2ABDFE" text='ideal' />
                                </div>
                            </div>
                            <div class="inner_summary_graph " style="padding: 5rem">
                                <canvas id="idealvsreal"> </canvas>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="new_que_chart1">
                                <canvas id="idealvsreal"> </canvas>
                            </div>
                        </div> --}}
                    </div>
                    {{-- chart section end --}}
                    {{-- check pening section section start --}}
                    <x-view-profile-edit-card title="{{ __('message.last_pending_check') }}" dataTarget="" :showBorderBottom="false"
                        class="no-padding" noIconOrButton="true" id="last-peding-check">
                        @can('read supplier')
                            <table class="table   pr-0 pl-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">{{ __('message.supplier') }}</th>
                                        <th scope="col">{{ __('message.location') }}</th>
                                        <th scope="col">{{ __('message.new') }}</th>
                                        <th scope="col">{{ __('message.level') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @if ($checkToPending->count() === 0)
                                        <tr>
                                            <td colspan="7">No data available</td>
                                        </tr>
                                    @else
                                        @foreach ($checkToPending as $pendingData)
                                            <tr>
                                                <td class="align-middle"> {{ $i++ }}</td>
                                                <td class="align-middle"> {{ $pendingData->receiver->getSupplierFullName() }}
                                                </td>
                                                <td class="align-middle"> {{ $pendingData->location->location_name }}</td>
                                                <td class="align-middle">
                                                    {{ date('d F Y', strtotime($pendingData->updated_at)) }}</td>
                                                <td class="align-middle"> </td>
                                                <td class="align-middle"> </td>
                                                <td class="align-middle">
                                                    <div class="li_itm">
                                                        <a href="{{ route('client.show.questionary', $pendingData->id) }}"
                                                            class="bg_btn view_btn">{{ __("message.view") }}</a>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="checkbx">
                                                        <input type="checkbox" class="listcheckbox"
                                                            value="{{ $pendingData->id }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endcan
                    </x-view-profile-edit-card>
                    {{-- check pending section end --}}
                    {{-- answer details chart section start --}}
                    <br>
                    <div class="w-100">
                        <div class="legend-container">
                            <div class="title">{{ __('message.location') }} vs {{ __('message.Status') }}</div>
                            <div class="legends">
                                <x-legend-circle color="#FB5700" text="{{ __('message.answers') }}" />
                                <x-legend-circle color="#5CA7F5" text='attach doc' />
                                <x-legend-circle color="#F6AC00" text='correct attach doc' />
                                <x-legend-circle color="#3BD1AC" text='observation' />
                            </div>
                        </div>
                        <div class="chart_rw">
                            <div class="questionary_data_wrap">
                                <div class="inner_questionary_data">
                                    <div class="row justify-content-between w-100 pl-4 pr-2">
                                        <div class="col-md-2 col-sm-2 col-6">
                                            <div class="inner_size_locate questionnaire_inner_size_locate">
                                                <p>correct answers</p>
                                                <h3 style="color:#FB5700 !important">{{ round($per_correct_ans) }}%</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-6">
                                            <div class="inner_size_locate questionnaire_inner_size_locate">
                                                <p>attached docs</p>
                                                <h3 style="color:#5CA7F5 !important">{{ round($per_attach_doc) }}%</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-6">
                                            <div class="inner_size_locate questionnaire_inner_size_locate"
                                                style="width: 180px">
                                                <p>correct attached docs</p>
                                                <h3 style="color:#F6AC00 !important">{{ round($per_correct_attach_doc) }}%
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-6">
                                            <div class="inner_size_locate questionnaire_inner_size_locate">
                                                <p>observations</p>
                                                <h3 style="color:#3BD1AC !important">{{ round($per_observation) }}%</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-view-profile-edit-card title='ALL QUESTIONNAIRES' dataTarget="" :showBorderBottom="false"
                        class="no-padding" noIconOrButton="true">
                        @can('read supplier')
                            <table class="table pr-0 pl-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">SUPPLIER</th>
                                        <th scope="col">LOCATION</th>
                                        <th scope="col">QUESTIONNAIRE</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">CREATED DATE</th>
                                        <th scope="col">MODIFY DATE</th>
                                        <th scope="col">LEVEL</th>
                                        <th scope="col">APPLY</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @if ($ansQuestionnaires->count() === 0)
                                        <tr>
                                            <td colspan="7">No data available</td>
                                        </tr>
                                    @else
                                        @foreach ($ansQuestionnaires as $questionary)
                                <tbody>
                                    <td class="align-middle">{{ $i++ }}</td>
                                    <td class="align-middle">{{ $questionary->receiver->getSupplierFullName() }}</td>
                                    <td class="align-middle"> {{ $questionary->location->location_name }} </td>
                                    <td class="align-middle"> {{ $questionary->questionnaire->name }}</td>
                                    <td class="align-middle">
                                        <div
                                            style="border-radius:1rem"class="
                                        @if ($questionary->answer_status == 1) bg-success
                                        @else
                                            bg-danger @endif text-white text-center">
                                            @if ($questionary->answer_status == 1)
                                                COMPLETED
                                            @else
                                                INACTIVE
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle"> {{ date('d M Y', strtotime($questionary->created_at)) }} </td>
                                    <td class="align-middle"> {{ date('d M Y', strtotime($questionary->updated_at)) }}</td>
                                    <td class="align-middle">{{ $questionary->questionnaire_value }}</td>
                                    <td class="align-middle">
                                        @if ($questionary->is_applied == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('client.download.questionnaire', ['sid' => $questionary->supplier_id, 'lid' => $questionary->location->id, 'qid' => $questionary->questionnaire->id]) }}"
                                            class="btn btn-change-password .btn-download d-flex align-items-center mr-2"
                                            style=" border: 2px solid #007bff;">
                                            <i class="fa fa-cloud-download text-primary"></i>
                                            <span class="text-primary">DOWNLOAD</span>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('client.supplier.details', $questionary->supplier_id) }}"
                                            class="btn btn-change-password d-flex align-items-center ml-2"
                                            style="border: 2px solid #61CE00;">
                                            <i class="fa fa-eye text-success"></i>
                                            <span class="text-success">VIEW</span>
                                        </a>
                                    </td>

                                </tbody>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        @endcan
                    </x-view-profile-edit-card>
                    {{-- answer details chart section end --}}
                    {{-- answered questionnaires section start  --}}

                    {{-- answered questionnaires section end --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- Answer data chart start --}}
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: 'Answers',
                        data: [
                            @foreach ($answers as $md)
                                {{ $md }},
                            @endforeach
                        ],
                        backgroundColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                '#FB5700',
                            @endfor
                        ],
                        borderColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                'rgba(255, 99, 132, 1)',
                            @endfor
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Attach Docs',
                        data: [
                            @foreach ($attachdoc as $md)
                                {{ $md }},
                            @endforeach
                        ],
                        backgroundColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                '#5CA7F5',
                            @endfor
                        ],
                        borderColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                'rgba(54, 162, 235, 1)',
                            @endfor
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'correct Attach Doc',
                        data: [
                            @foreach ($correctattachdoc as $md)
                                {{ $md }},
                            @endforeach
                        ],
                        backgroundColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                '#F6AC00',
                            @endfor
                        ],
                        borderColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                'rgba(255, 206, 86, 1)',
                            @endfor
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Observation',
                        data: [
                            @foreach ($observation as $md)
                                {{ $md }},
                            @endforeach
                        ],
                        backgroundColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                '#3BD1AC',
                            @endfor
                        ],
                        borderColor: [
                            @for ($i = 1; $i <= 12; $i++)
                                'rgba(75, 192, 192, 1)',
                            @endfor
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
    {{-- Answer data chart section end --}}
    {{-- paie chart answer value section start --}}
    <script>
        const data = {
            labels: ['High', 'Normal', 'Low', 'Not done'],
            datasets: [{
                label: 'My First Dataset',
{{--                data: [{{ $high->count() }}, {{ $mid->count() }}, {{ $low->count() }}, {{ $not->count() }}],--}}
                data: [20, 12, 12, 12],
                backgroundColor: [
                    'rgb(60, 179, 113)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
                legend: {
                    display: false
                },
                plugins: {
                    title: {
                        display: false,
                        position: "bottom"
                    }
                }
            }
        };
        var chart = document.getElementById('answerpiechart');
        var myChart = new Chart(chart, config);
        console.log(myChart)
    </script>
    {{-- paie chart answer value section end --}}
    {{-- pie chart ideal vas real section start --}}
    <script>
        const chartdata = {
            labels: ['Ideal', 'Real'],
            datasets: [{
                data: [10, 30],
                backgroundColor: [
                    '#2ABDFE',
                    '#3BD1AC',
                ],
                hoverOffset: 4
            }],
        };
        const chartconfig = {
            type: 'doughnut',
            data: chartdata,
            options: {
                cutoutPercentage: 70,
                legend: {
                    display: false
                },
                plugins: {
                    title: {
                        display: false,
                        Position: "bottom",
                    }
                }
            },
        };
        var piechart = document.getElementById('idealvsreal');
        var myChart = new Chart(piechart, chartconfig);
    </script>
    {{-- pie chart ideal vas real section start --}}
    {{-- jquery of this page start --}}
    <script>
        $(document).ready(function() {
            $('#allcheckpending').click(function() {
                $(".listcheckbox").prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    {{-- jquery of this page end --}}
@endsection
