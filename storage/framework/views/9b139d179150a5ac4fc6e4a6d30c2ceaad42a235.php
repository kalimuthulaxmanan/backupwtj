<?php $__env->startSection('content1'); ?>
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
                <?php foreach($user as $row): ?>
                    <div class="card-header" data-background-color="purple">
                    	<?php if(Session::has('updateprofilesuccess')): ?>
                        <body onload="demo.showNotification('top','center',2,'Profile updated Successfully.')"/>
                        <?php endif; ?>
                    	<div class="row">
                    		<div class="col-md-9">
                                <h4 class="title">My Profile</h4>
								<p class="category">Welcome to your profile</p>
							 </div>

                    		<div class="col-md-3"> 
                    		<a href="<?php echo e(url('/profileedit')); ?>/<?php echo $row->id; ?>" title="Edit Profile"><i class="material-icons edit-icon">border_color</i></a>
                    		</div>
                    	</div>
                    </div>
                    <div class="card-content">
                    	<div class="row">
                    		<div class="col-md-3">            			
								<img src="<?php echo e(url('/images/profile.jpg')); ?>">
                    		</div>
                    		<div class="col-md-9 view-profile">
								<ul>
									<li><i class="material-icons">email</i> <?php echo e($row->email); ?></li>
									<li><i class="material-icons">home	</i> <?php echo e($row->address); ?></li>
									<li><i class="material-icons">phone</i> <?php echo e($row->phone); ?></li>
									<li><i class="material-icons">location_city</i> <?php echo e($row->city); ?></li>
									<li><i class="material-icons">language</i> <?php echo e($row->country); ?></li>
								
								</ul>
                    		</div>
                    	</div>
                        <!--<button type="submit" class="btn btn-primary pull-right">Edit Profile</button>-->   	                             
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>