var popupShowFlag = 0;

function loadPopupShow(){
	if(popupShowFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupShowfiles").fadeIn("slow");
	popupShowFlag = 1;
	}
}

function disablePopupShow(){
	if(popupShowFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupShowfiles").fadeOut("slow");
	popupShowFlag = 0;
	}
}

function centerPopupShow(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupShowfiles").height();
	var popupWidth = $(".popupShowfiles").width();

	$(".popupShowfiles").css({
		"position": "absolute",
		"top": "50px",
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#showfiles").click(function(){   
		centerPopupShow();  
		loadPopupShow();  
	});
	$(".popupShowfilesClose").click(function(){  
		disablePopupShow();  
	});
	$(".background").click(function(){  
	disablePopupShow();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupShow();  
		}  
	});
});
