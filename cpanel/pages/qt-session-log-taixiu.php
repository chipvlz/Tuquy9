
  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Lịch sử chơi game</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Lịch sử ván chơi</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Lịch sử ván chơi</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Mã ván chơi:<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" name="gameid" id="gameid"/></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Loại tiền:<span class="req">*</span></label></div>
        <div class="grid9">
         <select name="typemoney" id="typemoney" class="validate[required]" >
          <option value="virtualmoney">XU</option>
          <option value="realmoney">GEM</option>
         </select>
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
	if ($('#gameid').val() == "") {
		alert("Chưa nhập mã ván chơi");
		$('#gameid').focus();
		return false;
	}

    $('#ajLoadContent').html('');
	$.ajax({
        url: "/loadcontent/aj-get-bet-history-taixiu",
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