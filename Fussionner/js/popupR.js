var popupRFlag = 0;

function loadPopupR(){
	if(popupRFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupReceipt").fadeIn("slow");
	popupRFlag = 1;
	}
}

function disablePopupR(){
	if(popupRFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupReceipt").fadeOut("slow");
	popupRFlag = 0;
	}
}

function centerPopupR(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupReceipt").height();
	var popupWidth = $(".popupReceipt").width();

	$(".popupReceipt").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#receipt").click(function(){   
		centerPopupR();  
		loadPopupR();  
	});
	$(".popupReceiptClose").click(function(){  
		disablePopupR();  
	});
	$(".background").click(function(){  
	disablePopupR();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupR();  
		}  
	});
});