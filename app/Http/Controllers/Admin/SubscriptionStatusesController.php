<?php

namespace App\Http\Controllers\Admin;

use App\SubscriptionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriptionStatusesRequest;
use App\Http\Requests\Admin\UpdateSubscriptionStatusesRequest;

class SubscriptionStatusesController extends Controller
{
    /**
     * Display a listing of SubscriptionStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subscription_status_access')) {
            return abort(401);
        }


                $subscription_statuses = SubscriptionStatus::all();

        return view('admin.subscription_statuses.index', compact('subscription_statuses'));
    }

    /**
     * Show the form for creating new SubscriptionStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('subscription_status_create')) {
            return abort(401);
        }
        return view('admin.subscription_statuses.create');
    }

    /**
     * Store a newly created SubscriptionStatus in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriptionStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionStatusesRequest $request)
    {
        if (! Gate::allows('subscription_status_create')) {
            return abort(401);
        }
        $subscription_status = SubscriptionStatus::create($request->all());



        return redirect()->route('admin.subscription_statuses.index');
    }


    /**
     * Show the form for editing SubscriptionStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('subscription_status_edit')) {
            return abort(401);
        }
        $subscription_status = SubscriptionStatus::findOrFail($id);

        return view('admin.subscription_statuses.edit', compact('subscription_status'));
    }

    /**
     * Update SubscriptionStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionStatusesRequest $request, $id)
    {
        if (! Gate::allows('subscription_status_edit')) {
            return abort(401);
        }
        $subscription_status = SubscriptionStatus::findOrFail($id);
        $subscription_status->update($request->all());



        return redirect()->route('admin.subscription_statuses.index');
    }


    /**
     * Display SubscriptionStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('subscription_status_view')) {
            return abort(401);
        }
        $subscription_status = SubscriptionStatus::findOrFail($id);

        return view('admin.subscription_statuses.show', compact('subscription_status'));
    }


    /**
     * Remove SubscriptionStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('subscription_status_delete')) {
            return abort(401);
        }
        $subscription_status = SubscriptionStatus::findOrFail($id);
        $subscription_status->delete();

        return redirect()->route('admin.subscription_statuses.index');
    }

    /**
     * Delete all selected SubscriptionStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subscription_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = SubscriptionStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
