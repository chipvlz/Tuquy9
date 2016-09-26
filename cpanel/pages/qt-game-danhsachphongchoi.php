
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Danh sách bàn chơi</span>
   </div>

   <!-- Breadcrumbs line -->
   <div class="breadLine">
    <div class="bc">
     <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Quản trị game</a>
       <ul>
        <li><a href="qt-game-list" title="">Danh sách game</a></li>
        <li><a href="qt-game-kichnguoichoi" title="">Kích người chơi</a></li>
        <li><a href="qt-game-guithongbao" title="">Gửi thông báo</a></li>
        <li><a href="qt-dongmo" title="">Mở / Đóng game</a></li>
       </ul>
      </li>
      <li class="current"><a href="#" title="">Danh sách bàn chơi</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <form id="validate" class="main" method="get" action="/getpage/qt-game-danhsachphongchoi">
      <fieldset>
       <div class="widget">
        <div class="whead"><h6>Lấy danh sách phòng</h6><div class="clear"></div></div>
        <div class="formRow">
         <div class="grid3"><label>Game:<span class="req">*</span></label></div>
         <div class="grid9">
          <select name="selectReq" id="selectReq" class="validate[required]" >
          <?php 
          $sql = "SELECT * FROM gamelist where id=3";
          $rs = mysql_query($sql);
          while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          ?>
           <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
          <?php }?> 
           
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label>Chọn server:<span class="req">*</span></label></div>
         <div class="grid9">
          <select name="selectReq" id="selectReq" class="validate[required]" >
           <option value="opt2">Tất cả</option>
           <option value="opt3">Thần tài lớn</option>
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <input type="submit" value="Thực hiện" class="buttonM bGreen">
         <div class="clear"></div>
        </div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>

    <div class="fluid">
     <!-- Media table -->
     <div class="widget check">
      <div class="whead">
       <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
       <h6>Danh sách phòng chơi</h6><div class="clear"></div>
      </div>
      <div id="dyn" class="hiddenpars">
       <a class="tOptions" title="Options"><img src="images/icons/options" alt="" /></a>
       <table cellpadding="0" cellspacing="0" width="100%" class="tDefault dTable checkAll tMedia" id="checkAll">
        <thead>
         <tr>
          <td><img src="images/elements/other/tableArrows.png" alt="" /></td>
          <td class="sortCol"><div>ID<span></span></div></td>
          <td class="sortCol"><div>Server<span></span></div></td>
          <td class="sortCol"><div>Loại Phòng / Bàn<span></span></div></td>
          <td class="sortCol" width="120"><div>Giá trị tiền cược<span></span></div></td>
          <td width="100">Kích hoạt</td>
         </tr>
        </thead>
        <tfoot>
         <tr>
          <td colspan="6">
           <div class="itemActions">
            <label>Apply action:</label>
            <select id="slAction">
             <option value="">Select action...</option>
             <option value="1">Kích hoạt hết</option>
             <option value="0">Hủy kích hoạt hết</option>
            </select>
           </div>
          </td>
         </tr>
        </tfoot>
        <tbody>
        <?php 
          $sql = "SELECT * FROM room";
          $rs = mysql_query($sql);
          while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
        ?>
         <tr>
          <td><input type="checkbox" name="checkRow" value="<?php echo $row['id']?>" /></td>
          <td><?php echo $row['id']?></td>
          <td class="textL">Thần tài lớn</td>
          <td class="textL"><?php echo $row['type']?></td>
          <td class="fileInfo"><span><strong><?php echo $row['value']?></strong></span></td>
          <td class="tableActs">
           <a href="javascript:;" data-id="<?php echo $row['id']?>" class="tablectrl_small buttonM bDefault tipS" title="Kích hoạt phòng"><span class="<?php echo ($row['actived']?'icos-check':'icos-block')?>"></span></a>
          </td>
         </tr>
         <?php }?>
        </tbody>
       </table>
      </div>
     </div>
    </div>
   </div>
   <!-- Main content ends -->
<script>
$('#slAction').change(function () {
	var action = $(this).val();
	if (action != '') {
    	var list = $('input[name="checkRow"]:checked').map(function() {
    	    return this.value;
    	}).get().join(",");
    	
    	$.post( "/getservice/activedAllroom", { list: list, action: action })
        .done(function(result) {
        	location.reload(); 
    	});
	}
});

$('.tablectrl_small').click(function() {
	var _this = $(this); 
	
	$.post( "/getservice/activedroom", { id: _this.data('id') })
    .done(function(result) {

        if (result == 0)
            _this.find('span').removeClass().addClass('icos-block');
        else
            _this.find('span').removeClass().addClass('icos-check');
	}); 
});

</script>