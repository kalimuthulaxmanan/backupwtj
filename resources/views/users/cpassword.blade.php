@extends('layouts.main')

@section('content1')
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-offset-2 col-md-8">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">Change Password</h4>
									<p class="category">Password can change</p>
	                            </div>
	                            <div class="card-content">
	                            <form method="POST" action="{{ url('/savepassword')}}" onsubmit="return check()">
	                                	{!! csrf_field() !!}
	                                	
	                                	@if(Session::has('passwordfail'))
		                              <body onload="demo.showNotification('top','center',4,'Current Password Cannot Match')"/>
		                            @endif

		                            @if(Session::has('passwordpass'))
		                              <body onload="demo.showNotification('top','center',2,'Password Changed Successfully')"/>
		                                @endif
	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating{{ $errors->has('current_password') ? ' has-error' : '' }}">
													<label class="control-label">Current Password</label>
													<input type="password"  title="Please enter your password"  class="form-control" name="current_password" id="cpassword">
												<span style="color:red;" id="password_error" > </span>
				                                @if ($errors->has('current_password'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('current_password') }}</strong>
				                                    </span>
				                                @endif
				                                </div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating{{ $errors->has('password') ? ' has-error' : '' }}">
													<label class="control-label">New Password</label>
													<input type="password"  title="Please enter your password" class="form-control" name="password" id="npassword">
												<span style="color:red;" id="npassword_error" > </span>
				                                @if ($errors->has('password'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('password') }}</strong>
				                                    </span>
				                                @endif
				                                </div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
													<label class="control-label">Confirm Password</label>
													<input type="password" title="Please enter your password" class="form-control" name="password_confirmation" id="cppassword">
												<span style="color:red;" id="cpassword_error" > </span>
				                                @if ($errors->has('password_confirmation'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                    </div>
	                                    <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
	                                    <div class="clearfix"></div>
	                                </form>   
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
@endsection
<script>
function currentpasswordvalidate()
    {   
        var status=true;
        var password=document.getElementById("cpassword").value;
        if(password=="")
            {
            document.getElementById("password_error").innerHTML = "Please enter your Password";
            status=false;
            document.getElementById("cpassword").focus();
            }
        else if (password.length<6) 
        {
            document.getElementById("password_error").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("cpassword").focus();
        }
        else if (password.length>30) 
        {
            document.getElementById("password_error").innerHTML = "Password exceeds 30 characters";
            status=false;
            document.getElementById("cpassword").focus();
        }
        else
            {
                document.getElementById("password_error").innerHTML = "";
            }
            return status;
    }

function newpasswordvalidate()
    {   
        var status=true;
        var password=document.getElementById("npassword").value;
        if(password=="")
            {
            document.getElementById("npassword_error").innerHTML = "Please enter your Password";
            status=false;
            document.getElementById("npassword").focus();
            }
        else if (password.length<6) 
        {
            document.getElementById("npassword_error").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("npassword").focus();
        }
        else if (password.length>30) 
        {
            document.getElementById("npassword_error").innerHTML = "Password exceeds 30 characters";
            status=false;
            document.getElementById("npassword").focus();
        }
        else
            {
                document.getElementById("npassword_error").innerHTML = "";
            }
            return status;
    }

function confirmpasswordvalidate()
    {   
        var status=true;
        var passwordnew=document.getElementById("npassword").value;
        var passwordconfirm=document.getElementById("cppassword").value;
        if(passwordconfirm=="")
            {
            document.getElementById("cpassword_error").innerHTML = "Please enter your Password";
            status=false;
            document.getElementById("cppassword").focus();
            }
        else if (passwordconfirm.length<6) 
        {
            document.getElementById("cpassword_error").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("cppassword").focus();
        }
        else if (passwordconfirm.length>30) 
        {
            document.getElementById("cpassword_error").innerHTML = "Password exceeds 30 characters";
            status=false;
            document.getElementById("cppassword").focus();
        }
        else if (passwordnew!=passwordconfirm) 
		{
			document.getElementById("cpassword_error").innerHTML = "New Password and Confirm Password does not match";
			status=false;
			document.getElementById("cppassword").focus();
		}
        else
            {
                document.getElementById("cpassword_error").innerHTML = "";
            }
            return status;
    }


function check()
{
    if(currentpasswordvalidate()&&newpasswordvalidate()&&confirmpasswordvalidate()==true)
    {
        return true;
    }
    else
    {
        return false;
    }
}
</script>