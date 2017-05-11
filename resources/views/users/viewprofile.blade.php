@extends('layouts.main')

@section('content1')
<style type="text/css">
	
.image img{
	width: 100%;
	height: 300px;
}
.view-profile{
	width: 60%;
	display: inline-block;
	vertical-align: top;
	padding-left: 30px;
}
.view-profile ul{
	padding: 0;
	margin: 0;
}
.view-profile ul li{
	list-style: none;
	margin-bottom: 15px;
    line-height: 30px;
}
.view-profile ul li:last-child{
	margin: 0;
}
.view-profile ul li i{
    font-size: 24px;
    float: left;
    margin-right: 15px;
    line-height: 30px;
    width: 30px;
    text-align: center;
    color: #a9afbb;
}
.edit-icon{
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
                @foreach($user as $row)
                    <div class="card-header" data-background-color="purple">
                    	@if(Session::has('updateprofilesuccess'))
                        <body onload="demo.showNotification('top','center',2,'Profile updated Successfully.')"/>
                        @endif
                    	<div class="row">
                    		<div class="col-md-9">
                                <h4 class="title">My Profile</h4>
								<p class="category">Welcome to your profile</p>
							 </div>

                    		<div class="col-md-3"> 
                    		<a href="{{ url('/profileedit') }}/<?php echo $row->id; ?>" title="Edit Profile"><i class="material-icons edit-icon">border_color</i></a>
                    		</div>
                    	</div>
                    </div>
                    <div class="card-content">
                    	<div class="row">
                    		<div class="col-md-3">            			
								<img src="{{ url('/images/profile.jpg')}}">
                    		</div>
                    		<div class="col-md-9 view-profile">
								<ul>
									<li><i class="material-icons">email</i> {{$row->email}}</li>
									<li><i class="material-icons">home	</i> {{$row->address}}</li>
									<li><i class="material-icons">phone</i> {{$row->phone}}</li>
									<li><i class="material-icons">location_city</i> {{$row->city}}</li>
									<li><i class="material-icons">language</i> {{$row->country}}</li>
								
								</ul>
                    		</div>
                    	</div>
                        <!--<button type="submit" class="btn btn-primary pull-right">Edit Profile</button>-->   	                             
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection