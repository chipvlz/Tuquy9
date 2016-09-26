<?php 
$userid = $_POST["username"];

$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$sql = "SELECT * FROM addmoneyhistory WHERE username LIKE '%$userid%' AND time >= $ft AND time <= $tt ORDER BY time DESC";
$rs = mysql_query($sql);
?>
<div class="whead"><h6>Lịch sử đổi tiền / chuyển tiền</h6><div class="clear"></div></div>
    <div id="dyn" class="hiddenpars">
     <a class="tOptions" title="Options"><img src="images/icons/options" alt="" /></a>
     <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
      <thead>
       <tr>
        <th>STT<span class="sorting" style="display: block;"></span></th>
        <th>UserName</th>
        <th>Loại tiền</th>
        <th>Số tiền</th>
        <th>Thao tác</th>
        <th>Người thực hiện</th>
        <th>Thời gian</th>
       </tr>
      </thead>
      <tbody>
      <?php 
      $i = 1;
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          $action = "";
          if ($row['action']==1)
              $action = 'Cộng tiền';
          else if ($row['action']==2)
              $action = 'Trừ tiền';
          else if ($row['action']==3)
              $action = 'Cho vay';
          else 
              $action = 'Trả nợ';
            
      ?>
       <tr>
        <td class="center"><?php echo $i?></td>
        <td class="center"><?php echo $row['username']?></td>
        <td class="center"><?php echo ($row['type']=='realmoney'?'Tiền GEM':'Tiền XU')?></td>
        <td class="center"><?php echo number_format($row['value'])?></td>
        <td class="center"><?php echo $action?></td>
        <td class="center"><?php echo $row['moder']?></td>
        <td class="center"><?php echo date("d-m-Y H:i:s",$row['time'])?></td>
       </tr>
       <?php $i++; }?>
      </tbody>
     </table>
    </div>
    
<script>
oTable = $('.dTable').dataTable({
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>'
});
</script>