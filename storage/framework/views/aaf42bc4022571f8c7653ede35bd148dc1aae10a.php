<?php $__env->startSection('content'); ?>
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
                        <form  id="loginForm" method="post" action="<?php echo e(url('/forgetpassword')); ?>" onsubmit="return emailvalidate()">
							     <?php echo csrf_field(); ?>

                            <?php if(Session::has('invalidemail')): ?>
                              <body onload="demo.showNotification('top','center',4,'Invalid Email')"/>
                            <?php endif; ?>
                            <?php if(Session::has('successemail')): ?>
                              <body onload="demo.showNotification('top','center',2,'The password has sent to your registered email.')"/>
                                <?php endif; ?>
                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label class="control-label" for="email">Email</label>
                                <input type="text" title="Please enter you email" value="" name="email" id="email" class="form-control">
                                <span style="color:red;" id="email_error" > </span>
                                <?php if($errors->has('email')): ?>
                                    <span style="color:red">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
							<a class="btn btn-default btn-block" href="<?php echo e(url('/login')); ?>">Login</a>
                            <!--<a class="btn btn-default btn-block" href="<?php echo e(url('/register')); ?>">Register</a>-->

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
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
            document.getElementById("email_error").innerHTML = "Please enter valid email address";
               status=false;
            document.getElementById("email").focus();
        }
        else
            {
                document.getElementById("email_error").innerHTML = "";
            }
            return status;
    }
</script>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>