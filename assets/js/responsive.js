$(document).ready(function(e) {
	
	function prependTh(){ 
		$('.product-info .image-additional-wrapper').css({opacity:0});
		$('.product-info .image-additional-wrapper').prependTo('.product-info .left');
		$('.product-info .image-additional-wrapper').animate({opacity:1}, 1000, function(){});
		}
	function appendTh(){ 
		$('.product-info .image-additional-wrapper').css({opacity:0});
		$('.product-info .image-additional-wrapper').appendTo('.product-info .left'); 
		$('.product-info .image-additional-wrapper').animate({opacity:1}, 1000, function(){});
		}
	
	/*#############################################################
	Desktop standard 960 and up
	*/
	enquire.register("only screen and (min-width: 980px)", {
		match : function() {
			
			if($('#main').hasClass('pro3-wrapper') == false){
				prependTh();
			}
			
			
			$('#welcome').prependTo('#header');
			$('#search').appendTo('.header-options');
			$('.slideshowMod').css({opacity:0});
			$('.slideshowMod').appendTo('.slideshow');
			
			$('.slideshowMod').animate({opacity:1}, 50, function(){
				if($('.slideshowMod .active').hasClass('jspScrollable') == true && $('.slideshowMod .active').find('.small-prd-block').length > 2){
					var api = $('.slideshowMod .active').data('jsp');
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
	
	/*#############################################################
	Tablet Portrait size to standard 980
	*/
	}).register("only screen and (min-width: 768px) and (max-width: 979px)", {
		match : function() {
			if($('#main').hasClass('pro3-wrapper') == false){
				prependTh();
			}
			$('#welcome').prependTo('.header-options');
			$('#search').appendTo('.header-options');
			
			$('.slideshowMod').appendTo('.slideshowMod-wrapper');
			
		},
		unmatch : function() {}
	
	/*#############################################################
	Mobile Landscape Size to Tablet Portrait
	*/
	}).register("only screen and (min-width: 200px) and (max-width: 767px)", {
		match : function() {
			if($('#main').hasClass('pro3-wrapper') == false){
				prependTh();
			}
			
			// HEADER COMPONENTS
			$('#welcome').prependTo('.header-options');
			$('#search').appendTo('#menu');
			$('#search').animate({opacity:1}, 1000, function(){});
			
			
			// FOOTER
			$('#footer .column h3').click(function(){
				if($(this).next('ul').hasClass('active') == false){
					$(this).next('ul').slideDown(500, function(){
						$(this).addClass('active');
					});
				}else {
					$(this).next('ul').slideUp(500, function(){
						$(this).removeClass('active');
					});
				}
			});
			
			// SLIDESHOW PRODUCTS
			$('.slideshowMod').appendTo('.slideshowMod-wrapper');
		},
		unmatch : function() {}
		
		
	}).register("only screen and (min-width: 600px) and (max-width: 767px)", {
		match : function() {
			$('.boxprd-grid, .product-grid').addClass('prd-col4');
			if($('#main').hasClass('pro3-wrapper') == false){
				prependTh();
			}
			$('.slideshowMod').appendTo('.slideshowMod-wrapper');
		},
		unmatch : function() { $('.boxprd-grid, .product-grid').removeClass('prd-col4'); }
		
	}).register("only screen and (min-width: 420px) and (max-width: 599px)", {
		match : function() {
			$('.boxprd-grid, .product-grid').addClass('prd-col3');
			if($('#main').hasClass('pro3-wrapper') == false){
				appendTh();
			}
			
			$('.slideshowMod').appendTo('.slideshowMod-wrapper');
		},
		unmatch : function() { $('.boxprd-grid, .product-grid').removeClass('prd-col3'); }
		
	}).register("only screen and (min-width: 200px) and (max-width: 419px)", {
		match : function() {
			$('.boxprd-grid, .product-grid').addClass('prd-col2');
			if($('#main').hasClass('pro3-wrapper') == false){
				appendTh();
			}
			$('.slideshowMod').appendTo('.slideshowMod-wrapper');
		},
		unmatch : function() { $('.boxprd-grid, .product-grid').removeClass('prd-col2'); }
	
	}).listen();
});