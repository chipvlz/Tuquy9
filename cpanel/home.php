<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
 <title>Người dùng - Tuquy9.com</title>

 <link href="/css/styles.css" rel="stylesheet" type="text/css" />
 <!--[if IE]> <link href="/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

 <script type="text/javascript" src="/js/files/jquery.min.1.7.js"></script>

 <script type="text/javascript" src="/js/plugins/forms/ui.spinner.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.mousewheel.js"></script>

 <script type="text/javascript" src="/js/files/jquery-ui.min.1.8.js"></script>

 <script type="text/javascript" src="/js/plugins/charts/excanvas.min.js"></script>
 <script type="text/javascript" src="/js/plugins/charts/jquery.flot.js"></script>
 <script type="text/javascript" src="/js/plugins/charts/jquery.flot.orderBars.js"></script>
 <script type="text/javascript" src="/js/plugins/charts/jquery.flot.pie.js"></script>
 <script type="text/javascript" src="/js/plugins/charts/jquery.flot.resize.js"></script>
 <script type="text/javascript" src="/js/plugins/charts/jquery.sparkline.min.js"></script>

 <script type="text/javascript" src="/js/plugins/tables/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="/js/plugins/tables/jquery.sortable.js"></script>
 <script type="text/javascript" src="/js/plugins/tables/jquery.resizable.js"></script>

 <script type="text/javascript" src="/js/plugins/forms/autogrowtextarea.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.uniform.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.inputlimiter.min.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.tagsinput.min.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.maskedinput.min.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.autotab.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.chosen.min.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.dualListBox.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.cleditor.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.ibutton.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine-en.js"></script>
 <script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine.js"></script>

 <script type="text/javascript" src="/js/plugins/uploader/plupload.js"></script>
 <script type="text/javascript" src="/js/plugins/uploader/plupload.html4.js"></script>
 <script type="text/javascript" src="/js/plugins/uploader/plupload.html5.js"></script>
 <script type="text/javascript" src="/js/plugins/uploader/jquery.plupload.queue.js"></script>

 <script type="text/javascript" src="/js/plugins/wizards/jquery.form.wizard.js"></script>
 <script type="text/javascript" src="/js/plugins/wizards/jquery.validate.js"></script>
 <script type="text/javascript" src="/js/plugins/wizards/jquery.form.js"></script>

 <script type="text/javascript" src="/js/plugins/ui/jquery.collapsible.min.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.breadcrumbs.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.tipsy.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.progress.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.timeentry.min.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.colorpicker.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.jgrowl.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.fancybox.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.fileTree.js"></script>
 <script type="text/javascript" src="/js/plugins/ui/jquery.sourcerer.js"></script>

 <script type="text/javascript" src="/js/plugins/others/jquery.fullcalendar.js"></script>
 <script type="text/javascript" src="/js/plugins/others/jquery.elfinder.js"></script>

 <script type="text/javascript" src="/js/plugins/ui/jquery.easytabs.min.js"></script>
 <script type="text/javascript" src="/js/files/bootstrap.js"></script>
 <script type="text/javascript" src="/js/files/functions.js"></script>

 <script type="text/javascript" src="/js/charts/chart.js"></script>
 
 
 <script type="text/javascript" src="/js/index.js"></script>
 
</head>

<body>

 <!-- Top line begins -->
 <div id="top">
  <div class="wrapper">
   <a href="/" title="" class="logo"><h3>Admin ControlPanel Tuquy9.com</h3></a>

   <!-- Right top nav -->
   <div class="topNav">
    <ul class="userNav">
     <li><a title="Tìm kiếm" class="search tipN"></a></li>
     <li><a href="#" title="Về trang chủ" class="screen tipN"></a></li>
     <li><a href="#" title="Tuỳ chỉnh" class="settings tipN"></a></li>
     <li><a href="#" title="Thoát" class="logout tipN"></a></li>
     <li class="showTabletP"><a href="#" title="" class="sidebar"></a></li>
    </ul>
    <a title="" class="iButton"></a>
    <a title="" class="iTop"></a>
    <div class="topSearch">
     <div class="topDropArrow"></div>
     <form action="">
      <input type="text" placeholder="Tìm kiếm..." name="topSearch" />
      <input type="submit" value="" />
     </form>
    </div>
   </div>

   <!-- Responsive nav -->
 
   <div class="clear"></div>
  </div>
 </div>
 <!-- Top line ends -->


 <!-- Sidebar begins -->
 <div id="sidebar">
  <div class="mainNav">
   <div class="user">
    <a title="" class="leftUserDrop"><img src="/images/user.png" alt="" /><span><strong>3</strong></span></a><span><?php echo $_SESSION['adminuser']?></span>
    <ul class="leftUser">
     <li><a href="#" title="" class="sProfile">Thông tin</a></li>
     <li><a href="#" title="" class="sMessages">Tin nhắn</a></li>
     <li><a href="#" title="" class="sSettings">Tuỳ chỉnh</a></li>
     <li><a href="#" title="" class="sLogout">Thoát</a></li>
    </ul>
   </div>

   <!-- Responsive nav -->
   <div class="altNav">
    <div class="userSearch">
     <form action="">
      <input type="text" placeholder="Tìm kiếm..." name="userSearch" />
      <input type="submit" value="" />
     </form>
    </div>

    <!-- User nav -->
    <ul class="userNav">
     <li><a href="#" title="" class="profile"></a></li>
     <li><a href="#" title="" class="messages"></a></li>
     <li><a href="#" title="" class="settings"></a></li>
     <li><a href="#" title="" class="logout"></a></li>
    </ul>
   </div>

   <!-- Main nav -->
   <ul class="nav">
    <li><a href="/" title=""><span>Dashboard</span></a></li>
    <li><a href="/getpage/qt-user-list" title=""><span>Quản trị người dùng</span></a>
     <ul>
      <li><a href="/getpage/qt-user-list" title="">Tất cả người dùng</a></li>
      <li><a href="/getpage/qt-user-addnew" title="">Tạo người dùng mới</a></li>
      <li><a href="/getpage/qt-user-addCoin" title="">Cộng/trừ/vay/trả tiền</a></li>
      <li><a href="/getpage/qt-user-log-game" title="">Lịch sử chơi game</a></li>
      <li><a href="/getpage/qt-user-log-coin" title="">Lịch sử chuyển tiền / đổi tiền</a></li>
      <li><a href="/getpage/qt-user-log-tcoin" title="">Lịch sử nạp GEM</a></li>
      <li><a href="/getpage/qt-user-log-card" title="">Lịch sử nạp thẻ</a></li>
     </ul>
    </li>
    <li><a href="/getpage/qt-game-list" title=""><span>Quản trị game</span></a>
     <ul>
      <li><a href="/getpage/qt-game-list" title="">Danh sách game</a></li>
      <li><a href="/getpage/qt-game-danhsachphongchoi" title="">Danh sách phòng chơi</a></li>
      <li><a href="/getpage/qt-game-kichnguoichoi" title="">Kích người chơi</a></li>
      <li><a href="/getpage/qt-game-dongmogame" title="">Mở / Đóng game</a></li>
     </ul>
    </li>
    <li><a href="/getpage/qt-news-tintronggame" title=""><span>Quản trị tin tức / Comments</span></a>
      <ul>
       <li><a href="/getpage/qt-news-tintronggame" title="">Tin chạy trong game</a></li>
       
      </ul>
     </li>
     <li><a href="/getpage/qt-tk-napthe" title=""><span>Quản trị thống kê</span></a>
      <ul>
        <li><a href="/getpage/qt-tk-ccu" title="">Thống kê CCU</a></li>
       <li><a href="/getpage/qt-tk-napthe" title="">Thống kê nạp thẻ</a></li>
       <li><a href="/getpage/qt-tk-chuyentiennh" title="">Thống kê chuyển tiền ngân hàng</a></li>
       
      </ul>
     </li>
    <li><a href="/getpage/qt-user-log-game" title=""><span>Tool Tài xỉu</span></a>
     <ul>
      <li><a href="/getpage/qt-user-log-game" title="">Check lịch sử cá nhân</a></li>
      <li><a href="/getpage/qt-session-log-taixiu" title="">Check lịch sử ván chơi</a></li>
      <li><a href="/getpage/tool-taixiu-bhx" title="">BHX</a></li>
      <li><a href="/getpage/qt-user-log-game" title="">Check log</a></li>
      <li><a href="/getpage/qt-autobetgame-taixiu" title="">Cấu hình tự động vào game</a></li>
     </ul>
     </li>
     <li><a href="/getpage/qt-user-log-game" title=""><span>Tool Minipoker</span></a>
     <ul>
      <li><a href="/getpage/qt-user-log-game-minipoker" title="">Check lịch sử cá nhân</a></li>
      <li><a href="/getpage/qt-session-log-taixiu" title="">Quỹ thưởng</a></li>
      <li><a href="/getpage/qt-user-log-game" title="">Check log game</a></li>
      <li><a href="/getpage/qt-autobetgame-minipoker" title="">Ăn gà tự động</a></li>
     </ul>
    </li>
    <li><a href="/getpage/qt-user-log-game" title=""><span>Tool 3 Cây</span></a>
     <ul>
      <li><a href="/getpage/qt-user-log-game" title="">Check lịch sử cá nhân</a></li>
      <li><a href="/getpage/qt-session-log-taixiu" title="">Setup bài</a></li>
     </ul>
    </li>
   </ul>
  </div>

  <!-- Secondary nav -->
  <div class="secNav">
   <div class="secWrapper">

    <div class="divider"><span></span></div>

    <!-- Sidebar datepicker -->
    <div class="sideWidget">
     <div class="inlinedate"></div>
    </div>

    <div class="divider"><span></span></div>

   </div>
   <div class="clear"></div>
  </div>
 </div>
 <!-- Sidebar ends -->

   <!-- Content begins -->
  <div id="content">
  
 <?php 
    $page = $match['params']['page'];
    
    if ($page == "") {
 ?>

   <div class="contentTop">
    <span class="pageTitle"><span class="icon-screen"></span>Dashboard</span>
    <ul class="quickStats">
     <li>
      <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
      <div class="floatR"><strong class="blue">5489</strong><span>visits</span></div>
     </li>
     <li>
      <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
      <div class="floatR"><strong class="blue">4658</strong><span>users</span></div>
     </li>
    </ul>
    <div class="clear"></div>
   </div>

   <!-- Breadcrumbs line -->
   <div class="breadLine">
    <div class="bc">
     <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="#">Dashboard</a></li>
     </ul>
    </div>
   </div>

   <!-- Main content -->
   <div class="wrapper">

    <div class="divider"><span></span></div>

    <!-- Buttons with font icons -->
    <ul class="middleNavA">
        <li><a href="/getpage/qt-tk-ccu" title="Upload files"><span class="iconb" data-icon="&#xe050;"></span><span>Thống kê CCU</span></a></li>
        <li><a href="/getpage/qt-game-dongmogame" title="Messages"><span class="iconb" data-icon="&#xe1c0;"></span><span>Đóng / Mở game</span></a></li>
        <li><a href="/getpage/qt-user-addCoin" title="Messages"><span class="iconb" data-icon="&#xe01b;"></span><span>Cộng / Trừ tiền game</span></a></li>
        <li><a href="/getpage/qt-game-kichnguoichoi" title="Messages"><span class="iconb" data-icon="&#xe0d6;"></span><span>Kích người chơi</span></a></li>
        <li><a href="/getpage/qt-game-taogiaidau" title="Messages"><span class="iconb" data-icon="&#xe1f9;"></span><span>Tạo giải đấu</span></a></li>
        <li><a href="/getpage/qt-news-taobaiviet" title="Messages"><span class="iconb" data-icon="&#xe004;"></span><span>Tạo bài viết mới</span></a></li>
        <li><a href="/getpage/qt-news-tinpopup" title="Messages"><span class="iconb" data-icon="&#xe0cd;"></span><span>Tin Popup</span></a></li>
        <li><a href="/getpage/qt-news-cm-danhsach" title="Add something"><span class="iconb" data-icon="&#xe03b;"></span><span>Comments</span></a><strong>8</strong></li>
        <li><a href="qln-duyet" title="Messages"><span class="iconb" data-icon="&#xe1e1;"></span><span>Danh sách nhóm</span></a></li>
        <!--<li><a href="/getpage/qt-news-taovideo" title="Check statistics"><span class="iconb" data-icon="&#xe009;"></span><span>Tạo Video</span></a></li> -->
<!--         <li><a href="other1" title="Messages"><span class="iconb" data-icon="&#xe1e1;"></span><span>Quản lý User</span></a></li>
        <li><a href="other2" title="Check statistics"><span class="iconb" data-icon="&#xe009;"></span><span>Quản lý T-Coin</span></a></li> -->
    </ul>

    <div class="divider"><span></span></div>

   </div>
   <!-- Main content ends -->

  <?php } else {
    require_once 'pages/'.$page.'.php';
  }?>
  
  </div>
  <!-- Content ends -->
 </body>
 </html>
