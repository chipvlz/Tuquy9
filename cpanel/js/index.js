function addCoin(frm) {
	if ($('input[name="username"]').val() == "" ) {
		alert("Chưa nhập Username");
		return false;
	}
	if ($('input[name="numsValid"]').val() == "" ) {
		alert("Chưa nhập số tiền");
		return false;
	}
	if ($('input[name="note"]').val() == "" ) {
		alert("Chưa nhập lý do");
		return false;
	}
	$.ajax({
        url: "/getservice/addcoin",
        type: "POST",
        data: frm.serializeArray(),
        success: function (result) {
        	alert(result);
        	if (result == "Thành công!") {
        		location.reload(); 
        	}
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
}

function addnewUser(frm) {
	if ($('input[name="username"]').val() == "" ) {
		alert("Chưa nhập Username");
		return false;
	}
	if ($('input[name="email"]').val() == "" ) {
		alert("Chưa nhập email");
		return false;
	}
	if ($('input[name="password"]').val() == "" ) {
		alert("Chưa nhập mật khẩu");
		return false;
	}
	$.ajax({
        url: "/getservice/addnewuser",
        type: "POST",
        data: frm.serializeArray(),
        success: function (result) {
        	
        	if (result != '') {
        		alert(result);
        	}else{
        		$('input[name="addnewuser"]').val("addnewuser");
        		frm.submit();
        	}
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
}

function loadDetailUser(userid) {
	$.ajax({
        url: "/loadcontent/aj-detail-user",
        type: "POST",
        data: { userid: userid },
        success: function (result) {
        	
        	$("#frmEditUserGame").html("");
            $("#detailUserGame").html(result);
            window.location.href = "#detailUserGame";
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
}

function deleteUserAccount (userid) {
	if (confirm('Bạn chắc chắn muốn xóa user: "'+ userid +'"?')) {
		$.ajax({
	        url: "/getservice/deleteuser",
	        type: "POST",
	        data: { userid: userid },
	        success: function (result) {
	            window.location.href = "/getpage/qt-user-list";
	        },
	        error: function (result) {
	            alert("Lỗi???\n" + result);
	        }
	    });
	}
}

function editUserInfo(userid) {
	$.ajax({
        url: "/loadcontent/aj-edit-user",
        type: "POST",
        data: { userid: userid },
        success: function (result) {
        	$("#detailUserGame").html("");
            $("#frmEditUserGame").html(result);
            window.location.href = "#detailUserGame";
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
}

function cancelEditUser () {
	$("#detailUserGame").html("");
    $("#frmEditUserGame").html("");
    window.location.href = "#listUserGame";
}

$(document).ready(function() {
  
	$("#login__input__pass").on( "keypress", function(event) {
	    if (event.which == 13 && !event.shiftKey) {
	        event.preventDefault();
	        $(".login__submit").trigger( "click" );
	    }
	});
	
  var animating = false;
  
  $(document).on("click", ".login__submit", function(e) {
	    var name = $("#login__input__name").val();
	 	var pass = $("#login__input__pass").val();
	 	if (name=='') {
	 	 	$("#loginError").html("Bạn chưa nhập tên đăng nhập");
	 	 	$("#login__input__name").focus();
	 	 	return;
	 	}
	 	if (pass=='') {
	 	 	$("#loginError").html("Bạn chưa nhập mật khẩu");
	 	 	$("#login__input__pass").focus();
	 	 	return;
	 	}
	 	
	 	if (animating) return;
	    animating = true;
	    var that = this;

	    $(that).addClass("processing");
 	
	    $.post( "/getservice/login", { name: name, pass: pass })
	    .done(function(data) {
	        if (data == "TRUE") {
	        	animating = false;
	        	$("#loginError").html("");
	        	setTimeout(function() {
	    	    	$(that).addClass("success");
	    	    }, 1100);
	        	window.location.href = "/";
	        }else{
	        	animating = false;
	        	$(that).removeClass("processing");
	            $("#loginError").html(data);
	        }
		})
	    .fail(function (result) {
	    	animating = false;
	    	alert("Lỗi kết nối, vui lòng kiểm tra kết nối mạng của bạn.");
	    });    
  });  
  
  $(".logout").click(function(){
	  window.location.href = "/getservice/logout";
  });
  
  
});