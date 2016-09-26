<?php 
$userid = $_POST["username"];

$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$sender = $_POST["sender"]!=""? " AND LIKE '%".$_POST["sender"]."%'" :"";
$account = $_POST["account"]!=""? " AND account = '".$_POST["account"]."'" :"";
$phone = $_POST["phone"]!=""? " AND phone = '".$_POST["phone"]."'" :"";
$email   = $_POST["email"]!=""? " AND email = '".$_POST["email"]."'" :"";
$bank   = $_POST["bank"]!=""? " AND bank = '".$_POST["bank"]."'" :"";

$sql = "SELECT * FROM banking WHERE username LIKE '%$userid%' $sender $account $phone $email $bank AND time >= $ft AND time <= $tt ORDER BY time DESC";
$rs = mysql_query($sql);
?>


<div class="whead"><h6>Thống kê chuyển tiền ngân hàng</h6><div class="clear"></div></div>

    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dTable" id="dynamic">
     <thead>
      <tr>
       <td>UID</td>
       <td>Username</td>
       <td>Kiểu</td>
       <td>Ngày chuyển</td>
       <td>Tên / tk chuyển</td>
       <td>NH nhận</td>
       <td>Số tiền</td>
       <td>Trạng thái</td>
      </tr>
     </thead>
     <tbody>
     <?php 
      while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
          $status = "";
          if ($row["status"] == 0)
              $status = "Sai thông tin";
          else if ($row["status"] == 1)
              $status = "Đợi duyệt";
          else
              $status = "Hoàn thành";
          
          $type = "";
          if ($row["type"] == 0)
              $type = "Nộp tiền";
          else if ($row["status"] == 1)
              $type = "Chuyển tiền";
          else
              $type = "Trả khoản";
      ?>
      <tr>
       <td align="center"><?php echo $row['id']?></td>
       <td align="center"><?php echo $row['username']?></td>
       <td align="center"><?php echo $type?></td>
       <td align="center"><?php echo date("d-m-Y H:i:s",$row['time'])?></td>
       <td align="center"><?php echo $row['account']?></td>
       <td align="center"><?php echo $row['bank']?></td>
       <td align="center"><?php echo number_format($row['amount'])?> đ</td>
       <td align="center"><?php echo $status?></td>
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