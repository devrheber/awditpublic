@extends('layouts.app')

@section('title', 'event')

@section('css')
    <style>
        .event {
            background-color: #5FBA7D !important;
            color: #ffffff !important;
        }
    </style>
@endsection

@section('content')
    <div class="agenda_item_wrap">
        {{ status() }}
        <div class="row">
            <div class="col-md-4">
                <div class=" inner_left_agenda  global_box">

                    <div class="app">
                        <div class="app__main">
                            <div class="calendar">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    @can('create event')
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addevent">
				 	<i class="fa fa-plus"></i>New event
				</button> --}}
                    @endcan


                    <div class="event_type_set">
                        <br>


                        <span
                            style="text-transform: uppercase;
                    color: #b6b6b6;
                    font-size: 11px;">MY
                            CALENDAR</span>
                        <ul>
                            <li>
                                <span></span>
                                <p>Tiket almost expired + Ticket expired</p>
                            </li>
                            <li>
                                <span></span>
                                <p>Invitation time out + Invitation expired</p>
                            </li>
                            <li>
                                <span></span>
                                <p>Questionnaire reminder</p>
                            </li>
                            <li>
                                <span></span>
                                <p>My events</p>
                            </li>
                        </ul>
                        <br>
                        <span
                            style="text-transform: uppercase;
                color: #b6b6b6;
                font-size:  11px; ">UPCOMING
                            EVENTS</span>
                        <div class="mb-3"></div>
                        {{-- {{$events}} --}}
                        @foreach ($events as $event)
                            @php
                                $startDateTime = strtotime($event['start_date'] . ' ' . $event['start_time']);
                                $startDateTimeFormatted = date('F j Y, g:i:s A', $startDateTime);
                            @endphp
                            <div style="border-left: .3rem solid #61CD00;"class="d-flex flex-column pl-2 mb-3">
                                <div class="upcoming-event-name">{{ $event->event_name }}</div>
                                <div class="upcoming-event-date">{{ $startDateTimeFormatted }}</div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="message-right-container p-4" style="margin-left:371px; margin-right:25px">
                <div class="inner_right_agenda">
                    <x-title-section title='apps' section='Calendar' subtitle='Calendar' extraButton='true'
                        extraButtonIcon="fa fa-file-text-o" extraButtonName="ADD NEW INVITATION" dataTarget="#" />
                    <div class="calendar-events-dates">
                        <div class="calendar-events-dates-header">
                            <div class="calendar-button btn" id="previous_day"><i class="fa fa-chevron-left"></i></div>
                            <div class="calendar-button btn" id="next_day"><i class="fa fa-chevron-right"></i></div>
                            <div id="current_day" class="calendar-today btn ml-4">Today</div>
                            <div class="calendar-date ml-auto mr-auto">{{ $today }}</div>
                        </div>

                    </div>
                    <div class="calendar-events-dates">
                        @if ($todayevents->isEmpty())
                            <div class="row mt-2 align-items-center pr-2">
                                <div class="col-12">
                                    <p class="text-center">No events found.</p>
                                </div>
                            </div>
                        @else
                            @foreach ($todayevents as $event)
                                <?php
                                $startDateTime = strtotime($event['start_date'] . ' ' . $event['start_time']);
                                $endDateTime = strtotime($event['end_date'] . ' ' . $event['end_time']);
                                $dayOfMonth = date('d', $startDateTime);
                                $dayOfWeek = date('D', $startDateTime);

                                // Obtener la hora y los minutos en formato 12 horas
                                $starttime = date('h:i A', $startDateTime);
                                $endtime = date('h:i A', $endDateTime);
                                ?>
                                <div class="row mt-2 align-items-center pr-2">
                                    @if (!isset($shownDay) || $shownDay !== $dayOfMonth)
                                        <div class="col-2 p-0 m-0">
                                            <div class="event-day-month">{{ $dayOfMonth }}</div>
                                            <div class="event-day-week">{{ $dayOfWeek }}</div>
                                        </div>
                                        <?php $shownDay = $dayOfMonth; ?>
                                    @else
                                        <div class="col-2 p-0 m-0"></div>
                                    @endif
                                    <div class="col-10 event-details ">
                                        <div class="event-time-range"> {{ $starttime }} - {{ $endtime }}</div>
                                        <div class="even-name">{{ $event->event_name }}</div>
                                        <div class="even-content">{{ $event->content }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="row">


                    </div>

                    <div class="right_day_list_agenda" id="todayeventlist">

                        <ul id="todayevnets">
                            @forelse($todayevents as $event)
                                <li>
                                    <a class="viewevent" id="{{ $event->id }}">
                                        <span>{{ $event->start_time }}</span>
                                        <h4>{{ $event->event_name }}<p>
                                        </h4>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a herf=""><span> No Any Today Event </span></a>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--add event  Modal start -->
    <div class="modal fade" id="addevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('client.event.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="start_date" class="form-control datetimepicker-input"
                                    id="datetimepicker2" required placeholder="Select Start Date"
                                    data-toggle="datetimepicker" data-target="#datetimepicker2" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="end_date" class="form-control datetimepicker-input"
                                    id="datetimepicker3" required placeholder="Select End Date" data-toggle="datetimepicker"
                                    data-target="#datetimepicker3" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="start_time" class="form-control datetimepicker-input"
                                    id="datetimepicker4" required placeholder="Select Start Time"
                                    data-toggle="datetimepicker" data-target="#datetimepicker4" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="end_time" class="form-control datetimepicker-input"
                                    id="datetimepicker5" required placeholder="Select End Time"
                                    data-toggle="datetimepicker" data-target="#datetimepicker5" />
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" name="alldays" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">All Days</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="event_name" class="form-control" id="event-title"
                                    placeholder="Event Title" required>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="content" rows="5" class="content" id="exampleFormControlTextarea1"
                                    style="resize:none" placeholder="Write Text..." required></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal End -->


    <!-- view events modal start -->
    <div class="modal fade" id="viewmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            Event start :<p class="start_date"></p>
                            <p class="start_time">00:00</p>
                            Event end : <p class="end_date"></p>
                            <p class="end_time">00:00</p>
                            <h3 id="event_title">Event Title</h3>
                            <p id="eventdata">Event text...</p>
                        </div>
                        <div class="col-md-6">
                            @can('update event')
                                <a href="#" class="btn btn-primary editeventbtn">Edit</a>
                            @endcan
                            @can('delete event')
                                <a href="#" class="btn btn-primary deletebutton"
                                    onclick="return confirm('are you sure to delete this record..??')">Delete</a>
                            @endcan
                        </div>
                        <div class="col-md-12">
                            <button href="#" class="btn btn-primary lookat">Done</button>
                            <form>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remind me tomorrow</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--view events modal  end   -->


    <!-- edit modal start  -->
    <div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="edit-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="start_date"
                                    class="form-control datetimepicker-input edit_start_date" id="edit_start_date"
                                    required placeholder="Select Start Date" data-toggle="datetimepicker"
                                    data-target="#edit_start_date" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="end_date"
                                    class="form-control datetimepicker-input edit_end_date" id="edit_end_date" required
                                    placeholder="Select End Date" data-toggle="datetimepicker"
                                    data-target="#edit_end_date" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="start_time"
                                    class="form-control datetimepicker-input edit_start_time" id="edit_start_time"
                                    required placeholder="Select Start Time" data-toggle="datetimepicker"
                                    data-target="#edit_start_time" />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="end_time"
                                    class="form-control datetimepicker-input edit_end_time" id="edit_end_time" required
                                    placeholder="Select End Time" data-toggle="datetimepicker"
                                    data-target="#edit_end_time" />
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" name="alldays" class="form-check-input duration"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">All Days</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="event_name" class="form-control edit_event_title"
                                    id="event-title" placeholder="Event Title" required>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control edit_content" name="content" rows="5" style="resize:none"
                                    placeholder="Write Text..." required></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- edit modla end -->


    <!-- delete modal start  -->
    <div class="modal fade" id="deleteeventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    delete modal
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- delete modla end -->
@endsection

@section('script')

    <script type="text/javascript">
        var dateToday = new Date();
        $(function() {
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY/MM/DD',
                minDate: dateToday,
            });
            $('#datetimepicker3 ').datetimepicker({
                format: 'YYYY/MM/DD',
                minDate: dateToday,
            });
            $('#datetimepicker4').datetimepicker({
                format: 'HH:mm:ss'
            });
            $('#datetimepicker5').datetimepicker({
                format: 'HH:mm:ss'
            });
            $('#edit_start_date').datetimepicker({
                format: 'YYYY/MM/DD',
                minDate: dateToday,
            });
            $('#edit_end_date').datetimepicker({
                format: 'YYYY/MM/DD',
                minDate: dateToday,
            });
            $('#edit_start_time').datetimepicker({
                format: 'HH:mm:ss'
            });
            $('#edit_end_time').datetimepicker({
                format: 'HH:mm:ss'
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.viewevent').on('click', function() {
                var id = $(this).attr('id');
                var url = "{{ route('client.event.getdata', ':id') }}";
                url = url.replace(':id', id);
                var del = "{{ route('client.event.delete', ':id') }}";
                del = del.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(data) {
                        $('.start_date').text(data.start_date);
                        $('.start_time').text(data.start_time);
                        $('.end_date').text(data.end_date);
                        $('.end_time').text(data.end_time);
                        $('#event_title').text(data.event_name);
                        $('#eventdata').text(data.content);
                        $('.editeventbtn').attr('id', data.id);
                        $('.deletebutton').attr('href', del);
                        $('#viewmodel').modal('show');
                    },
                })
            });
            $('.editeventbtn').on('click', function() {
                var id = $(this).attr('id');
                var url = "{{ route('client.event.getdata', ':id') }}";
                url = url.replace(':id', id);
                var action = "{{ route('client.event.update', ':id') }}";
                action = action.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(data) {
                        $('#viewmodel').modal('hide');
                        $('.edit_start_date').val(data.start_date);
                        $('.edit_start_time').val(data.start_time);
                        $('.edit_end_date').val(data.end_date);
                        $('.edit_end_time').val(data.end_time);
                        $('.edit_event_title').val(data.event_name);
                        $('.edit_content').text(data.content);
                        if (data.duration == 1) {
                            $('.duration').prop('checked', true);
                        }
                        $('#edit-form').attr('action', action);
                        $('#editeventmodal').modal('show');
                    },
                })
            });


            $('#calendar').datepicker({
                todayHighlight: true,
                weekStart: 0,
                beforeShowDay: function(date) {
                    var highlight = "{{ $today }}";
                    if (highlight) {
                        return [true, "event", 'Tooltip text'];
                    } else {
                        return [true, '', ''];
                    }
                }
            }).on({
                'changeDate': function(e) {
                    var milliseconds = Date.parse(e.date);
                    var date = new Date(milliseconds).format("yyyy-mm-dd");
                    $.ajax({
                        type: "POST",
                        url: "{{ url('event/today') }}",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'date': date,
                        },
                        success: function(res) {
                            url = "{{ route('client.get.event', ':date') }}";
                            url = url.replace(':date', date);
                            // window.location.href = url;
                            if(res.success  == 1)
                            {
                            	var string ="";
                            	if(res.data.length >0 )
                            	{
                            		for(var i=0; i< res.data.length; i++)
                            		{
                            			string = string+'<li>'+
                            				'<a class="viewevent" id="'+ res.data[i].id +'">'+
                            					'<span>'+ res.data[i].start_time +'</span>'+
                            					'<h4>'+ res.data[i].event_name +'<p></h4>'+
                            				'</a>'+
                            			'</li>';
                            		}

                            	}
                            	else{
                            		string = string+'<li>'+
                            			'<a herf=""><span> No Any Today Event </span></a>'+
                            		'</li>';
                            	}
                            	$('#todayevnets').html(string);
                            		$('#today').text(res.today);
                            }

                        }
                    });
                },
            });
            $('#previous_day').click(function() {
                let today = $('#today').text();
                $.ajax({
                    type: "POST",
                    url: "{{ url('event/prevday') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'date': today,
                    },
                    success: function(res) {
                        url = "{{ route('client.get.event', ':date') }}";
                        url = url.replace(':date', res.prevday);
                        window.location.href = url;

                    }
                });

            });
            $('#next_day').click(function() {
                let today = $('#today').text();
                $.ajax({
                    type: "POST",
                    url: "{{ url('event/nextday') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'date': today,
                    },
                    success: function(res) {
                        url = "{{ route('client.get.event', ':date') }}";
                        url = url.replace(':date', res.nextday);
                        window.location.href = url;

                    }
                });
            });
            $('#current_day').click(function() {
                // Obtén la fecha actual en formato YYYY-MM-DD
                let today = new Date().toISOString().split('T')[0];

                // Construye la URL de redirección con la fecha actual
                let url = "{{ route('client.get.event', ':date') }}";
                url = url.replace(':date', today);

                // Redirige a la página del día de hoy
                window.location.href = url;
            });
        });
    </script>
@endsection
