<?php

namespace App\Http\Controllers\Api\V1;

use App\SubscriptionStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriptionStatusesRequest;
use App\Http\Requests\Admin\UpdateSubscriptionStatusesRequest;

class SubscriptionStatusesController extends Controller
{
    public function index()
    {
        return SubscriptionStatus::all();
    }

    public function show($id)
    {
        return SubscriptionStatus::findOrFail($id);
    }

    public function update(UpdateSubscriptionStatusesRequest $request, $id)
    {
        $subscription_status = SubscriptionStatus::findOrFail($id);
        $subscription_status->update($request->all());
        

        return $subscription_status;
    }

    public function store(StoreSubscriptionStatusesRequest $request)
    {
        $subscription_status = SubscriptionStatus::create($request->all());
        

        return $subscription_status;
    }

    public function destroy($id)
    {
        $subscription_status = SubscriptionStatus::findOrFail($id);
        $subscription_status->delete();
        return '';
    }
}
