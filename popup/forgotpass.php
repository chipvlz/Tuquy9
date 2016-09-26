<div class="modalcontainer">
    <span class="modal_title" style="font-size: 30px; top: 40px;">Quên mật khẩu</span>
    <div class="divinput">    
        <div class="" id="loginError"></div>                    
        <input id="fusername" maxlength="30" placeholder="Tên tài khoản..." name="" type="text">
        <input id="femail" maxlength="30" placeholder="Địa chỉ email..." name="" type="text">
        <input id="fcaptchar" maxlength="4" placeholder="Mã xác nhận..." name="" type="text" style="width: 100px; float: left;">
        <div class="boxCaptchar"><img id="fimgCaptchar" src="/getcaptchar"></div>
        <img id="imgRegetCaptchar" onclick="$('#fimgCaptchar').attr('src','/getcaptchar/'+Math.random()); " style="width: 35px; height: 35px; float: left; margin-left: 3px; margin-top: 5px; cursor: pointer;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAAAxCAYAAABznEEcAAADx0lEQVRoge1ZMWsbSRT+IjjFHCYJIm6EvG/ifZNmG6MfcNVVKUwKVyaFSWNzRQgB43bhCOciaHcm1ipHClVHOFyEFIcLV/cDhApXx5FC1RXBBCNCCCHoiluJ0VqOdye7Wl/IB1NI8N583755M2/eAN/wlaANPIuAo7J5WKMNrEfAKAJGbWC9bD5WiIDXETDqAL2yuVghAnb/11EIgBsR8DaOwkHZfKwQAXvjKOwDzfH/La9RU5I2lOt0NFNPM/UU0yfF9Gny23U6StLGk9v1m6UJ2AeaYwERsOd7XlVL50FMeJRlaKaels4D3/OqcxXRAQ5iAW+fLtd/UkynWcnPGKdais25CDC31P3a9ZMZZN5rFq+UFNsBUzNgavpAxQcq499Kim3N9FIxvZ9hP1ArdKdQERFwFAGj6MqVd+pW41gxfYwnP9bsrHeFWEjrqyvEgmZnXTEdn11m4mGRInaNfBi1q9+dtq9e/bMDbJkJnhWa6b5iGphCQtd5lif3CQLgRgfomUIS43WcM7tZRbW8Rk25dJSIyvNChACTHWq3Axx8TlRWIT5Q0UxP57a0TETASgfYioA9U5TtSR66Qk1FpOhkn4X4RP/R1t4HKomlNciR3vygma+Zya6l2CqbkxVCdu4Z0Rhm2cIvDXygopj6hpBHZXOyQuCKu2atVTYfK3SFWDBLlJbXqJXNyQqaxSsjGvdTGYXy1g+/1uvfF8wtNbQUm0Y50k1lpJgOlaQ/tKQdzXytYI4XImBqZs4LxfQmrlCHl2ENtrxGzdihTlIZKaYPY6O537pmwPe8qiHiQyqjr0XEyWXa0qyWk3npD5isLzt5IZBi1RDRT2UUuk7XKLw2i6V4May22Pi6mM2oQEx91LSHXcttsBG+Nz5QKZbm+fD/KwL/meSo2+DUxorpr0leuOJucTQ/j5CX14wo/J3JWDE9MpPJLyEafqIU15J2MjmIq8fhRIikjWKong8lacO8FLW9pUULJ2LbvOdaObFE21tanOpFSbFt7Wy6qSV+z5HnRfP+llujwEysOLke58TzXGimx1PdQF5e+2KnoUs/T7cYhfILSHQfqJzpObHzS24TKEkvEi3GwzzvGnGL5nBqDkkv8vI/gWJ6nhAyCNm596V+49bMIOG7uD6slrSTmGykmPohL69lKdt9z6vG+dZP+st8HthArdCdGV9upJiGmunl5JFFitWxTSDFauKRZTjDvvhHliS0FFvnkMk6hqW2Kdve0mK8xM4sixSjryXtzPMQvRBPbtdvmk/ACWH9S/ME/A0F4V8iytFhcqyhRgAAAABJRU5ErkJggg==">
        <div class="clear"></div>
        <div class="cmdButton" style="margin-top: 15px;">
        	<a href="javascript:;" id="btnLogin">XÁC NHẬN</a>                    	
        </div>                        
        <div class="clear"></div>    
    </div>
</div>
<script>
$('#fimgCaptchar').attr('src','/getcaptchar/'+Math.random());

$("#btnLogin").click(function(e){	
	e.preventDefault();
	e.stopPropagation();
	
 	var email = $("#femail").val();
 	var name = $("#fusername").val();
 	var captchar = $("#fcaptchar").val();
 	
 	if (name=='') {
 	 	$("#loginError").html("Bạn chưa nhập tên tài khoản.");
 	 	$("#fusername").focus();
 	 	return;
 	}
 	
 	if (email=='') {
 	 	$("#loginError").html("Bạn chưa nhập địa chỉ email");
 	 	$("#femail").focus();
 	 	return;
 	}
 	
	var apos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if (apos<1||dotpos-apos<2){
		$("#loginError").html('Email không hợp lệ, bạn vui lòng nhập lại!');
		$("#femail").focus();
		return false;
	}

	if (captchar=="") {
 	 	$("#loginError").html("Chưa nhập mã xác nhận.");
 	 	$("#fcaptchar").focus();
 	 	return;
 	}
 	
    $.post( "/getservice/forgotpass", { email: email, name: name, captchar: captchar })
    .done(function(data) {
    	$('.divinput').html(data);
//     	if (data == "TRUE") {
//         	var text = "Cám ơn bạn đã sử dụng dịch vụ của chúng tôi! <br>Mật khẩu mới đã được gửi đến địa chỉ email: " + email; 
//         	var p = $('<p />').html(text);
//         	var div = $('<div class="cmdButton" style="margin-top: 50px;" />');
//         	var a = $('<a href="javascript:;" id="btnRegister">ĐĂNG NHẬP</a>').click(function(){showpopup("login");});

//         	div.append(a);        	
//     		$('.divinput').html('').append(p).append(div);
//         }else{
//             $("#imgRegetCaptchar").trigger( "click" );
//             $("#loginError").html(data);
//         }
	})
    .fail(function (result) {
    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
    });
});
</script>