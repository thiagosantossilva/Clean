<?php

namespace App\Http\Controllers\Admin;

use App\CleaningType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleaningTypesRequest;
use App\Http\Requests\Admin\UpdateCleaningTypesRequest;

class CleaningTypesController extends Controller
{
    /**
     * Display a listing of CleaningType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cleaning_type_access')) {
            return abort(401);
        }


                $cleaning_types = CleaningType::all();

        return view('admin.cleaning_types.index', compact('cleaning_types'));
    }

    /**
     * Show the form for creating new CleaningType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cleaning_type_create')) {
            return abort(401);
        }
        return view('admin.cleaning_types.create');
    }

    /**
     * Store a newly created CleaningType in storage.
     *
     * @param  \App\Http\Requests\StoreCleaningTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCleaningTypesRequest $request)
    {
        if (! Gate::allows('cleaning_type_create')) {
            return abort(401);
        }
        $cleaning_type = CleaningType::create($request->all());



        return redirect()->route('admin.cleaning_types.index');
    }


    /**
     * Show the form for editing CleaningType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cleaning_type_edit')) {
            return abort(401);
        }
        $cleaning_type = CleaningType::findOrFail($id);

        return view('admin.cleaning_types.edit', compact('cleaning_type'));
    }

    /**
     * Update CleaningType in storage.
     *
     * @param  \App\Http\Requests\UpdateCleaningTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCleaningTypesRequest $request, $id)
    {
        if (! Gate::allows('cleaning_type_edit')) {
            return abort(401);
        }
        $cleaning_type = CleaningType::findOrFail($id);
        $cleaning_type->update($request->all());



        return redirect()->route('admin.cleaning_types.index');
    }


    /**
     * Display CleaningType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cleaning_type_view')) {
            return abort(401);
        }
        $cleans = \App\Clean::where('clean_type_id', $id)->get();

        $cleaning_type = CleaningType::findOrFail($id);

        return view('admin.cleaning_types.show', compact('cleaning_type', 'cleans'));
    }


    /**
     * Remove CleaningType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cleaning_type_delete')) {
            return abort(401);
        }
        $cleaning_type = CleaningType::findOrFail($id);
        $cleaning_type->delete();

        return redirect()->route('admin.cleaning_types.index');
    }

    /**
     * Delete all selected CleaningType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cleaning_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CleaningType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
