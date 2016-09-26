
    <script src="/js/jquery-1.7.2.min.js"></script>
	<script src="/js/jquery.numeric.min.js"></script>
	<link rel="stylesheet" href="/svertaixiu/css/stylesheet.css?v=1.011">		
		
		

    <input name="tx_token" value="<?php echo tokenEncode($_SESSION["username"])?>" type="hidden" />
    <input name="tx_hisbettype" value="virtualmoney" type="hidden" />
    		   
    <div id="popup_gametaixiu">
    	<div class="tx_gamepanel">
            <a href="javascript:;" class="tx_btClose">x</a>
            <div class="tx_bg_btclose"></div>
    		<div class="tx_dice-game">
    			<div class="tx_guide-icon-game"><a href="#"></a></div>
				<div class="tx_use-money">
    				<div class="tx_use-xu"></div>
    				<div class="tx_use-gem"></div>
    			</div>
				<div class="tx_countdown-dice" id="tx_canvas_tai_xiu" style="z-index: 500 ;background: none;"></div>
    			<div class="tx_countdown-dice">
    			</div>
    			<div class="tx_ranked-room" id="tx_sessionid"></div>
    			<div class="tx_annotation"></div>
    			<div class="tx_bet">
    				<div class="tx_bet_option" id="tx_betOver">
    					<span class="tx_user">0</span>
    					<span class="tx_title">Tài</span><!--active-->
    					<span class="tx_totalbet">0</span>
    					<div class="tx_inputbetvalue toogle_value_xu"><input type="text" name="tx_valuebetOver" value="0"/></div>
    					<span class="tx_betvalueofuser">0</span>
    				</div>
    				<div class="tx_bet_option" id="tx_betUnder">
    					<span class="tx_user">0</span>
    					<span class="tx_title">Xỉu</span><!--active-->
    					<span class="tx_totalbet">0</span>
    					<div class="tx_inputbetvalue toogle_value_xu"><input type="text" name="tx_valuebetUnder" value="0"/></div>
    					<span class="tx_betvalueofuser">0</span>
    				</div>
    			</div>
    			<div class="tx_taixiu_guide"></div>
    			<div class="tx_history_statistic">
    				<ul class="tx_list-dice-small">							
    				</ul>
    			</div>
    			<div class="tx_guide-bottom-game">
    				<ul class="tx_list_bottom">
    					<li class="tx_rankings_bottom"><a href="#"></a></li>
    					<li class="tx_history_bottom"><a href="#"></a></li>
    					<li class="tx_help_bottom"><a href="#"></a></li>
    				</ul>
    			</div>
    		</div>
    	</div>
    </div>
    
    		
    	
    <script type="text/javascript" src="/js/phaser.min.js"></script>
    <script src="/svertaixiu/js/taixiu.js"></script>		
	<script src="/svertaixiu/js/functions.js?v1.001"></script>	

	<script type="text/javascript">

	function getTopLevel(type) {
		$.post( "/getpopup/rankingTaixiu/" + Math.random(), {type: type})
        .done(function(data) {
        	$('#idrankingContentTaixiu').html(data);
        	$("#rankingBoxTaixiu").show();
    	})
        .fail(function (result) {
        	alert("Lỗi không thể hiển thị thông tin.");
        });
	}
	
    $("body").on('click', '.tx_btClose', function() {
    	$(this).closest(".draggable").hide();
    });
    
    $("li.tx_help_bottom").click(function() {
    	$("#helpHowtoPlayTaixiu").show();
    });
    
    $("#btGemSessionRanking.txRanking").click(function() {
    	getTopLevel('realmoney');
		$(this).addClass('active');
		console.log('onclick GEM');
		$('#btXuSessionRanking.txRanking').removeClass('active');
    });

    $("li.tx_rankings_bottom, #btXuSessionRanking.txRanking").click(function() {
    	getTopLevel('virtualmoney');
		$(this).addClass('active');
		console.log('onclick XU');
		$('#btGemSessionRanking.txRanking').removeClass('active');
    });

    $("li.tx_history_bottom").click(function() {
        $("#historyBox").show();
    });
    </script>