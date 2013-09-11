
if($('#content-body').hasClass('pro-layout3')){
	$(".image-additional").scrollable({});
}else{
	$(".image-additional").scrollable({vertical:true});
}

$('#tabs a').tabs();

$('.buying-info .review a, .info-links a').bind('click',function(event){
	$('html, body').animate({scrollTop: $('.info-layout2').offset().top}, 500);
	
	var obj = $(this).attr('rev');
	$('#tabs a').removeClass('selected');
	$('.info-layout2 .tab-content').hide();
	
	$('#tabs a[href=' + obj +']').addClass('selected');
	
	$(obj).fadeIn();
	
	if($(obj + ' .scrollPane > .innerWrp').length == 0){
		$(obj + ' .scrollPane').wrapInner('<div class="innerWrp">');
	}
	
	if($(obj + ' .scrollPane').hasClass('jspScrollable') == false && $(obj + ' .scrollPane > .innerWrp').height() > 450){
		$(obj).find('.scrollPane').jScrollPane({
			verticalGutter: -15,
			verticalDragMinHeight: 41,
			verticalDragMaxHeight: 41
		});
		$(obj + ' .scrollPane').stop().animate({ paddingRight:35 }, 50);
		$(obj + ' .jspContainer').stop().animate({ paddingRight:35 }, 50);
	}
});


$('#tab-description .scrollPane').jScrollPane({
	verticalGutter: 0,
	verticalDragMinHeight: 41,
	verticalDragMaxHeight: 41,
	hideFocus:true
});
$('.info-layout2 .tab-content:first').addClass('activePane');

/*$('#tab-description .scrollPane').stop().animate({ paddingRight:35 }, 50);
$('#tab-description .jspContainer').stop().animate({ paddingRight:35 }, 50);*/
$('#tabs a').click(function(){
	var obj = $(this).attr('href');
	$('.tab-content').removeClass('activePane');
	$(obj).addClass('activePane');
	
	if($(obj + ' .scrollPane > .innerWrp').length == 0){
		$(obj + ' .scrollPane').wrapInner('<div class="innerWrp">');
	}
	
	if($(obj + ' .scrollPane').hasClass('jspScrollable') == false && $(obj + ' .scrollPane > .innerWrp').height() > 450){
		$(obj).find('.scrollPane').jScrollPane({
			verticalGutter: -15,
			verticalDragMinHeight: 41,
			verticalDragMaxHeight: 41
		});
		$(obj + ' .scrollPane').stop().animate({ paddingRight:35 }, 50);
		$(obj + ' .jspContainer').stop().animate({ paddingRight:35 }, 50);
		
	}
});

$(document).ready(function(e) {
	/*#############################################################
	Desktop standard 960 and up
	*/
	enquire.register("only screen and (min-width: 980px)", {
		match : function() {
			var api = $('.activePane .scrollPane').data('jsp');
			var throttleTimeout;
			if ($.browser.msie) {
				// IE
				if (!throttleTimeout) {throttleTimeout = setTimeout(function() {api.reinitialise();throttleTimeout = null;}, 50);}
			} else {
				$('.activePane .scrollPane, .activePane .jspContainer').css({ paddingRight:0 });
				$('.activePane .scrollPane').css({ opacity:0 });
				api.reinitialise();
			}
			$('.activePane .scrollPane, .activePane .jspContainer').stop().animate({ opacity:1, paddingRight:35 }, 50);
		}
	
	/*#############################################################
	Tablet Portrait size to standard 980
	*/
	}).register("only screen and (min-width: 768px) and (max-width: 979px)", {
		match : function() {}
	
	/*#############################################################
	Mobile Landscape Size to Tablet Portrait
	*/
	}).register("only screen and (min-width: 200px) and (max-width: 767px)", {
		match : function() {},
		unmatch : function() {}
	}).listen();
});