var popupFlag = 0;

function loadPopup(){
	if(popupFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupCheck").fadeIn("slow");
	popupFlag = 1;
	}
}

function disablePopup(){
	if(popupFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupCheck").fadeOut("slow");
	popupFlag = 0;
	}
}

function centerPopup(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupCheck").height();
	var popupWidth = $(".popupCheck").width();

	$(".popupCheck").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#check").click(function(){   
		centerPopup();  
		loadPopup();  
	});
	$(".popupCheckClose").click(function(){  
		disablePopup();  
	});
	$(".background").click(function(){  
	disablePopup();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopup();  
		}  
	});
});
