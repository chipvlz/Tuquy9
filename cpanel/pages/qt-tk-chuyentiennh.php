
  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Thống kê chuyển tiền ngân hàng</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Thống kê</a>
      <ul>
       <li><a href="qt-tk-ccu" title="">Thống kê CCU</a></li>
      </ul>
     </li>
     <li class="current"><a href="#" title="">Thống kê chuyển tiền ngân hàng</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">
   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Xem thống kê chuyển tiền ngân hàng</h6><div class="clear"></div></div>

       <div class="formRow">
        <div class="grid3"><label for="labelfor1">Username:</label></div>
        <div class="grid3"><input type="text" name="username" id="labelfor1" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label for="labelfor">Người gửi:</label></div>
        <div class="grid3"><input type="text" name="sender" id="labelfor" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label for="labelfor1">Số TK:</label></div>
        <div class="grid3"><input type="text" name="account" id="labelfor1" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label for="labelfor">Phone:</label></div>
        <div class="grid3"><input type="text" name="phone" id="labelfor" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label for="labelfor1">Email:</label></div>
        <div class="grid3"><input type="text" name="email" id="labelfor1" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Ngày gửi:</label></div>
        <div class="grid9">
         <ul class="datesRange">
          <li><input type="text" id="fromDate" name="fromDate" placeholder="Từ ngày"/></li>
          <li class="sep">-</li>
          <li><input type="text" id="toDate" name="toDate" placeholder="Đến ngày"/></li>
         </ul>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Ngân hàng:</label></div>
        <div class="grid9">
         <select name="bank" id="selectReq">
          <option value="">Tất cả</option>
          <option value="VCB">VCB</option>
          <option value="TCB">TCB</option>
          <option value="HSBC">HSBC</option>
         </select>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bGreen" /><div class="clear"></div></div>
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
$('.buttonM').click(function() {

	if ($('#fromDate').val() == '' || $('#toDate').val() == '') {
		alert("Chưa nhập khoảng thời gian cần xem");
		return false;
	}

    $('#ajLoadContent').html('');
	$.ajax({
        url: "/loadcontent/aj-chuyentiennh",
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