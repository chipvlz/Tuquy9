<?php 
$userid = $_POST["userid"];

$sql = "SELECT * FROM player WHERE username='".$userid."'";
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
?>

<form id="frmUpdateUserAccount" class="main" method="post" action="/getservice/updateuser" enctype="multipart/form-data">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Sửa thông tin người dùng</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Username:</label></div>
        <div class="grid9"><span><?php echo $row["username"]?></span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Họ và tên:</label></div>
        <div class="grid4"><input type="text" class="validate[required]" value="<?php echo $row["fullname"]?>" name="fullname" id="fullname"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Email:</label></div>
        <div class="grid4"><input type="text" class="" value="<?php echo $row["email"]?>" name="email"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Mật khẩu:</label></div>
        <div class="grid4"><input type="text" class="" value="" name="password"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số điện thoại:</label></div>
        <div class="grid4"><input type="text" class="" value="<?php echo $row["phone"]?>" name="phone"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Trạng thái nick:</label></div>
        <div class="grid9">
         <input type="radio" id="radio1" name="actived" value="1" <?php echo ($row["actived"]?'checked="checked"':'')?> /><label for="radio1"  class="mr20">Actived</label>
         <input type="radio" id="radio2" name="actived" value="0" <?php echo ($row["actived"]?'':'checked="checked"')?> /><label for="radio2"  class="mr20">Banned</label>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Ngày tạo nick:</label></div>
        <div class="grid9"><span><?php echo $row["createdate"]?></span></div>
        <div class="clear"></div>
       </div>       
       <div class="formRow">
        <div class="grid3"><label>Avatar:</label></div>
        <div class="grid9"><input type="file" class="fileInput" id="fileInput" name="avatar" /><span class="note">File Image</span></div>
        <div class="clear"></div>
       </div>       
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền XU:</label></div>
        <div class="grid4"><input type="text" class="" value="<?php echo $row["virtualmoney"]?>" name="virtualmoney"/></div>
        <div class="clear"></div>
       </div>       
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền GEM:</label></div>
        <div class="grid4"><input type="text" class="" value="<?php echo $row["realmoney"]?>" name="realmoney"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Loại người dùng:</label></div>
        <div class="grid9">
         <div class="dialogSelect m10">
          <select name="isadmin" >
           <option value="0" <?php echo ($row["isadmin"]?'':'selected="selected"')?> >User thường</option>
           <option value="1" <?php echo ($row["isadmin"]?'selected="selected"':'')?> >Admin</option>
          </select>
          <span class="note">Chỉ admin nhìn thấy</span>
         </div>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid7">
            <input type="hidden" name="username" value="<?php echo $row["username"]?>" />
            <input type="button" value="Cập nhật" class="buttonM bGreen" onclick="$('#frmUpdateUserAccount').submit()"/> 
            <input type="button" value="Huỷ" class="buttonM bRed" onclick="cancelEditUser()" /> 
            <input type="button" value="Xoá người dùng" class="buttonM bRed" onclick="deleteUserAccount('<?php echo $row["username"]?>')"/></div>
        <div class="clear"></div>
       </div>
      </div>
     </fieldset>
    </form>
    
    <script>
    $("select[name='isadmin'], input[name='actived'], input#fileInput").uniform();
    
    $( "#frmUpdateUserAccount" ).submit(function( event ) {
    	$.ajax({
            url: "/getservice/updateuser",
            type: "POST",
            data: $("#frmUpdateUserAccount").serialize(),
            success: function (result) {
            	alert(result);
            	window.location.href = "/getpage/qt-user-list";
            },
            error: function (result) {
                alert("Lỗi???\n" + result);
            }
        });
        event.preventDefault();
  	});
    </script>
    
<?php }?>