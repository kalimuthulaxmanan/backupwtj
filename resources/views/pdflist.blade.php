@extends('layouts.main')

@section('content1')
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">File Table</h4>
                                    <p class="category">Details about the Files</p>
                                </div>
								  @if(Session::has('deletesucessfull'))
                              <body class="login-close" onload="demo.showNotification('top','center',2,'File deleted sucessfully')"/>
                                   {{session::forget('deletesucessfull')}} 
								@endif
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                            	<th>S.No</th>
                                                <th>File Name</th>
                                                <th>User Name</th>
												<th>Created Date</th>
												
                                                
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
												 <th>&nbsp;&nbsp;&nbsp;</th>
												<th>&nbsp;&nbsp;&nbsp;</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($pdflist as $file)
                                            <tr>
                                            	<td>{{$file->file_name}}</td>
												<td>{{$file->firstName}}</td>
												<td>{{$file->created_at}}</td>
												
												<td><a href="{{ url('/fileGenerate') }}" ><i class="fa fa-cogs" aria-hidden="true" title="Generate"></i></a></td>	
												<td><a href="{{ url('/download') }}"><i class="material-icons"  title="PDF" >picture_as_pdf</i> </a></td>	
												<td><a href="" ><i class="fa fa-file-word-o " aria-hidden="true" title="Word"></i></a></td>
												
												<td><a href="{{ url('/flipbook') }}" ><i class="fa fa-book" aria-hidden="true" title="Flip Book" ></i></a></td>
												<td> <a href="{{ url('/listdelete') }}/<?php echo $file->id;?>"><i class="material-icons"  title="Delete" >delete</i></a></td>
                                             <!--   <td><a href="{{ url('/useredit') }}/<?php echo $file->id; ?>" alt="Edit" title="Edit"><i class="material-icons">mode_edit</i></a></td>
                                                <td><a href="{{ url('/userdelete') }}/<?php echo $file->id; ?>" alt="Delete" title="Delete"><i class="material-icons">delete</i></a></td>-->
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