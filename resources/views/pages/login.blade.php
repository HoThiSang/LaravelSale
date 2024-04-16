@extends('layout.master');
@section('banner')

@endsection
@section('content')
<div class="container">
    <div id="content">

        <form action="{{ route('postLogin') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng nhập</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                        @error('email')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Enter your password">
                        @error('password')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> 
</div> 
@endsection