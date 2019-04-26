@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.faxinas-abertas.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable">
                <thead>
                    <tr>
                        <th>@lang('abrigosoftware.cleans.fields.address-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-category')</th>
                        <th>@lang('abrigosoftware.cleans.fields.client')</th>
                        <th>@lang('abrigosoftware.cleans.fields.status')</th>
                        <th>@lang('abrigosoftware.cleans.fields.assigned-to')</th>
                        <th>@lang('abrigosoftware.cleans.fields.products-included')</th>
                        <th>@lang('abrigosoftware.cleans.fields.value')</th>
                        <th>@lang('abrigosoftware.cleans.fields.start-time')</th>
                        <th>@lang('abrigosoftware.cleans.fields.end-time')</th>
                        <th>@lang('abrigosoftware.cleans.fields.pet')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.cleans_open.index') !!}';
            window.dtDefaultOptions.columns = [
				{data: 'address_type.title', name: 'address_type.title'},
                {data: 'clean_type.title', name: 'clean_type.title'},
                {data: 'clean_category.title', name: 'clean_category.title'},
                {data: 'client.name', name: 'client.name'},
                {data: 'status.title', name: 'status.title'},
                {data: 'assigned_to.name', name: 'assigned_to.name'},
                {data: 'products_included', name: 'products_included'},
                {data: 'value', name: 'value'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'pet', name: 'pet'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection