
        <link rel="stylesheet" href="/sverpoker/css/stylesheet.css">
        
        <script src="/sverpoker/js/poker.js"></script>
        <script src="/js/socket.io/socket.io.js"></script>
    	<script src="/sverpoker/js/functions.js"></script>

	
    <input name="pk_token" value="<?php echo tokenEncode($_SESSION["username"])?>" type="hidden" />
    
    <div id="popup_gamepoker">
        <div class="pk_gamepanel">
            <div class="pk_annotation"></div>
            <a href="javascript:;" class="pk_btClose">x</a>
            <div class="pk_bg_btclose"></div>
            
            <div class="pk_slot-game">
                <div class="pk_guide-icon-game"><a href="#"></a></div>
                <div class="pk_hu_game">
                    <span>Gà</span><span id="pk_hu">0</span>
                </div>
                <div class="pk_moneybet">
                    <ul class="pk_choose-money">
                        <li class="pk_money pk_option1 pk_active"><span>100k</span></li>
                        <li class="pk_money pk_option2"><span>1K</span></li>
                        <li class="pk_money pk_option3"><span>10K</span></li>
                    </ul>
                </div>
                <div class="pk_use-money">
                    <div class="pk_use-xu"></div>
                    <div class="pk_use-gem"></div>
                </div>
                <div class="pk_list-slot-machine" id="pk_minipokernamquanbai"></div>
                <div class="pk_control-drive"><img src="/sverpoker/images/minipoker/cangat.png"></div>
                <span class="pk_buttonquay">*</span>
    
                <div class="pk_slot-auto">
                    <div class="pk_squaredThree">
                        <input type="checkbox" value="1" id="pk_slot_auto" name="pk_slot_auto"/>
                        <label for="pk_slot_auto"></label>
                        <span>Tự quay</span>
                    </div>
                </div>
                <div class="pk_guide-bottom-game">
                    <ul class="pk_list_bottom">
                        <li class="pk_rankings_bottom"><a href="#"></a></li>
                        <li class="pk_trathuong_bottom"><a href="#"></a></li>
                        <li class="pk_help_bottom"><a href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    		
    <script type="text/javascript">
    $("body").on('click', '.pk_btClose', function() {
    	$(this).closest(".draggable").hide();
    });

    $("li.pk_help_bottom").click(function() {
        $("#helpHowtoPlayPK").show();
    });
    $("li.pk_rankings_bottom").click(function() {
        $("#rankingBoxPK").show();
    });

    $("li.pk_trathuong_bottom").click(function() {
        $("#quychetrathuongBox").show();
    });
    </script>		
 