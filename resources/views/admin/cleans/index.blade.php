@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleans.title')</h3>
    @can('clean_create')
    <p>
        <a href="{{ route('admin.cleans.create') }}" class="btn btn-success">@lang('abrigosoftware.as_add_new')</a>
        
    </p>
    @endcan

    <div class="row">
		<div class="col-md-12">
			<div class="box box-default box-solid collapsed-box" id="box-widget">
				<div class="box-header with-border">
				  <h3 class="box-title">Filtro</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
					</button>
				  </div>
				  <!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				{!! Form::open(['method' => 'GET', 'id' => 'search-form']) !!}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 form-group">
							<p style="font-weight: bold;">Data da Faxina</p>
							<div class="col-md-4">
								{!! Form::label('day_start', 'Dia', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('day_start', old('day_start'), ['class' => 'form-control date-day', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
							<div class="col-md-4">
								{!! Form::label('month_start', 'Mês', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('month_start', old('month_start'), ['class' => 'form-control date-month', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
							<div class="col-md-4">
								{!! Form::label('year_start', 'Ano', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('year_start', old('year_start'), ['class' => 'form-control date-year', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
							<p style="text-align: center;">até</p>
							<div class="col-md-4">
								{!! Form::label('day_end', 'Dia', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('day_end', old('day_end'), ['class' => 'form-control date-day', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
							<div class="col-md-4">
								{!! Form::label('month_end', 'Mês', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('month_end', old('month_end'), ['class' => 'form-control date-month', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
							<div class="col-md-4">
								{!! Form::label('year_end', 'Ano', ['class' => 'control-label']) !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('year_end', old('year_end'), ['class' => 'form-control date-year', 'placeholder' => '']) !!}
								</div>
								<p class="help-block"></p>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					{!! Form::submit('Pesquisar', ['class' => 'btn btn-primary pull-right']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('clean_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('clean_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('abrigosoftware.cleans.fields.address-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-type')</th>
                        <th>@lang('abrigosoftware.cleans.fields.clean-category')</th>
                        <th>@lang('abrigosoftware.cleans.fields.client')</th>
						<th>@lang('abrigosoftware.cleans.fields.payment-status')</th>
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
        @can('clean_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cleans.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.cleans.index') !!}?day_start={{ request('day_start') }}&month_start={{ request('month_start') }}&year_start={{ request('year_start') }}&day_end={{ request('day_end') }}&month_end={{ request('month_end') }}&year_end={{ request('year_end') }}';
            window.dtDefaultOptions.columns = [@can('clean_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'address_type.title', name: 'address_type.title'},
                {data: 'clean_type.title', name: 'clean_type.title'},
                {data: 'clean_category.title', name: 'clean_category.title'},
                {data: 'client.name', name: 'client.name'},
				{data: 'payment_status.title', name: 'payment_status.title'},
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
			$('.date-day').datetimepicker({
                format: "D",
                locale: "{{ App::getLocale() }}",
            });
			$('.date-month').datetimepicker({
                format: "M",
                locale: "{{ App::getLocale() }}",
            });
			$('.date-year').datetimepicker({
                format: "YYYY",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
@endsection