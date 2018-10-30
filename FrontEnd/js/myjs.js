$(document).ready(function(){
		showMenu();
	});
	function showMenu(){
		// var showMenu = $('#showMenu');
		var menu = $('div > ul');
		$('#showMenu').on('click', function(e){
			e.preventDefault();
        	menu.slideToggle();
		});
		$(window).resize(function(){
    		var w = $(window).width();
    		if(w > 266 && menu.is(':hidden')) {
        		menu.removeAttr('style');
    		}
		});
		// $('#showMenu').on('click', function(){
		// 	$(".left").css({"display": "block"});
		// 	$(".right").css({"display": "block"});
		// })
	}