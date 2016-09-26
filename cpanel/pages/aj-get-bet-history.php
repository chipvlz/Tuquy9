<?php 
$userid = $_POST["username"];
$gameid = $_POST["gameid"];
$fromdate = $_POST["fromDate"];
$todate = $_POST["toDate"];

$f = explode ("/", $fromdate);
$t = explode ("/", $todate);

$ft = strtotime($f[2]."-".$f[0]."-".$f[1]);
$tt = strtotime($t[2]."-".$t[0]."-".$t[1]);

$gameName = "";
if ($gameid == 'minipoker' ) {
    $gameName = "Mini Poker";
    
    $sql = "SELECT bethistory.username, bonushistory.tien_cuoc, remainmoney, bonushistory.tien_thuong, bonushistory.tien_tra_lai, bonushistory.loai, bonushistory.gameid,bethistory.betmoney, bethistory.bettype, bethistory.time
    from bethistory
    left join bonushistory on bonushistory.username=bethistory.username and bonushistory.gameid=bethistory.gameid and bonushistory.time=bethistory.time
    WHERE bethistory.username = '$userid' AND LOWER(bethistory.gameid) LIKE '%$gameid%' AND bethistory.time >= $ft AND bethistory.time <= $tt";
    
} else if ($gameid == 'taixiu' ) {
    $gameName = "Tài xỉu";
    
    $sql = "SELECT bethistory.username, bonushistory.tien_cuoc, remainmoney, bonushistory.tien_thuong, bonushistory.tien_tra_lai, bonushistory.loai, bonushistory.gameid,bethistory.betmoney, bethistory.bettype, bethistory.time
    from bethistory
    left join bonushistory on bonushistory.username=bethistory.username and bonushistory.gameid=bethistory.gameid
    WHERE bethistory.username = '$userid' AND LOWER(bethistory.gameid) LIKE '%$gameid%' AND bethistory.time >= $ft AND bethistory.time <= $tt";

}else if ($gameid == '3caychuong' )
    $gameName = "3 cây chương";

$rs = mysql_query($sql);
?>

<div class="whead"><h6>Lịch sử ván đánh game <?php echo $gameName?></h6><div class="clear"></div></div>

    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
     <thead>
      <tr>
       <td>Username</td>
       <td>Tiền cược</td>
       <td>Tiền còn lại</td>
       <td>Tiền thưởng</td>
       <td>Tiền trả lại</td>
       <td>Loại tiền</td>
       <td>Thời gian cược</td>
      </tr>
     </thead>
     <tbody>
     
    <?php while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) { ?>

      <tr>
       <td class="center"><?php echo $row['username']?></td>
       <td class="center"><strong><?php echo number_format($row['betmoney'])?></strong></td>
       <td class="center"><strong><?php echo number_format($row['remainmoney'])?></strong></td>
       <td class="center"><strong><?php echo number_format($row['tien_thuong'])?></strong></td>
       <td class="center"><strong><?php echo number_format($row['tien_tra_lai'])?></strong></td>
       <td class="center"><?php echo ($row['bettype'] == 'virtualmoney'?'Tiền XU':'Tiền GEM')?></td>
       <td class="center"><?php echo date("d-m-Y H:i:s", $row['time'])?></td>
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