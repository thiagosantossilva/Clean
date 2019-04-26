@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleaning-type.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.cleaning_types.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('abrigosoftware.cleaning-type.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('external_id', trans('abrigosoftware.cleaning-type.fields.external-id').'', ['class' => 'control-label']) !!}
                    {!! Form::number('external_id', old('external_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('external_id'))
                        <p class="help-block">
                            {{ $errors->first('external_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('abrigosoftware.as_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

