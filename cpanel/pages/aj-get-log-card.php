<?php 
$userid = $_POST["username"];

$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$sql = "SELECT * FROM addcardhistory WHERE username LIKE '%$userid%' AND time >= $ft AND time <= $tt ORDER BY time DESC";
$rs = mysql_query($sql);
?>
<div class="whead"><h6>Lịch sử nạp thẻ</h6><div class="clear"></div></div>
    <div id="dyn" class="hiddenpars">
     <a class="tOptions" title="Options"><img src="images/icons/options" alt="" /></a>
     <table id="exampleCard" class="dTable" cellspacing="0" width="100%">
      <thead>
       <tr>
        <th>Thời gian </th>
        <th>UserName</th>
        <th>Mã thẻ</th>
        <th>Số serial</th>
        <th>Nhà mạng</th>
        <th>Giá trị</th>
        <th>IP</th>
        <th>Trạng thái</th>
        <th>Mô tả</th>
       </tr>
      </thead>
      <tbody>
      <?php 
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
      ?>
       <tr>
        <td class="center"><?php echo date("d-m-Y H:i:s",$row['time'])?></td>
        <td class="center"><strong><?php echo $row['username']?></strong></td>
        <td class="center"><?php echo $row['cardid']?></td>
        <td class="center"><?php echo $row['seri']?></td>
        <td class="center"><?php echo $row['vendor']?></td>
        <td class="center"><?php echo number_format($row['amount'])?></td>
        <td class="center"><?php echo $row['ip']?></td>
        <td class="center"><?php echo ($row['status'] == 0 ? "Lỗi" : "OK")?></td>
        <td><?php echo $row['description']?></td>
       </tr>
       <?php }?>
      </tbody>
     </table>
    </div>
    
<script>
$('#exampleCard').DataTable( {
    "order": [[ 0, "desc" ]],
    "sPaginationType": "full_numbers",
    "bJQueryUI": false,
    "bAutoWidth": false,
    "sDom": '<"H"fl>t<"F"ip>'
} );
// oTable = $('.dTable').dataTable({
// 	"bJQueryUI": false,
// 	"bAutoWidth": false,
// 	"order": [[ 0, "esc" ]],
// 	"sPaginationType": "full_numbers",
// 	"sDom": '<"H"fl>t<"F"ip>'
// });
</script>