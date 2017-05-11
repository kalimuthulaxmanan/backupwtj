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

                        <form  id="loginForm" method="post" action="{{ url('/login') }}" onsubmit="return check()">
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
                                    <input type="text" title="Please enter you email" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" name="email" id="email" class="form-control">
                                    <span style="color:red;" id="email_error" > </span>
                                    @if ($errors->has('email'))
                                        <span style="color:red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" name="password" id="password" class="form-control">
                                <span style="color:red;" id="showpwd" > </span>
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
                            <button type="submit" class="btn btn-success btn-block" style="margin: 30px 0;">Login</button>
                            <!--<a class="btn btn-default btn-block" href="{{ url('/register') }}">Register</a>-->
							<a href="{{ url('/forgetpassword') }}">Forgot Your Password?</a>                 
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function emailvalidate()
    {   
        var status=true;
        var email=document.getElementById("email").value;
        var y=email.trim();
        var atpos = y.indexOf("@");
        var dotpos = y.lastIndexOf(".");
        if(y=="")
            {
            document.getElementById("email_error").innerHTML = "Please enter your email address";
            status=false;
            document.getElementById("email").focus();
            }
        else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=y.length)
        {
            document.getElementById("email_error").innerHTML = "Please enter a valid email address";
               status=false;
            document.getElementById("email").focus();
        }
        else
            {
                document.getElementById("email_error").innerHTML = "";
            }
            return status;
    }
function passwordvalidate()
    {   
        var status=true;
        var password=document.getElementById("password").value;
        if(password=="")
            {
            document.getElementById("showpwd").innerHTML = "Please enter your Password";
            status=false;
            document.getElementById("password").focus();
            }
        else if (password.length<6) 
        {
            document.getElementById("showpwd").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("password").focus();
        }
        else
            {
                document.getElementById("showpwd").innerHTML = "";
            }
            return status;
    }
function check()
{
    if(emailvalidate()&&passwordvalidate()==true)
    {
        return true;
    }
    else
    {
        return false;
    }
}


</script>
