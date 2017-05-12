@extends('layouts.main')

@section('content1')
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
                                    <a href="{{ url('/adduser')}}" title="Add User"><i class="fa fa-user-plus adduser"  aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                                @if(Session::has('deleteuser'))
                                      <body onload="demo.showNotification('top','center',2,'Deleted Successfully')"/>
                                @endif
                                @if(Session::has('updatesuccess'))
                                      <body onload="demo.showNotification('top','center',2,'Updated Successfully')"/>
                                @endif
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
                                        <tbody>
                                        	@foreach($viewme as $row)
                                            <tr>
                                                <td>{{$row->firstName}}</td>
                                                <td>{{$row->email}}</td>
                                                <!--<td class="image"><img src="{{$row->image}}"/></td>-->
                                                <td>
													<a style="padding-right:20px;" href="{{ url('/useredit') }}/<?php echo $row->id; ?>" alt="Edit" title="Edit"><i class="material-icons">mode_edit</i></a>
													<a style="padding-right:20px;" onclick="return confirm('Are you sure you want to delete?');" href="{{ url('/userdelete') }}/<?php echo $row->id; ?>" alt="Delete" title="Delete"><i class="material-icons">delete</i></a></td>
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
