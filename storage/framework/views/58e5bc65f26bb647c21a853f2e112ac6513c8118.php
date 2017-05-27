<?php $__env->startSection('content1'); ?>
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">PDF List</h4>
                                    <p class="category">Details about the PDF </p>
                                </div>
								  <?php if(Session::has('deletesucessfull')): ?>
                              <body class="login-close" onload="demo.showNotification('top','center',2,'File deleted sucessfully')"/>
                                   <?php echo e(session::forget('deletesucessfull')); ?> 
								<?php endif; ?>
                                <div class="card-content table-responsive">
                                    <table  id="example" class="mdl-data-table table" cellspacing="0" width="100%">
                                        <thead class="text-primary">
                                            <tr>
                                            	<th>S.No</th>
                                                <th style="width: 15%">File Name</th>
                                                <th style="width: 20%">Client Name</th>
												<th style="width: 20%">Created Date</th>
                                                <th style="text-align:center">Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody class="tbodypad">
                                        	<?php foreach($pdflist as $file): ?>
                                            <tr>
                                            	<td><?php echo e($file->upload_file); ?></td>
												<?php if($file->firstName!=null): ?>
												<td><?php echo e($file->firstName); ?></td>
												<?php else: ?>
												<td><?php echo e($file->email); ?></td>
												<?php endif; ?>
												
												<td><?php $dates="$file->created_at"; $date=date_create_from_format("Y-m-d H:i:s","$dates");
                                                echo date_format($date,"M-d-Y"); ?></td>
												
												<td>
												<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Generate" href="<?php echo e(url('/generateHtmlPreview')); ?>/<?php echo e(base64_encode($file->id)); ?>" ><i class="fa fa-cogs" aria-hidden="true"></i></a>
												<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="PDF" href="<?php echo e(url('/generatePdfPreview')); ?>/<?php echo e(base64_encode($file->id)); ?>" target="_blank"><i class="material-icons">picture_as_pdf</i> </a>	
                                                <a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Word" href="#" ><i class="fa fa-file-word-o " aria-hidden="true"></i></a>
												<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Flip Book" href="<?php echo e(url('/flipbook')); ?>/<?php echo e(base64_encode($file->id)); ?>" target="_blank"><i class="fa fa-book" aria-hidden="true"></i></a>
												<a style="padding:10px 15px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo e(url('/listdelete')); ?>/<?php echo base64_encode($file->id);?>"><i class="material-icons">delete</i></a></td>

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