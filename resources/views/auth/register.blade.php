    @extends('layouts.app')

@section('content')

<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-center m-b-md">
                    <div class="card-header" data-background-color="purple">
                    <h4 class="title">REGISTRATION</h4>            
                    </div> 
              <!--  <small>Full suported AngularJS WebApp/Admin template with very clean and aesthetic style prepared for your next app. </small>-->
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                            
                            <div class="form-group col-lg-12{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label>Username</label>
                                  <input type="text" placeholder="Fullname" title="Please enter you fullname" required="" class="form-control" name="fullname" value="{{ old('fullname') }}">

                                @if ($errors->has('fullname'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                @endif
                            </div>
								  <div class="form-group col-lg-12{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email Address</label>
                                  <input type="email" placeholder="example@gmail.com" title="Please enter you email" required="" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Password</label>
                                       <input type="password"  title="Please enter your password" placeholder="******" required="" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label>Repeat Password</label>
                                     <input type="password" title="Please enter your password" placeholder="******" required="" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
								
								<div class="form-group col-lg-12{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Register</button>
                                <a href="{{ url('/login') }}"><button type="button"  class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

