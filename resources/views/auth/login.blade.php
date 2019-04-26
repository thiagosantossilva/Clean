@extends('layouts.auth')

@section('content')


<div class="login-box">
	<!-- /.login-logo -->
	<div class="login-box-body">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> Não foi possível continuar:
				<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<p class="login-box-msg"><strong>Digite suas credenciais</strong></p>
		
		<form role="form" method="POST" action="{{ url('login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group has-feedback">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="Senha">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox" name="remember"> @lang('abrigosoftware.as_remember_me')
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

		<a href="{{ route('auth.password.reset') }}">@lang('abrigosoftware.as_forgot_password')</a><br>

	</div>
	<!-- /.login-box-body -->
</div>

@endsection