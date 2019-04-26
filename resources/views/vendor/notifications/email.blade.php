@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Hello!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('abrigosoftware.as_email_regards'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang('abrigosoftware.as_if_you_are_having_trouble') "{{ $actionText }}"
@lang('abrigosoftware.as_copy_paste_url_bellow') [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
