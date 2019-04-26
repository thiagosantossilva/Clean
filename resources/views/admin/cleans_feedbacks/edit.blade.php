@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleans-feedbacks.title')</h3>
    
    {!! Form::model($cleans_feedback, ['method' => 'PUT', 'route' => ['admin.cleans_feedbacks.update', $cleans_feedback->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('clean_id', trans('abrigosoftware.cleans-feedbacks.fields.clean').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('clean_id', $cleans, old('clean_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('clean_id'))
                        <p class="help-block">
                            {{ $errors->first('clean_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('text', trans('abrigosoftware.cleans-feedbacks.fields.text').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('text', old('text'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('text'))
                        <p class="help-block">
                            {{ $errors->first('text') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('abrigosoftware.as_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

