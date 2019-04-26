@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.clients.title')</h3>
    @can('client_create')
    <p>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('client_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('abrigosoftware.clients.fields.name')</th>
                        <th>@lang('abrigosoftware.clients.fields.email')</th>
                        <th>@lang('abrigosoftware.clients.fields.birthdate')</th>
                        <th>@lang('abrigosoftware.clients.fields.gender')</th>
                        <th>@lang('abrigosoftware.clients.fields.phone')</th>
                        <th>@lang('abrigosoftware.clients.fields.celphone')</th>
                        <th>@lang('abrigosoftware.clients.fields.street')</th>
                        <th>@lang('abrigosoftware.clients.fields.number')</th>
                        <th>@lang('abrigosoftware.clients.fields.zip')</th>
                        <th>@lang('abrigosoftware.clients.fields.neighborhood')</th>
                        <th>@lang('abrigosoftware.clients.fields.city')</th>
                        <th>@lang('abrigosoftware.clients.fields.state')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.clients.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.clients.index') !!}';
            window.dtDefaultOptions.columns = [@can('client_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'birthdate', name: 'birthdate'},
                {data: 'gender', name: 'gender'},
                {data: 'phone', name: 'phone'},
                {data: 'celphone', name: 'celphone'},
                {data: 'street', name: 'street'},
                {data: 'number', name: 'number'},
                {data: 'zip', name: 'zip'},
                {data: 'neighborhood', name: 'neighborhood'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection