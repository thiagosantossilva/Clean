@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.clients.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.name')</th>
                            <td field-key='name'>{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.email')</th>
                            <td field-key='email'>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.cpf')</th>
                            <td field-key='cpf'>{{ $client->cpf }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.birthdate')</th>
                            <td field-key='birthdate'>{{ $client->birthdate }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.gender')</th>
                            <td field-key='gender'>{{ $client->gender }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.phone')</th>
                            <td field-key='phone'>{{ $client->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.celphone')</th>
                            <td field-key='celphone'>{{ $client->celphone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.location')</th>
                            <td>
                    <strong>{{ $client->location_address }}</strong>
                    <div id='location-map' style='width: 600px;height: 300px;' class='map' data-key='location' data-latitude='{{$client->location_latitude}}' data-longitude='{{$client->location_longitude}}'></div>
                </td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.street')</th>
                            <td field-key='street'>{{ $client->street }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.number')</th>
                            <td field-key='number'>{{ $client->number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.zip')</th>
                            <td field-key='zip'>{{ $client->zip }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.neighborhood')</th>
                            <td field-key='neighborhood'>{{ $client->neighborhood }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.city')</th>
                            <td field-key='city'>{{ $client->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.state')</th>
                            <td field-key='state'>{{ $client->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.complement')</th>
                            <td field-key='complement'>{{ $client->complement }}</td>
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
                        <th>@lang('abrigosoftware.cleans.fields.assigned-to')</th>
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
                                <td field-key='assigned_to'>{{ $clean->assigned_to->name or '' }}</td>
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

            <a href="{{ route('admin.clients.index') }}" class="btn btn-default">@lang('abrigosoftware.as_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
 
    <script>
        function initialize() {
            const maps = document.getElementsByClassName("map");
            for (let i = 0; i < maps.length; i++) {
                const field = maps[i]
                const fieldKey = field.dataset.key;
                const latitude = parseFloat(field.dataset.latitude) || -25.4342;
                const longitude = parseFloat(field.dataset.longitude) || -49.2714;
        
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });
        
                marker.setVisible(true);
            }    
              
          }
    </script>
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
