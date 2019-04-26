<?php

namespace App\Http\Controllers\Admin;

use App\CleaningStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleaningStatusesRequest;
use App\Http\Requests\Admin\UpdateCleaningStatusesRequest;

class CleaningStatusesController extends Controller
{
    /**
     * Display a listing of CleaningStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cleaning_status_access')) {
            return abort(401);
        }


                $cleaning_statuses = CleaningStatus::all();

        return view('admin.cleaning_statuses.index', compact('cleaning_statuses'));
    }

    /**
     * Show the form for creating new CleaningStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cleaning_status_create')) {
            return abort(401);
        }
        return view('admin.cleaning_statuses.create');
    }

    /**
     * Store a newly created CleaningStatus in storage.
     *
     * @param  \App\Http\Requests\StoreCleaningStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCleaningStatusesRequest $request)
    {
        if (! Gate::allows('cleaning_status_create')) {
            return abort(401);
        }
        $cleaning_status = CleaningStatus::create($request->all());



        return redirect()->route('admin.cleaning_statuses.index');
    }


    /**
     * Show the form for editing CleaningStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cleaning_status_edit')) {
            return abort(401);
        }
        $cleaning_status = CleaningStatus::findOrFail($id);

        return view('admin.cleaning_statuses.edit', compact('cleaning_status'));
    }

    /**
     * Update CleaningStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateCleaningStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCleaningStatusesRequest $request, $id)
    {
        if (! Gate::allows('cleaning_status_edit')) {
            return abort(401);
        }
        $cleaning_status = CleaningStatus::findOrFail($id);
        $cleaning_status->update($request->all());



        return redirect()->route('admin.cleaning_statuses.index');
    }


    /**
     * Display CleaningStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cleaning_status_view')) {
            return abort(401);
        }
        $cleans = \App\Clean::where('status_id', $id)->get();

        $cleaning_status = CleaningStatus::findOrFail($id);

        return view('admin.cleaning_statuses.show', compact('cleaning_status', 'cleans'));
    }


    /**
     * Remove CleaningStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cleaning_status_delete')) {
            return abort(401);
        }
        $cleaning_status = CleaningStatus::findOrFail($id);
        $cleaning_status->delete();

        return redirect()->route('admin.cleaning_statuses.index');
    }

    /**
     * Delete all selected CleaningStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cleaning_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CleaningStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
