<?php 
$gameID  = $_POST['gameID'];
$txSession = $_POST['txSession'];
$id = substr($gameID, strpos($gameID, "#"), strpos($gameID, "-") - strpos($gameID, "#"));
$bettype = $_POST['bettype'];
$next = substr($id, 1) + 1;
$prev = substr($id, 1) - 1 ;

$detail_dice = $_POST['detail_dice'];
$dice = explode(",", $detail_dice);
$desc = 0;
foreach ($dice as $d) {
    $desc += $d;
}


//echo $sql;die;
?>
    <div class="hisContentLeft">
        <div class="titleBoxContent">
            <div class="textTitleContent"><span <?php echo ($txSession == 1 ? 'class="tx_title tx_active"' : '')?> id="titleHeaderTai">Tài</span></div>
        </div>
    </div>
    <div class="hisContentRight">
        <div class="titleBoxContent">
            <div class="textTitleContent"><span <?php echo ($txSession == 2 ? 'class="tx_title tx_active"' : '')?> id="titleHeaderXiu"><img src="/images/text-xiu.png" height="24" style="margin-top: 1px;"></span></div>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="hisContentLeft">
		<table class="hisTabHeader">
			<tr>
				<th style="width: 65px">Thời gian</th>
				<th>Tài khoản</th>
				<th style="width: 94px">Hoàn tiền</th>
				<th style="width: 94px">Cược</th>
			</tr>
		</table>
	</div>
	<div class="hisContentRight">
		<table class="hisTabHeader">
			<tr>
				<th style="width: 65px">Thời gian</th>
				<th>Tài khoản</th>
				<th style="width: 94px">Hoàn tiền</th>
				<th style="width: 94px">Cược</th>
			</tr>
		</table>
	</div>
	<div class="clear"></div>
	
	<div class="scrollbar-inner">
		<div class="hisContentLeft">
	        <table class="hisTabDetail gemHis">
	        <?php 
	        $sql = "SELECT h.username, betmoney, tien_tra_lai, h.time
	        FROM bethistory h
	        LEFT JOIN bonushistory b ON h.gameid = b.gameid AND h.username=b.username
	        WHERE h.gameid = '$gameID' AND gate = 1 AND bettype = '$bettype'";
	        
	        $rs = mysql_query($sql);
	        $sum_tien_tra_lai = 0;
	        $sum_betmoney = 0;
	        while ( $row = mysql_fetch_array($rs)) { ?>
				<tr>
					<td style="width: 65px; text-align: center"><?php echo date("H”i”s", $row['time'])?></td>
					<td><?php echo $row['username']?></td>
					<td style="width: 94px; text-align: right"><?php echo number_format($row['tien_tra_lai'])?></td>
					<td style="width: 94px; text-align: right" class="noborderright"><?php echo number_format($row['betmoney'])?></td>
				</tr>
			<?php $sum_betmoney += $row['betmoney']; $sum_tien_tra_lai += $row['tien_tra_lai']; }?>
			</table>
		</div>
		<div class="hisContentRight">
			<table class="hisTabDetail gemHis">
			<?php 
			$sql = "SELECT h.username, betmoney, tien_tra_lai, h.time
			FROM bethistory h
			LEFT JOIN bonushistory b ON h.gameid = b.gameid AND h.username=b.username
			WHERE h.gameid = '$gameID' AND gate = 2 AND bettype = '$bettype'";
			
			$rs = mysql_query($sql);
			$sum_tien_tra_lai2 = 0;
	        $sum_betmoney2 = 0;
			while ( $row = mysql_fetch_array($rs)) { ?>
				<tr>
					<td style="width: 65px; text-align: center"><?php echo date("H”i”s", $row['time'])?></td>
					<td><?php echo $row['username']?></td>
					<td style="width: 94px; text-align: right"><?php echo number_format($row['tien_tra_lai'])?></td>
					<td style="width: 94px; text-align: right" class="noborderright"><?php echo number_format($row['betmoney'])?></td>
				</tr>
			<?php $sum_betmoney2 += $row['betmoney']; $sum_tien_tra_lai2 += $row['tien_tra_lai']; }?>
			</table>
		</div>
		<div class="clear"></div>
	</div>
	<div class="hisContentLeft coverRadiusBottom" style="border-bottom: 2px solid rgba(255, 255, 255, .05);">
		<div class="hisBottom">
			<div class="hisLbBottom"><div>Tổng</div></div>
			<div class="hisLbSumBetMoney"><?php echo number_format($sum_betmoney)?></div>
			<div class="hisLbSumReturnMoney"><?php echo number_format($sum_tien_tra_lai)?></div>				
			<div class="clear"></div>
		</div>
	</div>
	<div class="hisContentRight coverRadiusBottom" style="border-bottom: 2px solid rgba(255, 255, 255, .05);">
		<div class="hisBottom">
			<div class="hisLbBottom"><div>Tổng</div></div>
			<div class="hisLbSumBetMoney"><?php echo number_format($sum_betmoney2)?></div>
			<div class="hisLbSumReturnMoney"><?php echo number_format($sum_tien_tra_lai2)?></div>			
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	
	<div id="boxFindGame">
		<div class="arrowFindGame" onclick="findTXGame('<?php echo $prev?>')">
			<svg>
				<polygon points="0,8 13,15 13,0" style="fill:#fff;"/>
			</svg>
		</div>
		<div class="gameSession">PHIÊN <label id="gameSessionID"><?php echo $id?></label></div>
		<div class="arrowFindGame" onclick="findTXGame('<?php echo $next?>')">
			<svg>
				<polygon points="0,0  0,15  13,8" style="fill:#fff;"/>
			</svg>
		</div>
		<div class="clear"></div>
		
		<div class="txtInput">
			<input type="text" id="txtSearchTXGame">				
		</div>
		<button type="button" id="cmdSearchTXGame"></button>
		<div class="clear"></div>
	</div>
	<div class="number-of-session"><?php echo $desc?></div>
	<div class="icon-point-session dot1" id="dotIconLeft"></div>
	<div class="icon-point-session dot3" id="dotIconCenter"></div>
	<div class="icon-point-session dot6" id="dotIconRight"></div>
	<div id="btGemSession" class="btnGemHis <?php echo ($bettype=='realmoney'?'active':'')?>"><img src="/images/icon_money1.png"><div><p>GEM</p></div></div>
	<div id="btXuSession" class="btnXuHis <?php echo ($bettype=='virtualmoney'?'active':'')?>"><img src="/images/icon_money2.png"><div><p>XU</p></div></div>
	<div class="clear"></div>
<script>
function findTXGame(current) {
	var li = $("li[id*='" + current + "']");
	li.trigger('click');
	//alert(id);
	
}
$('#cmdSearchTXGame').click(function (){
	var current = $('#txtSearchTXGame').val(); 
	var li = $("li[id*='" + current + "']");
	li.trigger('click');
});
$('#btGemSession').click(function () {
	$('input[name="tx_hisbettype"]').val('realmoney');
	var current = $('#gameSessionID').text();
	var li = $("li[id*='" + current + "']");
	li.trigger('click');
});
$('#btXuSession').click(function () {
	$('input[name="tx_hisbettype"]').val('virtualmoney');
	var current = $('#gameSessionID').text();
	var li = $("li[id*='" + current + "']");
	li.trigger('click');
});

//$('.scrollbar-inner').scrollbar();
</script>