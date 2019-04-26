<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
	<link href="{{ url('adminlte/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
</head>

<body class="page-header-fixed" style="display:none;">
	<div class="topo">
		<img src="{{ url('abrigosoftware/images') }}/logo.png"/>
	</div>
	
    <div style="margin-top: 3%;"></div>

    <div class="container-fluid">
        @yield('content')
    </div>

    @include('partials.javascripts')
<script src="{{ url('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$("body").show();
	});
	$(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '5%' /* optional */
		});
	});
</script>
</body>
</html>