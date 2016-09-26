
  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Lịch sử chơi game</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Lịch sử chơi game</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Xem Log chơi game</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Người chơi(UserName):<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" name="username" id="req2"/></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Game:<span class="req">*</span></label></div>
        <div class="grid9">
         <select name="gameid" id="selectReq" class="validate[required]" >
          <option value="taixiu" selected="selected">Tài xỉu</option>
         </select>
        </div>
        <div class="clear"></div>
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
       <div class="formRow"><button type="button" value="Thực hiện" class="buttonM bBlack formSubmit" id="cmdExe">Thực hiện</button><div class="clear"></div></div>
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
$('#cmdExe').click(function() {
	if ($('input[name="username"]').val() == "") {
		alert("Chưa nhập tên người chơi");
		return false;
	}

	if ($('#fromDate').val() == '' || $('#toDate').val() == '') {
		alert("Chưa nhập khoảng thời gian cần xem");
		return false;
	}

    $('#ajLoadContent').html('');
	$.ajax({
        url: "/loadcontent/aj-get-bet-history",
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