var popupHFlag = 0;

function loadPopupH(){
	if(popupHFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupHelp").fadeIn("slow");
	popupHFlag = 1;
	}
}

function disablePopupH(){
	if(popupHFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupHelp").fadeOut("slow");
	popupHFlag = 0;
	}
}

function centerPopupH(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupHelp").height();
	var popupWidth = $(".popupHelp").width();

	$(".popupHelp").css({
		"position": "absolute",
		"top": "50px",
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#help").click(function(){   
		centerPopupH();  
		loadPopupH();  
	});
	$(".popupHelpClose").click(function(){  
		disablePopupH();  
	});
	$(".background").click(function(){  
	disablePopupH();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupH();  
		}  
	});
});