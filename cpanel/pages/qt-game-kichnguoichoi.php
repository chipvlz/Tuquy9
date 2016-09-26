
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Kích người chơi</span>
   </div>

   <!-- Breadcrumbs line -->
   <div class="breadLine">
    <div class="bc">
     <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Quản trị game</a>
       <ul>
        <li><a href="qt-game-list" title="">Danh sách game</a></li>
        <li><a href="qt-game-guithongbao" title="">Gửi thông báo</a></li>
        <li><a href="qt-game-dongmogame" title="">Mở / Đóng game</a></li>
        <li><a href="qt-game-bannick" title="">Ban / Bỏ ban nick</a></li>
       </ul>
      </li>
      <li class="current"><a href="#" title="">Kích người chơi</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <div class="nNote nSuccess displayNone">
         <p>Success message! hoooraaay!!!!</p>
     </div>
     <div class="nNote nFailure displayNone">
         <p>Oops sorry. That action is not valid, or our servers have gone bonkers</p>
     </div>

    </div>

    <div class="fluid">
     <form id="validate" class="main" method="post" action="">
      <fieldset>
       <div class="widget">
        <div class="whead"><h6>Kích người chơi</h6><div class="clear"></div></div>
        <div class="formRow">
         <div class="grid3"><label>Người chơi(Name):<span class="req">*</span></label></div>
         <div class="grid4"><input type="text" class="validate[required]" name="username" id="req2"/></div><div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label>Lý do:<span class="req">*</span></label></div>
         <div class="grid9"><textarea rows="8" cols="" name="note" class="validate[required]" id="textareaValid"></textarea></div><div class="clear"></div>
        </div>
        <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bBlack formSubmit" /><div class="clear"></div></div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>



   </div>
   <!-- Main content ends -->
   
   <script type="text/javascript">
<!--
$('.formSubmit').click(function () {
	if ($('input[name="username"]').val() == "" ) {
		alert("Chưa nhập Username");
		return false;
	}
	if ($('textarea[name="note"]').val() == "" ) {
		alert("Chưa nhập lý do");
		return false;
	}
	
	$.ajax({
        url: "/getservice/kichnguoichoi",
        type: "POST",
        data: $('#validate').serializeArray(),
        success: function (result) {
            alert(result);               
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
});
//-->
</script>
