<?php

namespace App\Http\Controllers\Admin;

use App\CleanCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCleanCategoriesRequest;
use App\Http\Requests\Admin\UpdateCleanCategoriesRequest;

class CleanCategoriesController extends Controller
{
    /**
     * Display a listing of CleanCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('clean_category_access')) {
            return abort(401);
        }


                $clean_categories = CleanCategory::all();

        return view('admin.clean_categories.index', compact('clean_categories'));
    }

    /**
     * Show the form for creating new CleanCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('clean_category_create')) {
            return abort(401);
        }
        return view('admin.clean_categories.create');
    }

    /**
     * Store a newly created CleanCategory in storage.
     *
     * @param  \App\Http\Requests\StoreCleanCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCleanCategoriesRequest $request)
    {
        if (! Gate::allows('clean_category_create')) {
            return abort(401);
        }
        $clean_category = CleanCategory::create($request->all());



        return redirect()->route('admin.clean_categories.index');
    }


    /**
     * Show the form for editing CleanCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('clean_category_edit')) {
            return abort(401);
        }
        $clean_category = CleanCategory::findOrFail($id);

        return view('admin.clean_categories.edit', compact('clean_category'));
    }

    /**
     * Update CleanCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateCleanCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCleanCategoriesRequest $request, $id)
    {
        if (! Gate::allows('clean_category_edit')) {
            return abort(401);
        }
        $clean_category = CleanCategory::findOrFail($id);
        $clean_category->update($request->all());



        return redirect()->route('admin.clean_categories.index');
    }


    /**
     * Display CleanCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('clean_category_view')) {
            return abort(401);
        }
        $cleans = \App\Clean::where('clean_category_id', $id)->get();

        $clean_category = CleanCategory::findOrFail($id);

        return view('admin.clean_categories.show', compact('clean_category', 'cleans'));
    }


    /**
     * Remove CleanCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clean_category_delete')) {
            return abort(401);
        }
        $clean_category = CleanCategory::findOrFail($id);
        $clean_category->delete();

        return redirect()->route('admin.clean_categories.index');
    }

    /**
     * Delete all selected CleanCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('clean_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CleanCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
