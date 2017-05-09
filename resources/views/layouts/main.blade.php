<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{ url('/images/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Window To Japan</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ url('/assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ url('/assets/css/material-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('/assets/css/custom.css')}}" rel="stylesheet" />

	<link rel="stylesheet" href="{{ url('assets/css/custom-stylehtml.css')}}" />
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">  
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

    <div class="wrapper">

        <div class="sidebar" data-color="purple" data-image="{{ url('/assets/img/sidebar-1.jpg')}}">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->

            <div class="logo">
                <a href="{{url('/dashboard')}}" class="simple-text">
                    <img width="200px" src="{{ url('/images/logo.png')}}">
                </a>
            </div>

            <div class="sidebar-wrapper">
                <ul class="nav collapsible">
                    <li >
                        <a class="collapsible-header" href="{{url('/dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li> 
											<?php $currentUrl= url()->current(); ?>

                    <li>
						
                        <a class="collapsible-header active collapsible-header <?php echo (strpos($currentUrl,'userlist')!=0)?'Activesub':''; ?> <?php echo (strpos($currentUrl,'adduser')!=0)?'Activesub':''; ?> ">
                            <i <?php echo (strpos($currentUrl,'adduser')!=0 || strpos($currentUrl,'userlist')!=0)?'style="color:white"':''; ?> class="material-icons">person</i>
                            <p <?php echo (strpos($currentUrl,'adduser')!=0 || strpos($currentUrl,'userlist')!=0)?'style="color:white"':''; ?> >User Profile</p>
                        </a>
                        <div class="collapsible-body <?php echo (strpos($currentUrl,'adduser')!=0)?'activeDisplay':''; ?> <?php echo (strpos($currentUrl,'userlist')!=0)?'activeDisplay':''; ?>"  >
                            <a href="{{ url('/userlist')}}">
                                <i class="fa fa-list" aria-hidden="true"></i>List User
                            </a>
                            <a href="{{ url('/adduser')}}">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Add User
                            </a> 
                        </div>
                    </li>
                    <li <?php echo (strpos($currentUrl,'pdflist')!=0)?'class="Active"':''; ?> <?php echo (strpos($currentUrl,'generateHtmlPreview')!=0)?'class="Active"':''; ?>>
                        <a  class="collapsible-header"  href="{{ url('/pdflist')}}">
                            <i class="material-icons">picture_as_pdf</i>
                            <p  >PDF List</p>
                        </a>
                        <!--<div class="collapsible-body">
                            <a href="#">
                                <i class="fa fa-user" aria-hidden="true"></i>Add User
                            </a>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>Star
                            </a>
                            <a href="#">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>Sent Mail
                            </a>
                            <a href="#">
                                <i class="fa fa-envelope-open" aria-hidden="true"></i>Drafts
                            </a>
                        </div>-->
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!--<li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Mike John responded to your email</a></li>
                                    <li><a href="#">You have 5 new tasks</a></li>
                                    <li><a href="#">You're now friend with Andrew</a></li>
                                    <li><a href="#">Another Notification</a></li>
                                    <li><a href="#">Another One</a></li>
                                </ul>
                            </li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">account_circle</i>
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li><a href="{{ url('/viewprofile')}}"><i class="material-icons">account_box</i>View Profile</a></li>
                                    
                                    <li><a href="{{ url('/changepassword')}}"><i class="material-icons">vpn_key</i>Change Password</a></li>
                                    <li>
                                    <a href="{{ url('/logout')}}">
                                    <i class="material-icons">input</i> Log Out
                                    </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>

                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i><div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            @yield('content')
            @yield('content1')
            <footer class="footer">
                <div class="container-fluid">
                    <!--<nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                   Blog
                                </a>
                            </li>
                        </ul>
                    </nav>-->
                    <!--<p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.kenhike.com">Kenhike</a>, made with love for a better web
                    </p>-->
                </div>
            </footer>
        </div>
    </div>
</body>


    <!--   Core JS Files   -->
    <script src="{{ url('/assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/material.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/material.js')}}" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('/assets/js/bootstrap-notify.js')}}"></script>

    <!-- Material Dashboard javascript methods -->
    <script src="{{ url('/assets/js/material-dashboard.js')}}"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ url('/assets/js/demo.js')}}"></script>

    <script src="{{ url('/assets/js/according.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{ url('/css/dataTables.material.css')}}">


	<script type="text/javascript" language="javascript" src="{{ url('/js/jquery.dataTables.js')}}">
	</script>

	<script type="text/javascript" language="javascript" class="init">
	
jQuery(document).ready(function($) {
	$('#example').DataTable();
} );

	</script>


</html>
<script>
    jQuery(function($) {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('ul a').each(function() {
      if (this.href === path) {
       $(this).addClass('active');
	  var $parent = $(this).parent();
		  
       if (!$parent.hasClass('active')) {
           $parent.addClass('active');
       }  
      
	  }
     });
    });
	
	
	setTimeout(function() { 
    jQuery(".activeDisplay").css('display','block'); 
}, 600);



</script>
<style>
	.Activesub, .Activesub a, .activeDisplay a
	{
		background-color:#9c27b0;
		box-shadow:0 12px 20px -10px rgba(156, 39, 176, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
	}
	
</style>