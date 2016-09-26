<div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Lịch sử đổi tiền / chuyển tiền</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Lịch sử đổi tiền / chuyển tiền</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Xem Log đổi tiền / chuyển tiền</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Người chơi(UserName):<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" name="username" id="req2"/></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Thời gian:</label></div>
        <div class="grid9">
         <ul class="datesRange">
          <li><input type="text" id="fromDate" name="fromDate" placeholder="Từ ngày"/></li>
          <li class="sep">-</li>
          <li><input type="text" id="toDate" name="toDate" placeholder="Đến ngày"/></li>
         </ul>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bBlack formSubmit" /><div class="clear"></div></div>
       <div class="clear"></div>
      </div>
     </fieldset>
    </form>
   </div>

   <div class="widget" id="ajLoadContent">
    
   </div>

  </div>
  <!-- Main content ends -->
  
<script type="text/javascript">
<!--
$('.formSubmit').click(function() {
// 	if ($('input[name="username"]').val() == "") {
// 		alert("Chưa nhập tên người chơi");
// 		return false;
// 	}

	if ($('#fromDate').val() == '' || $('#toDate').val() == '') {
		alert("Chưa nhập khoảng thời gian cần xem");
		return false;
	}

    $('#ajLoadContent').html('');
	$.ajax({
        url: "/loadcontent/aj-get-log-tcoin",
        type: "POST",
        data: $('#validate').serializeArray(),
        success: function (result) {
        	$('#ajLoadContent').html(result);
        },
        error: function (result) {
            alert("Lỗi???\n" + result);
        }
    });
});
//-->
</script>