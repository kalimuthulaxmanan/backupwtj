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

									<a href="{{ url('generateDoc') }}/{{$fileid}}"> <button type="button"  class="btn btn-primary " target="_blank">Word</button></a>
									<a href="{{ url('/generatePdfPreview') }}/{{$fileid}}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="{{ url('/flipbook') }}/{{$fileid}}" target="_blank"> <button type="button" class="btn btn-primary ">Flip Book</button></a>	
                                    <input type="hidden" name="uploadpath" value="<?php echo $uploadpath; ?>"  id="uploadpath"/>
									<a href="{{ url('/pdflist') }}"> <button type="button" class="btn btn-primary ">Back</button></a>
									<div class="container">
										
										<?php echo $data; ?>
                                         
									
									</div>

									<a href="{{ url('generateDoc') }}/{{$fileid}}" > <button type="button" class="btn btn-primary " target="_blank">Word</button></a>
									<a href="{{ url('/generatePdfPreview') }}/{{$fileid}}" target="_blank"> <button type="button" class="btn btn-primary ">PDF</button></a>	
									<a href="{{ url('/flipbook') }}/{{$fileid}}" target="_blank" > <button type="button" class="btn btn-primary ">Flip Book</button></a>		    

									<!-- PDF view end -->
									
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
      </div>

@endsection
<style>
        .edit-image label:before {
          content: url("https://cdn1.iconfinder.com/data/icons/windows8_icons_iconpharm/26/unchecked_checkbox.png");
          position: absolute;
          z-index: 100;
        }

        :checked+label:before {
          content: url("https://cdn1.iconfinder.com/data/icons/windows8_icons_iconpharm/26/checked_checkbox.png");
        }

        input[type=radio] {
          display: none;
        }
                
        .edit-image img {
          width: 130px;
          height: 130px;
        }

        .file-upload{
    max-width: 800px;
    margin: 0 auto;
    margin-top: 30px;
    padding: 20px;
    font-family:'Roboto';
    font-size: 20px;
    text-align: center;
}
.box{
    background-color: #f5f5f5;
    padding: 6.25rem 1.25rem;
}
.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    cursor: pointer;
}
.inputfile + label {
    color: #000;
    cursor: pointer;
    display: block;
}

.inputfile:focus + label,
.inputfile.has-focus + label,
.inputfile + label:hover {
    color: #000;
}

.inputfile + label figure {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #a62cbb;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile:focus + label figure,
.inputfile.has-focus + label figure,
.inputfile + label:hover figure {
    background-color: #852196;
}

.inputfile + label svg {
    width: 100%;
    height: 100%;
    fill: #f1e5e6;
}
.box input[type=submit]{
    background-color: #d3394c;
    padding: 10px 25px;
    border: none;
    width: 150px;
    color: #fff;
    font-weight: 600;
    display: inline-block;
    margin-top: 10px;
}
.box input[type=submit]:hover{
    background-color: #722040;
}

    </style>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
           
        <div class="card-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <h4 class="title">Choose Image</h4>
                            
                        </div>
                    <ul class="nav nav-tabs">
                      <li><a data-toggle="tab" href="#home">Upload</a></li>
                      <li class="active"><a data-toggle="tab" href="#menu1">Select</a></li>
                    </ul>

                <div class="tab-content">
                  <div id="home" class="tab-pane fade">
                        <form id="upload_img" name="upload_img" action="" onsubmit="return setimage();" method="post" enctype="multipart/form-data" >
                    <div class="modal-body file-upload">   
                                {!! csrf_field() !!} 
                                <input type="file" name="image" id="image" class="inputfile">
                                <label for="image">
                                    <figure>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                    </figure> 
                                <span id="uploadfile">Choose a file...</span></label>
                    </div>
                    <div class="modal-footer">
                    <p id="meg"></p>
						         <input type="text" name="uploadpath" value="<?php echo $uploadpath; ?>"  id="uploadpath"/>
                                <input type="submit" name="submit" class="btn btn-default"  />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                    </div>
                    </form>
                    
                      
                  </div>
                  <div id="menu1" class="tab-pane fade in active">
                   <div class="modal-body edit-image">
					   
                        @foreach($galleries as $gallery)

                        <input type="radio" id="{{$gallery->id}}" name="myRadio"/>
                        <label for="{{$gallery->id}}">
						<img id="imageid{{$gallery->id}}" src="{{ url('/') }}/<?php echo trim($gallery->image);?>" />
                        </label>
                        @endforeach
                     <!--   <input type="radio" id="2" name="myRadio" />
                        <label for="2">
                          <img id="imageid2" src="images/fileimage/images/image4.jpg" />
                        </label>
                        <input type="radio" id="3" name="myRadio" />
                        <label for="3">
                          <img id="imageid3" src="images/fileimage/images/image5.jpg" />
                        </label>
                        <input type="radio" id="4" name="myRadio" />
                        <label for="4">
                          <img id="imageid4" src="images/fileimage/images/image6.jpg" />
                        </label>
                        <input type="radio" id="5" name="myRadio" />
                        <label for="5">
                          <img id="imageid5" src="images/fileimage/images/image7.jpg" />
                        </label>
                        <input type="radio" id="6" name="myRadio" />
                        <label for="6">
                          <img id="imageid6" src="images/fileimage/images/image8.jpg" />
                        </label>-->
                        <input type="text" name="radio" value="" id="fill"/><br>
                        <input type="text" name="radio" value="" id="fill2"/><br>
                        <input type="text" name="radio" value="" id="fill1"/><br>
					   <input type="text" name="radio" value="" id="popimgid"/>
					  
                       </div> 
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" onclick="changeimage()" data-dismiss="modal">Change</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
                    <!--<div class="modal-footer">
                      <button type="button" class="btn btn-default" onclick="setimage()" data-dismiss="modal">Change</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>-->
                </div>
            </div>
     
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
        $(document).ready(function(){
        $("input[type='radio']").click(function(){
            var radioValue = $("input[name='myRadio']:checked").attr('id');
          var src=($("#imageid"+radioValue).attr('src')); 
           var poimgid=document.getElementById("popimgid").value=radioValue;
          var x=document.getElementById("fill1").value=src;
        });
        
    });
         

    function newFunction(id,imageid)
    {   
        document.getElementById("fill").value=id;
        document.getElementById("fill2").value=imageid;
      
    }

    function changeimage()
    {
        var z=document.getElementById("fill2").value;
        var x=document.getElementById("fill").value;
        var y=document.getElementById("fill1").value;
	    var baseurl="<?php echo url('/'); ?>";
   	   var popimgid=document.getElementById("popimgid").value;
	
        $('#'+x).attr("src",y);  
        var Imgname = y.split("/")[y.split("/").length-1];
		
        
         
      /*  $.ajax({
                          type: 'get',
                          
                          url :baseurl+"/changeimage/"+z+"/"+Imgname,
                          
                        
   }); */
          
 $.ajax({
                          type: 'post',
                          
                          url :baseurl+"/changeimage/"+z,

                          data:{
						    "_token": "{{ csrf_token() }}",
                            
                             file_path:popimgid,
                              },
            });         
	}

   function setimage()
   {
    var form = new FormData(document.getElementById("upload_img"));
    var x=document.getElementById("fill").value;
    var z=document.getElementById("fill2").value;
    var f =document.getElementById("uploadfile").innerHTML;
	var uploadpath=document.getElementById("uploadpath").value; 

	var baseurl="<?php echo url('/'); ?>"; 
	var file_name=baseurl+'/'+uploadpath+f;   
	console.log(file_name)
	   

 $.ajax({
                          type: 'post',
                          
                          url :baseurl+"/galleryupload/"+z,

                          data:form,
                          cache: false,
                        contentType: false, //must, tell jQuery not to process the data
                        processData: false,
                        success: function()
                        {
                        $('#'+x).attr("src",file_name); 
                      $("#myModal .close").click();


                        }
                        
                         
                       
   





   });
                       


return false;



   }



    'use strict';

;( function ( document, window, index )
{
    var inputs = document.querySelectorAll( '.inputfile' );
    Array.prototype.forEach.call( inputs, function( input )
    {
        var label    = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
}( document, window, 0 ));
   
    </script>