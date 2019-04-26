<?php

namespace App\Http\Controllers\Admin;

use App\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentStatusesRequest;
use App\Http\Requests\Admin\UpdatePaymentStatusesRequest;

class PaymentStatusesController extends Controller
{
    /**
     * Display a listing of PaymentStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payment_status_access')) {
            return abort(401);
        }


                $payment_statuses = PaymentStatus::all();

        return view('admin.payment_statuses.index', compact('payment_statuses'));
    }

    /**
     * Show the form for creating new PaymentStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payment_status_create')) {
            return abort(401);
        }
        return view('admin.payment_statuses.create');
    }

    /**
     * Store a newly created PaymentStatus in storage.
     *
     * @param  \App\Http\Requests\StorePaymentStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentStatusesRequest $request)
    {
        if (! Gate::allows('payment_status_create')) {
            return abort(401);
        }
        $payment_status = PaymentStatus::create($request->all());



        return redirect()->route('admin.payment_statuses.index');
    }


    /**
     * Show the form for editing PaymentStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payment_status_edit')) {
            return abort(401);
        }
        $payment_status = PaymentStatus::findOrFail($id);

        return view('admin.payment_statuses.edit', compact('payment_status'));
    }

    /**
     * Update PaymentStatus in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentStatusesRequest $request, $id)
    {
        if (! Gate::allows('payment_status_edit')) {
            return abort(401);
        }
        $payment_status = PaymentStatus::findOrFail($id);
        $payment_status->update($request->all());



        return redirect()->route('admin.payment_statuses.index');
    }


    /**
     * Display PaymentStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payment_status_view')) {
            return abort(401);
        }
        $payment_status = PaymentStatus::findOrFail($id);

        return view('admin.payment_statuses.show', compact('payment_status'));
    }


    /**
     * Remove PaymentStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payment_status_delete')) {
            return abort(401);
        }
        $payment_status = PaymentStatus::findOrFail($id);
        $payment_status->delete();

        return redirect()->route('admin.payment_statuses.index');
    }

    /**
     * Delete all selected PaymentStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payment_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PaymentStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
