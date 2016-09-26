<div class="modalcontainer" style="margin-top: 30px;">
    <span class="modal_title">Đăng ký</span>
    <div class="divinput" style="background-image: url('/Images/r2.png');">  
        <div class="" id="loginError"></div>                      
        <input id="username" maxlength="30" placeholder="Tên tài khoản..." name="" type="text">
        <input id="password" maxlength="30" placeholder="Mật khẩu..." name="" type="password">
        <input id="repassword" maxlength="30" placeholder="Nhập lại mật khẩu..." name="" type="password">
        <input id="captchar" maxlength="4" placeholder="Mã xác nhận..." name="" type="text" style="width: 100px; float: left;">
        <div class="boxCaptchar"><img id="imgCaptchar" src="/getcaptchar"></div>
        <img id="imgRegetCaptchar" onclick="$('#imgCaptchar').attr('src','/getcaptchar/'+Math.random()); " style="width: 35px; height: 35px; float: left; margin-left: 3px; margin-top: 5px; cursor: pointer;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAAAxCAYAAABznEEcAAADx0lEQVRoge1ZMWsbSRT+IjjFHCYJIm6EvG/ifZNmG6MfcNVVKUwKVyaFSWNzRQgB43bhCOciaHcm1ipHClVHOFyEFIcLV/cDhApXx5FC1RXBBCNCCCHoiluJ0VqOdye7Wl/IB1NI8N583755M2/eAN/wlaANPIuAo7J5WKMNrEfAKAJGbWC9bD5WiIDXETDqAL2yuVghAnb/11EIgBsR8DaOwkHZfKwQAXvjKOwDzfH/La9RU5I2lOt0NFNPM/UU0yfF9Gny23U6StLGk9v1m6UJ2AeaYwERsOd7XlVL50FMeJRlaKaels4D3/OqcxXRAQ5iAW+fLtd/UkynWcnPGKdais25CDC31P3a9ZMZZN5rFq+UFNsBUzNgavpAxQcq499Kim3N9FIxvZ9hP1ArdKdQERFwFAGj6MqVd+pW41gxfYwnP9bsrHeFWEjrqyvEgmZnXTEdn11m4mGRInaNfBi1q9+dtq9e/bMDbJkJnhWa6b5iGphCQtd5lif3CQLgRgfomUIS43WcM7tZRbW8Rk25dJSIyvNChACTHWq3Axx8TlRWIT5Q0UxP57a0TETASgfYioA9U5TtSR66Qk1FpOhkn4X4RP/R1t4HKomlNciR3vygma+Zya6l2CqbkxVCdu4Z0Rhm2cIvDXygopj6hpBHZXOyQuCKu2atVTYfK3SFWDBLlJbXqJXNyQqaxSsjGvdTGYXy1g+/1uvfF8wtNbQUm0Y50k1lpJgOlaQ/tKQdzXytYI4XImBqZs4LxfQmrlCHl2ENtrxGzdihTlIZKaYPY6O537pmwPe8qiHiQyqjr0XEyWXa0qyWk3npD5isLzt5IZBi1RDRT2UUuk7XKLw2i6V4May22Pi6mM2oQEx91LSHXcttsBG+Nz5QKZbm+fD/KwL/meSo2+DUxorpr0leuOJucTQ/j5CX14wo/J3JWDE9MpPJLyEafqIU15J2MjmIq8fhRIikjWKong8lacO8FLW9pUULJ2LbvOdaObFE21tanOpFSbFt7Wy6qSV+z5HnRfP+llujwEysOLke58TzXGimx1PdQF5e+2KnoUs/T7cYhfILSHQfqJzpObHzS24TKEkvEi3GwzzvGnGL5nBqDkkv8vI/gWJ6nhAyCNm596V+49bMIOG7uD6slrSTmGykmPohL69lKdt9z6vG+dZP+st8HthArdCdGV9upJiGmunl5JFFitWxTSDFauKRZTjDvvhHliS0FFvnkMk6hqW2Kdve0mK8xM4sixSjryXtzPMQvRBPbtdvmk/ACWH9S/ME/A0F4V8iytFhcqyhRgAAAABJRU5ErkJggg==">
        <div class="clear"></div>
        <p><label><input type="checkbox" id="acceptprivate"> Tôi đồng ý với </label> <a href="javascript:;">điều khoản sử dụng</a></p>
        <div class="cmdButton" style="margin-top: 15px;">
        	<a href="javascript:;" id="btnRegister">ĐĂNG KÝ</a>                    	
        </div>                        
        <div class="clear"></div>    
    </div> 
    <div class="modal_bottom">
        <div class="text-popup">Hoặc đăng ký bằng</div>
        <a class="icon_social face" href="javascript:;"></a>
        <a class="icon_social goog" href="javascript:;"></a>                     
        <div class="clear"></div>
    </div>         
</div>

<script>
$('#imgCaptchar').attr('src','/getcaptchar/'+Math.random());

$("#btnRegister").click(function(e) {
	e.preventDefault();
	e.stopPropagation();
	
	var name = $("#username").val();
 	var pass = $("#password").val();
 	var repass = $("#repassword").val();
 	var captchar = $("#captchar").val();
 	if (name=='') {
 	 	$("#loginError").html("Bạn chưa nhập tên đăng nhập.");
 	 	$("#username").focus();
 	 	return;
 	}
 	if (name.length < 3) {
 		$("#loginError").html("Tên tài khoản tối thiểu 3 ký tự.");
 	 	$("#username").focus();
 	 	return;
    }
 	if (pass=='') {
 	 	$("#loginError").html("Bạn chưa nhập mật khẩu.");
 	 	$("#password").focus();
 	 	return;
 	}
 	var validated = true;
    if (pass.length < 8 || pass.length > 30)
        validated = false;

    if (!/\d/.test(pass))
        validated = false;
    if (!/[a-z]/.test(pass) && !/[A-Z]/.test(pass))
        validated = false;

    if (pass == name)
        validated = false;

    if (!validated) {
        $("#loginError").html('Mật khẩu 8-30 ký tự; gồm chữ cái, chữ số và không trùng tên tài khoản.');
        $("#password").focus();
        return;
    }
    
 	if (pass != repass) {
 	 	$("#loginError").html("Nhập lại mật khẩu không chính xác.");
 	 	$("#repassword").focus();
 	 	return;
 	}
 	if (captchar=="") {
 	 	$("#loginError").html("Chưa nhập mã xác nhận.");
 	 	$("#captchar").focus();
 	 	return;
 	}
 	if (!$("input#acceptprivate").is(":checked")) {
 	 	$("#loginError").html("Bạn cần phải đồng ý với điều khoản sử dụng.");
 	 	$("#acceptprivate").focus();
 	 	return;
 	}
    $.post( "/getservice/register", { name: name, pass: pass, captchar: captchar })
    .done(function(data) {
        if (data == "TRUE") {
        	$.post( "/header", function(data){
        	    $("#boxBanner").html(data);
        	    //$("._btClose").trigger( "click" );
        	    showpopup("confimemail");
     		});

     		
        }else{
            $("#imgRegetCaptchar").trigger( "click" );
            $("#loginError").html(data);
        }
	})
    .fail(function (result) {
    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
    });
});
</script>