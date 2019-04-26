@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.users.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.users.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('abrigosoftware.users.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('abrigosoftware.users.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', trans('abrigosoftware.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('role_id', trans('abrigosoftware.users.fields.role').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif
                </div>
            </div>
			
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cpf', trans('abrigosoftware.users.fields.cpf').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cpf', old('cpf'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cpf'))
                        <p class="help-block">
                            {{ $errors->first('cpf') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('birthdate', trans('abrigosoftware.users.fields.birthdate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('birthdate', old('birthdate'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('birthdate'))
                        <p class="help-block">
                            {{ $errors->first('birthdate') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('gender', trans('abrigosoftware.users.fields.gender').'', ['class' => 'control-label']) !!}
                    {!! Form::text('gender', old('gender'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('gender'))
                        <p class="help-block">
                            {{ $errors->first('gender') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('abrigosoftware.users.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('celphone', trans('abrigosoftware.users.fields.celphone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('celphone', old('celphone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('celphone'))
                        <p class="help-block">
                            {{ $errors->first('celphone') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('street', trans('abrigosoftware.users.fields.street').'', ['class' => 'control-label']) !!}
                    {!! Form::text('street', old('street'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('street'))
                        <p class="help-block">
                            {{ $errors->first('street') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('number', trans('abrigosoftware.users.fields.number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('number', old('number'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('number'))
                        <p class="help-block">
                            {{ $errors->first('number') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('zip', trans('abrigosoftware.users.fields.zip').'', ['class' => 'control-label']) !!}
                    {!! Form::text('zip', old('zip'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('zip'))
                        <p class="help-block">
                            {{ $errors->first('zip') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('neighborhood', trans('abrigosoftware.users.fields.neighborhood').'', ['class' => 'control-label']) !!}
                    {!! Form::text('neighborhood', old('neighborhood'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('neighborhood'))
                        <p class="help-block">
                            {{ $errors->first('neighborhood') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city', trans('abrigosoftware.users.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('state', trans('abrigosoftware.users.fields.state').'', ['class' => 'control-label']) !!}
                    {!! Form::text('state', old('state'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('state'))
                        <p class="help-block">
                            {{ $errors->first('state') }}
                        </p>
                    @endif
                </div>
            </div>
			<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('complement', trans('abrigosoftware.users.fields.complement').'', ['class' => 'control-label']) !!}
                    {!! Form::text('complement', old('complement'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('complement'))
                        <p class="help-block">
                            {{ $errors->first('complement') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('abrigosoftware.as_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript') 
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
@endsection

