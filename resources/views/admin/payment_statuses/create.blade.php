@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.payment-status.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.payment_statuses.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('abrigosoftware.payment-status.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('abrigosoftware.as_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

