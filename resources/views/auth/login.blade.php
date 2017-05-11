@extends('layouts.app')

@section('content')
<div>
    <div class="col-md-12">
        <div class="card">
            <div class="text-center m-b-md">
                <div class="card-header" data-background-color="purple">
                 <h4 class="title">LOGIN</h4>                  
                </div>
            <!--    <small>This is the best app ever!</small>-->
            
            </div>
            <div class="hpanel">
                <div class="panel-body">

                        <form  id="loginForm" method="post" action="{{ url('/login') }}">
							     {!! csrf_field() !!}
                                 @if(Session::has('invalidLogin'))
                              <body onload="demo.showNotification('top','center',4,'Invalid Email and Password.')"/>
                                 
							   @endif
                                <!--<div id="alertclose">
                                @if(Session::has('invalidLogin'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="background-color: #fb4141";>{{ Session::get('invalidLogin') }}</p>
                                @endif
                                </div>-->
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" title="Please enter you email" required="" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" name="email" id="email" class="form-control">
                                    @if ($errors->has('email'))
                                        <span style="color:red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" required="" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" name="password" id="password" class="form-control" minlength="6">
                                @if ($errors->has('password'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="remember" class="i-checks">
                                     <label class="control-label">Remember Login</label>
                                
                            </div>
                            <button type="submit" class="btn btn-success btn-block" style="margin: 30px 0;" >Login</button>
                            <!--<a class="btn btn-default btn-block" href="{{ url('/register') }}">Register</a>-->
							<a href="{{ url('/forgetpassword') }}">Forgot Your Password?</a>                 
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
