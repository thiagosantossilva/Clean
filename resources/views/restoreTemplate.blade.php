@can($gateKey.'delete')
    {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
        'route' => [$routeKey.'.restore', $row->id])) !!}
    {!! Form::submit(trans('abrigosoftware.as_restore'), array('class' => 'btn btn-xs btn-success')) !!}
    {!! Form::close() !!}
@endcan
@can($gateKey.'delete')
    {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("abrigosoftware.as_are_you_sure")."');",
        'route' => [$routeKey.'.perma_del', $row->id])) !!}
    {!! Form::submit(trans('abrigosoftware.as_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
    {!! Form::close() !!}
@endcan