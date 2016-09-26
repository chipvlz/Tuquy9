
   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Thống kê CCU</span>
   </div>

   <!-- Breadcrumbs line -->
   <div class="breadLine">
    <div class="bc">
     <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Thống kê</a>
       <ul>
        <li><a href="tk-log" title="">Xem Log</a></li>
       </ul>
      </li>
      <li class="current"><a href="#" title="">Thống kê CCU</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="fluid">
     <form id="validate" class="main" method="post" action="">
      <fieldset>
       <div class="widget">
        <div class="whead"><h6>Xem thống kê CCU</h6><div class="clear"></div></div>
        <div class="formRow">
         <div class="grid3"><label>Ngày:</label></div>
         <div class="grid9">
          <ul class="datesRange">
           <li><input type="text" id="fromDate" name="from" placeholder="Từ ngày"/></li>
           <li class="sep">-</li>
           <li><input type="text" id="toDate" name="to" placeholder="Đến ngày"/></li>
          </ul>
         </div>
         <div class="clear"></div>
        </div>
        <div class="formRow"><input type="button" value="Thực hiện" class="buttonM bGreen" /><div class="clear"></div></div>
        <div class="clear"></div>
       </div>
      </fieldset>
     </form>
    </div>

    <!-- Chart -->
    <div class="widget chartWrapper">
     <div class="whead"><h6>Thống kê tài khoản đăng ký đăng nhập</h6>
      <div class="titleOpt">
       <a href="#" data-toggle="dropdown"><span class="icos-cog3"></span><span class="clear"></span></a>
       <ul class="dropdown-menu pull-right">
        <li><a href="#"><span class="icos-add"></span>Add</a></li>
        <li><a href="#"><span class="icos-trash"></span>Remove</a></li>
        <li><a href="#" class="">Edit</a></li>
        <li><a href="#" class=""><span class="icos-heart"></span>Do whatever you like</a></li>
       </ul>
      </div>
      <div class="clear"></div>
     </div>
     <div class="body"><div class="chart" style="z-index: 1;"></div></div>
    </div>

   </div>
   <!-- Main content ends -->
