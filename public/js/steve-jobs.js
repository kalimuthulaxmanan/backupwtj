/* Steve jobs' book */

var wheight = $(window).height();
var thumbnailheight = $(".thumbnail").outerHeight(true);
console.log(thumbnailheight);
var multiplication = (thumbnailheight*2);
var zoommes = wheight-multiplication;
zoommes = zoommes-600;
zoommes = (zoommes/600)*100;
var zoom=96+zoommes+'%';
var zoom_mozila=(96+zoommes)/100;
$("#canvas").css("zoom", zoom);
$("#canvas").css("-moz-transform",'scale('+zoom_mozila+')');


// Zoom Slider
$(document).ready(function(){
	$(".page-zoom .zoom").change(function(){
		var zoom_value = $(this).val();
		var zoom_valuemozila=(parseInt(zoom_value) + 100)/100;
		var zoom_percentage = parseInt(zoom_value) + 100 + '%';
		var margin_percentage = parseInt(zoom_value);
		var marginvalue = margin_percentage/2;
		var marginvaluehalf = marginvalue/2;
		var bookmargin = '-' + marginvalue + '%';
		var bookmarginhalf = '-' + marginvaluehalf + '%';
		$("#book-zoom").css("zoom", zoom_percentage);
		$("#book-zoom").css("-moz-transform",'scale('+zoom_valuemozila+')');
		if (!(navigator.userAgent.indexOf("Firefox") != -1)) {
           $("#book-zoom").css("margin-left", bookmargin);
		   $("#book-zoom").css("margin-top", bookmarginhalf);
	    }
		
		
	});
	$(".page-zoom .zoom").mousemove(function(){
		var zoom_value = $(this).val();
		var zoom_valuemozila=(parseInt(zoom_value) + 100)/100;
		var zoom_percentage = parseInt(zoom_value) + 100 + '%';
		var margin_percentage = parseInt(zoom_value);
		var marginvalue = margin_percentage/2;
		var marginvaluehalf = marginvalue/2;
		var bookmargin = '-' + marginvalue + '%';
		var bookmarginhalf = '-' + marginvaluehalf + '%';
		$("#book-zoom").css("zoom", zoom_percentage);
		$("#book-zoom").css("-moz-transform",'scale('+zoom_valuemozila+')');
		if (!(navigator.userAgent.indexOf("Firefox") != -1)) {
           $("#book-zoom").css("margin-left", bookmargin);
		   $("#book-zoom").css("margin-top", bookmarginhalf);
	    }
	});
});


function updateDepth(book, newPage) {

	var page = book.turn('page'),
		pages = book.turn('pages'),
		depthWidth = 16*Math.min(1, page*2/pages);

		newPage = newPage || page;
		
}

function loadPage(page) {

	$.ajax({type: "POST",
  data: {page : page,userId:$("#userId").val()},url:'fetchFlipData'}).
		done(function(pageHtml) {
			$('.sj-book .p' + page).html(pageHtml.replace('samples/steve-jobs/', ''));
		});

}

function addPage(page, book) {

	var id, pages = book.turn('pages');

	if (!book.turn('hasPage', page)) {

		var element = $('<div />',
			{'class': 'own-size',
				css: {width: 600, height: 600}
			}).
			html('<div class="loader"></div>');

		if (book.turn('addPage', element, page)) {
			loadPage(page);
		}

	}
}

function numberOfViews(book) {

	return book.turn('pages') / 2 + 1;

}

function getViewNumber(book, page) {

	return parseInt((page || book.turn('page'))/2 + 1, 10);

}

function zoomHandle(e) {

	if ($('.sj-book').data().zoomIn)
		zoomOut();
	else if (e.target && $(e.target).hasClass('zoom-this')) {
		zoomThis($(e.target));
	}

}

function zoomThis(pic) {

	var	position, translate,
		tmpContainer = $('<div />', {'class': 'zoom-pic'}),
		transitionEnd = $.cssTransitionEnd(),
		tmpPic = $('<img />'),
		zCenterX = $('#book-zoom').width()/2,
		zCenterY = $('#book-zoom').height()/2,
		bookPos = $('#book-zoom').offset(),
		picPos = {
			left: pic.offset().left - bookPos.left,
			top: pic.offset().top - bookPos.top
		},
		completeTransition = function() {
			$('#book-zoom').unbind(transitionEnd);

			if ($('.sj-book').data().zoomIn) {
				tmpContainer.appendTo($('body'));

				$('body').css({'overflow': 'hidden'});
				
				tmpPic.css({
					margin: position.top + 'px ' + position.left+'px'
				}).
				appendTo(tmpContainer).
				fadeOut(0).
				fadeIn(500);
			}
		};

		$('.sj-book').data().zoomIn = true;

		$('.sj-book').turn('disable', true);

		$(window).resize(zoomOut);
		
		tmpContainer.click(zoomOut);

		tmpPic.load(function() {
			var realWidth = $(this)[0].width,
				realHeight = $(this)[0].height,
				zoomFactor = realWidth/pic.width(),
				picPosition = {
					top:  (picPos.top - zCenterY)*zoomFactor + zCenterY + bookPos.top,
					left: (picPos.left - zCenterX)*zoomFactor + zCenterX + bookPos.left
				};


			position = {
				top: ($(window).height()-realHeight)/2,
				left: ($(window).width()-realWidth)/2
			};

			translate = {
				top: position.top-picPosition.top,
				left: position.left-picPosition.left
			};

			$('.samples .bar').css({visibility: 'hidden'});
			$('#slider-bar').hide();
			
		
			$('#book-zoom').transform(
				'translate('+translate.left+'px, '+translate.top+'px)' +
				'scale('+zoomFactor+', '+zoomFactor+')');

			if (transitionEnd)
				$('#book-zoom').bind(transitionEnd, completeTransition);
			else
				setTimeout(completeTransition, 1000);

		});

		tmpPic.attr('src', pic.attr('src'));

}

function zoomOut() {

	var transitionEnd = $.cssTransitionEnd(),
		completeTransition = function(e) {
			$('#book-zoom').unbind(transitionEnd);
			$('.sj-book').turn('disable', false);
			$('body').css({'overflow': 'auto'});
			moveBar(false);
		};

	$('.sj-book').data().zoomIn = false;

	$(window).unbind('resize', zoomOut);

	moveBar(true);

	$('.zoom-pic').remove();
	$('#book-zoom').transform('scale(1, 1)');
	$('.samples .bar').css({visibility: 'visible'});
	$('#slider-bar').show();

	if (transitionEnd)
		$('#book-zoom').bind(transitionEnd, completeTransition);
	else
		setTimeout(completeTransition, 1000);
}


function moveBar(yes) {
	/* if (Modernizr && Modernizr.csstransforms) {
		$('#slider .ui-slider-handle').css({zIndex: yes ? -1 : 10000});
	} */
}

function setPreview(view) {

	/* var previewWidth = 115,
		previewHeight = 73,
		previewSrc = 'pages/preview.jpg',
		preview = $(_thumbPreview.children(':first')),
		numPages = (view==1 || view==$('#slider').slider('option', 'max')) ? 1 : 2,
		width = (numPages==1) ? previewWidth/2 : previewWidth;

	_thumbPreview.
		addClass('no-transition').
		css({width: width + 15,
			height: previewHeight + 15,
			top: -previewHeight - 30,
			left: ($($('#slider').children(':first')).width() - width - 15)/2
		});

	preview.css({
		width: width,
		height: previewHeight
	});

	if (preview.css('background-image')==='' ||
		preview.css('background-image')=='none') {

		preview.css({backgroundImage: 'url(' + previewSrc + ')'});

		setTimeout(function(){
			_thumbPreview.removeClass('no-transition');
		}, 0);

	}

	preview.css({backgroundPosition:
		'0px -'+((view-1)*previewHeight)+'px'
	}); */
}

function isChrome() {

	// Chrome's unsolved bug
	// http://code.google.com/p/chromium/issues/detail?id=128488

	return navigator.userAgent.indexOf('Chrome')!=-1;

}