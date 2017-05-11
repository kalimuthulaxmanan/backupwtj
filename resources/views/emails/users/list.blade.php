@extends('layouts.main')

@section('content1')
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                                <div id="alertclose">
                            @if(Session::has('updatesuccess'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('updatesuccess') }}</p>
                           {{Session::forget('updatesuccess')}}
                            @endif
                            </div>
                             	<div class="card-header" data-background-color="purple">
                                    <h4 class="title">User Table</h4>
                                    <p class="category">Details about the User</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                            	<th>S.No.</th>
                                            	<th>User id</th>
                                                <th>User name</th>
                                                <th>E-mail</th>
                                                <!--<th>Image</th>-->
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($viewme as $row)
                                            <tr>
                                            	<td>{{$row->id}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->email}}</td>
                                                <!--<td class="image"><img src="{{$row->image}}"/></td>-->
                                                <td><a href="{{ url('/useredit') }}/<?php echo $row->id; ?>" alt="Edit" title="Edit"><i class="material-icons">mode_edit</i></a></td>
                                                <td><a href="{{ url('/userdelete') }}/<?php echo $row->id; ?>" alt="Delete" title="Delete"><i class="material-icons">delete</i></a></td>
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
