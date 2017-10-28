@extends('layouts.main')

@section('content1')
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">PDF List</h4>
                                    <p class="category">Details about the PDF </p>
                                </div>
								  @if(Session::has('deletesucessfull'))
                              <body class="login-close" onload="demo.showNotification('top','center',2,'File deleted sucessfully')"/>
                                   {{session::forget('deletesucessfull')}} 
								@endif
                                <div class="card-content table-responsive">
										@if($errors->any())
									<body onload="demo.showNotification('top','center',4,'Unable to generate file, because of invalid arguments or invalid image names')"/>
                                    @endif
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
                                        	@foreach($pdflist as $file)
                                            <tr>
                                            	<td>{{$file->upload_file}}</td>
												@if($file->firstName!=null)
												<td>{{$file->firstName}}</td>
												@else
												<td>{{$file->email}}</td>
												@endif
												
												<td><?php $dates="$file->created_at"; $date=date_create_from_format("Y-m-d H:i:s","$dates");
                                                echo date_format($date,"M-d-Y"); ?><br /><?php echo date_format($date,"h:i:sa");?></td>
												<?php $file_name=base64_encode($file->id);  $publicpath=public_path(); $file_path = $publicpath.'/pdf/'.$file_name.'.pdf';   ?>
												<td>
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Click to Generate preview and pdf" href="{{ url('/generateHtmlPreview') }}/{{base64_encode($file->id)}}" ><i class="fa fa-cogs" aria-hidden="true"></i></a>
												<a <?php if (!(file_exists($file_path))){ echo 'disabled';} ?> style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="<?php if($file->pdf_name==NULL){echo 'Click left icon to generate pdf'; } elseif($file->pdf_name==1){echo 'PDF';} elseif($file->pdf_name==0){echo 'contents exist page size so Unable to generate PDF';} ?>" href="{{ url('/download') }}/{{base64_encode($file->id)}}.pdf"><i class="material-icons">picture_as_pdf</i> </a>	
                                                <a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Word" href="{{ url('generateDoc') }}/{{base64_encode($file->id)}}" ><i class="fa fa-file-word-o " aria-hidden="true"></i></a>
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Flip Book" href="{{ url('/flipbook') }}/{{base64_encode($file->id)}}" target="_blank"><i class="fa fa-book" aria-hidden="true"></i></a>
												<input type="hidden" name="flip_url" id="{{$file->id}}" value ="{{ url('/flipbook') }}/{{base64_encode($file->id)}}" />
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Click & Copy Flip Book Link" s><i class="fa fa-link" onClick="copyToClipboard('#{{$file->id}}')" aria-hidden="true"></i></a>	
												<a style="padding:10px 10px;" class="btn btn-primary btn-simple" rel="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');" href="{{ url('/listdelete') }}/<?php echo base64_encode($file->id);?>"><i class="material-icons">delete</i></a></td>
                                                 <TEXTAREA ID="holdtext" STYLE="display:none;"></TEXTAREA> 
                                            </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
	        </div>
@endsection

<SCRIPT LANGUAGE="JavaScript">

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
}

</SCRIPT>
