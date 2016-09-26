<?php 
$userid = $_POST["userid"];

$sql = "SELECT * FROM player WHERE username='".$userid."'";
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
?>

<form id="validate" class="main" method="post" action="">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Thông tin chi tiết về người dùng</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Username:</label></div>
        <div class="grid9"><span><?php echo $row["username"]?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Họ tên:</label></div>
        <div class="grid9"><span><?php echo $row["fullname"]?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Email:</label></div>
        <div class="grid9"><span><?php echo $row["email"]?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Mật khẩu:</label></div>
        <div class="grid9"><span>***********</span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số điện thoại:</label></div>
        <div class="grid9"><span><?php echo $row["phone"]?></span></div>
        <div class="clear"></div>
       </div>       
       <div class="formRow">
        <div class="grid3"><label>Trạng thái nick:</label></div>
        <div class="grid9"><span><?php echo ($row["actived"]?"Actived":"Banned") ?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Ngày tạo nick:</label></div>
        <div class="grid9"><span><?php echo $row["createdate"]?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Avatar:</label></div>
        <div class="grid9"><span><img src="<?php echo ($row["avatar"]!=""?$row["avatar"]:"/images/userLogin.png")?>" width="36" height="36" alt=""></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Lịch sử chơi game:</label></div>
        <div class="grid9"><a href="#">Link</a></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Lịch sử chuyển tiền, đổi tiền:</label></div>
        <div class="grid9"><a href="#">Link</a></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền XU:</label></div>
        <div class="grid9"><img src="/images/icon_money2.png" width="36" height="36" style="float: left;"> <span style="line-height: 40px; padding-left: 10px; font-size: 14px;"> <?php echo number_format($row["virtualmoney"])?></span></div>
        <div class="clear"></div>
       </div>       
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền GEM:</label></div>
        <div class="grid9"><img src="/images/icon_money1.png" width="36" height="36" style="float: left;"> <span style="line-height: 40px; padding-left: 10px; font-size: 14px;"> <?php echo number_format($row["realmoney"])?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Lịch sử nạp GEM:</label></div>
        <div class="grid9"><a href="#">Link</a></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid7">
            <input type="button" value="Sửa thông tin" class="buttonM bGreen" onclick="editUserInfo('<?php echo $row["username"]?>')" /> 
            <input type="button" value="Xoá người dùng" class="buttonM bRed" onclick="deleteUserAccount('<?php echo $row["username"]?>')" />
        </div>
        <div class="clear"></div>
       </div>
      </div>
     </fieldset>
    </form>
    
<?php }?>