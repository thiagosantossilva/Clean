@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('abrigosoftware.cleans-feedbacks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('abrigosoftware.as_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('abrigosoftware.cleans-feedbacks.fields.clean')</th>
                            <td field-key='clean'>{{ $cleans_feedback->clean->external_id or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('abrigosoftware.cleans-feedbacks.fields.text')</th>
                            <td field-key='text'>{!! $cleans_feedback->text !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.cleans_feedbacks.index') }}" class="btn btn-default">@lang('abrigosoftware.as_back_to_list')</a>
        </div>
    </div>
@stop


