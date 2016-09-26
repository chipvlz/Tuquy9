<?php 
$userid = $_POST["username"];

$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$sql = "SELECT * FROM addgemhistory WHERE username LIKE '%$userid%' AND time >= $ft AND time <= $tt ORDER BY time DESC";
$rs = mysql_query($sql);
?>
<div class="whead"><h6>Lịch sử nạp GEM</h6><div class="clear"></div></div>
    <div id="dyn" class="hiddenpars">
     <a class="tOptions" title="Options"><img src="images/icons/options" alt="" /></a>
     <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
      <thead>
       <tr>
        <th>STT<span class="sorting" style="display: block;"></span></th>
        <th>Mô tả</th>
        <th>Người cộng</th>
        <th>Ngày cộng</th>
       </tr>
      </thead>
      <tbody>
      <?php 
      $i = 1;
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
      ?>
       <tr>
        <td class="center"><?php echo $i?></td>
        <td class="center"><strong><?php echo $row['username']?></strong> <?php echo $row['description']?></td>
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