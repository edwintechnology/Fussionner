var popupLRFlag = 0;

function loadPopupLR(){
	if(popupLRFlag == 0){
	$(".background").css({
	"opacity": "0.7"
	});
	$(".background").fadeIn("slow");
	$(".popupListReceipts").fadeIn("slow");
	popupLRFlag = 1;
	}
}

function disablePopupLR(){
	if(popupLRFlag == 1){
	$(".background").fadeOut("slow");
	$(".popupListReceipts").fadeOut("slow");
	popupLRFlag = 0;
	}
}

function centerPopupLR(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".popupListReceipts").height();
	var popupWidth = $(".popupListReceipts").width();

	$(".popupListReceipts").css({
		"position": "absolute",
		"top": "50px",
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function(){  
 
	$("#listReceipts").click(function(){   
		centerPopupLR();  
		loadPopupLR();  
	});
	$(".popupListReceiptsClose").click(function(){  
		disablePopupLR();  
	});
	$(".background").click(function(){  
	disablePopupLR();  
	});
	$(document).keyup(function(e){  
		if(e.keyCode==27){  
			disablePopupLR();  
		}  
	});
});
