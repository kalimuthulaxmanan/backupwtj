@extends('layouts.main')

@section('content1')
<div class="content pdf-view">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <div class="card">
                               <!-- <div class="card-header" data-background-color="purple">
                                    <h4 class="title">File Table</h4>
                                    <p class="category">Details about the Files</p>
                                </div>-->
                                <div class="card-content table-responsive">
									
									<!-- PDF view start -->

									<a href=""> <button type="button"  class="btn btn-primary ">Word</button></a>
									<a href="{{ url('/download') }}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="" > <button type="button" class="btn btn-primary ">Flip Book</button></a>	

									<div class="container">
										
										<?php echo $data; ?>

									
									</div>

									<a href="" > <button type="button" class="btn btn-primary ">Word</button></a>
									<a href="{{ url('/download') }}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="" > <button type="button" class="btn btn-primary ">Flip Book</button></a>		    

									<!-- PDF view end -->
									
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
      </div>

@endsection