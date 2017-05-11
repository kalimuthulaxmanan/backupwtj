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
                                    <table  id="example" class="mdl-data-table table" cellspacing="0" width="100%">
                                        <thead class="text-primary">
                                            <tr>
                                            	<th>S.No</th>
                                                <th>File Name</th>
                                                <th>User Name</th>
												<th>Created Date</th>
												
                                                
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($pdflist as $file)
                                            <tr>
                                            	<td>{{$file->file_name}}</td>
												<td>{{$file->firstName}}</td>
												<td>{{$file->created_at}}</td>
												
												<td>
												<a style="padding-right:20px;" href="{{ url('/generateHtmlPreview') }}/{{$file->id}}" ><i class="fa fa-cogs" aria-hidden="true" title="Generate"></i></a>
												<a style="padding-right:20px;" href="{{ url('/generatePdfPreview') }}/{{$file->id}}" target="_blank"><i class="material-icons"  title="PDF" >picture_as_pdf</i> </a>	<a style="padding-right:20px;" href="#" ><i class="fa fa-file-word-o " aria-hidden="true" title="Word"></i></a>
												<a style="padding-right:20px;" href="{{ url('/flipbook') }}/{{$file->id}}" target="_blank"><i class="fa fa-book" aria-hidden="true" title="Flip Book" ></i></a>
												<a style="padding-right:20px;" onclick="return confirm('Are you sure you want to delete this item?');" href="{{ url('/listdelete') }}/<?php echo $file->id;?>"><i class="material-icons"  title="Delete" >delete</i></a></td>

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