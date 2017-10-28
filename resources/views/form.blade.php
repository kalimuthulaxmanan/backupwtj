
@extends('layouts.main')
@section('content')	
<style type="text/css">
/* leave this part out */
/* leave this part out */

.clearfix{*zoom:1;}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0;}
.clearfix:after{clear:both;}
.hide-text{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0;}
.input-block-level{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
.btn-file{overflow:hidden;position:relative;vertical-align:middle;}.btn-file>input{position:absolute;top:0;right:0;margin:0;opacity:0;filter:alpha(opacity=0);transform:translate(-300px, 0) scale(4);font-size:23px;direction:ltr;cursor:pointer;}
.fileupload{margin-bottom:9px;}.fileupload .uneditable-input{display:inline-block;margin-bottom:0px;vertical-align:middle;cursor:text;}
.fileupload .thumbnail{overflow:hidden;display:inline-block;margin-bottom:5px;vertical-align:middle;text-align:center;}.fileupload .thumbnail>img{display:inline-block;vertical-align:middle;max-height:100%;}
.fileupload .btn{vertical-align:middle;}
.fileupload-exists .fileupload-new,.fileupload-new .fileupload-exists{display:none;}
.fileupload-inline .fileupload-controls{display:inline;}
.fileupload-new .input-append .btn-file{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;}
.thumbnail-borderless .thumbnail{border:none;padding:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
.fileupload-new.thumbnail-borderless .thumbnail{border:1px solid #ddd;}
.control-group.warning .fileupload .uneditable-input{color:#a47e3c;border-color:#a47e3c;}
.control-group.warning .fileupload .fileupload-preview{color:#a47e3c;}
.control-group.warning .fileupload .thumbnail{border-color:#a47e3c;}
.control-group.error .fileupload .uneditable-input{color:#b94a48;border-color:#b94a48;}
.control-group.error .fileupload .fileupload-preview{color:#b94a48;}
.control-group.error .fileupload .thumbnail{border-color:#b94a48;}
.control-group.success .fileupload .uneditable-input{color:#468847;border-color:#468847;}
.control-group.success .fileupload .fileupload-preview{color:#468847;}
.control-group.success .fileupload .thumbnail{border-color:#468847;}	
.upload-form{
    padding-top: 20px;
}
.upload-form .form-group{}
.upload-form .form-group input{
	padding-left: 0 
}
.upload-form .fileupload label{
	margin: 0;
    vertical-align: middle;
    padding: 0 20px;
}
.upload-form .fileupload .btn{
	margin: 0;	
}
.upload-form .form-group button{
	margin: 0;
}
.upload-form .fileupload-preview{	
    padding: 0px 20px;
    margin-top: 10px;
    display: block;
}
.alert{display: inline-block;
    width: 100%;
    text-align: center;
    border-bottom: none;
}
td{ font-size: medium;
	padding:5px;
	text-align: -webkit-left;
	border-bottom:1px solid;
	}	
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
<div class="col-md-12">
        <div class="card">
           
                <div class="card-header" data-background-color="purple">
                 <h4 class="title">Manual File Upload</h4>                  
               </div>
						<div class="col-md-12 upload-form">
					  <form role="form" action="{{url('/getzip')}}" method="post" enctype="multipart/form-data">
					  {!! csrf_field() !!}
						<div class="form-group col-md-5">
						  <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Client Name">
						</div>

						<div class="form-group" style="display:none">
						  <label for="api_token">API TOKEN <abbr title="required">*</abbr></label>
						  <input type="api_token" class="form-control" id="api_token" name="api_token" value="jh4h48kjsfjkwe)(*&%nkjg@gkjh" placeholder="API TOKEN">
						</div>
					 	  
					  <div class="fileupload fileupload-new col-md-5" data-provides="fileupload">
						  <label>Select Archive File</label>
						<span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
						<span class="fileupload-exists">Change</span>         <input type="file" name="fileToUpload" /></span>
						<span class="fileupload-preview"><a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: right">×</a></span>
					  </div>

						 <div style="text-align: center;" class="form-group col-md-2">
						<button  type="submit" class="btn btn-primary">Submit</button>
						</div>
					  </form>

					  @if (Session::has('sucessmsg'))
					   <div class="alert alert-success">{{ Session::get('sucessmsg') }}</div>
					@endif
					 @if (Session::has('msg'))
					   <div class="alert alert-danger">{!! Session::get('msg') !!}</div>
					@endif
					</div>
            <!--    <small>This is the best app ever!</small>-->
            
           </div>
    </div>



<!-- <div class="container" >
<form action="{{url('/getzip')}}" method="post" enctype="multipart/form-data">
   <input type="text" name="client_name" value=""/>
   <input  type="text" name="api_token"  value=""/>
    {!! csrf_field() !!}
   Select image to upload:

   <input type="file" name="fileToUpload" id="fileToUpload">
   <input type="submit" value="Upload Image" name="submit">
</form>
</div> -->

<script type="text/javascript">
	!function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
</script>
@endsection