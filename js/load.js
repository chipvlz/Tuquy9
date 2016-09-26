function openHistoryTaixiu(gameID, txSession, detail_dice) {
	var bettype = $('input[name="tx_hisbettype"]').val();
	$.post( "/getpopup/historyTaixiu/" + Math.random(), { gameID: gameID, txSession: txSession, detail_dice: detail_dice, bettype: bettype })
    .done(function(data) {
    	$("#historyBox").find('.hisContent').html(data);
		$("#historyBox").show();
	});	
}

function showpopup(boxpopup) {
	$.post( "/getpopup/" + boxpopup + "/" + Math.random(), function( data ) {
		$('.modal').fadeIn(300);
		$('#bodyModal').fadeOut(300, function(){
			$(this).html(data);
			$(this).fadeIn(300, function(){
				$("#username_login").focus();
				$("#fusername").focus();
				$("#username").focus();
				$("#email").focus();
			});
			
		});
	});
}

function openGame(gameid) {
	var sverid = "popup_game" + gameid.substring(4);
	if ($("#" + sverid).length == 0 ) {		
		$.post( "/opengame/"+ gameid, { unid: Math.random() })
	    .done(function(data) {
	    	//alert(data);
	    	if (data == "NOTLOGIN") {
	    		showpopup("login");
	    	}else {
		    	var content = $("#content");
		        var popup = $('<div class="draggable" style="top: 160px; left: 120px;width: 527px;height: 250px; position: absolute;"></div>')
		        .draggable({scroll: false})
		    	.html(data);	
		        content.prepend(popup);
	    	}
		})
	    .fail(function (result) {
	    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
	    });	
	}else{
		$("#" + sverid).closest(".draggable").show();
	}
}

function getBalance() {
    var virtualBalance = $("#box_virtualmoney label");
    var realBalance = $("#box_realmoney label");
    $.post( "/getservice/getBalance", { unid: Math.random() })
    .done(function(data) {
    	if (data == "NOTACTIVED") {
    		location.reload(); 
    	}else if (data != "NOTLOGIN") {
	    	var b = JSON.parse(data);
	    	virtualBalance.text(b.virtual);
	    	realBalance.text(b.real);
    	}
    	setTimeout(getBalance, 2000);
	})
    .fail(function (result) {
    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
    });    
}

$(document).ready(function(){	
    $(".se-pre-con").fadeOut("slow");

    var slider = new MasterSlider();
	slider.setup('masterslider' , {
		loop:true,
		width:300,
		height:300,
		speed:20,
		view:'stf',//basic
		preload:0,
		
		space: 10,
		viewOptions:{centerSpace:1.6}
	});
	
	
	$('.ms-nav-next').click(function() {
		slider.api.next();
	});
	$('.ms-nav-prev').click(function() {
		slider.api.previous();
	});
	
	$('._btClose').click(function(){
		$(this).parent().fadeOut(300, function() {
			$('#bodyModal').html("");
		});
	});
	
	//$("#itemGamePoker").draggabilly();
	
	var downX = 0;
	var upX = 0;
	$( ".ms-slide" ).on( "mouseup mousedown", function( event ) {		
		if (event.type == "mousedown")
			downX = event.pageX ;
		if (event.type == "mouseup")
			upX = event.pageX ;
		if (downX == upX) {
			var _this = $(this);
    		var gameid = _this.data("sver");
    		
    		if (gameid == "sver3caychuong") {
					$.post( "/opengame/"+ gameid, { unid: Math.random() })
	    			.done(function(data) {
	    			if (data == "NOTLOGIN") {
	    				showpopup("login");
	    			} else {
						$("#chosenBetLevel").show();
					}
				})
	    		.fail(function (result) {
	    		alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
	    		});
				//window.open("/getgame/sver3caychuong", "sver3caychuong");
			}else {
				openGame(gameid);
			}			
		}			
	});
	
	$("#fullscreenIcon").click(function(){
		screenfull.toggle($('body')[0]);
	});
	if(screen.width < 500 || ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )) {
		$("#fullscreenIcon").show();
	}
	
	var timerBalance = setTimeout(getBalance, 3000);
});