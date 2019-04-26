@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('abrigosoftware.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.cpf')</th>
                            <td field-key='cpf'>{{ $user->cpf or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.birthdate')</th>
                            <td field-key='birthdate'>{{ $user->birthdate or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.gender')</th>
                            <td field-key='gender'>{{ $user->gender or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.celphone')</th>
                            <td field-key='celphone'>{{ $user->celphone or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.street')</th>
                            <td field-key='street'>{{ $user->street or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.number')</th>
                            <td field-key='number'>{{ $user->number or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.zip')</th>
                            <td field-key='zip'>{{ $user->zip or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.neighborhood')</th>
                            <td field-key='neighborhood'>{{ $user->neighborhood or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.city')</th>
                            <td field-key='city'>{{ $user->city or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.state')</th>
                            <td field-key='state'>{{ $user->state or '' }}</td>
                        </tr>
						<tr>
                            <th>@lang('abrigosoftware.users.fields.complement')</th>
                            <td field-key='complement'>{{ $user->complement or '' }}</td>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#cleans" aria-controls="cleans" role="tab" data-toggle="tab">Faxinas</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="cleans">
<table class="table table-bordered table-striped {{ count($cleans) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('abrigosoftware.cleans.fields.address-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-category')</th>
                        <th>@lang('abrigosoftware.cleans.fields.client')</th>
                        <th>@lang('abrigosoftware.cleans.fields.status')</th>
                        {{--<th>@lang('abrigosoftware.cleans.fields.assigned-to')</th>--}}
                        <th>@lang('abrigosoftware.cleans.fields.products-included')</th>
                        <th>@lang('abrigosoftware.cleans.fields.value')</th>
                        <th>@lang('abrigosoftware.cleans.fields.start-time')</th>
                        <th>@lang('abrigosoftware.cleans.fields.end-time')</th>
                        <th>@lang('abrigosoftware.cleans.fields.pet')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($cleans) > 0)
            @foreach ($cleans as $clean)
                <tr data-entry-id="{{ $clean->id }}">
                    <td field-key='address_type'>{{ $clean->address_type->title or '' }}</td>
                                <td field-key='clean_type'>{{ $clean->clean_type->title or '' }}</td>
                                <td field-key='clean_category'>{{ $clean->clean_category->title or '' }}</td>
                                <td field-key='client'>{{ $clean->client->name or '' }}</td>
                                <td field-key='status'>{{ $clean->status->title or '' }}</td>
									{{--<td field-key='assigned_to'>{{ $clean->assigned_to->name or '' }}</td>--}}
                                <td field-key='products_included'>{{ Form::checkbox("products_included", 1, $clean->products_included == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='value'>{{ $clean->value }}</td>
                                <td field-key='start_time'>{{ $clean->start_time }}</td>
                                <td field-key='end_time'>{{ $clean->end_time }}</td>
                                <td field-key='pet'>{{ Form::checkbox("pet", 1, $clean->pet == 1 ? true : false, ["disabled"]) }}</td>
                                                                <td>
                                    @can('clean_view')
                                    <a href="{{ route('admin.cleans.show',[$clean->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
                                    @endcan
                                    @can('clean_edit')
                                    <a href="{{ route('admin.cleans.edit',[$clean->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
                                    @endcan
                                    @can('clean_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
                                        'route' => ['admin.cleans.destroy', $clean->id])) !!}
                                    {!! Form::submit(trans('abrigosoftware.as_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="23">@lang('abrigosoftware.as_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('abrigosoftware.as_back_to_list')</a>
        </div>
    </div>
@stop


