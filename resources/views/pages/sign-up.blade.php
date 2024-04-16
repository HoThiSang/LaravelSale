	@extends('layout.master');
	@section('banner')

	@endsection

	@section('banner')

	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@endsection
	@section('content')
	<div class="container">
		<div id="content">

			<form action="{{ route('sign-up') }}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>


						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email" name="email" value="{{ old('email') }}">
							@error('email')
							<span style="color: red;">{{$message}}</span>
							@enderror
						</div>

						<div class="form-block">
							<label for="your_last_name">Fullname*</label>
							<input type="text" id="your_last_name" name="name" value="{{ old('name') }}">
							@error('name')
							<span style="color: red;">{{$message}}</span>
							@enderror
						</div>

						<div class="form-block">
							<label for="password">Password*</label>
							<input type="password" id="password" name="password" value="{{ old('password') }}">
							@error('password')
							<span style="color: red;">{{$message}}</span>
							@enderror
						</div>

						<div class="form-block">
							<label for="confirmPassword">Confirm password*</label>
							<input type="password" id="confirmPassword" name="confirmPassword" value="{{ old('confirmPassword') }}">
							@error('confirmPassword')
							<span style="color: red;">{{$message}}</span>
							@enderror
						</div>

						<div class="form-block">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>

					<div class="col-sm-3"></div>
				</div>
			</form>
		</div>
	</div>
	@endsection