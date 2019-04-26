@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleans-feedbacks.title')</h3>
    @can('cleans_feedback_create')
    <p>
        <a href="{{ route('admin.cleans_feedbacks.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('cleans_feedback_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('cleans_feedback_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('abrigosoftware.cleans-feedbacks.fields.clean')</th>
                        <th>@lang('abrigosoftware.cleans-feedbacks.fields.text')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('cleans_feedback_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cleans_feedbacks.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.cleans_feedbacks.index') !!}';
            window.dtDefaultOptions.columns = [@can('cleans_feedback_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'clean.external_id', name: 'clean.external_id'},
                {data: 'text', name: 'text'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection