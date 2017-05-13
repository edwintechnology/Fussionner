var popupLCFlag = 0;

function loadPopupLC(){
	if(popupLCFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupListChecks").fadeIn("slow");
	popupLCFlag = 1;
	}
}

function disablePopupLC(){
	if(popupLCFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupListChecks").fadeOut("slow");
	popupLCFlag = 0;
	}
}

function centerPopupLC(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupListChecks").height();
	var popupWidth = $(".popupListChecks").width();

	$(".popupListChecks").css({
		"position": "absolute",
		"top": "50px",
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#listChecks").click(function(){   
		centerPopupLC();  
		loadPopupLC();  
	});
	$(".popupListChecksClose").click(function(){  
		disablePopupLC();  
	});
	$(".background").click(function(){  
	disablePopupLC();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupLC();  
		}  
	});
});
