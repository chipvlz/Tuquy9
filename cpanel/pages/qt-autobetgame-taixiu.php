<?php 
$sql = "SELECT * FROM taixiu_autobet ";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs,MYSQL_ASSOC);
?>

  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Tự động vào game Tài Xỉu</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Tự động vào game Tài Xỉu</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Thông tin cấu hình</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Tên người chơi (UserName):<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" name="username" value="<?php echo $row["username"]?>" /></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Hình thức đặt cược:</label></div>
        <div class="grid9">
         <select name="bettype" id="bettype" class="validate[required]" >
          <option <?php echo ($row["bettype"] == 1 ? "selected=selected":"")?> value="1">Số tiền cố định</option>
          <option <?php echo ($row["bettype"] == 2 ? "selected=selected":"")?> value="2">Bằng số tiền bên thắng</option>
          <option <?php echo ($row["bettype"] == 3 ? "selected=selected":"")?> value="3">Bằng số tiền bên thua</option>
          <option <?php echo ($row["bettype"] == 4 ? "selected=selected":"")?> value="4">Bằng số tiền chênh lệch</option>
         </select>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số tiền cố định:</label></div>
        <div class="grid4"><input type="text" name="betmoney" id="betmoney"  value="<?php echo $row["betmoney"]?>"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Kích hoạt chức năng:</label></div>
        <div class="grid9">
         <input type="radio" id="radio3" name="actived" value="1" <?php echo ($row["actived"] == 1 ? "checked=checked":"")?> /><label for="radio3"  class="mr20">Kích hoạt</label>
         <input type="radio" id="radio4" name="actived" value="0" <?php echo ($row["actived"] == 0 ? "checked=checked":"")?> /><label for="radio4"  class="mr20">Không kích hoạt</label>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bBlack formSubmit" id="cmdExe" /><div class="clear"></div></div>
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
	if ($('input[name="actived"]').val() == "") {
		alert("Vui lòng chọn hình thức hoạt");
		return false;
	}
	
	$.ajax({
        url: "/getservice/updateConfigAutoBetTaiXiu",
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