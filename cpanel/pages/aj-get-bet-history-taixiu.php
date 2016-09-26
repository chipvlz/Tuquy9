<?php 

$gameid = str_replace("taixiu", "", str_replace("#", "", strtolower( $_POST["gameid"]) ));
$typemoney = $_POST["typemoney"];

$sql = "SELECT bethistory.username, bonushistory.tien_cuoc, bonushistory.tien_thuong, bonushistory.tien_tra_lai, bonushistory.loai, bonushistory.gameid,bethistory.betmoney, bethistory.bettype, bethistory.time
from bethistory
left join bonushistory on bonushistory.username=bethistory.username and bonushistory.gameid=bethistory.gameid
WHERE LOWER(bethistory.gameid) LIKE 'taixiu#$gameid%' AND bethistory.bettype='$typemoney'";

$rs = mysql_query($sql);

?>

<div class="whead"><h6>Lịch sử ván chơi TaiXiu#<?php echo $gameid?> - Tổng số người chơi: <?php echo mysql_num_rows($rs)?></h6><div class="clear"></div></div>

    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
     <thead>
      <tr>
       <td>Username</td>
       <td>Tiền cược</td>
       <td>Tiền thưởng</td>
       <td>Tiền trả lại</td>
       <td>Loại tiền</td>
       <td>Thời gian cược</td>
      </tr>
     </thead>
     <tbody>
     
    <?php  while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) { ?>

      <tr>
       <td class="center"><?php echo $row['username']?></td>
       <td class="center"><strong><?php echo number_format($row['betmoney'])?></strong></td>
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