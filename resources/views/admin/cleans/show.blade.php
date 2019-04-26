@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleans.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.payment-id')</th>
                            <td field-key='payment_id'>{{ $clean->payment_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.address-type')</th>
                            <td field-key='address_type'>{{ $clean->address_type->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.clean-type')</th>
                            <td field-key='clean_type'>{{ $clean->clean_type->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.clean-category')</th>
                            <td field-key='clean_category'>{{ $clean->clean_category->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.client')</th>
                            <td field-key='client'>{{ $clean->client->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.status')</th>
                            <td field-key='status'>{{ $clean->status->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.assigned-to')</th>

							<td field-key='assigned_to'>
                                @foreach ($clean->clean_slots as $slot)
                                    <span class="label label-info label-many">{{ $slot->user->name or ''}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.qt-bedrooms')</th>
                            <td field-key='qt_bedrooms'>{{ $clean->qt_bedrooms }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.qt-bathrooms')</th>
                            <td field-key='qt_bathrooms'>{{ $clean->qt_bathrooms }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.additionals')</th>
                            <td field-key='additionals'>{{ $clean->additionals }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.total-time')</th>
                            <td field-key='total_time'>{{ $clean->total_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.products-included')</th>
                            <td field-key='products_included'>{{$clean->products_included == 1 ? "SIM" : "NÃO"}}
							{{-- Form::checkbox("products_included", 1, $clean->products_included == 1 ? true : false, ["disabled"]) --}}</td>
                        </tr>
						@can('admin_home')
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.value') Total</th>
                            <td field-key='value'>{{ $clean->value }}</td>
                        </tr>
						@endcan
						@php ($value = NULL)
						@foreach($clean->clean_slots as $slot)
							@isset($value)
								@if($value !== $slot->value)
									@php ($value = NULL)
									@break
								@endif
							@endisset
						@php ($value = $slot->value)
						@endforeach
						<tr>
						<th>Valor a Receber</th>
						<td field-key='value'>
						@if($value === NULL)
							@php ($count = 1)
							@foreach($clean->clean_slots as $slot)
								Vaga {{$count}}: R$ {{ $slot->value }} <br />
							{{--@isset($value)
									@if($value === $slot->value)
										
									@endif
								@endisset
							@php ($value = $slot->value)--}}
							@php ($count++)
							@endforeach
						@else
							R$ {{$value}}
						@endif
						</td>
						</tr>
						{{--<tr>
                            <th>Valor a Receber</th>
							@foreach()
                            <td field-key='value'>{{ $clean->value }}</td>
                        </tr>--}}
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.start-time')</th>
                            <td field-key='start_time'>{{ $clean->start_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.end-time')</th>
                            <td field-key='end_time'>{{ $clean->end_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.pet')</th>
                            <td field-key='pet'>{{$clean->pet == 1 ? "SIM" : "NÃO"}}
							{{-- Form::checkbox("pet", 1, $clean->pet == 1 ? true : false, ["disabled"]) --}}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans.fields.pet-cautions')</th>
                            <td field-key='pet_cautions'>{!! $clean->pet_cautions !!}</td>
                        </tr>
                    </table>
                </div>
				
				<div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.name')</th>
                            <td field-key='name'>{{ $clean->client->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.gender')</th>
                            <td field-key='gender'>{{ $clean->client->gender }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.celphone')</th>
                            <td field-key='celphone'>{{ $clean->client->celphone }}</td>
                        </tr>
                        {{--<tr>
                            <th>@lang('abrigosoftware.clients.fields.location')</th>
                            <td>
                    <strong>{{ $clean->client->location_address }}</strong>
                    <div id='location-map' style='width: 600px;height: 300px;' class='map' data-key='location' data-latitude='{{$clean->client->location_latitude}}' data-longitude='{{$clean->client->location_longitude}}'></div>
                </td>
                        </tr>--}}
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.street')</th>
                            <td field-key='street'>{{ $clean->client->street }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.number')</th>
                            <td field-key='number'>{{ $clean->client->number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.zip')</th>
                            <td field-key='zip'>{{ $clean->client->zip }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.neighborhood')</th>
                            <td field-key='neighborhood'>{{ $clean->client->neighborhood }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.city')</th>
                            <td field-key='city'>{{ $clean->client->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.state')</th>
                            <td field-key='state'>{{ $clean->client->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.clients.fields.complement')</th>
                            <td field-key='complement'>{{ $clean->client->complement }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#cleans_feedbacks" aria-controls="cleans_feedbacks" role="tab" data-toggle="tab">Feedback</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="cleans_feedbacks">
<table class="table table-bordered table-striped {{ count($cleans_feedbacks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('abrigosoftware.cleans-feedbacks.fields.clean')</th>
                        <th>@lang('abrigosoftware.cleans-feedbacks.fields.text')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($cleans_feedbacks) > 0)
            @foreach ($cleans_feedbacks as $cleans_feedback)
                <tr data-entry-id="{{ $cleans_feedback->id }}">
                    <td field-key='clean'>{{ $cleans_feedback->clean->external_id or '' }}</td>
                                <td field-key='text'>{!! $cleans_feedback->text !!}</td>
                                                                <td>
                                    @can('cleans_feedback_view')
                                    <a href="{{ route('admin.cleans_feedbacks.show',[$cleans_feedback->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
                                    @endcan
                                    @can('cleans_feedback_edit')
                                    <a href="{{ route('admin.cleans_feedbacks.edit',[$cleans_feedback->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
                                    @endcan
                                    @can('cleans_feedback_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
                                        'route' => ['admin.cleans_feedbacks.destroy', $cleans_feedback->id])) !!}
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

            <p>&nbsp;</p>
            <a href="{{ url()->previous() }}" class="btn btn-default">@lang('abrigosoftware.as_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

	{{--<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
 
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
    </script>--}}
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
