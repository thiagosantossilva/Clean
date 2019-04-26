<?php

namespace App\Http\Controllers\Admin;

use App\CleansFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleansFeedbacksRequest;
use App\Http\Requests\Admin\UpdateCleansFeedbacksRequest;
use Yajra\Datatables\Datatables;

class CleansFeedbacksController extends Controller
{
    /**
     * Display a listing of CleansFeedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cleans_feedback_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = CleansFeedback::query();
            $query->with("clean");
            $template = 'actionsTemplate';
            
            $query->select([
                'cleans_feedbacks.id',
                'cleans_feedbacks.clean_id',
                'cleans_feedbacks.text',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'cleans_feedback_';
                $routeKey = 'admin.cleans_feedbacks';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('clean.external_id', function ($row) {
                return $row->clean ? $row->clean->external_id : '';
            });
            $table->editColumn('text', function ($row) {
                return $row->text ? $row->text : '';
            });

            

            return $table->make(true);
        }

        return view('admin.cleans_feedbacks.index');
    }

    /**
     * Show the form for creating new CleansFeedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cleans_feedback_create')) {
            return abort(401);
        }
        
        $cleans = \App\Clean::get()->pluck('external_id', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        return view('admin.cleans_feedbacks.create', compact('cleans'));
    }

    /**
     * Store a newly created CleansFeedback in storage.
     *
     * @param  \App\Http\Requests\StoreCleansFeedbacksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCleansFeedbacksRequest $request)
    {
        if (! Gate::allows('cleans_feedback_create')) {
            return abort(401);
        }
        $cleans_feedback = CleansFeedback::create($request->all());



        return redirect()->route('admin.cleans_feedbacks.index');
    }


    /**
     * Show the form for editing CleansFeedback.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cleans_feedback_edit')) {
            return abort(401);
        }
        
        $cleans = \App\Clean::get()->pluck('external_id', 'id')->prepend(trans('abrigosoftware.as_please_select'), '');

        $cleans_feedback = CleansFeedback::findOrFail($id);

        return view('admin.cleans_feedbacks.edit', compact('cleans_feedback', 'cleans'));
    }

    /**
     * Update CleansFeedback in storage.
     *
     * @param  \App\Http\Requests\UpdateCleansFeedbacksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCleansFeedbacksRequest $request, $id)
    {
        if (! Gate::allows('cleans_feedback_edit')) {
            return abort(401);
        }
        $cleans_feedback = CleansFeedback::findOrFail($id);
        $cleans_feedback->update($request->all());



        return redirect()->route('admin.cleans_feedbacks.index');
    }


    /**
     * Display CleansFeedback.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cleans_feedback_view')) {
            return abort(401);
        }
        $cleans_feedback = CleansFeedback::findOrFail($id);

        return view('admin.cleans_feedbacks.show', compact('cleans_feedback'));
    }


    /**
     * Remove CleansFeedback from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cleans_feedback_delete')) {
            return abort(401);
        }
        $cleans_feedback = CleansFeedback::findOrFail($id);
        $cleans_feedback->delete();

        return redirect()->route('admin.cleans_feedbacks.index');
    }

    /**
     * Delete all selected CleansFeedback at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cleans_feedback_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CleansFeedback::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
