<?php
namespace App\Http\Controllers\Admin;

use App\Clean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class MinhasFaxinasController extends Controller
{
    public function index()
    {
        if (! Gate::allows('minhas_faxina_access')) {
            return abort(401);
        }
		
		if (request()->ajax()) {
            $query = \App\Clean::query();
            $query->with("address_type");
            $query->with("clean_type");
            $query->with("clean_category");
            $query->with("client");
            $query->with("status");
            $query->with("assigned_to");
			//$query->where('assigned_to_id', \Auth::user()->id);
			$query->whereHas('clean_slots',
				function ($query) {
					$query->where('user_id', \Auth::user()->id);
			});
            $template = 'actionsTemplate';
            
            $query->select([
                'cleans.id',
                'cleans.external_id',
                'cleans.payment_id',
                'cleans.address_type_id',
                'cleans.clean_type_id',
                'cleans.clean_category_id',
                'cleans.client_id',
                'cleans.status_id',
                //'cleans.assigned_to_id',
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
				if($row->clean_slots){
					return $row->clean_slots[0]->value;
				}
				else {
					return '';
				}
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
		
        return view('admin.minhas_faxinas.index');
    }
}
