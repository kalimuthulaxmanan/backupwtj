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
										<?php if($errors->any()): ?>
									<body onload="demo.showNotification('top','center',4,'Unable to generate file, because of invalid arguments or invalid image names')"/>
                                    <?php endif; ?>
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
                                                echo date_format($date,"M-d-Y"); ?><br /><?php echo date_format($date,"h:i:sa");?></td>
												<?php $file_name=base64_encode($file->id);  $publicpath=public_path(); $file_path = $publicpath.'/pdf/'.$file_name.'.pdf';   ?>
												<td>
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Click to Generate preview and pdf" href="<?php echo e(url('/generateHtmlPreview')); ?>/<?php echo e(base64_encode($file->id)); ?>" ><i class="fa fa-cogs" aria-hidden="true"></i></a>
												<a <?php if (!(file_exists($file_path))){ echo 'disabled';} ?> style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="<?php if($file->pdf_name==NULL){echo 'Click left icon to generate pdf'; } elseif($file->pdf_name==1){echo 'PDF';} elseif($file->pdf_name==0){echo 'contents exist page size so Unable to generate PDF';} ?>" href="<?php echo e(url('/download')); ?>/<?php echo e(base64_encode($file->id)); ?>.pdf"><i class="material-icons">picture_as_pdf</i> </a>	
                                                <a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Word" href="<?php echo e(url('generateDoc')); ?>/<?php echo e(base64_encode($file->id)); ?>" ><i class="fa fa-file-word-o " aria-hidden="true"></i></a>
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Flip Book" href="<?php echo e(url('/flipbook')); ?>/<?php echo e(base64_encode($file->id)); ?>" target="_blank"><i class="fa fa-book" aria-hidden="true"></i></a>
												<input type="hidden" name="flip_url" id="<?php echo e($file->id); ?>" value ="<?php echo e(url('/flipbook')); ?>/<?php echo e(base64_encode($file->id)); ?>" />
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Click & Copy Flip Book Link" s><i class="fa fa-link" onClick="copyToClipboard('#<?php echo e($file->id); ?>')" aria-hidden="true"></i></a>	
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo e(url('/listdelete')); ?>/<?php echo base64_encode($file->id);?>"><i class="material-icons">delete</i></a></td>
                                                 <TEXTAREA ID="holdtext" STYLE="display:none;"></TEXTAREA> 
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

<SCRIPT LANGUAGE="JavaScript">

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
}

</SCRIPT>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>