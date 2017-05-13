var popupPFlag = 0;

function loadPopupPhoto(){
	if(popupPFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupPhoto").fadeIn("slow");
	popupPFlag = 1;
	}
}

function disablePopupPhoto(){
	if(popupPFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupPhoto").fadeOut("slow");
	popupPFlag = 0;
	}
}

function centerPopupPhoto(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupPhoto").height();
	var popupWidth = $(".popupPhoto").width();

	$(".popupPhoto").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#photo").click(function(){   
		centerPopupPhoto();  
		loadPopupPhoto();  
	});
	$(".popupPhotoClose").click(function(){  
		disablePopupPhoto();  
	});
	$(".background").click(function(){  
	disablePopupPhoto();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupPhoto();  
		}  
	});
});