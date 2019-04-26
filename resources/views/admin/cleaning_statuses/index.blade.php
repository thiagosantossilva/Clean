@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleaning-status.title')</h3>
    @can('cleaning_status_create')
    <p>
        <a href="{{ route('admin.cleaning_statuses.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($cleaning_statuses) > 0 ? 'datatable' : '' }} @can('cleaning_status_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('cleaning_status_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('abrigosoftware.cleaning-status.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($cleaning_statuses) > 0)
                        @foreach ($cleaning_statuses as $cleaning_status)
                            <tr data-entry-id="{{ $cleaning_status->id }}">
                                @can('cleaning_status_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $cleaning_status->title }}</td>
                                                                <td>
                                    @can('cleaning_status_view')
                                    <a href="{{ route('admin.cleaning_statuses.show',[$cleaning_status->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
                                    @endcan
                                    @can('cleaning_status_edit')
                                    <a href="{{ route('admin.cleaning_statuses.edit',[$cleaning_status->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
                                    @endcan
                                    @can('cleaning_status_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
                                        'route' => ['admin.cleaning_statuses.destroy', $cleaning_status->id])) !!}
                                    {!! Form::submit(trans('abrigosoftware.as_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('abrigosoftware.as_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('cleaning_status_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cleaning_statuses.mass_destroy') }}';
        @endcan

    </script>
@endsection