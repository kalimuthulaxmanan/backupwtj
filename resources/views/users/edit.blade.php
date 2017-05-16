@extends('layouts.main')

@section('content1')
<style type="text/css">
.edit{
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
                                        <h4 class="title">Update User</h4>
                                        <p class="category">Update User profile</p>
                                     </div>

                                    <div class="col-md-3"> 
                                    <a href="{{ url('/userlist')}}" title="Back"><i class="fa fa-arrow-left edit"  aria-hidden="true"></i></a>
                                    </div>
                        </div>
	                </div>
	                <div class="card-content">
	                    <form method="POST" action="{{ url('/updateuser')}}/{{$id}}" enctype="multipart/form-data" onsubmit="return check()" id="editform">
	                    	{!! csrf_field() !!}
	                    	@foreach($results as $row)
                    	<div class="row">
                            <div class="col-md-6">
								<div class="form-group label-floating{{ $errors->has('firstname') ? ' has-error' : '' }}">
									<label class="control-label">First name</label>
                                <input type="hidden" name="id" id="id" value="{{$row->id}}">
								<input type="text" title="Please enter you firstName" class="form-control" name="firstname" value="{{$row->firstName}}" id="firstname">
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
								<input type="text" title="Please enter you lastName" class="form-control" name="lastname" value="{{$row->lastName}}" id="lastname">
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
									<input type="text"  title="Please enter you email" class="form-control" name="email" value="{{$row->email}}" id="email" onblur="emailcheck()">
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
									<input type="text" title="Please enter you Phone Number" class="form-control" name="phone" value="{{$row->phone}}" id="phone" onblur="phonecheck()">
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
									<input type="text" title="Please enter you Address" class="form-control" name="address" value="{{$row->address}}" id="address">
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
									<input type="text" title="Please enter you City" class="form-control" name="city" value="{{$row->city}}" id="city">
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
									<input type="text" title="Please enter you Country" class="form-control" name="country" value="{{$row->country}}" id="country">
                                <span style="color:red;" id="country_error" > </span>
                                @if ($errors->has('country'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
								</div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-6">
								<div class="form-group label-floating{{ $errors->has('password') ? ' has-error' : '' }}">
									<label class="control-label">Password</label>
									<input type="password"  title="Please enter your password" required="" class="form-control" name="password" value="{{$row->password}}">

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
									<input type="password" title="Please enter your password" required="" class="form-control" name="password_confirmation" value="{{$row->password}}">

                                @if ($errors->has('password_confirmation'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
								</div>
                            </div>
                        </div>-->
	                	<div class="row">
	                        <!--<div class="col-md-2">
							    <img src="{{$row->image}}"/>	
	                    	</div>-->
	                    	<div class="col-md-10">
	                    	<!--<div class="file-field input-field{{ $errors->has('picture') ? ' has-error' : '' }}">
							      <div class="btn">
							        <span>Picture</span>
							     	<input name="MAX_FILE_SIZE" value="102400" type="hidden"/>
									<input name="picture" accept="image/jpeg" type="file"/>
							      </div>
							      <div class="file-path-wrapper">
							        <input disabled class="file-path validate" type="text">
							      </div>
							    </div>-->
                        	<button type="submit" class="btn btn-primary pull-right">Update</button>
                        	</div>
                        </div>
	                    @endforeach
	                    </form>                           
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection
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
        else if (x.length>100) 
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
        else if (x.length>20) 
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
        else if (x.length>20) 
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

function check()
{
    if(fnamevalidate()&&lnamevalidate()&&emailvalidate()&&emailcheck()&&phonevalidate()&&phonecheck()&&addressvalidate()&&cityvalidate()&&countryvalidate()==true)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function emailcheck()
{   
    var email=document.getElementById("email").value;
    //console.log(email.length);
    if(email.length>0)
    {
    var status=true;
    var form = new FormData(document.getElementById("editform"));
    //var email=document.getElementById("email").value;

    var id=document.getElementById("id").value;
    //console.log(id);
    var baseurl="<?php echo url('/'); ?>"; 

    $.ajax({
                          type: 'post',
                          
                          url :baseurl+"/updateemailcheck/"+id,

                          data:form,
                          cache: false,
                        contentType: false, //must, tell jQuery not to process the data
                        processData: false,
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

}
function phonecheck()
{   
    var phone=document.getElementById("phone").value;
    if(phone.length>0)
    {
    var status=true;
    
    var form = new FormData(document.getElementById("editform"));
    var id=document.getElementById("id").value;
    var baseurl="<?php echo url('/'); ?>"; 
    //console.log(phone);

    $.ajax({
                        type: 'post',
                          
                        url :baseurl+"/updatephonecheck/"+id,

                          data:form,
                          cache: false,
                        contentType: false, //must, tell jQuery not to process the data
                        processData: false,

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
}

</script>