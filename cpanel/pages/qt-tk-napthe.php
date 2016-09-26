
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Thống kê nạp thẻ</span>
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
      <li class="current"><a href="#" title="">Thống kê nạp thẻ</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <form id="validate" class="main" method="post" action="">
      <fieldset>
       <div class="widget">
        <div class="whead"><h6>Xem thống kê nạp thẻ</h6><div class="clear"></div></div>
        <div class="formRow">
         <div class="grid3"><label for="labelfor">Username:</label></div>
         <div class="grid3"><input type="text" name="username" id="labelfor" /></div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label>Vendor:</label></div>
         <div class="grid9">
          <select name="vendor" id="selectReq" class="validate[required]" >
           <option value="">Tất cả</option>
           <option value="VTC">VTC</option>
           <option value="FPT">FPT</option>
           <option value="TELCO">TELCO</option>
           <option value="TT">TT</option>
           <option value="NL">NL</option>
           <option value="NLVAT">NLVAT</option>
           <option value="Viettel">Viettel</option>
           <option value="Mobifone">Mobifone</option>
           <option value="Vinaphone">Vinaphone</option>
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label>Status:</label></div>
         <div class="grid9">
          <select name="status" id="selectReq" class="validate[required]" >
           <option value="">Tất cả</option>
           <option value="0">Chưa sử dụng</option>
           <option value="1">Chưa chuyển GEM</option>
           <option value="2">Hoàn thành</option>
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label for="labelfor1">Card ID:</label></div>
         <div class="grid3"><input type="text" name="cardid" id="labelfor1" /></div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label for="labelfor2">Seri:</label></div>
         <div class="grid3"><input type="text" name="seri" id="labelfor2" /></div>
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
        <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bGreen" /><div class="clear"></div></div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>

    <div class="widget"  id="ajLoadContent">
     
    </div>

   </div>
   <!-- Main content ends -->

   
   <script type="text/javascript">
<!--
$('.buttonM').click(function() {
// 	if ($('select[name="vendor"]').val() == "") {
// 		alert("Chưa nhập tên người chơi");
// 		return false;
// 	}

	if ($('#fromDate').val() == '' || $('#toDate').val() == '') {
		alert("Chưa nhập khoảng thời gian cần xem");
		return false;
	}

    $('#ajLoadContent').html('');
	$.ajax({
        url: "/loadcontent/aj-napthe",
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