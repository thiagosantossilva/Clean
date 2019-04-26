@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.users.title')</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    {!! Form::open(['method' => 'get']) !!}
    <div class="row">
        <div class="col-xs-6 col-md-2 form-group">
            {!! Form::label('role_id','Função',['class' => 'control-label']) !!}
            {!! Form::select('role_id', $roles, old('role_id',request('role_id')), ['class' => 'form-control']) !!}
        </div>
        <div class="col-xs-4">
            <label class="control-label">&nbsp;</label><br>
            {!! Form::submit('Filtrar',['class' => 'btn btn-info']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable">
                <thead>
                    <tr>

                        <th>@lang('abrigosoftware.users.fields.name')</th>
                        <th>@lang('abrigosoftware.users.fields.email')</th>
                        <th>@lang('abrigosoftware.users.fields.role')</th>
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
            window.dtDefaultOptions.ajax = '{!! route('admin.users.index') !!}?role_id={{ request('role_id') }}';
            window.dtDefaultOptions.columns = [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role.title', name: 'role.title', sortable: false},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });

    </script>

@endsection