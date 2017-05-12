@extends('layouts.main')

@section('content1')
<style type="text/css">
.listuser{
    font-size: 30px;
    color: #eee;
    padding-top: 10px;
    float: right;
}
</style>
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
								<div class="row">
                                    <div class="col-md-9">
                                        <h4 class="title">Add User</h4>
                                        <p class="category">Complete User profile</p>
                                     </div>

                                    <div class="col-md-3"> 
                                    <a href="{{ url('/userlist')}}" title="List User"><i class="fa fa-list listuser"  aria-hidden="true"></i></a>
                                    </div>
                                </div>	
	                            </div>
	                            <div class="card-content">
	                                <form method="POST" action="{{ url('/adduser')}}" enctype="multipart/form-data" onsubmit="return check()">
	                                {!! csrf_field() !!}
		                                @if(Session::has('addsuccess'))
	                              <body onload="demo.showNotification('top','center',2,'User Added Successfully.')"/>
	                                @endif
	                                	<div class="row">
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('firstname') ? ' has-error' : '' }}">
													<label class="control-label">First name</label>
												<input type="text" title="Please enter you firstName" class="form-control" name="firstname" value="{{ old('firstname') }}" id="firstname">
												<span style="color:red;" id="first_error" > </span>
				                                @if ($errors->has('firstname'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('firstname') }}</strong>
				                                    </span>
				                                @endif

												</div>
	                                        </div>
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('lastname') ? ' has-error' : '' }}">
													<label class="control-label">Last name</label>
												<input type="text" title="Please enter you lastName" class="form-control" name="lastname" id="lastname" value="{{ old('lastname') }}">
												<span style="color:red;" id="last_error" > </span>
				                                @if ($errors->has('lastname'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('lastname') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                    	<div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('email') ? ' has-error' : '' }}">
													<label class="control-label">E-mail</label>
													<input type="text"  title="Please enter you email" class="form-control" name="email" id="email" value="{{ old('email') }}" onblur="emailcheck()">
												<span style="color:red;" id="email_error" > </span>
				                                @if ($errors->has('email'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('email') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('phone') ? ' has-error' : '' }}">
													<label class="control-label">Phone</label>
													<input type="text" title="Please enter you phone number"  class="form-control" name="phone" id="phone" value="{{ old('phone') }}" onblur="phonecheck()">
													<span style="color:red;" id="phone_error" > </span>
				                                @if ($errors->has('phone'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('phone') }}</strong>
				                                    </span>
				                                @endif

												</div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating{{ $errors->has('address') ? ' has-error' : '' }}">
													<label class="control-label">Address</label>
													<input type="text" title="Please enter you Address" class="form-control" name="address" id="address" value="{{ old('address') }}">
												<span style="color:red;" id="address_error" > </span>
				                                @if ($errors->has('address'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('address') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                    </div>

	                                    <div class="row">
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('city') ? ' has-error' : '' }}">
													<label class="control-label">City</label>
													<input type="text" title="Please enter you City" class="form-control" name="city" id="city" value="{{ old('city') }}">
												<span style="color:red;" id="city_error" > </span>
				                                @if ($errors->has('city'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('city') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('country') ? ' has-error' : '' }}">
													<label class="control-label">Country</label>
													<input type="text" title="Please enter you Country" class="form-control" name="country" id="country" value="{{ old('country') }}">
												<span style="color:red;" id="country_error" > </span>
				                                @if ($errors->has('country'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('country') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('password') ? ' has-error' : '' }}">
													<label class="control-label">Password</label>
													<input type="password"  title="Please enter your password" class="form-control" id="password" name="password">
													<span style="color:red;" id="password_error" > </span>
				                                @if ($errors->has('password'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('password') }}</strong>
				                                    </span>
				                                @endif
				                                </div>
	                                        </div>
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
													<label class="control-label">Confirm password</label>
													<input type="password" title="Please enter your password" class="form-control" id="confirmpassword" name="password_confirmation">
												<span style="color:red;" id="cpassword_error" > </span>
				                                @if ($errors->has('password_confirmation'))
				                                    <span style="color:red">
				                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
				                                    </span>
				                                @endif
												</div>
	                                        </div>
	                                    </div>
	                                   	<!--<div class="row">
	                                        <div class="col-md-12">
											    <div class="file-field input-field{{ $errors->has('picture') ? ' has-error' : '' }}">
											      <div class="btn">
											        <span>Picture</span>
											     	<input name="MAX_FILE_SIZE" value="102400" type="hidden"/>
	    											<input name="picture" accept="image/jpeg" type="file" title="Please Upload a Picture" required=""/>
											      </div>
											      <div class="file-path-wrapper">
											        <input disabled class="file-path validate" type="text">
											      </div>
											    </div>	
	                                    	</div>
	                                    </div>-->
          
	                                    <button type="submit" class="btn btn-primary pull-right">Add</button>
	                                    
		                                <!--  <button class="btn btn-primary btn-block" onclick="demo.showNotification('top','center')">Top Center</button>-->

	                                    <div class="clearfix"></div>
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
@endsection
<!--<script>
        function validationForm()
		{ 
			
		var returnVar =true;
		   var arrayParm=["firstname","lastname","email","phone","address","city","country","password","confirmpassword"];
		   var arrayerror=["first_error","last_error","email_error","phone_error","address_error","city_error","country_error","password_error","cpassword_error"];

		   var message=["Please Fill all the details"];
			for (i = 0; i < arrayParm.length; i++) { 
				if(document.getElementById(arrayParm[i]).value=="" || document.getElementById(arrayParm[i]).value==null)
				{
					document.getElementById(arrayerror[i]).innerHTML ="please enter the  "+ arrayParm[i];
					//document.getElementById(arrayParm[i]+"ERROR").style.display ="block";
					returnVar =false;
//alert(returnVar);

				}
				
			
			
                else if(arrayParm[i]=="firstname"||"lastname"||"city"||"country")
                {   var names=trim(document.getElementById(arrayParm[i].value));
                   if (names>20)
                   {
                   document.getElementById(arrayerror[i]).innerHTML ="Length of  "+arrayParm[i]+"  should not exceeds more than 20 characters";   
                   returnVar =false;
                   }
                }
                /* else if(arrayParm[i]=="email") 
                 {
                  var email=trim(document.getElementById(arrayParm[i].value));
                  if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
                  {
                   document.getElementById(arrayerror[i]).innerHTML ="please enter the valid email address";   
                   returnVar =false;
                  }
                 } */             
                
	}
					
			return returnVar;
		}

</script>-->
<script>
function fnamevalidate()
	{
		var status=true;
		var name=document.getElementById("firstname").value;
		var x=name.trim();
			if(x=="")
			{
			document.getElementById("first_error").innerHTML = "Please enter your first name";
			status=false;
			document.getElementById("firstname").focus();
			}
		else if (x.length>15) 
		{
			document.getElementById("first_error").innerHTML = "Length of first name should not exceeds more than 15 characters";
			status=false;
			document.getElementById("firstname").focus();
		}
		else
			{
				document.getElementById("first_error").innerHTML = "";
			}

		return status;	
	}
function lnamevalidate()
	{
		var status=true;
		var name=document.getElementById("lastname").value;
		var x=name.trim();
			if(x=="")
			{
			document.getElementById("last_error").innerHTML = "Please enter your last name";
			status=false;
			document.getElementById("lastname").focus();
			}
		else if (x.length>15) 
		{
			document.getElementById("last_error").innerHTML = "Length of last name should not exceeds more than 15 characters";
			status=false;
			document.getElementById("lastname").focus();
		}
		else
			{
				document.getElementById("last_error").innerHTML = "";
			}

		return status;	
	}
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
function phonevalidate()
{	
	var status=true;
		var name=document.getElementById("phone").value;

		var x=name.trim();

		var y=x.length;
		console.log(y);
 
			if(x=="")
			{
			document.getElementById("phone_error").innerHTML = "Please enter your phone number";
			status=false;
			document.getElementById("phone").focus();
			} 
	  		else if (isNaN(x))  
	        {  
	        document.getElementById("phone_error").innerHTML = "Phone number must be number";
 			status=false;
			document.getElementById("phone").focus();
	        }
	        else if(x.length<10||x.length>10)
	        {
	        document.getElementById("phone_error").innerHTML = "Phone number must 10 digits";
 			status=false;
			document.getElementById("phone").focus();
	        }
			else
            {
                document.getElementById("phone_error").innerHTML = "";
            }
            return status;
}
function addressvalidate()
	{
		var status=true;
		var name=document.getElementById("address").value;
		var x=name.trim();
			if(x=="")
			{
			document.getElementById("address_error").innerHTML = "Please enter your address";
			status=false;
			document.getElementById("address").focus();
			}
		else if (x.length>15) 
		{
			document.getElementById("address_error").innerHTML = "Length of address should not exceeds more than 100 characters";
			status=false;
			document.getElementById("address").focus();
		}
		else
			{
				document.getElementById("address_error").innerHTML = "";
			}

		return status;	
	}
function cityvalidate()
	{
		var status=true;
		var name=document.getElementById("city").value;
		var x=name.trim();
			if(x=="")
			{
			document.getElementById("city_error").innerHTML = "Please enter your City";
			status=false;
			document.getElementById("city").focus();
			}
		else if (x.length>15) 
		{
			document.getElementById("city_error").innerHTML = "Length of city should not exceeds more than 20 characters";
			status=false;
			document.getElementById("city").focus();
		}
		else
			{
				document.getElementById("city_error").innerHTML = "";
			}

		return status;	
	}
function countryvalidate()
	{
		var status=true;
		var name=document.getElementById("country").value;
		var x=name.trim();
			if(x=="")
			{
			document.getElementById("country_error").innerHTML = "Please enter your Country";
			status=false;
			document.getElementById("country").focus();
			}
		else if (x.length>15) 
		{
			document.getElementById("country_error").innerHTML = "Length of country should not exceeds more than 20 characters";
			status=false;
			document.getElementById("country").focus();
		}
		else
			{
				document.getElementById("country_error").innerHTML = "";
			}

		return status;	
	}

function passwordvalidate()
    {   
        var status=true;
        var password=document.getElementById("password").value;
        if(password=="")
            {
            document.getElementById("password_error").innerHTML = "Please enter your Password";
            status=false;
            document.getElementById("password").focus();
            }
        else if (password.length<6) 
        {
            document.getElementById("password_error").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("password").focus();
        }
        else if (password.length>30) 
        {
            document.getElementById("password_error").innerHTML = "Password exceeds 30 characters";
            status=false;
            document.getElementById("password").focus();
        }
        else
            {
                document.getElementById("password_error").innerHTML = "";
            }
            return status;
    }

function cpasswordvalidate()
	{	
		var status=true;
		var password=document.getElementById("password").value;
		var cpassword=document.getElementById("confirmpassword").value;
		if(cpassword=="")
			{
			document.getElementById("cpassword_error").innerHTML = "Please enter your Confirm Password";
			status=false;
			document.getElementById("confirmpassword").focus();
			}
		else if (cpassword.length<6) 
        {
            document.getElementById("cpassword_error").innerHTML = "Password must contain at least six characters";
            status=false;
            document.getElementById("confirmpassword").focus();
        }
        else if (cpassword.length>30) 
        {
            document.getElementById("cpassword_error").innerHTML = "Password exceeds 30 characters";
            status=false;
            document.getElementById("confirmpassword").focus();
        }
		else if (password!=cpassword) 
		{
			document.getElementById("cpassword_error").innerHTML = "Password and Confirm Password does not match";
			status=false;
			document.getElementById("confirmpassword").focus();
		}
		else
			{
				document.getElementById("cpassword_error").innerHTML = "";
			}
			return status;
	}

function check()
{
    if(fnamevalidate()&&lnamevalidate()&&emailvalidate()&&emailcheck()&&phonevalidate()&&phonecheck()&&addressvalidate()&&cityvalidate()&&countryvalidate()&&passwordvalidate()&&cpasswordvalidate()==true)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function emailcheck()
{	var status=true;
	var email=document.getElementById("email").value;
	var baseurl="<?php echo url('/'); ?>"; 

	$.ajax({
                          type: 'get',
                          
                          url :baseurl+"/emailcheck/"+email,
                          success: function(data){
               if (data == 'success') {
                    document.getElementById("email_error").innerHTML = "Email Already Exists";
            		document.getElementById("email").focus();
            		status=false;
               } else {
                    
                    status=true;
               }
            }
                        
   });
	return status;
}
function phonecheck()
{	var status=true;
	var phone=document.getElementById("phone").value;
	var baseurl="<?php echo url('/'); ?>"; 
	console.log(phone);
	$.ajax({
                          type: 'get',
                          
                          url :baseurl+"/phonecheck/"+phone,
                          success: function(data){
               if (data == 'success') {
                    document.getElementById("phone_error").innerHTML = "Phone Number Already Exists";
            		document.getElementById("phone").focus();
            		status=false;
               } else {
                    
                 status=true;   
               }
            }
                        
   });
	return status;
}

</script>