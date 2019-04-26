<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
		if (Gate::allows('admin_home')) {
			$qtClients = \App\User::where('role_id', 4)->count();
			$qtCleans = \App\Clean::count();
			$status_open = \App\CleaningStatus::where('title', 'Aberta')->first()->id;
			$status_payment = \App\PaymentStatus::AGUARDANDO_PAGAMENTO;
			$qtOpenCleans = \App\Clean::where([['status_id', '=', $status_open], ['payment_status_id', '=', \App\PaymentStatus::PAGO]])->count();
			$qtProfissionais = \App\User::where('role_id', 3)->count();

			$cleans = \App\Clean::has('free_slots')->with('client')->where('status_id', $status_open)->get();
			$payment = \App\Clean::with(['client'])->where('payment_status_id', $status_payment)->get();
			$clients = \App\User::where('role_id', 4)->latest()->limit(10)->get(); 
			$lastCleans = \App\Clean::has('clean_slots')->doesntHave('free_slots')->with(['client', 'clean_slots', 'status'])->latest()->limit(10)->get();
			return view('home', compact( 'cleans', 'payment', 'clients', 'lastCleans', 'qtClients', 'qtCleans', 'qtOpenCleans', 'qtProfissionais' ));
		}
		else {
			$status_open = \App\CleaningStatus::where('title', 'Aberta')->first()->id;

			$city = \Auth::user()->city;
			if($city){
				$cleans = \App\Clean::with(['client', 'clean_slots', 'clean_category', 'clean_type'])->has('free_slots')->whereDoesntHave('clean_slots',
					function ($query) {
						$query->where('user_id', \Auth::user()->id);
					})->whereHas('client',
					function ($query) use ($city) {
						if($city === "Itajaí" || $city === "Balneário Camboriú" || $city === "Camboriú") {
							$query->where('city', "Itajaí")->orWhere('city', "Balneário Camboriú")->orWhere('city', "Camboriú");
						}
						else if($city === "Joinville") {
							$query->where('city', "Joinville");
						}
						else if($city === "Maringá"){
							$query->where('city', "Maringá");
						}
						else if($city === "Londrina"){
							$query->where('city', "Londrina");
						}
						else { // Curitiba e "REGIÃO"
							$query->whereNotIn('city', ['Itajaí', 'Balneário Camboriú', 'Camboriú', 'Joinville', 'Maringá', 'Londrina']);
						}
					})
				->where('status_id', $status_open)
				->get();
			}
			else {
				$cleans = \App\Clean::has('free_slots')->whereDoesntHave('clean_slots',
					function ($query) {
						$query->where('user_id', \Auth::user()->id);
				})->with(['client', 'clean_slots', 'clean_category', 'clean_type'])->where('status_id', $status_open)->get();
			}
			
			$mycleaning = \App\Clean::where('start_time', '>=', \Carbon\Carbon::now())->whereHas('clean_slots',
				function ($query) {
					$query->where('user_id', \Auth::user()->id);
			})->with(['client'])->get();
			return view('home', compact('cleans', 'mycleaning'));
		}
    }
}
