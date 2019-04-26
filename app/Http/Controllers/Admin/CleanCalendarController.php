<?php
namespace App\Http\Controllers\Admin;

use App\Clean;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CleanCalendarController extends Controller
{
    public function index()
    {
        //$events = Clean::all();
        return view('admin.clean_calendar.index');
    }
	
	public function filter(Request $request)
    {
		if ($request->input('start') && $request->input('end')) {
			$events = Clean::whereHas('clean_slots',
				function ($query) {
					$query->where('user_id', \Auth::user()->id);
			})/*where('assigned_to_id', \Auth::user()->id)*/
			->whereBetween('start_time', [$request->input('start'), $request->input('end')])->get();
			$eventsList = array();
			foreach($events as $e){
				$start = \Carbon\Carbon::createFromFormat("d/m/Y H:i:s", $e->start_time)->format('Y-m-d H:i:s');
				$end = "";
				if($e->end_time){
					$end = \Carbon\Carbon::createFromFormat("d/m/Y H:i:s", $e->end_time)->format('Y-m-d H:i:s');
				}
				$eventsList[] = array('start_time' => $start, 'end_time' => $end, 'total_time' => $e->total_time, 'id' => $e->id);
			}
			return json_encode($eventsList);
			
		}
    }
}
