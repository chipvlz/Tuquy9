
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Mở / Đóng game</span>
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
        <li><a href="qt-game-bannick" title="">Ban / Bỏ ban nick</a></li>
       </ul>
      </li>
      <li class="current"><a href="#" title="">Mở / Đóng game</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <form id="validate" class="main" method="post" action="">
      <fieldset>
       <div class="widget">
        <div class="whead"><span class="icon-glass"></span><h6>Đóng / Mở Game</h6><div class="clear"></div></div>
        <div class="formRow">
         <div class="grid3"><label>Server:<span class="req">*</span></label></div>
         <div class="grid9">
          <select name="selectReq" id="selectReq" class="validate[required]" >
           <option value="">Tất cả</option>
           <option value="1">Thần tài lớn</option>
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="body">
         <div class="leftBox">
          <p><strong>Đang mở</strong></p>
          <select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
          <?php 
          $sql = "SELECT * FROM gamelist where actived";
          $rs = mysql_query($sql);
          while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          ?>
           <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
          <?php }?> 
          </select>
          <br/>
          <span id="box1Counter" class="countLabel"></span>

          <div class="displayNone"><select id="box1Storage"></select></div>
         </div>

         <div class="dualControl">
          <button id="to2" type="button" class="dualBtn mr5 mb15">&nbsp;&gt;&nbsp;</button>
          <button id="allTo2" type="button" class="dualBtn">&nbsp;&gt;&gt;&nbsp;</button><br />
          <button id="to1" type="button" class="dualBtn mr5">&nbsp;&lt;&nbsp;</button>
          <button id="allTo1" type="button" class="dualBtn">&nbsp;&lt;&lt;&nbsp;</button>
         </div>

         <div class="rightBox">
          <p><strong>Đang đóng</strong></p>
          <select id="box2View" multiple="multiple" class="multiple" style="height:300px;">
          <?php 
          $sql = "SELECT * FROM gamelist where Not(actived)";
          $rs = mysql_query($sql);
          while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          ?>
           <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
          <?php }?> 
          </select><br/>
          <span id="box2Counter" class="countLabel"></span>

          <div class="displayNone"><select id="box2Storage"></select></div>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bBlack formSubmit" /><div class="clear"></div></div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>



   </div>
   <!-- Main content ends -->

<script type="text/javascript">
<!--
$('.formSubmit').click(function () {

	var open = $('#box1View option').map(function() {
	    return this.value;
	}).get().join(",");

	var close = $('#box2View option').map(function() {
	    return this.value;
	}).get().join(",");

	$.post( "/getservice/activedGame", { open: open, close: close })
    .done(function(result) {
    	alert(result);
	});


});
//-->
</script>   