<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;
use Yajra\Datatables\Datatables;

class ClientsController extends Controller
{
    /**
     * Display a listing of Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Client::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'clients.id',
                'clients.name',
                'clients.email',
                'clients.external_id',
                'clients.cpf',
                'clients.birthdate',
                'clients.gender',
                'clients.phone',
                'clients.celphone',
                'clients.location_address',
                'clients.street',
                'clients.number',
                'clients.zip',
                'clients.neighborhood',
                'clients.city',
                'clients.state',
                'clients.complement',
            ]);
			
			$query->where('role_id', 4);
			
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'client_';
                $routeKey = 'admin.clients';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('external_id', function ($row) {
                return $row->external_id ? $row->external_id : '';
            });
            $table->editColumn('cpf', function ($row) {
                return $row->cpf ? $row->cpf : '';
            });
            $table->editColumn('birthdate', function ($row) {
                return $row->birthdate ? $row->birthdate : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? $row->gender : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('celphone', function ($row) {
                return $row->celphone ? $row->celphone : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('street', function ($row) {
                return $row->street ? $row->street : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : '';
            });
            $table->editColumn('neighborhood', function ($row) {
                return $row->neighborhood ? $row->neighborhood : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('complement', function ($row) {
                return $row->complement ? $row->complement : '';
            });

            

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    /**
     * Show the form for creating new Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        return view('admin.clients.create');
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param  \App\Http\Requests\StoreClientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        $client = Client::create($request->all());



        return redirect()->route('admin.clients.index');
    }


    /**
     * Show the form for editing Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update Client in storage.
     *
     * @param  \App\Http\Requests\UpdateClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, $id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->update($request->all());



        return redirect()->route('admin.clients.index');
    }


    /**
     * Display Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_view')) {
            return abort(401);
        }
        $cleans = \App\Clean::where('client_id', $id)->get();

        $client = Client::findOrFail($id);

        return view('admin.clients.show', compact('client', 'cleans'));
    }


    /**
     * Remove Client from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index');
    }

    /**
     * Delete all selected Client at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Client::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
