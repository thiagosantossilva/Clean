@can($gateKey.'view')
    <a href="{{ route($routeKey.'.show', $row->id) }}"
       class="btn btn-xs btn-primary">@lang('abrigosoftware.as_view')</a>
@endcan
@can($gateKey.'edit')
    <a href="{{ route($routeKey.'.edit', $row->id) }}" class="btn btn-xs btn-info">@lang('abrigosoftware.as_edit')</a>
@endcan
@can($gateKey.'delete')
    {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
        'route' => [$routeKey.'.destroy', $row->id])) !!}
    {!! Form::submit(trans('abrigosoftware.as_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
    {!! Form::close() !!}
@endcan