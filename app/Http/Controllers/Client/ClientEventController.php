<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;


class ClientEventController extends Controller
{
	// middleware controller
	public function __construct()
    {
        $this->middleware('auth');
	}

	// event home pa		ge
	public function index()
	{
		$today= date('Y-m-d');
		$current_date_time  = Carbon::now();
		$events = Event::where('start_date','>=',$current_date_time)->where('status',1)->orderBy('created_at')->take(3)->get();
		$todayevents =Event::where('status',1)->where('start_date',date('Y-m-d'))->orderBy('start_date')->orderBy('start_time')->get();
		return view('client.event.eventlist',compact('events','todayevents','today'));
	}
	public function geteventdata($id)
	{
		$event = Event::find($id);
		return $event;
	}

	public function storeEvent(Request $request)
	{
		$duration=0;
		if($request->alldays == "on")
		{
			$duration = 1;
			$start_time = "00:00:00";
		}
		$event = Event::create([
			'start_date'=>$request->start_date,
			'start_time'=>$request->start_time,
			'end_date' => $request->end_date,
			'end_time'=>$request->end_time,
			'duration'=> $duration,
			'status'=>1,
			'event_name'=>$request->event_name,
			'content'=>$request->content,
			'created_by'=>Auth::user()->id,
		]);
		return back()->with('success',trans('message.Data saved successfully'));
	}
	public function updateEvent(Request $request,$id)
	{
		// dd($id);
		$event =  Event::find($id);
		$duration=0;
		if($request->alldays == "on")
		{
			$duration = 1;
		}
		$event->start_date=$request->start_date;
		$event->start_time=$request->start_time;
		$event->end_date=$request->end_date;
		$event->end_time=$request->end_time;
		$event->duration= $duration;
		$event->status=1;
		$event->event_name=$request->event_name;
		$event->content=$request->content;
		$event->updated_by=Auth::user()->id;
		$event->update();
		return redirect()->route('client.event.inex')->with('success',trans('message.Data updated successfully'));
	}

	public function deleteEvent(Request $request,$id)
	{
		// dd($id);
		$event =  Event::find($id);
		$event->delete();
		return redirect()->route('client.event.inex')->with('success',trans('message.Data Deleted successfully'));
    }

	public function getPrevDay(Request $request)
	{
		// dd($request);
		$today = carbon::parse($request->date);
		$prevDay = $today->subDays(1);
		$newday = $prevDay->toDateString();
		$todayevents =Event::where('status',1)->where('start_Date',$newday)->orderBy('start_date')->orderBy('start_time')->get();
		// dd($todayevents);
		return response()->json([
			'data'=>$todayevents,
			'success'=>1,
			'prevday'=>trim($newday),
		]);
	}
	public function getNextDay(Request $request)
	{
		$today = carbon::parse($request->date);
		$nextDay = $today->addDays(1);
		$newday = $nextDay->toDateString();
		$todayevents =Event::where('status',1)->where('start_Date',$newday)->orderBy('start_date')->orderBy('start_time')->get();
		return response()->json([
			'data'=>$todayevents,
			'success'=>1,
			'nextday'=>trim($newday),
		]);
	}
	public function getToDay(Request $request)
	{
//        dd($request);
		$today = $request->date;
		$todayevents =Event::where('status',1)->where('start_Date',$today)->orderBy('start_date')->orderBy('start_time')->get();
		return response()->json([
			'data'=>$todayevents,
			'success'=>1,
			'today'=>trim($today),
		]);
	}

	public function getDateEvent($date)
	{
        $formatted_date = new DateTime($date);
        $today = $formatted_date->format('M j, Y');
		$current_date_time  = Carbon::now();
		$events = Event::where('start_date','>=',$current_date_time)->where('status',1)->orderBy('created_at')->take(3)->get();
		$todayevents =Event::where('status',1)->where('start_date',$date)->orderBy('start_date')->orderBy('start_time')->get();
		return view('client.event.eventlist',compact('events','todayevents','today'));
	}
}
