@extends('layouts.app')

@section('content')
@can('admin_home')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{$qtClients}}</h3>

				<p>Clientes Cadastrados</p>
			</div>
			<div class="icon">
				<i class="fa fa-address-card-o"></i>
			</div>
			<a href="{{route('admin.users.index', ['role_id' => 4])}}" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->
	
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-teal">
			<div class="inner">
				<h3>{{$qtCleans}}</h3>

				<p>Faxinas Cadastradas</p>
			</div>
			<div class="icon">
				<i class="fa fa-briefcase"></i>
			</div>
			<a href="{{route('admin.cleans.index')}}" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->
	
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-olive">
			<div class="inner">
				<h3>{{$qtOpenCleans}}</h3>

				<p>Faxinas Disponíveis</p>
			</div>
			<div class="icon">
				<i class="fa fa-check-circle"></i>
			</div>
			<a href="{{route('admin.cleans_open.index')}}" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->
	
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-ch-red">
			<div class="inner">
				<h3>{{$qtProfissionais}}</h3>

				<p>Profissionais Cadastrados(as)</p>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
			<a href="{{route('admin.users.index', ['role_id' => 3])}}" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div><!-- ./col -->
				
</div>

@if(count($cleans) > 0)
<div class="row">
	<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Faxinas Disponíveis (com vagas abertas)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table">
                <tbody>
					<tr>
					  <th>ID</th>
					  <th>Cliente</th>
					  <th>Solicitada em</th>
					  <th>Data e Hora</th>
					  <th>Tempo (horas)</th>
					  <th>Vagas Disponíveis</th>
					  <th>Bairro</th>
					  <th>Detalhes</th>
					  <th>Ações</th>
					</tr>
				@foreach($cleans as $clean)
					@php
					{{--$start = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $clean->created_at);--}}
						$start = $clean->created_at;
						$finish = \Carbon\Carbon::now();
						$hours = $finish->diffInHours($start);
					@endphp
					<tr @if($hours >= 16) class="cleanhouse-red" @elseif($hours >= 8)class="cleanhouse-yellow" @endif>
					  <td>{{$clean->id}}</td>
					  <td>{{$clean->client->name}}</td>
					  <td>{{$clean->created_at->format('d/m/Y H:i')}}</td>
					  <td>{{$clean->start_time}}</td>
					  <td>{{$clean->total_time}}</td>
					  <td>{{$clean->qt_free_slots()}}</td>
					  <td>{{$clean->client->neighborhood}}</td>
					  <td>
						@if($clean->clean_type_id === 4)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Comercial"><i aria-hidden="true" class="fa fa-institution"></i></a>
						@else
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Residencial"><i aria-hidden="true" class="fa fa-home"></i></a>
						@endif
						@if($clean->pet)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Possui PET"><i aria-hidden="true" class="fa fa-paw"></i></a>
						@endif
						@if($clean->products_included)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Produtos Incluídos"><i aria-hidden="true" class="fa fa-flask"></i></a>
						@endif
						@if($clean->qt_bedrooms)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Quartos: {{$clean->qt_bedrooms}}"><i aria-hidden="true" class="fa fa-bed"></i></a>
						@endif
						@if($clean->qt_bathrooms)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Banheiros: {{$clean->qt_bathrooms}}"><i aria-hidden="true" class="fa fa-shower"></i></a>
						@endif
					  </td>
					  <td>
						<a href="{{ route('admin.cleans.show', $clean->id) }}"
							class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
						<a href="{{ route('admin.cleans.edit', $clean->id) }}#config-slots"
							class="btn btn-xs btn-success">Atribuir</a>
					  </td>
					</tr>
				@endforeach
				</tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
</div>
@endif
@if(count($payment) > 0)
<div class="row">
	<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Faxinas Aguardando Pagamento (somente Administrador e Moderador)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table">
                <tbody>
					<tr>
					  <th>ID</th>
					  <th>Cliente</th>
					  <th>Solicitada em</th>
					  <th>Data e Hora</th>
					  <th>Tempo (horas)</th>
					  <th>Bairro</th>
					  <th>Detalhes</th>
					  <th>Ações</th>
					</tr>
				@foreach($payment as $clean)
					@php
					{{--$start = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $clean->created_at);--}}
						$start = $clean->created_at;
						$finish = \Carbon\Carbon::now();
						$hours = $finish->diffInHours($start);
					@endphp
					<tr @if($hours >= 16) class="cleanhouse-red" @elseif($hours >= 8) class="cleanhouse-yellow" @endif>
					  <td>{{$clean->id}}</td>
					  <td>{{$clean->client->name}}</td>
					  <td>{{$clean->created_at->format('d/m/Y H:i')}}</td>
					  <td>{{$clean->start_time}}</td>
					  <td>{{$clean->total_time}}</td>
					  <td>{{$clean->client->neighborhood}}</td>
					  <td>
						@if($clean->clean_type_id === 4)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Comercial"><i aria-hidden="true" class="fa fa-institution"></i></a>
						@else
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Residencial"><i aria-hidden="true" class="fa fa-home"></i></a>
						@endif
						@if($clean->pet)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Possui PET"><i aria-hidden="true" class="fa fa-paw"></i></a>
						@endif
						@if($clean->products_included)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Produtos Incluídos"><i aria-hidden="true" class="fa fa-flask"></i></a>
						@endif
						@if($clean->qt_bedrooms)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Quartos: {{$clean->qt_bedrooms}}"><i aria-hidden="true" class="fa fa-bed"></i></a>
						@endif
						@if($clean->qt_bathrooms)
							<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Banheiros: {{$clean->qt_bathrooms}}"><i aria-hidden="true" class="fa fa-shower"></i></a>
						@endif
					  </td>
					  <td>
						<a href="{{ route('admin.cleans.show', $clean->id) }}"
							class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
						<!--a href="{{ route('admin.cleans.edit', $clean->id) }}"
							class="btn btn-xs btn-success">Atribuir</a-->
							
						<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal" data-clean-id="{{$clean->id}}" data-backdrop="static">Confirmar</button>
						<a href="{{ route('admin.cleans.cancel', $clean->id) }}"
							class="btn btn-xs btn-danger">Cancelar</a>
					  </td>
					</tr>
				@endforeach
				</tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
</div>
@endif

<div class="row">
	<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Últimos 10 Clientes Cadastrados</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('abrigosoftware.users.fields.name')</th> 
                            <th> @lang('abrigosoftware.users.fields.email')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($clients as $client)
                            <tr>
                               
                                <td>{{ $client->name }} </td> 
                                <td>{{ $client->email }} </td> 
                                <td>

                                    @can('client_view')
                                    <a href="{{ route('admin.users.show',[$client->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
                                    @endcan

                                    @can('client_edit')
                                    <a href="{{ route('admin.users.edit',[$client->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
                                    @endcan
                                
								</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
	</div>

 <div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Últimas 10 Faxinas Solicitadas com Responsável</div>

			<div class="panel-body table-responsive">
				<table class="table table-bordered table-striped ajaxTable">
					<thead>
					<tr>
						<th> Responsável</th> 
						<th> Cliente</th> 
						<th> Data e Hora</th> 
						<th> Tempo (horas)</th> 
						<th> Bairro</th> 
						<th> Status</th> 
						<th>&nbsp;</th>
					</tr>
					</thead>
					@foreach($lastCleans as $clean)
						<tr>
						   
							<td>@foreach($clean->clean_slots as $c)
								{{$c->user->name}} 
							@endforeach</td> 
							<td>{{$clean->client->name}} </td> 
							<td>{{$clean->start_time}} </td> 
							<td>{{$clean->total_time}} </td> 
							<td>{{$clean->client->neighborhood}} </td> 
							<td>{{$clean->status->title}} </td> 
							<td>

								@can('clean_view')
								<a href="{{ route('admin.cleans.show',[$clean->id]) }}" class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
								@endcan

								@can('clean_edit')
								<a href="{{ route('admin.cleans.edit',[$clean->id]) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
								@endcan                                
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
 </div>


</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Abertura de Vagas para a Faxina</h4>
	  </div>
	  {!! Form::open(['method' => 'POST', 'route' => ['admin.cleans.config']]) !!}
	  <input type="hidden" name="id" id="id">
	  <div class="modal-body" id="load-modal">
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
		{!! Form::submit(trans('abrigosoftware.as_save'), ['class' => 'btn btn-success', 'id' => 'modal-save']) !!}
		{!! Form::close() !!}
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endcan
@cannot('admin_home')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">@lang('abrigosoftware.as_dashboard')</div>

			<div class="panel-body">
				{{\Auth::user()->name}}, bem-vindo(a) ao painel administrativo da Clean House Express.
				@php ($unread = App\MessengerTopic::countUnread())
				@if($unread > 0)
					<br />
					<p style="color: red">Você tem {{$unread}} nova(s) mensagem(ns)<p>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">
	  <h3 class="box-title">Próximos Compromissos</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding" style="overflow: auto;">
	  <table class="table table-striped">
		<tbody><tr>
		  <th style="width: 10px">#</th>
		  <th>Data e Hora</th>
		  <th>Tempo</th>
		  <th>Endereço</th>
		  <th>Bairro</th>
		  <th>Produtos Incluídos</th>
		  <th>Ação</th>
		</tr>
		@if(count($mycleaning) > 0)
			@foreach($mycleaning as $c)
			<tr>
			  <td>{{$c->id}}</td>
			  <td>{{$c->start_time}}</td>
			  <td>{{$c->total_time}}</td>
			  @if(strpos($c->client->street, ',') !== false)
				  <td>{{$c->client->street}}</td>
			  @else
				  <td>{{$c->client->street}}, {{$c->client->number}}</td>
			  @endif
			  <td>{{$c->client->neighborhood}}</td>
			  <td>
				{{$c->products_included ? "SIM" : "NÃO"}}
			  </td>
			  <td>
				<a href="{{ route('admin.cleans.show', $c->id) }}"
					class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
			  </td>
			</tr>
			@endforeach
		@else
            <tr>
                <td colspan="23">Não há compromissos próximos.</td>
            </tr>
        @endif
	  </tbody></table>
	</div>
<!-- /.box-body -->
</div>


@if(count($cleans) > 0)
<h3>Faxinas Disponíveis</h3>
<div class="row">

@foreach($cleans as $clean)
@php $slot = $clean->clean_slots->where('user_id', NULL); 
foreach($slot as $s){
	$slot = $s;
	break;
}
@endphp

{{--@foreach($clean->clean_slots as $slot)
@if($slot->user_id === NULL)--}}
<div class="col-md-3 col-sm-6">
<div class="box box-success">
<div class="box-body box-profile">
  <h4 class="profile-username text-center">@if($clean->clean_category_id != 1)Assinatura {{$clean->clean_category->title}}@endif {{$clean->clean_type->title}} @if($clean->clean_category_id == 1) {{$clean->clean_category->title}} @endif{{--Faxina @if($clean->clean_type_id === 4) Comercial @else Residencial @endif--}}</h4>

  <p class="text-muted text-center">{{$clean->products_included ? "(Com Produtos Incluídos)" : "(Sem Produtos Incluídos)"}}</p>

  <ul class="list-group list-group-unbordered">
	<li class="list-group-item">
	  <b>Bairro</b> <a class="pull-right">{{$clean->client->neighborhood or ''}}</a>
	</li>
	<li class="list-group-item">
	  <b>Quando</b> <a class="pull-right large-date">{{$clean->start_time}}</a>
	</li>
	<li class="list-group-item">
	  <b>Tempo</b> <a class="pull-right">{{$clean->total_time}}</a>
	</li>
	<li class="list-group-item">
	  <b>Valor a Receber</b> <a class="pull-right">R$ {{$slot->value}}</a>
	</li>
	{{--<li class="list-group-item">
	  <b>Quartos</b> <a class="pull-right">{{$clean->qt_bedrooms}}</a>
	</li>
	<li class="list-group-item">
	  <b>Banheiros</b> <a class="pull-right">{{$clean->qt_bathrooms}}</a>
	</li>--}}
	<li class="list-group-item">
	  <b>PET</b> <a class="pull-right">{{$clean->pet ? "SIM" : "NÃO"}}</a>
	</li>
  </ul>

  {{--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>--}}
	<div class="btn-group pull-left clean-options">
		<a href="{{ route('admin.cleans.show', $clean->id) }}" class="btn btn-primary"><b>@lang('abrigosoftware.as_view')</b></a>
		
	</div>
	<div class="btn-group pull-right clean-options">
		<a href="{{ route('admin.cleans.assign', $slot->id) }}" class="btn btn-success"><b>Aceitar Serviço</b></a>
	</div>
</div>
<!-- /.box-body -->
</div>
</div>
{{--@endif
@endforeach--}}
@endforeach
</div>
@else
	<h4>Não há nenhuma nova faxina disponível no momento</h4>
@endif
	
	{{--@if(count($cleans) > 0)
	<div class="row">
		<div class="col-xs-12">
			  <div class="box">
				<div class="box-header">
				  <h3 class="box-title">Faxinas Disponíveis (com vagas abertas)</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
				  <table class="table">
					<tbody>
						<tr>
						  <th>ID</th>
						  <th>Cliente</th>
						  <th>Solicitada em</th>
						  <th>Data e Hora</th>
						  <th>Tempo (horas)</th>
						  <th>Vagas Disponíveis</th>
						  <th>Bairro</th>
						  <th>Detalhes</th>
						  <th>Ações</th>
						</tr>
					@foreach($cleans as $clean)
						@php
							$start = $clean->created_at;
							$finish = \Carbon\Carbon::now();
							$hours = $finish->diffInHours($start);
						@endphp
						<tr @if($hours >= 16) class="cleanhouse-red" @elseif($hours >= 8) class="cleanhouse-yellow" @endif>
						  <td>{{$clean->id}}</td>
						  <td>{{$clean->client->name}}</td>
						  <td>{{$clean->created_at->format('d/m/Y H:i')}}</td>
						  <td>{{$clean->start_time}}</td>
						  <td>{{$clean->total_time}}</td>
						  <td>{{$clean->qt_free_slots()}}</td>
						  <td>{{$clean->client->neighborhood}}</td>
						  <td>
							@if($clean->clean_type_id === 4)
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Comercial"><i aria-hidden="true" class="fa fa-institution"></i></a>
							@else
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Faxina Residencial"><i aria-hidden="true" class="fa fa-home"></i></a>
							@endif
							@if($clean->pet)
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Possui PET"><i aria-hidden="true" class="fa fa-paw"></i></a>
							@endif
							@if($clean->products_included)
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Produtos Incluídos"><i aria-hidden="true" class="fa fa-flask"></i></a>
							@endif
							@if($clean->qt_bedrooms)
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Quartos: {{$clean->qt_bedrooms}}"><i aria-hidden="true" class="fa fa-bed"></i></a>
							@endif
							@if($clean->qt_bathrooms)
								<a href="#" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Quantidade de Banheiros: {{$clean->qt_bathrooms}}"><i aria-hidden="true" class="fa fa-shower"></i></a>
							@endif
						  </td>
						  <td>
							<a href="{{ route('admin.cleans.show', $clean->id) }}"
								class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
							<a href="{{ route('admin.cleans.assign', $clean->id) }}"
								class="btn btn-xs btn-success">Aceitar Serviço</a>
						  </td>
						</tr>
					@endforeach
					</tbody></table>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
		</div>
</div>
	@endif--}}
@endcannot
@endsection
@can('admin_home')
@section('javascript')
<script>

/*var backup = "";
	$('#modal').on('show.bs.modal', function (event) {
		//backup = $('#vagas-em-faxinas').html();
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('clean-id');
		$('#id').val(id);
		$.get( "{{url('admin/cleans_load_config')}}" + "/" + id, function( data ) {
            console.log(data);
        });
		
	});
	$('#modal').on('hide.bs.modal', function (event) {
		$("#vagas-em-faxinas").html(backup);
	});*/
	
	$('[data-toggle="modal"]').click(function(e) {
		var id = e.currentTarget.dataset.cleanId;
		$('#id').val(id);
		$.get( "{{url('admin/cleans_load_config')}}" + "/" + id, function( data ) {
            $("#load-modal").html(data);
        });
	});
</script>

@stop
@endcan

