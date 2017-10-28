<?php $__env->startSection('content1'); ?>
<style type="text/css">
.adduser{
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
                                        <h4 class="title">User Table</h4>
                                        <p class="category">Details about the users</p>
                                     </div>

                                    <div class="col-md-3"> 
                                    <a href="<?php echo e(url('/adduser')); ?>" title="Add User"><i class="fa fa-user-plus adduser"  aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                                <?php if(Session::has('deleteuser')): ?>
                                      <body onload="demo.showNotification('top','center',2,'Deleted Successfully')"/>
                                <?php endif; ?>
                                <?php if(Session::has('updatesuccess')): ?>
                                      <body onload="demo.showNotification('top','center',2,'Updated Successfully')"/>
                                <?php endif; ?>
                                <div class="card-content table-responsive">
                                    <table id="example" class="table">
                                        <thead class="text-primary">
                                            <tr>
                                            	<th>S.No.</th>
                                                <th>First Name</th>
                                                <th>Email</th>
                                                <!--<th>Image</th>-->
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbodypad">
                                        	<?php foreach($viewme as $row): ?>
                                            <tr>
                                                <td><?php echo e($row->firstName); ?></td>
                                                <td><?php echo e($row->email); ?></td>
                                                <!--<td class="image"><img src="<?php echo e($row->image); ?>"/></td>-->
                                                <td>
													<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Edit" href="<?php echo e(url('/useredit')); ?>/<?php echo $row->id; ?>" alt="Edit"><i class="material-icons">mode_edit</i></a>
													<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');" href="<?php echo e(url('/userdelete')); ?>/<?php echo $row->id; ?>" alt="Delete"><i class="material-icons">delete</i></a></td>
                                            </tr>
                                            <?php endforeach; ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
	        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>