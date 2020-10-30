@extends('layouts.app')
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" >
                <span class="login100-form-title-1">
                    IC Portal 
                </span>
            </div>
            <form class="login100-form validate-form" method='post' action='' onsubmit='show()'>
                {{ csrf_field() }}
                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="Enter email" required>
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter password" required>
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn"  type='submit' >
                        Login
                    </button>
                </div>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong style='color:red;'>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                @if(session()->has('status'))
                <span class="help-block" style="color:red;">
                    <strong>{{ session()->get('status')}}</strong>
                </span>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

