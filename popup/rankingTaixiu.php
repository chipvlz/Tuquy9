<table class="hisTabDetail">
    <tbody>
    	<tr class="thead">
    		<td style="width: 144px; text-align: center">Hạng</td>
    		<td style="text-align: center">Tài khoản</td>
    		<td style="width: 273px; text-align: center" class="noborderright">Tiền tươi <p><em>(vnđ)</em></p></td>
    	</tr>
    	<?php 
    	$type = $_POST['type'];
    	$sql = "SELECT * FROM player WHERE isdeleted = 0 && actived = 1 order by $type desc limit 10";
    	$rs = mysql_query($sql); 
    	$i = 1;
    	while ( $row = mysql_fetch_array($rs)) {
    	?>
    	<tr>
    		<td style="text-align: center"><?php echo $i?> q</td>
    		<td style="text-align: center"><?php echo $row['username']?></td>
    		<td style="width: 273px; text-align: center" class="noborderright"><?php echo number_format($row[$type])?></td>
    	</tr>
    	<?php  $i++; } ?>
    </tbody>
</table>
