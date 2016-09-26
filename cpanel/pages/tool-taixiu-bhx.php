
  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>BHX - Xem user thắng thua nhiều nhất</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">     
     <li class="current"><a href="#" title="">BHX - Xem user thắng thua nhiều nhất</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>BHX - Xem user thắng thua nhiều nhất</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Thời gian:<span class="req">*</span></label></div>
        <div class="grid9">
         <p><label><input type="radio" name="thoigian" value="1" checked="checked"> Trong ngày</label>
         <p><label><input type="radio" name="thoigian" value="2"> Trong tuần</label>
         <p><label><input type="radio" name="thoigian" value="3"> Trong tháng</label>
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
        url: "/loadcontent/aj-get-tool-taixiu-bhx",
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