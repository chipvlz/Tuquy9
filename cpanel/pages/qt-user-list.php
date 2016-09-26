  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Danh sách người dùng</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Danh sách người dùng</a></li>
     <li class="current"><a href="#" title="">All user</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main">
     <fieldset>
      <div class="widget">
       <div  class="whead hand closed"><h6>Lọc thông tin</h6><div class="clear"></div></div>
       <div class="body">
        <div class="formRow">
         <div class="grid3"><label for="labelfor">User ID:</label></div>
         <div class="grid3"><input type="text" name="labelfor" id="labelfor" /></div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label for="labelfor">User Name:</label></div>
         <div class="grid3"><input type="text" name="labelfor" id="labelfor" /></div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="grid3"><label>Loại:</label></div>
         <div class="grid9">
          <select name="select2" >
           <option value="">Tất cả</option>
           <option value="0">User thường</option>
           <option value="1">Admin</option>
          </select>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow">
         <div class="status"></div>
         <div class="formSubmit">
          <a href="#" class="buttonM bGreen">Tìm kiếm</a>
          <div class="clear"></div>
         </div>
         <div class="clear"></div>
        </div>
       </div>
       <div class="clear"></div>
      </div>
     </fieldset>
    </form>
   </div>

   <a name="listUserGame"></a>
   <div class="widget">
    <div class="whead"><h6>Danh sách người dùng</h6><div class="clear"></div></div>
    <div id="dyn" class="showpars">
     <a class="tOptions" title="Options"><img src="/images/icons/options" alt="" /></a>
     <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
      <thead>
       <tr>
        <th>Username</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Ngày tạo</th>
        <th>Chi tiết</th>
       </tr>
      </thead>
      <tbody>
      <?php 
      $sql = "SELECT * FROM player WHERE isdeleted=0";
      $rs = mysql_query($sql);
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
      ?>
       <tr>
        <td class="center"><?php echo $row["username"]?></td>
        <td class="center"><?php echo $row["fullname"]?></td>
        <td class="center"><?php echo $row["email"]?></td>
        <td class="center"><?php echo $row["createdate"]?></td>
        <td class="tableActs">
         <a href="javascript:;" onclick="loadDetailUser('<?php echo $row["username"]?>')" class="tablectrl_small bDefault tipS" title="Chi tiết"><span class="iconb" data-icon="&#xe1db;"></span></a>
        </td>
       </tr>
       <?php } ?>       
      </tbody>
     </table>
    </div>
   </div>

   <a name="detailUserGame"></a>
   <div class="fluid" id="detailUserGame"></div>

   <div class="fluid" id="frmEditUserGame"></div>

  </div>
  <!-- Main content ends -->
