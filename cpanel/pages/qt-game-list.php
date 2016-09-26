
  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Danh sách game</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị game</a></li>
     <li class="current"><a href="#" title="">Danh sách game</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="widget">
    <div class="whead"><h6>Danh sách Game</h6><div class="clear"></div></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tAlt wGeneral">
     <thead>
      <tr>
       <td>GID</td>
       <td>Tên Game</td>
       <td>Logo</td>
       <td>Ngày public</td>
       <td>Action</td>
      </tr>
     </thead>
     <tbody>
     <?php 
     $sql = "SELECT * FROM gamelist";
     $rs = mysql_query($sql);
     while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
     ?>
      <tr>
       <td align="center"><?php echo $row['id']?></td>
       <td align="center"><?php echo $row['name']?></td>
       <td align="center"><img src="/<?php echo $row['logo']?>" width="36" height="36" alt=""></td>
       <td align="center"><?php echo $row['publishdate']?></td>
       <td align="center">
        <a href="#" class="tablectrl_small bDefault tipS" title="Sửa" data-id="<?php echo $row['id']?>" data-url="<?php echo $row['url']?>"  data-name="<?php echo $row['name']?>"><span class="iconb" data-icon="&#xe1db;"></span></a>
       </td>
      </tr>
      <?php }?>
     </tbody>
    </table>

   </div>

   <div class="fluid">
    <form id="validate" class="main" method="post" action="/getservice/updategamelist"  enctype="multipart/form-data">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Sửa thông tin game</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Game ID:</label></div>
        <div class="grid9"><input type="hidden" class="validate[required]" value="" name="gameid" /> <span id="lbGameID">9999999</span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Tên Game:</label></div>
        <div class="grid4"><input type="text" class="validate[required]" value="Chắn" name="name" id="req"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Đường dẫn game:</label></div>
        <div class="grid4"><input type="text" class="" value="http://apps.thapthanh.com/chan" name="url"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Logo:</label></div>
        <div class="grid9"><input type="file" class="fileInput" id="fileInput" name="logo" /><span class="note">File .image</span></div>
        <div class="clear"></div>
       </div>
      </div>
     </fieldset>
    </form>
   </div>

  </div>
  <!-- Main content ends -->



<script>
dialog = $('#validate').dialog({
 autoOpen: false,
 width: 360,
 modal: true,
 buttons: {
  "Cập nhật": function () {
	  $('#validate').submit();
  },
  "Đóng": function () {
   $(this).dialog("close");
  }
 }
});

$('.tablectrl_small').click(function() {

	$('input[name="name"]').val($(this).data('name'));
	$('input[name="url"]').val($(this).data('url'));
	$('input[name="gameid"]').val($(this).data('id'));
	$('#lbGameID').text($(this).data('id'));	
    
	dialog.dialog('open');
	
});
</script>

