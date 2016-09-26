
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Tin chạy trong game</span>
   </div>

   <!-- Breadcrumbs line -->
   <div class="breadLine">
    <div class="bc">
     <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Quản trị tin</a>
       <ul>
        <li><a href="qt-news-danhsachtin" title="">Danh sách tin đăng</a></li>
        <li><a href="qt-news-taobaiviet" title="">Tạo bài viết mới</a></li>
        <li><a href="qt-news-tinpopup" title="">Tin Pop Up</a></li>
        <li><a href="qt-news-video" title="">Quản lý Video</a></li>
        <li><a href="qt-news-taovideo" title="">Đăng Video mới</a></li>
       </ul>
      </li>
      <li class="current"><a href="#" title="">Tin trong Game</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <form id="validate" class="main">
      <fieldset>
       <div class="widget">
        <div class="whead"><h6>Tin chạy trên cổng game</h6><div class="clear"></div></div>
        <div class="displayNone" id="newsTemplate">
            <div class="formRow">
             <div class="grid2"><label for="labelfor">Tiêu đề:</label></div>
             <div class="grid9"><input type="text" name="title[]" /></div>
             <div class="grid1"><a href="javascript:;" class="tablectrl_small bDefault tipS" onclick="xoaFormrow(this)"><span class="iconb" data-icon="&#xe136;"></span></a></div>
             <div class="clear"></div>
            </div>        
            <div class="formRow">
             <div class="grid2"><label for="labelfor1">Link to:</label></div>
             <div class="grid9"><input type="text" name="link[]" /></div>
             <div class="clear"></div>
            </div>
            <div class="formRow"></div>
        </div>
        <?php 
        $sql = "SELECT * FROM newsmarquee";
        $rs = mysql_query($sql);
        while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
        ?>
        <div class="formRow">
         <div class="grid2"><label for="labelfor">Tiêu đề:</label></div>
         <div class="grid9"><input type="text" name="title[]" value="<?php echo $row['title']?>" id="labelfor" /></div>
         <div class="grid1"><a href="javascript:;" class="tablectrl_small bDefault tipS" onclick="xoaFormrow(this)"><span class="iconb" data-icon="&#xe136;"></span></a></div>
         <div class="clear"></div>
        </div>        
        <div class="formRow">
         <div class="grid2"><label for="labelfor1">Link to:</label></div>
         <div class="grid9"><input type="text" name="link[]" id="labelfor1" value="<?php echo $row['link']?>" /></div>
         <div class="clear"></div>
        </div>
        <div class="formRow"></div>
        <?php }?>
        
        <div class="formRow" id="btActionFormrow">
         <div class="status"></div>
         <div class="formSubmit">
          <a href="javascript:;" class="buttonM bRed" id="addnewnews">Thêm tin</a>
          <a href="javascript:;" class="buttonM bGreen ml10" id="updatenews">Cập nhật</a>
          <div class="clear"></div>
         </div>
         <div class="clear"></div>
        </div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>
   </div>
   <!-- Main content ends -->

   
<script type="text/javascript">
<!--
function xoaFormrow(a){
	var formRow = $(a).closest('.formRow');
	formRow.next().remove();
	formRow.next().remove();
	formRow.remove();
}

$('#addnewnews').click(function(){
	var btn = $("#btActionFormrow");
    var formRow = $("#newsTemplate").html();
    btn.before(formRow);
});



$('#updatenews').click(function() {
	var data = $('#validate').serializeArray();
	$.ajax({
        url: "/getservice/updateNewsMarquee",
        type: "POST",
        data: data,
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