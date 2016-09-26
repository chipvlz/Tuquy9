  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Tạo người dùng mới</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Tạo người dùng</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="frmAddNewUser" class="main" method="post" action="/getservice/addnewuser" enctype="multipart/form-data">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Tạo người dùng mới</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Username:<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" value="" name="username" id="req"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Họ và tên:</label></div>
        <div class="grid4"><input type="text" class="validate[required]" value="" name="fullname" id="req"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Email:<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="" value="" name="email"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Mật khẩu:<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="" value="" name="password"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số điện thoại:</label></div>
        <div class="grid4"><input type="text" class="" value="" name="phone"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền XU:</label></div>
        <div class="grid4"><input type="text" class="" value="500000" name="virtualmoney"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số dư tiền GEM:</label></div>
        <div class="grid4"><input type="text" class="" value="0" name="realmoney"/></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Avatar:</label></div>
        <div class="grid9"><input type="file" class="fileInput" id="fileInput" name="avatar" /><span class="note">File image</span></div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Loại người dùng:</label></div>
        <div class="grid9">
         <div class="dialogSelect m10">
          <select name="isadmin" >
           <option value="0">User thường</option>           
           <option value="1">Admin</option>           
          </select>
          
         </div>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid7">
        	<input type="button" value="Cập nhật" class="buttonM bGreen" onclick="addnewUser($('#frmAddNewUser'))" /> 
        	<input type="button" value="Huỷ" class="buttonM bRed" />
        	<input type="hidden" value="" name="addnewuser" />  
        </div>
        <div class="clear"></div>
       </div>
      </div>
     </fieldset>
    </form>
   </div>

  </div>
  <!-- Main content ends -->
