<?php 
$userid = $_POST["username"];

$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$vvendor = $_POST["vendor"]!=""? " AND vendor = '".$_POST["vendor"]."'" :"";
$vstatus = $_POST["status"]!=""? " AND status = '".$_POST["status"]."'" :"";
$vcardid = $_POST["cardid"]!=""? " AND cardid LIKE '%".$_POST["cardid"]."%'" :"";
$vseri   = $_POST["seri"]!=""? " AND seri LIKE '%".$_POST["seri"]."%'" :"";

$sql = "SELECT * FROM addcardhistory WHERE username LIKE '%$userid%' $vvendor $vstatus $vcardid $vseri AND time >= $ft AND time <= $tt ORDER BY time DESC";
$rs = mysql_query($sql);
?>

<div class="whead"><h6>Thống kê nạp thẻ</h6><div class="clear"></div></div>

     <table cellpadding="0" cellspacing="0" border="0" width="100%"  class="dTable" id="dynamic">
      <thead>
       <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Vendor</td>
        <td>Card ID</td>
        <td>Seri</td>
        <td>Amount</td>
        <td>Status</td>
        <td>User</td>
        <td>IP</td>
       </tr>
      </thead>
      <tbody>
      <?php 
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          $status = "";
          if ($row["status"] == 0) 
              $status = "Chưa sử dụng";
          else if ($row["status"] == 1) 
              $status = "Chưa chuyển GEM";
          else 
              $status = "Hoàn thành";
      ?>
       <tr>
        <td align="center"><?php echo $row["id"]?></td>
        <td align="center"><?php echo date("d-m-Y H:i:s",$row["time"])?></td>
        <td align="center"><?php echo $row["vendor"]?></td>
        <td align="center"><?php echo $row["cardid"]?></td>
        <td align="center"><?php echo $row["seri"]?></td>
        <td align="center"><?php echo $row["amount"]?></td>
        <td align="center"><?php echo $status?></td>
        <td align="center"><?php echo $row["username"]?></td>
        <td align="center"><?php echo $row["ip"]?></td>
       </tr>
       <?php }?>
       
      </tbody>
     </table>
<script>
oTable = $('.dTable').dataTable({
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>'
});
</script>