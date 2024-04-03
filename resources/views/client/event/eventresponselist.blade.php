@forelse($todayevents as $event)
							<li>
								<a class="viewevent" id="{{ $event->id}}">
									<span>{{ $event->start_time}}</span>
									<h4>{{ $event->event_name}}<p></h4>						
								</a>
							</li>
						@empty
							<li>
								<a herf=""><span> No Any Today Event </span></a>
							</li>
						@endforelse