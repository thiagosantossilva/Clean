@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleaning-type.title')</h3>
    @can('cleaning_type_create')
    <p>
        <a href="{{ route('admin.cleaning_types.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($cleaning_types) > 0 ? 'datatable' : '' }} @can('cleaning_type_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('cleaning_type_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('abrigosoftware.cleaning-type.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($cleaning_types) > 0)
                        @foreach ($cleaning_types as $cleaning_type)
                            <tr data-entry-id="{{ $cleaning_type->id }}">
                                @can('cleaning_type_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $cleaning_type->title }}</td>
                                                                <td>
                                    @can('cleaning_type_view')
                                    <a href="{{ route('admin.cleaning_types.show',[$cleaning_type->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
                                    @endcan
                                    @can('cleaning_type_edit')
                                    <a href="{{ route('admin.cleaning_types.edit',[$cleaning_type->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
                                    @endcan
                                    @can('cleaning_type_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
                                        'route' => ['admin.cleaning_types.destroy', $cleaning_type->id])) !!}
                                    {!! Form::submit(trans('abrigosoftware.as_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('abrigosoftware.as_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('cleaning_type_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cleaning_types.mass_destroy') }}';
        @endcan

    </script>
@endsection