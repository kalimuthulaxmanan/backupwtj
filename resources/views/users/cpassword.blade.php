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
	                            <form method="POST" action="{{ url('/savepassword')}}">
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
													<input type="password"  title="Please enter your password" required="" class="form-control" name="current_password" minlength="6">

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
													<input type="password"  title="Please enter your password" required="" class="form-control" name="password" minlength="6">

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
													<input type="password" title="Please enter your password" required="" class="form-control" name="password_confirmation" minlength="6">

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