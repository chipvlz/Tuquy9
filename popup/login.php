<div class="modalcontainer">
    <span class="modal_title">Đăng nhập</span>    
    <div class="divinput">        
        <div class="" id="loginError"></div>                     
        <input id="username_login" maxlength="30" placeholder="Tên tài khoản..." name="" type="text" autofocus>
        <input id="password_login" maxlength="30" placeholder="Mật khẩu..." name="" type="password">   
        <div class="linegradian"></div>                     
        <div class="cmdButton">
        	<a href="javascript:;" id="btnLogin">ĐĂNG NHẬP</a>                    	
        </div>
        <div class="cmdButton" style="float: right">
        	<a href="javascript:;" id="btnregister">ĐĂNG KÝ</a>                    	
        </div>        
        <p align="right"><a href="javascript:;" id="btnfogotpass">Quên mật khẩu...</a></p>          
    </div> 
    <div class="modal_bottom">
        <div class="text-popup">Hoặc đăng nhập bằng</div>
        <a class="icon_social face" href="javascript:;"></a>
        <a class="icon_social goog" href="javascript:;"></a>                     
        <div class="clear"></div>
    </div>
</div>
<script>
$('#btnfogotpass').click(function (e) {
	e.preventDefault();
    e.stopPropagation();
	showpopup("forgotpass");	
});
$('#btnregister').click(function(e){
	e.preventDefault();
    e.stopPropagation();
	showpopup("register");
});

$("#btnLogin").click(function(e){	
	e.preventDefault();
	e.stopPropagation();
	
 	var name = $("#username_login").val();
 	var pass = $("#password_login").val();
 	if (name=='') {
 	 	$("#loginError").html("Bạn chưa nhập tên đăng nhập");
 	 	$("#username_login").focus();
 	 	return;
 	}
 	if (pass=='') {
 	 	$("#loginError").html("Bạn chưa nhập mật khẩu");
 	 	$("#password_login").focus();
 	 	return;
 	}
    $.post( "/getservice/login", { name: name, pass: pass })
    .done(function(data) {
        if (data == "TRUE" || data == "NOTEMAIL") {
        	$.post( "/header", function(data){
        	    $("#boxBanner").html(data);
        	    $("._btClose").trigger( "click" );
     		});
        	
     		if (data == "NOTEMAIL") {
     			showpopup("confimemail");
     		}

     		//openGame("sverpoker");
             window.location.replace('http://tuquy9.com');
        }else{
            $("#loginError").html(data);
        }
	})
    .fail(function (result) {
    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
    });
});

$("#username_login").on( "keypress", function(event) {
    if (event.which == 13 && !event.shiftKey) {
        event.preventDefault();
        $("#password_login").focus();
    }
});

$("#password_login").on( "keypress", function(event) {
    if (event.which == 13 && !event.shiftKey) {
        event.preventDefault();
        $("#btnLogin").trigger( "click" );
    }
});
</script>