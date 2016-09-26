<div class="modalcontainer">
    <span class="modal_title">Thông báo</span>
    <div class="divinput" style="background-image: url('/Images/rectang_f.png');"> 
        <p style="margin-top: 10px; text-align: center;">Bạn chắc chắn muốn thoát khỏi hệ thống?</p>
        <a href="javascript:;" class="flatbutton" id="cmdAccept">Đồng ý</a>
        <a href="javascript:;" class="flatbutton" id="cmdCancel">Hủy bỏ</a>
    </div>
</div>

<script>
$("#cmdCancel").click(function() {
	//$("._btClose").trigger( "click" );
	$(".modal").fadeOut(300, function() {
		$('#bodyModal').html("");
	});
});

$("#cmdAccept").click(function() {
	//window.location.href = '/getservice/logout';
	$.post( "/getservice/login", { name: '', pass: '' })
    .done(function() {
    	window.location.href = '/';
//     	$("#content").find(".draggable").remove();
//      	$.post( "/header", function(data){
//      	    $("#boxBanner").html(data);
//       	   //$("._btClose").trigger( "click" );
//      	    $(".modal").fadeOut(300, function() {
//       			$('#bodyModal').html("");
//       		});
//     	});
	});
});
</script>