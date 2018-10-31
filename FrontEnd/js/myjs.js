$(document).ready(function(){
	showMenu();
	showOption();
});
function showOption(){
		// var showMenu = $('#showMenu');
		var menuOption = document.getElementById('status-child');
		if(menuOption.style.display == "block") { // if is menuBox displayed, hide it
			menuOption.style.display = "none";
		}
  		else { // if is menuBox hidden, display it
  			menuOption.style.display = "block";
  		}
		// $('#showMenu').on('click', function(){
		// 	$(".left").css({"display": "block"});
		// 	$(".right").css({"display": "block"});
		// })
	}

	function showMenu(){
		// var showMenu = $('#showMenu');
		var menu = document.getElementById('menu-item');

		if(menu.style.display == "block") { // if is menuBox displayed, hide it
			menu.style.display = "none";
		}
  		else { // if is menuBox hidden, display it
  			menu.style.display = "block";
  		}
	}