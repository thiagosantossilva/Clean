<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
	
	/**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }

		if (request()->ajax()) {
            $query = User::query();
			$query->with('role');
			if(request('role_id')){
				$query->where('role_id', request('role_id'));
			}
            $template = 'actionsTemplate';
            
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            //$table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_';
                $routeKey = 'admin.users';
                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('password', function ($row) {
                return '---';
            });
            $table->editColumn('remember_token', function ($row) {
                return $row->remember_token ? $row->remember_token : '';
            });
			$table->editColumn('role.title', function ($row) {
                return $row->role_id ? $row->role->title : '';
            });
			$table->rawColumns(['actions']);
            return $table->make(true);
        }
		$roles = \App\Role::pluck('title', 'id')->prepend('--- Todos os usuários ---', '');
		return view('admin.users.index', compact('roles'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $user = User::create($request->all());



        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->update($request->all());



        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');
		$cleans = \App\Clean::whereHas('clean_slots',
				function ($query) use ($id){
					$query->where('user_id', $id);
			})->orWhereHas('client',
				function ($query) use ($id){
					$query->where('id', $id);
			})->get();

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user', 'cleans'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
