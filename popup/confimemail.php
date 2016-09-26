<div class="modalcontainer">
    <span class="modal_title" style="font-size: 30px; top: 40px;">Xác nhận email</span>
    <div class="divinput" style="background-image: url('/Images/rectang_f.png');">    
        <div class="" id="loginError"></div>                    
        <input id="email" maxlength="30" placeholder="Địa chỉ email..." name="email" type="text">
        <input id="reemail" maxlength="30" placeholder="Nhập lại địa chỉ email..." name="reemail" type="text">
        <p style="padding-top: 10px;">* Email giúp bạn lấy lại mật khẩu khi quên.</p>
        <div class="clear"></div>
        <div class="cmdButton" style="margin-top: 15px;">
        	<a href="javascript:;" id="btnLogin">XÁC NHẬN</a>                    	
        </div>                        
        <div class="clear"></div>    
    </div>
</div>

<script>
$("#btnLogin").click(function(e){	
	e.preventDefault();
	e.stopPropagation();
	
 	var email = $("#email").val();
 	var reemail = $("#reemail").val();
 	if (email=='') {
 	 	$("#loginError").html("Bạn chưa nhập địa chỉ email");
 	 	$("#email").focus();
 	 	return;
 	}

	var apos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if (apos<1||dotpos-apos<2){
		$("#loginError").html('Email không hợp lệ, bạn vui lòng nhập lại!');
		$("#email").focus();
		return false;
	}

 	if (reemail=='') {
 	 	$("#loginError").html("Bạn chưa nhập lại địa chỉ email");
 	 	$("#reemail").focus();
 	 	return;
 	}
 	if (email != reemail) {
 	 	$("#loginError").html("Nhập lại email không chính xác.");
 	 	$("#reemail").focus();
 	 	return;
 	}
    $.post( "/getservice/confimemail", { email: email })
    .done(function(data) {
    	if (data == "TRUE") {
        	$("._btClose").trigger( "click" );        	    		
        }else{
            $("#loginError").html(data);
        }
	})
    .fail(function (result) {
    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
    });
});
</script>