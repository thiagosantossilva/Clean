<?php

namespace App\Http\Controllers\Api\V1;

use App\Clean;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class WordpressController extends Controller
{
	private $token = "FPiY4jziII4VtXyeQAmpmSK4faH2boyK";
	
	public function insert_clean(Request $request){
		if(!$request->input('token') || $request->input('token') !== $this->token) {
			return "Invalid Request";
		}
		if($request->input('address_type')){
			$address_type = \App\AddressType::where('title', $request->input('address_type'))->first()->id;
		}
		if($request->input('date') && $request->input('hour')){
			$datetime = $request->input('date') . " " . $request->input('hour');
			$date = \Carbon\Carbon::createFromFormat("d-m-Y H:i", $datetime)->format('d/m/Y H:i:s');
		}
		else {
			return "Invalid Request";
		}
		if($request->input('clean')){
			$clean = $request->input('clean')[0];
			if (strpos($clean, 'Faxina Residencial Comum') !== false) {
				$type = \App\CleaningType::where('title', 'Faxina Residencial Comum')->first()->id;
			}
			else if(strpos($clean, 'Faxina Residencial Express') !== false){
				$type = \App\CleaningType::where('title', 'Faxina Residencial Express')->first()->id;
			}
			else if(strpos($clean, 'Faxina Residencial Alto Brilho') !== false){
				$type = \App\CleaningType::where('title', 'Faxina Residencial Alto Brilho')->first()->id;
			}
			else if(strpos($clean, 'Faxina Comercial') !== false){
				$type = \App\CleaningType::where('title', 'Faxina Comercial')->first()->id;
				if(count($request->input('clean')) > 1){
					if(strpos($request->input('clean')[1], 'Assinatura')) {
						$clean = $request->input('clean')[1];
					}
				}
			}
			
			if(strpos($clean, 'Avulsa') !== false){
				$category_id = \App\CleanCategory::where('title', 'Avulsa')->first()->id;
			}
			else if(strpos($clean, 'Quinzenal') !== false){
				$category_id = \App\CleanCategory::where('title', 'Quinzenal')->first()->id;
			}
			else if(strpos($clean, 'Semanal') !== false){
				$category_id = \App\CleanCategory::where('title', 'Semanal')->first()->id;
			}
			else if(strpos($clean, 'mais de uma vez na semana') !== false){
				$category_id = \App\CleanCategory::where('title', 'Múltipla')->first()->id;
			}
		}
		if($request->input('client') && $request->input('client')['email']){
			$client = User::firstOrNew(['email' => $request->input('client')['email']]);
			if(!$client->exists){
				$client->password = str_random(8);
			}
			$client->fill($request->input('client'));
			$client->role_id = 4;
			$client->save();
			
			$clean = new Clean();
			$clean->fill($request->all());
			$clean->start_time = $date;
			$clean->client_id = $client->id;
			$clean->status_id = 2;
			$clean->payment_status_id = \App\PaymentStatus::AGUARDANDO_PAGAMENTO;
			if(isset($address_type)){
				$clean->address_type_id = $address_type;
			}
			$clean->clean_type_id = $type;
			$clean->clean_category_id = $category_id;
			$clean->save();
			return 1;
		}
		else {
			return "Invalid Request";
		}
	}
}
