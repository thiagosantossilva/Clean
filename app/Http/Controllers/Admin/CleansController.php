<?php

namespace App\Http\Controllers\Admin;

use App\Clean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleansRequest;
use App\Http\Requests\Admin\UpdateCleansRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class CleansController extends Controller
{
    /**
     * Display a listing of Clean.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('clean_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Clean::query();
            $query->with("address_type");
            $query->with("clean_type");
            $query->with("clean_category");
            $query->with("client");
            $query->with("status");
			$query->with("clean_slots");
			$query->with("assigned_to");
			$query->with("payment_status");
			$query->filterByRequest($request);
            //$query->with("assigned_to");
            $template = 'actionsTemplate';
            
            $query->select([
                'cleans.id',
                'cleans.external_id',
                'cleans.payment_id',
                'cleans.address_type_id',
                'cleans.clean_type_id',
                'cleans.clean_category_id',
                'cleans.client_id',
				'cleans.payment_status_id',
                'cleans.status_id',
                'cleans.qt_bedrooms',
                'cleans.qt_bathrooms',
                'cleans.additionals',
                'cleans.total_time',
                'cleans.products_included',
                'cleans.value',
                'cleans.start_time',
                'cleans.end_time',
                'cleans.pet',
                'cleans.pet_cautions',
				'cleans.qt_employees',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'clean_';
                $routeKey = 'admin.cleans';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('external_id', function ($row) {
                return $row->external_id ? $row->external_id : '';
            });
            $table->editColumn('payment_id', function ($row) {
                return $row->payment_id ? $row->payment_id : '';
            });
            $table->editColumn('address_type.title', function ($row) {
                return $row->address_type ? $row->address_type->title : '';
            });
            $table->editColumn('clean_type.title', function ($row) {
                return $row->clean_type ? $row->clean_type->title : '';
            });
            $table->editColumn('clean_category.title', function ($row) {
                return $row->clean_category ? $row->clean_category->title : '';
            });
            $table->editColumn('client.name', function ($row) {
                return $row->client ? $row->client->name : '';
            });
            $table->editColumn('status.title', function ($row) {
                return $row->status ? $row->status->title : '';
            });
			$table->editColumn('payment_status.title', function ($row) {
                return $row->payment_status ? $row->payment_status->title : '';
            });
            $table->editColumn('qt_bedrooms', function ($row) {
                return $row->qt_bedrooms ? $row->qt_bedrooms : '';
            });
            $table->editColumn('qt_bathrooms', function ($row) {
                return $row->qt_bathrooms ? $row->qt_bathrooms : '';
            });
            $table->editColumn('additionals', function ($row) {
                return $row->additionals ? $row->additionals : '';
            });
            $table->editColumn('total_time', function ($row) {
                return $row->total_time ? $row->total_time : '';
            });
            $table->editColumn('products_included', function ($row) {
                return \Form::checkbox("products_included", 1, $row->products_included == 1, ["disabled"]);
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : '';
            });
            $table->editColumn('end_time', function ($row) {
                return $row->end_time ? $row->end_time : '';
            });
            $table->editColumn('pet', function ($row) {
                return \Form::checkbox("pet", 1, $row->pet == 1, ["disabled"]);
            });
            $table->editColumn('pet_cautions', function ($row) {
                return $row->pet_cautions ? $row->pet_cautions : '';
            });
			$table->editColumn('qt_employees', function ($row) {
                return $row->qt_employees ? $row->qt_employees : '';
            });
			$table->editColumn('assigned_to.name', function ($row) {
				if(count($row->clean_slots) == 0) {
                    return '';
                }
                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->assigned_to->pluck('name')->toArray()) . '</span>';
            });

            
			$table->rawColumns(['actions', 'assigned_to.name']);
            return $table->make(true);
        }

        return view('admin.cleans.index');
    }

    /**
     * Show the form for creating new Clean.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('clean_create')) {
            return abort(401);
        }
        
        $address_types = \App\AddressType::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clean_types = \App\CleaningType::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clean_categories = \App\CleanCategory::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clients = \App\User::where('role_id', 4)->get()->pluck('name', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $statuses = \App\CleaningStatus::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
		$payment_statuses = \App\PaymentStatus::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $assigned_tos = \App\User::where('role_id', 3)->get()->pluck('name', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        return view('admin.cleans.create', compact('address_types', 'clean_types', 'clean_categories', 'clients', 'payment_statuses', 'statuses', 'assigned_tos'));
    }

    /**
     * Store a newly created Clean in storage.
     *
     * @param  \App\Http\Requests\StoreCleansRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCleansRequest $request)
    {
        if (! Gate::allows('clean_create')) {
            return abort(401);
        }
		$data = $request->all();
		if($request->input('clean_slots') !== NULL){
			$quantity = count($request->input('clean_slots'));
		}
		$data['qt_employees'] = $quantity;
        $clean = Clean::create($data);
		foreach ($request->input('clean_slots', []) as $data) {
            $clean->clean_slots()->create($data);
        }


        return redirect()->route('admin.cleans.index');
    }


    /**
     * Show the form for editing Clean.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('clean_edit')) {
            return abort(401);
        }
        
        $address_types = \App\AddressType::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clean_types = \App\CleaningType::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clean_categories = \App\CleanCategory::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $clients = \App\User::where('role_id', 4)->get()->pluck('name', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $statuses = \App\CleaningStatus::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
		$payment_statuses = \App\PaymentStatus::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
        $assigned_tos = \App\User::where('role_id', 3)->get()->pluck('name', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        $clean = Clean::findOrFail($id);

        return view('admin.cleans.edit', compact('clean', 'address_types', 'clean_types', 'clean_categories', 'clients', 'payment_statuses', 'statuses', 'assigned_tos'));
    }

    /**
     * Update Clean in storage.
     *
     * @param  \App\Http\Requests\UpdateCleansRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCleansRequest $request, $id)
    {
        if (! Gate::allows('clean_edit')) {
            return abort(401);
        }
        $clean = Clean::findOrFail($id);
		$updateData = $request->all();
		if($request->input('clean_slots') !== NULL){
			$quantity = count($request->input('clean_slots'));
		}
		else {
			$quantity = NULL;
		}
		$updateData['qt_employees'] = $quantity;
        $clean->update($updateData);
		
		$cleanSlots           = $clean->clean_slots;
        $currentCleanSlotData = [];
        foreach ($request->input('clean_slots', []) as $index => $data) {
            if (is_integer($index)) {
                $clean->clean_slots()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentCleanSlotData[$id] = $data;
            }
        }
        foreach ($cleanSlots as $item) {
            if (isset($currentCleanSlotData[$item->id])) {
                $item->update($currentCleanSlotData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.cleans.index');
    }


    /**
     * Display Clean.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('clean_view')) {
            return abort(401);
        }
        
		$cleans_feedbacks = \App\CleansFeedback::where('clean_id', $id)->get();

        $clean = Clean::with(['client', 'clean_slots'])->findOrFail($id);

        return view('admin.cleans.show', compact('clean', 'cleans_feedbacks'));
    }


    /**
     * Remove Clean from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clean_delete')) {
            return abort(401);
        }
        $clean = Clean::findOrFail($id);
        $clean->delete();

        return redirect()->route('admin.cleans.index');
    }

    /**
     * Delete all selected Clean at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('clean_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Clean::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
	
	public function assign($id){
		$slot = \App\CleanSlot::findOrFail($id);
		// verifica se a vaga possui usuário atribuido
		if($slot->user_id !== NULL){
			return redirect()->route('admin.home')->withErrors(['Erro!', 'Essa vaga já foi preenchida por outra profissional. Por favor, escolha outro serviço.']);
		}
		
		$clean = Clean::findOrFail($slot->clean_id);
		
		// verifica se faxina possui status aberto, se foi configurada e se não atingiu o número máximo de profissionais designadas
		$status_open = \App\CleaningStatus::where('title', 'Aberta')->first()->id;
		if($clean->status_id !== $status_open || $clean->payment_status_id !== \App\PaymentStatus::PAGO){
			//return abort(403);
			return redirect()->route('admin.home')->withErrors(['Erro!', 'O serviço escolhido não está disponível. Por favor, escolha outro serviço.']);
		}
		else if($clean->qt_employees === NULL || $clean->qt_assigned_to() == $clean->qt_employees){
			return redirect()->route('admin.home')->withErrors(['Erro!', 'O serviço escolhido não está mais disponível. Por favor, escolha outro serviço.']);
		}
		
		// atribui o usuário à vaga
		$user = \Auth::user()->id;
		$slot->user_id = $user;
		$slot->save();
		
		// verifica se a faxina já atingiu a quantidade de funcionários configurada
		if($clean->qt_assigned_to() == $clean->qt_employees){
			// mudar status para confirmada
			$status_ok = \App\CleaningStatus::where('title', 'Confirmada')->first()->id;
			
			$clean->status_id = $status_ok;
			$clean->save();
		}
		
		return redirect()->route('admin.cleans_mine.index')->with('success', 'Sua participação na faxina foi confirmada com sucesso.'/*'Atribuição da faxina realizada com sucesso.'*/);
		
		
	}
	
	public function load_config($id){
		if (! Gate::allows('clean_edit')) {
            return abort(401);
        }
		
		$clean = Clean::findOrFail($id);
		$assigned_tos = $this->get_available_professionals($clean)->pluck('name', 'id');
		if($assigned_tos->isEmpty()) {
			$assigned_tos->prepend('Não existem profissionais disponíveis!', '');
		}
		else {
			$assigned_tos->prepend('Forçar atribuição de profissional', '');
		}
		$template = view('admin.cleans.config_modal', compact('clean', 'assigned_tos'));
		return $template;
	}
	
	public function config(Request $request){
		if (! Gate::allows('clean_edit')) {
            return abort(401);
        }
		if(!$request->input('id') || empty($request->input('clean_slots'))){
			return redirect()->route('admin.home')->withErrors(['Erro!', 'Falha ao configurar faxina. A faxina precisa ter ao menos 1 (uma) vaga disponível.']);
		}
		foreach($request->input('clean_slots', []) as $slot){
			if(!$slot['value'] || $slot['value'] == ''){
				return redirect()->route('admin.home')->withErrors(['Erro!', 'Falha ao configurar faxina. Não é possível criar uma vaga sem um valor associado.']);
			}
		}
		$clean = Clean::findOrFail($request->input('id'));
		$cleanSlots           = $clean->clean_slots;
        $currentCleanSlotData = [];
        foreach ($request->input('clean_slots', []) as $index => $data) {
            if (is_integer($index)) {
                $clean->clean_slots()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentCleanSlotData[$id] = $data;
            }
        }
        foreach ($cleanSlots as $item) {
            if (isset($currentCleanSlotData[$item->id])) {
                $item->update($currentCleanSlotData[$item->id]);
            } else {
                $item->delete();
            }
        }
		$quantity = count($request->input('clean_slots'));
		$status_open = \App\CleaningStatus::where('title', 'Aberta')->first()->id;
		$status_paid = \App\PaymentStatus::PAGO;
		$clean->status_id = $status_open;
		$clean->payment_status_id = $status_paid;
		$clean->qt_employees = $quantity;
		$clean->save();
		
		return redirect()->route('admin.home')->with('success', 'Alteração de status e abertura de vagas realizada com sucesso.');
		
	}
	
	public function cancel($id){
		if (! Gate::allows('clean_edit')) {
            return abort(401);
        }
		$clean = Clean::findOrFail($id);
		$status_cancelled = \App\CleaningStatus::where('title', 'Cancelada')->first()->id;
		$payment_cancelled = \App\PaymentStatus::CANCELADO;
		$clean->status_id = $status_cancelled;
		$clean->payment_status_id = $payment_cancelled;
		$clean->save();
		return redirect()->back()->with('success', 'Alteração de status realizada com sucesso.');
	}
	
	private function get_available_professionals(Clean $clean){
		$total = $this->filter_total_time($clean->total_time);
		if($total > 8){
			$total = 8;
		}
		else {
			$total = $total + 1; // TEMPO DE DESLOCAMENTO.
		}
		$start = \Carbon\Carbon::parse($clean->getOriginal('start_time'));
		$end = \Carbon\Carbon::parse($start)->addHours($total);
		$status = \App\CleaningStatus::where('title', 'Aberta')->orWhere('title', 'Confirmada')->get()->pluck('id')->toArray();

		// Busca profissionais que possuem faxinas agendadas (abertas ou confirmadas) entre as datas da faxina passada por parâmetro.
		$users = DB::table('users')
		->join('clean_slots', 'users.id', '=', 'clean_slots.user_id')
		->join('cleans', 'clean_slots.clean_id', '=', 'cleans.id')
		->whereIn('cleans.status_id', $status)
		->whereBetween('cleans.start_time', [$start, $end])->orWhereBetween('cleans.end_time', [$start, $end])
		->where('users.role_id', 3)
		->get()->pluck('user_id');
		// Retorna todas as demais que não estão na query acima.
		return \App\User::where('role_id', 3)->whereNotIn('id', $users)->get();
		
	}
	
	private function filter_total_time($total){
		$total = str_replace(['+', '-'], '', $total);
		$total = str_replace(',', '.', $total);
		return filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	}
	// QUANTIDADE DE PROFISSIONAIS: (int)ceil(($total / 8))
}
