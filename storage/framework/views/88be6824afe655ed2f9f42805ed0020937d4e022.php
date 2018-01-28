<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<style>
@font-face{
	font-family: 'helvetica25';
	src: url(../fonts/helveticaneueltStd-ultLt25.ttf);
}
	.thumbnail{
		padding: 15px;
		position: fixed;
		background-color: #454545;
		bottom: 0;
		width: calc(100% - 30px);
	}
	.flip{
		display: block;
		margin: 0 auto;	
		overflow: hidden;
		width: 100%;
		height: 60px;
	}
	.flip::-webkit-scrollbar {
		width: 0px;
		height: 1px;
	}
	.flip::-webkit-scrollbar-thumb {
		background-color: #9b9c9c;
		outline: #708090 solid 1px
	}
	.flip > li{
		cursor: pointer;
	    display: inline-block;
	    width: 10%;
		list-style: none;
		opacity: .5;
	}	
	.flip > li:hover, .flip > li.activethumbil{
		opacity: 1;
	}		
	.flip > li:last-child{
		padding-right: 0px;
	}	
	.flip > li img{
		float: left;
		width: 50%;
		height: auto;
	}	
	.flip > li:first-child{
		text-align: right
	}
	.flip > li:first-child img{
		float: none
	}		
</style>
		
<script type="text/javascript" src="<?php echo e(url('extras/jquery.min.1.7.js')); ?>"></script>	
<script type="text/javascript" src="<?php echo e(url('extras/jquery-ui-1.8.20.custom.min.js')); ?>"></script>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 		
<script type="text/javascript" src="<?php echo e(url('extras/jquery.mousewheel.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('extras/modernizr.2.5.3.min.js')); ?>"></script>
	
<script type="text/javascript" src="<?php echo e(url('lib/hash.js')); ?>"></script>

</head>
<body>
	<input type="hidden" name="userId" id="userId" value="<?php echo e($id); ?>" />
    <input type="hidden" name="pagescount" id="pagescount" value="<?php echo e($filepagesCount); ?>" >
		
	<!-- Page Top Options -->
	<div class="zoom-top">
	<div class="page-options">
		<div class="options-box">
			<div class="page-zoom">
				<input type="range" id="rangezoom" title="Zoom" class="zoom" min="1" max="100" value="0">
			</div>
			<div id="page-left" class="page-arrow">
				<a title="Previous Page"><span>&nbsp;</span></a>
			</div>
			<div id="page-right" class="page-arrow right">
				<a title="Next Page"><span>&nbsp;</span></a>
			</div>
		</div>
	</div>
	</div>

	<!-- Left Arrow -->
	<div id="arrow-left" class="arrow arrow-left"><a title="Previous Page"><svg class="nav-button" width="30" height="30" viewBox="0 0 36 93" xmlns="http://www.w3.org/2000/svg"><path class="nav-button" d="M29.958 0L0 46.035l29.958 46.02H36L6.042 46.035 36 0z"></path></svg></a></div>

	<div id="canvas">
		<div id="zoom">
			<div id="book-zoom">
				<div class="sj-book"></div>
			</div>
		</div>
	</div>

	<!-- Right Arrow -->
	<div id="arrow-right" class="arrow arrow-right"><a title="Next Page"><svg class="nav-button" width="30" height="30" viewBox="0 0 36 93" xmlns="http://www.w3.org/2000/svg"><path class="nav-button" d="M6.042 0L36 46.035 6.042 92.055H0l29.958-46.02L0 0z"></path></svg></a></div>

	<!-- Thumbnail -->	
	<div class="thumbnail">
		<ul id="content-slider" class="flip">
			<?php $i=1; ?>
			<?php foreach($thumbil as $thumbils): ?>
			<?php if($i==1): ?>
			<li id="<?php echo e($i); ?>" class="activethumbil" onclick="<?php echo 'pageTurn('.$i.')' ?>">
			<img src="<?php echo e(url($thumbils)); ?>" alt="Smiley face" height="42" width="42">	
			</li>	
			<?php endif; ?>
			<?php if($i%2==0 && $i!=1 && $i!=$filepagesCount): ?>
			<?php $next=$i+1;?>
		    <li id="<?php echo e($i); ?>"  onclick="<?php echo 'pageTurn('.$i.')' ?>">
			<img src="<?php echo e(url($thumbils)); ?>"  alt="Smiley face" height="42" width="42" >	
			<?php if(isset($thumbil[$i])): ?>	
			<img src="<?php echo e(url($thumbil[$i])); ?>"  alt="Smiley face" height="42" width="42">
			<?php endif; ?>	
			</li>
			<?php endif; ?>
			<?php if($i==$filepagesCount): ?>
			<li id="<?php echo e($i); ?>"  onclick="<?php echo 'pageTurn('.$i.')' ?>">
			<img src="<?php echo e(url($thumbils)); ?>"  alt="Smiley face" height="42" width="42">
			</li>	
			<?php endif; ?>
			<?php  $i++;?>
			<?php endforeach; ?>
		</ul>
	</div>

<script type="text/javascript">

	
function pageTurn(page){
$('.sj-book').turn('page', page);	
pageActive(page);	
}	
function pageActive(page){
console.log(page);	
$('.activethumbil').removeClass('activethumbil');		
$('#'+page).addClass('activethumbil');	
}	

function loadApp() {
	
	var flipbook = $('.sj-book');

	// Check if the CSS was already loaded
	
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}

	// Mousewheel

	$('#book-zoom').mousewheel(function(event, delta, deltaX, deltaY) {

		var data = $(this).data(),
			step = 30,
			flipbook = $('.sj-book'),
			actualPos = $('#slider').slider('value')*step;

		if (typeof(data.scrollX)==='undefined') {
			data.scrollX = actualPos;
			data.scrollPage = flipbook.turn('page');
		}

		data.scrollX = Math.min($( "#slider" ).slider('option', 'max')*step,
			Math.max(0, data.scrollX + deltaX));

		var actualView = Math.round(data.scrollX/step),
			page = Math.min(flipbook.turn('pages'), Math.max(1, actualView*2 - 2));
//		alert(page);

		if ($.inArray(data.scrollPage, flipbook.turn('view', page))==-1) {
			data.scrollPage = page;
			flipbook.turn('page', page);
		}

		if (data.scrollTimer)
			clearInterval(data.scrollTimer);
		
		data.scrollTimer = setTimeout(function(){
			data.scrollX = undefined;
			data.scrollPage = undefined;
			data.scrollTimer = undefined;
		}, 1000);

	});

	// Slider

	$( "#slider" ).slider({
		min: 1,
		max: 26,

		start: function(event, ui) {

			if (!window._thumbPreview) {
				_thumbPreview = $('<div />', {'class': 'thumbnail'}).html('<div></div>');
				setPreview(ui.value);
				_thumbPreview.appendTo($(ui.handle));
			} else
				setPreview(ui.value);

			moveBar(false);

		},

		slide: function(event, ui) {

			setPreview(ui.value);

		},

		stop: function() {

			if (window._thumbPreview)
				_thumbPreview.removeClass('show');
			
			$('.sj-book').turn('page', Math.max(1, $(this).slider('value')*2 - 2));

		}
	});


	// URIs
	
	
	Hash.on('^page\/([0-9]*)$', {
		yep: function(path, parts) {

			var page = parts[1];

			if (page!==undefined) {
				if ($('.sj-book').turn('is'))
					$('.sj-book').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.sj-book').turn('is'))
				$('.sj-book').turn('page', 1);
		}
	});

	// Arrows

	$(document).keydown(function(e){

		var previous = 37, next = 39;

		switch (e.keyCode) {
			case previous:

				$('.sj-book').turn('previous');

			break;
			case next:
				
				$('.sj-book').turn('next');

			break;
		}

	});
	
	$('#arrow-left a, #page-left a').click(function(){
		$('.sj-book').turn('previous');		
	});
	$('#arrow-right a, #page-right a').click(function(){
		$('.sj-book').turn('next');
	});
	
	


	// Flipbook

	flipbook.bind(($.isTouch) ? 'touchend' : 'click', zoomHandle);
    var pagesCount=document.getElementById("pagescount").value;
	flipbook.turn({
		elevation: 50,
		acceleration: !isChrome(),
		autoCenter: true,
		gradients: true,
		duration: 1000,
		pages: pagesCount,
		when: {
			turning: function(e, page, view) {
				
			//	alert('hai');
				
				var book = $(this),
					currentPage = book.turn('page'),
					pages = book.turn('pages');
                   
				if (currentPage>3 && currentPage<pages-3) {
				
					if (page==1) { 
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (page==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				} else if (page>3 && page<pages-3) {
					if (currentPage==1) {
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (currentPage==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				}
			   var pageactive;	
			   if(currentPage==1){
			   pageactive=currentPage+1;
			   }else{
			   pageactive=currentPage+2;	   
			   }	
               pageActive(pageactive);	
			   updateDepth(book, page);
				
				if (page>=2)
					$('.sj-book .p2').addClass('fixed');
				else
					$('.sj-book .p2').removeClass('fixed');

				if (page<book.turn('pages'))
					$('.sj-book .p25').addClass('fixed');
				else
					$('.sj-book .p25').removeClass('fixed');

				Hash.go('page1/'+page).update();
					
			},

			turned: function(e, page, view) {

				var book = $(this);

				if (page==2 || page==3) {
					book.turn('peel', 'br');
				}

				updateDepth(book);
				
				$('#slider').slider('value', getViewNumber(book, page));

				book.turn('center');

			},

			start: function(e, pageObj) {
		
				moveBar(true);

			},

			end: function(e, pageObj) {
			
				var book = $(this);

				updateDepth(book);

				setTimeout(function() {
					
					$('#slider').slider('value', getViewNumber(book));

				}, 1);

				moveBar(false);

			},

			missing: function (e, pages) {
				
				//	alert(pages);


				for (var i = 0; i < pages.length; i++) {
					addPage(pages[i], $(this));
				}

			}
		}
	});


	$('#slider').slider('option', 'max', numberOfViews(flipbook));

	flipbook.addClass('animated');

	// Show canvas

	$('#canvas').css({visibility: ''});
}

// Hide canvas

$('#canvas').css({visibility: 'hidden'});

// Load turn.js
	
	

yepnope({
	test : Modernizr.csstransforms,
	yep: ['<?php echo e(url("lib/turn.min.js")); ?>'],
	nope: ['<?php echo e(url("lib/turn.html4.min.js")); ?>', '<?php echo e(url("css/jquery.ui.html4.css")); ?>', '<?php echo e(url("css/steve-jobs-html4.css")); ?>'],
	both: ['<?php echo e(url("js/steve-jobs.js")); ?>', '<?php echo e(url("css/jquery.ui.css")); ?>', '<?php echo e(url("css/steve-jobs.css")); ?>', '<?php echo e(url("css/lightslider.css")); ?>', '<?php echo e(url("js/lightslider.js")); ?>'],
	complete: loadApp
});

</script>
		
<script src="<?php echo e(url('js/lightslider.js')); ?>"></script>
<link href="<?php echo e(url('css/lightslider.css')); ?>" />	
<script>
	 $(document).ready(function() {
		$("#content-slider").lightSlider({
		item: 10,
		});
	});
</script>
 
<script>
function offset(el) {
    var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}

// example use
var div =  document.getElementById('canvas');
var divOffset = offset(div);
console.log(divOffset.left, divOffset.top);	
function placeDiv(x_pos, y_pos) {
  var d = document.getElementById('book-zoom');	
 // d.style.position = "absolute";
  d.style.left = 0+'px';
  d.style.top = 0+'px';
}		
$('#rangezoom').on('change',function(){
var rangeval=$('#rangezoom').val();
if(rangeval > 1){
$('#book-zoom').css('cursor','pointer');	
$('#book-zoom').addClass('drag');
$('.drag')
    .draggable({cancel : '.sj-book animated'});	
	
}else{
	
placeDiv(divOffset.top,divOffset.left);	
$('.drag').draggable( "destroy" );
$('#book-zoom').css('cursor','default');	
$('#book-zoom').removeClass('drag');
}	
});	
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
<script>	
$('.drag')
    .draggable({cancel : '.sj-book animated'});	
</script> 

</body>
</html>