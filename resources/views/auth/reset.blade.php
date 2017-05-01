@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-center m-b-md">
            <div class="card-header" data-background-color="purple">
                 <h4 class="title">Forgot Password</h4>                  
            </div>
            <!--    <small>This is the best app ever!</small>-->
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <form  id="loginForm" method="post" action="{{ url('/forgetpassword') }}">
							     {!! csrf_field() !!}
                            @if(Session::has('invalidemail'))
                              <body onload="demo.showNotification('top','center',4,'Invalid Email')"/>
                            @endif
                            @if(Session::has('successemail'))
                              <body onload="demo.showNotification('top','center',2,'The password has sent to your registered email.')"/>
                                @endif
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" title="Please enter you email" required="" value="" name="email" id="email" class="form-control">
                                @if ($errors->has('email'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
							<a class="btn btn-default btn-block" href="{{ url('/login') }}">Login</a>
                            <!--<a class="btn btn-default btn-block" href="{{ url('/register') }}">Register</a>-->

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
