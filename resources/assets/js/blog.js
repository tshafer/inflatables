// JavaScript Document

function clearText(field){
  if (field.defaultValue == field.value) field.value = '';
  else if (field.value == '') field.value = field.defaultValue;
}

$(document).ready(function() {
	// some variables
	var sideBarWidth = $('#right-col').width();
	var sidebar = sideBarWidth + 30;
	var contentWidth = $('.story-content').width();

	setInterval(fixAd, 100);

	var docHeight = $(document).height();
	var screenWidth = $(window).width();
	$('.social-col').height(400);


	var url = '/assets//primary-navigation.html#primary-nav';

$('#toggle').click(function() {
	$("#flyout-menu").fadeIn(100, function() {
		$(this).animate({'left':'0px'}, 300);
		$(this).load(url);
		$(this).addClass('open');
	});
	return false;
});

if($(window).width() > 1024){
		$('.story').width(contentWidth - sidebar);

	}
	else {
		$('.story').width(contentWidth);
	}

	if(screenWidth < 770) {
		$('li.dropper div').width(screenWidth);
	}

	//////////////// MATCH SIZES ON RESIZE ///////////////////
	$(window).resize(function() {
		var sideBarWidth = $('#right-col').width();
		var sidebar = sideBarWidth + 30;
		var contentWidth = $('.story-content').width();

		if($(window).width() > 1024){
			$('.story').width(contentWidth - sidebar);

		}
		else {
			$('.story').width(contentWidth);
		}
	});


	// desktop fixed social media
	function fixAd() {
		var $ad = $('.social-col');
		var bottomSlot = $('.story').height() - 100;
    if($("h3.kickers").length){
		  var static = $("h3.kickers").position().top;
    } else {
      var static = 0;
    }
    if($("h3.kickers").length){
      var readNext = $('#next-slot').position().top;
    } else {
      var readNext = 0;
    }

		var screenHeight = $(window).height() * 1.25;
		var readLess = readNext - screenHeight;

		if( $(window).scrollTop() > ( $ad.data("top") - 10 ) && $(window).scrollTop() < ( $('.story').height() - 100 ) ){
			$('.social-col').css({'position': 'fixed', 'top': '10px'});
		} else
		if( $(window).scrollTop() <= ( $ad.data("top") - 10 ) ) {
			$('.social-col').css({'position': 'absolute', 'top': static}); //was static/auto, which worked in FF
		}
		else {
      $('.social-col').css({'position': 'absolute', 'top': bottomSlot});
    }

		if($(window).scrollTop() > readLess) {
			$('i.scroll-top').fadeIn(200);
		}
		else {
			$('i.scroll-top').fadeOut(200);
		}
	}


// column might be omitted on full width stories
if( $('.social-col').length ){
  $(".social-col").data("top", $(".social-col").offset().top);
}

$('.scroll-top').click(function() {
	$('#top-branding').goTo();
});

// Site Login/Search
$('.dropper').click(function() {
	$(this).children('div').fadeIn(300);
	$(this).addClass('open');
});

	// expand comments

	$('#c_arrow').click(function() {
		$('#disqus').slideToggle(600, function(){
  		if($('#disqus').is(':visible')) {
  			$('img#c_arrow').attr("src", '/responsive/images/arrow_close.png');
  		} else {
  			$('img#c_arrow').attr("src", '/responsive/images/comments_arrow.png');
  		}
		});
	});

}); // end doc ready functions



$(document).click(function (e)
{
    var container = $('#flyout-menu');
	var menuItem = $('li.dropper');

    if (!container.is(e.target)
        && container.has(e.target).length === 0 // target not a descendent of container.
		&& container.hasClass('open'))
    {
        container.animate({'left':'-310px'}, 300, function() {
			container.fadeOut(100);
			container.removeClass('open');
			});
    }

	if (!menuItem.is(e.target)
        && menuItem.has(e.target).length === 0 // target not a descendent of container.
		&& menuItem.hasClass('open'))
    {
        menuItem.children('div').fadeOut(200);
		menuItem.removeClass('open');

    }
});



// select functionality for finder ul
$(function(){
	var selectedItem = $('<i class="fa fa-arrow-circle-down"></i>');
	var finderCount = $('#finder-tools li').length;
	var finderHeight = finderCount*39;

	$('#finder-tools ul').click(function(){


			if($(this).height() < 41) {

				$(this).animate({'height':finderHeight}, 300);
				$(this).children('li').css({'position':'static'});
			}

			else {
				$(this).animate({'height':'38px'}, 200);
				$(this).children('li').css({'position':'absolute'});
			}

		});


		$('#finder-tools li').click(function(){

			$(this).siblings().removeClass('active-item');
	    	$(this).addClass('active-item');

			// and go to page
			if($('#finder-tools ul').height() == finderHeight) {
				var url = $('li.active-item').attr('title');
				window.Form::open(url, '_parent');
			}
		});



	// global finder go button

	$('a#finder-submit').click(function(){
		var url = $('li.active-item').attr('title');
		window.Form::open(url, '_parent');
	});



});

$(document).mouseup(function (e)
{
    var container = $('#finder-tools ul');

    if (!container.is(e.target)
        && container.has(e.target).length === 0 // target not a descendent of container.
				)
    {
        container.animate({'height':'39px'}, 200);
    }
});

$.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'slow');
        return this; // chaining if needed
    }
