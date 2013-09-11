// Tiny jQuery Plugin by Chris Goodchild
$.fn.exists = function(callback) { var args = [].slice.call(arguments, 1); if (this.length) { callback.call(this, args); } return this; };

/* Author:	R.Genesis */
$(document).ready(function() {
	$('#notification').prependTo('body');
/* ==============
    MENU
   ============== */
	// IE6 & IE7 Fixes
	if ($.browser.msie) {
		if ($.browser.version <= 6) {
			$('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');
			
			$('#column-right + #content').css('margin-right', '195px');
		
			$('.box-category ul li a.active + ul').css('display', 'block');	
			alert($.browser.version);
		}
		
		if ($.browser.version <= 7) {
			$('nav > ul > li').bind('mouseover', function() {
				$(this).addClass('active');
			});
				
			$('nav > ul > li').bind('mouseout', function() {
				$(this).removeClass('active');
			});	
		}
	}
	
	/************************************************************/
	/* MAIN MENU DROP DOWN */
	
	var mainNavigation = $('#menu').clone();
	
	if($('#menu').find('select').length == 0){
		$('#menu').prepend('<span class="mob-menu-wrapper"><select class="mob-menu"></select></span>');
	}
	var selectMenu 	= $('select.mob-menu');
	var menuText 	= $('#menu > b').text();
	$('.mob-menu-wrapper').attr('title', menuText);
	
	$(selectMenu).prepend('<option></option>');
	//$(selectMenu).append('<option value="'+$('#menu .home-btn').attr('href')+'">'+ $('#menu .home-btn').text() +'</option>');
	
	$(mainNavigation).children('ul').children('li').each(function() {
		var href = $(this).children('a').attr('href');
		var text = $(this).children('a').text();
		$(selectMenu).append('<option value="'+href+'">'+text+'</option>');
		
		if ($(this).children('div').find('ul').length > 0) {
			$(this).children('div').find('ul').children('li').each(function() {
				var href2 = $(this).children('a').attr('href');
				var text2 = $(this).children('a').text();
				$(selectMenu).append('<option value="'+href2+'"> |-- '+text2+'</option>');
			});
		}
	});
	$(selectMenu).change(function() { location = this.options[this.selectedIndex].value; });


/* ==============
    CUSTOM FOOTER
   ============== */
	$('.custom-footer').find('.column:last').addClass('last');
	var colHeight = 0;  
    $('.custom-footer').find('.column').each(function(){  
        if($(this).height() > colHeight){ 
			colHeight = $(this).height();  
        }
    });
	if(colHeight > 200){
		$('.custom-footer .column').height(colHeight);  	
	}


/* ==============
	CUSTOM CSS CLASSES
   ============== */
	if($('.refine-tools').find('.refine-search').html() == null){
		$('.refine-tools').addClass('no-refine');
	}
	if($('#content').find('.column').html() == null){
		$('#content').addClass('no-column');
	}
	if($('.refine-tools').find('.product-filter').html() == null){
		$('.refine-tools').addClass('no-filter');
	}
	
	
/* ==============
	TOOL TIP
   ============== */
	$(".mob-menu-wrapper, .header-options > a, .prd-block li a, .cart a, .small-prd-block ul a, .lrg-stars, .sml-stars, .social a").tooltip();


/* ==============
	SLIDE SHOW PRODUCT SETUP
   ============== */
   $(".slideshowMod .box-heading").live("click", function(){ 
		if($(this).next().is(':visible') == false) {
			$('.slideshowMod .box-content').slideUp(300, function(){
				$(this).removeClass('active');
				$('.box-heading').removeClass('open');
			});
		}
		
		if($(this).hasClass('open') == true) {
			$(this).next().slideUp(300, function(){
				$(this).removeClass('active');
				$(this).prev().removeClass('open');
			});
		}else{
			$(this).next().slideDown(300, function(){
				$(this).addClass('active');
				$(this).prev().addClass('open');
				if($(this).hasClass('.jspScrollable') == false && $(this).find('.small-prd-block').length > 2){
					$(this).jScrollPane({ verticalDragMinHeight: 31, verticalDragMaxHeight: 31 });
				}
				if($(this).hasClass('.jspScrollable') == true){
					var api = $(this).data('jsp');
					var throttleTimeout;
					if ($.browser.msie) {
						// FOR IE 
						if (!throttleTimeout) {throttleTimeout = setTimeout(function() {api.reinitialise();throttleTimeout = null;}, 50);}
					} else {
						api.reinitialise();
					}
				}
			});
		}
	});
	
	var obj = $('.slidshow-prd');
	obj.each(function(index, element) {
		$(this).appendTo('.slideshowMod');
	});
	
	if($('#content').hasClass('store-home')){
		var moveSlideshow = $('.slideshow');
		
		moveSlideshow.promise().done(function() {
			moveSlideshow.hide().prependTo('#content-body').fadeIn(1000, function(){
				$('.slideshowMod .box-content').hide()
				$('.slideshowMod .box-content:eq(0)').slideDown('slow', function(){
					$(this).addClass('active');
					$(this).prev().addClass('open');
					
					// Apply scroll pane
					if($(this).hasClass('.jspScrollable') == false && $(this).find('.small-prd-block').length > 2){
						$(this).jScrollPane({ verticalDragMinHeight: 31, verticalDragMaxHeight: 31 });
					}
					if($(this).hasClass('.jspScrollable') == true){
						var api = $(this).data('jsp');
						var throttleTimeout;
						if ($.browser.msie) {
							// FOR IE 
							if (!throttleTimeout) {throttleTimeout = setTimeout(function() {api.reinitialise();throttleTimeout = null;}, 50);}
						} else {
							api.reinitialise();
						}
					}
					
				});
				obj.css({height:'auto', overflow:'inherit'})
				obj.fadeIn(5000);
			});
		});
	}




});/*<================================== Ready function close */

/* ==============
   QUANTITY TEXT BOX
   ============== */
function qtyPlus(){
	var qty = parseInt($('#qty').val());
	if(qty > 0){
    	$('#qty').val(qty+1);
    }         
    return false;
}

function qtyMinus(){
	var qty = parseInt($('#qty').val());
    if(qty > 1){
    	$('#qty').val(qty-1);
    }         
    return false;
}
	
