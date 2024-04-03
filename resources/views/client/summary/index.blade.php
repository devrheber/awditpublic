@extends('layouts.app')

@section('title', 'Summary')

@section('content')
    <div style="padding-left: 75px">
        <div class="global_wrapper flex-grow-1">
            {{ status() }}
            <div class="row">
                <div class="col-md-8">
                    <x-title-section title='dashboard' section='summary' subtitle="{{ __('message.welcome_to_summary') }}" />

                </div>
                <div class="col-md-4 text-right">

                    <button type="button" class="btn btn-summary">
                        <i class="fa fa-envelope-o text-secondary"></i> Email
                    </button>

                    <!-- Botón 2 -->
                    <button type="button" class="btn btn-summary">
                        <i class="fa fa-print text-secondary"></i> {{ __('message.print') }}
                    </button>

                    <!-- Botón 3 -->
                    <button type="button" class="btn btn-generate-report btn-summary">
                        <i class="fa fa-file-text-o"></i> {{ __('message.generate_report') }}
                    </button>

                </div>
            </div>
            <div class="row d-flex align-items-stretch">
                <div class="col-md-8 flex-column">
                    <div class="row main_global_wrap">
                        <x-summary-cards color=#3bd1ac min="{{ intval($newquestionnaire) }}"
                            max="{{ intval($totalquestionnaire) }}" title="{{ __('message.new_messages') }}" href="/questionnaire#last-peding-check" />
                        <x-summary-cards icon="2" color=#29bdfc min="{{ intval($newclientticket) }}"
                            max="{{ intval($totalclientticket) }}" title="{{ __('message.new_responses') }}" href="/ticket/inbox" />
                        <x-summary-cards icon="4" color=#61cd00 min="{{ intval(62) }}" max="{{ intval(80) }}"
                            title="{{ __('message.pending_responses') }}" href="/invitation/sent" />

                        <x-summary-cards icon="3" color=#f6ac00 min="{{ intval($totalaccepted) }}"
                            max="{{ intval($invitation) }}" title="{{ __('message.accepted_invitations') }}" href="/invitation/sent" />
                        <x-summary-cards icon="5" color=#0284ff min="{{ intval($newsentinivitation) }}"
                            max="{{ intval($totalsentinivtation) }}" title="{{ __('message.invitations_time_out') }}" href="/invitation/sent" />
                        <x-summary-cards icon="6" color=#be1a1c min="{{ intval($newexpired) }}"
                            max="{{ intval($invitation) }}" title="{{ __('message.invitations_expired') }}" href="/invitation/expired" />
                    </div>
                </div>
                <div class="col-md-4 flex-column">
                    <div class="legend-container events-container text-left">
                        <div class="title">{{ __('message.next_events') }}</div>

                    </div>
                    <div class="events-list events-card ">
                        @if ($events->count() > 0)
                            @foreach ($events as $event)
                                <div class="row events-content align-items-center">
                                    <div class="col-md-3">
                                        <p>{{ date('d/m/Y', strtotime($event->start_date)) }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $event->event_name }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ date('h:i', strtotime($event->end_date)) }}</p>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="/event" class="btn btn-primary btn-circle"><i
                                                style="font-size: 12px " class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row events-header ">
                                <div class="col-md-3 col-sm-2">
                                    <p>{{ __('message.date') }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p>{{ __('message.event') }}</p>
                                </div>
                                <div class="col-md-3 col-sm-2">
                                    <p>{{ __('message.time') }}</p>
                                </div>
                                <div class="col-md-2 col-sm-2">

                                </div>
                            </div>
                            @php
                                $data = [
                                    'Event demo one' => ['datetime' => '2022-05-05 10:00:00'],
                                    'Event demo two' => ['datetime' => '2022-05-08 11:35:00'],
                                    'Event demo three' => ['datetime' => '2022-05-12 18:05:00'],
                                ];
                            @endphp

                            @foreach ($data as $eventName => $eventData)
                                <div class="row events-content align-items-center">
                                    <div class="col-md-3 col-sm-2">
                                        <p>{{ date('m/d/Y', strtotime($eventData['datetime'])) }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <p>{{ $eventName }}</p>
                                    </div>
                                    <div class="col-md-3 col-sm-2">
                                        <p>{{ date('h:i A', strtotime($eventData['datetime'])) }}</p>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <button type="button" class="btn btn-primary btn-circle"><i
                                                style="font-size: 12px " class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="legend-container">
                    <div class="title">{{ __('message.partner_suppliers') }}</div>
                    <div class="legends">
                        <x-legend-circle color="#3BD1AC" text="{{ __('message.total_suppliers') }}" />
                        <x-legend-circle color="#5CA7F6" text="{{ __('message.new_suppliers') }}" />
                    </div>
                </div>
                <div class="inner_summary_graph">
                    <div class="chart-container">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="legend-container events-container text-left">
                    <div class="title">{{ __('message.supplier_invitation_status') }}</div>
                </div>
                <div class="events-list">
                    @if ($events->count() > 0)
                        @foreach ($events as $event)
                            <div class="row">
                                <div class="col-md-4">
                                    <p>{{ date('d/m/Y', strtotime($event->start_date)) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>{{ $event->event_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>{{ date('h:i', strtotime($event->end_date)) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row events-header">
                            <div class="col-md-3 col-sm-2">
                                <p>{{ __('message.date') }}</p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <p>{{ __('message.accepted') }} / {{ __('message.sent') }}</p>
                            </div>
                            <div class="col-md-5 col-sm-4">
                                <p>% {{ __('message.accepted') }}</p>
                            </div>
                        </div>
                        @php
                            $data = [
                                'January' => ['accepted' => 1, 'send' => 10],
                                'February' => ['accepted' => 2, 'send' => 12],
                                'March' => ['accepted' => 18, 'send' => 20],
                                'April' => ['accepted' => 18, 'send' => 20],
                                'May' => ['accepted' => 8, 'send' => 21],
                                'June' => ['accepted' => 8, 'send' => 21],
                                'July' => ['accepted' => 8, 'send' => 21],
                                'August' => ['accepted' => 8, 'send' => 21],
                                'September' => ['accepted' => 8, 'send' => 21],
                                'October' => ['accepted' => 8, 'send' => 21],
                                'November' => ['accepted' => 8, 'send' => 21],
                                'December' => ['accepted' => 8, 'send' => 21],
                            ];
                        @endphp

                        @foreach ($data as $month => $values)
                            <div class="events-content supplier-invitation-status row align-items-center ">
                                <div class="col-md-3 col-sm-2">
                                    <p>{{ $month }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p>{{ $values['accepted'] }} / {{ $values['send'] }}</p>
                                </div>
                                <div class="col-md-5 col-sm-4">
                                    <p>{{ number_format($values['accepted'] / $values['send'], 2) }}%</p>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
        {{-- <div class="supplier_wrapper">
            <div class="row">
                <div class="col-md-8">

                </div>
                <div class="col-md-4 d-none">
                    <h2>Accepted VS Invited</h2>
                    <div class="row summary_graph_right">
                        <div class="col-md-4">
                            <h3>Total</h3>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ $totalaccepted }}/{{ $invitation }}</h3>
                        </div>
                        <div class="col-md-4">
                            <h3> {{ round($acceptedpersentage) }}%</h3>
                        </div>
                        @foreach ($totalinvitationlastsixmonth as $data)
                            @foreach ($totalacceptedlastsixmonth as $acceptdata)
                                @if ($data->monthname == $acceptdata->monthname)
                                    <div class="col-md-4">
                                        <h5>{{ $data->monthname }}</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            {{ $acceptdata->count }}/{{ $data->count }}
                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            @if ($data->count > 0)
                                                {{ round(($acceptdata->count * 100) / $data->count) }}%
                                            @else
                                                0%
                                            @endif
                                        </h5>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="questionary_data_wrap my-4">
            <div class="row">
                <div class="col-12">
                    <div class="legend-container">
                        <div class="title">MF: Total VS new</div>
                    </div>
                    <div class="inner_summary_graph">
                        <div class="chart-container">
                            <canvas id="chartdiv"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')

    <script>
        //  supplier chart
        var data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: " New Suppliers",
                    backgroundColor: [
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                    ],
                    borderColor: [
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                        '#5CA7F6',
                    ],
                    borderWidth: 4,
                    hoverBackgroundColor: "#9FC3F8",
                    hoverBorderColor: "#9FC3F8",
                    // data: [65, 59, 20, 81, 56, 55, 40, 78, 26, 21, 17, 24],
                    data: [
                        @foreach ($newquestionnaireofyear as $md)
                            {{ $md }},
                        @endforeach
                    ],
                }, {
                    label: "Total Supplier",
                    backgroundColor: [
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                    ],
                    borderColor: [
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                        '#3BD1AC',
                    ],

                    borderWidth: 4,
                    hoverBackgroundColor: "#80DFCA",
                    hoverBorderColor: "#80DFCA",
                    // data: [65, 59, 20, 81, 56, 55, 40, 78, 26, 21, 17, 24],
                    data: [
                        @foreach ($totalsuppliersofyear as $md)
                            {{ $md }},
                        @endforeach
                    ],

                },

            ]
        };

        var options = {
            maintainAspectRatio: false,

            scales: {
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "#deebec"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                ticks: {
                    beginAtZero: true, // Empieza en cero
                    max: 90, // Valor máximo del eje
                    stepSize: 10 // Incremento de 10 en 10
                },

            },
            legend: {
                display: false
            }
        };

        Chart.Bar('chart', {
            options: options,
            data: data
        });

        // chart div

        var data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "{{ __('message.total_questionnaires') }}",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 4,
                    hoverBackgroundColor: "#2D2A78",
                    hoverBorderColor: 'rgba(54, 162, 235, 0.5)',
                    // data: [65, 59, 20, 81, 56, 55, 40, 78, 26, 21, 17, 24],
                    data: [
                        @foreach ($totalquestionnaireofyear as $md)
                            {{ $md }},
                        @endforeach
                    ],

                },
                {
                    label: "{{ __('message.new_questionnaires') }}",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 4,
                    hoverBackgroundColor: "#2D2A78",
                    hoverBorderColor: 'rgba(60  , 180, 200, 1)',
                    // data: [65, 59, 20, 81, 56, 55, 40, 78, 26, 21, 17, 24],
                    data: [
                        @foreach ($newquestionnaireofyear as $md)
                            {{ $md }},
                        @endforeach
                    ],
                }
            ]
        };

        var options = {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    stacked: false,
                    gridLines: {
                        display: true,
                        color: "#deebec"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        };

        Chart.Bar('chartdiv', {
            options: options,
            data: data
        });
    </script>
@endsection
