@extends('layouts.main')

@section('content1')
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="purple">
	                                <h4 class="title">Add User</h4>
									<p class="category">Complete User profile</p>
	                            </div>
	                            <div class="card-content">
	                                <form method="POST" action="{{ url('/adduser')}}" enctype="multipart/form-data">
	                                {!! csrf_field() !!}
		                                @if(Session::has('addsuccess'))
	                              <body onload="demo.showNotification('top','center',2,'User Added Successfully.')"/>
	                                @endif
	                                	<div class="row">
	                                        <div class="col-md-6">
												<div class="form-group label-floating{{ $errors->has('firstname') ? ' has-error' : '' }}">
													<label class="control-label">First name</label>
												<input type="text" title="Please enter you firstName" required="" class="form-control" name="firstname" value="{{ old('firstname') }}">

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
												<input type="text" title="Please enter you lastName" required="" class="form-control" name="lastname" value="{{ old('lastname') }}">

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
													<input type="email"  title="Please enter you email" required="" class="form-control" name="email" value="{{ old('email') }}">

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
													<input type="text" title="Please enter you phone number" required="" class="form-control" name="phone" value="{{ old('phone') }}">

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
													<input type="text" title="Please enter you Address" required="" class="form-control" name="address" value="{{ old('address') }}">

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
													<input type="text" title="Please enter you City" required="" class="form-control" name="city" value="{{ old('city') }}">

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
													<input type="text" title="Please enter you Country" required="" class="form-control" name="country" value="{{ old('country') }}">

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
													<input type="password"  title="Please enter your password" required="" class="form-control" name="password" minlength="6">

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
													<input type="password" title="Please enter your password" required="" class="form-control" name="password_confirmation" minlength="6">

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