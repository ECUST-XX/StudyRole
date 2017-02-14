@extends('layouts.auth')

@section('content')
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form method="POST" action="{{ url('/login') }}">
                {{csrf_field()}}
                <h1>Login</h1>
                <div>
                    <input type="text" class="form-control {{ $errors->has(config('admin.globals.username')) ? ' parsley-error' : '' }}" placeholder="{{config('admin.globals.username')}}" name="{{config('admin.globals.username')}}" />
                    @if ($errors->has(config('admin.globals.username')))
                        <span class="help-block">
                            <p class="text-danger text-left"><strong>{{ $errors->first(config('admin.globals.username')) }}</strong></p>
                        </span>
                    @endif
                </div>
                <div>
                    <input type="password" class="form-control {{ $errors->has('password') ? ' parsley-error' : '' }}" placeholder="password" name="password" />
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <p class="text-danger text-left"><strong>{{ $errors->first('password') }}</strong></p>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-8">
                    <input type="text" class="form-control {{ $errors->has('captcha') ? ' parsley-error' : '' }}" placeholder="captcha" name="captcha" />
                    @if ($errors->has('captcha'))
                        <span class="help-block">
                        <p class="text-danger text-left"><strong>{{ $errors->first('captcha') }}</strong></p>
                        </span>
                    @endif
                    </div>
                    <div class="col-md-4">
                        <img src="{{captcha_src()}}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()">
                    </div>
                </div>
                <div class="row">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
                </div>
                <div>
                    <button class="btn btn-default submit" type="submit" >Log in</button>
                    <a class="reset_pass" href="{{url('/password/reset')}}">Lost your password?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">New to site?
                        <a href="{{url('/register')}}" class="to_register"> Create Account </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
