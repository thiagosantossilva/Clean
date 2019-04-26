<?php

namespace App\Http\Controllers\Api\V1;

use App\Clean;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleansRequest;
use App\Http\Requests\Admin\UpdateCleansRequest;
use Yajra\Datatables\Datatables;

class CleansController extends Controller
{
    public function index()
    {
        return Clean::all();
    }

    public function show($id)
    {
        return Clean::findOrFail($id);
    }

    public function update(UpdateCleansRequest $request, $id)
    {
        $clean = Clean::findOrFail($id);
        $clean->update($request->all());
        

        return $clean;
    }

    public function store(StoreCleansRequest $request)
    {
        $clean = Clean::create($request->all());
        

        return $clean;
    }

    public function destroy($id)
    {
        $clean = Clean::findOrFail($id);
        $clean->delete();
        return '';
    }
}
