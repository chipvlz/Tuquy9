jQuery(function ($) {
    console.log('start script');
    //var userId = 'user123456923'; //+ Math.floor((Math.random() * 10000) + 1);
	//var userId = 'WTI5dVkyaHBiWFJ2WHpJd01UWXdOakkwTURjeE56TXo4NjMwYTZhMTgwMGM1YTJiYjM1NzVhODNjZjhhZmI3Ng==';
	var userId = $('input[name="tx_token"]').val();
	//WTI5dVkyaHBiWFJ2WHpJd01UWXdOakkwTURjeE56TXo4NjMwYTZhMTgwMGM1YTJiYjM1NzVhODNjZjhhZmI3Ng==
	//var userId = 'YlhKa2RXNW5Yekl3TVRZd05qSTBNVE0wT0RFejI5ZGMzOTZmMmFjYTVhOWEzYWVmZTYxYmQ0MjNkODk0';
    var tokenken = 'Bearer WTF_Token_GiDay';
    var show_guide;
	var show_guide00;
	var show_guide07;
    var bet_type = 6;
	var check_h = false;
	var check_s = false;
	console.log(userId);

    var socket_taixiu = '';
	
	chenthoigian(-9999);
	try{
		socket_taixiu = io.connect('http://103.15.50.106:9094');//('http://115.84.183.203:9094');//('http://103.15.50.106:9094');

		socket_taixiu.on('connect', function () {
			var jsonObject = {
				"userId": userId,
				"requestType":bet_type
			};
			socket_taixiu.emit('taixiu_game_event', jsonObject);
			//Test
			output('<span class="connect-msg">Client has connected to the server xu!</span>');
		});

		socket_taixiu.on('taixiu_game_event', function (data) {
			/* 
			 Type: 1 -> Counting
			 Type: 2 -> Notification
			 Type: 3 -> Game Start
			 Type: 4 -> Connection Update
			 Type: 5 -> Choose Team Update
			 Type: 6 -> Refresh
			 Type: 7 -> Return Money
			 Type: 8 -> Return Result
			 */
			
			switch(data.type) {
				case 1:
					chenthoigian(data.value);
					
					//Test
					output('<span class="username-msg">' + data.value + '</span> (' + data.message + ')');
					break;
				case 2:
					if(data.betMessage!=null && typeof data.betMessage != undefined && data.betMessage != ''){
						$('.tx_annotation').text(data.betMessage);
						$('.tx_annotation').addClass('tx_floating');
						setTimeout(function () {
							$('.tx_annotation').removeClass('tx_floating');
						}, 2000);
					}
					
					//Test
					console.log(data);
					output('<span class="username-msg">Case2: ' + data.message + '</span>');
					output('<span class="username-msg">Case2 bet: ' + data.betMessage + '</span>');
					break;
				case 3:
					check_s = false;
					var xuOverBetBudget = data.xuTaiBudget, xuUnderBetBudget = data.xuXiuBudget, 
						gemOverBetBudget = data.gemTaiBudget, gemUnderBetBudget = data.gemXiuBudget;
					var ac = $('.bet').find('.title');
					ac.removeClass('active');
					sessionid(data.message);
					returnCounter(bet_type, data.xuTaiCounter, data.xuXiuCounter, data.gemTaiCounter, data.gemXiuCounter);
					returnBudget(bet_type, data.xuTaiBudget, data.xuXiuBudget, xuOverBetBudget, xuUnderBetBudget, 
									data.gemTaiBudget, data.gemXiuBudget, gemOverBetBudget, gemUnderBetBudget);
					statistic(data.statisticResult);
					
					//Test
					output('<span class="username-msg">' + data.message + '</span>');
					// output('<span class="connect-msg"> THỐNG KÊ :' + data.statisticResult + '</span>');
					//console.log('Type 3 - ' + data.statisticResult);
					console.log('Type 3 - ' + data.gemTaiCounter + ' người Xu.--'+data.gemTaiBudget + ' Xu.--'+data.gemXiuCounter + ' người Xu.--'+data.gemXiuBudget + ' Xu.');
					console.log('Type 3 - ' + data.gemTaiCounter + ' người Gem.--'+data.gemTaiBudget + ' Gem.--'+data.gemXiuCounter + ' người Gem.--'+data.gemXiuBudget + ' Gem.');
					break;
				case 4:
				
					//Test
					//output('<span class="username-msg">' + data.message + '</span>');
					document.getElementById('lblConnection').innerHTML = 'Connections : ' + data.connectionCount;
					break;
				case 5:
					var xuOverBetBudget = data.xuTaiBudget, xuUnderBetBudget = data.xuXiuBudget, 
						gemOverBetBudget = data.gemTaiBudget, gemUnderBetBudget = data.gemXiuBudget;
					var optionBet ='';
					var gate__ = 0;
					if(!data.message.localeCompare('T')){
						optionBet ='T';
						gate__ = 1;
					}
					else if(!data.message.localeCompare('X')){
						optionBet ='X';
						gate__ = 2;
					}
					
					if(data.userInfo != null){
						console.log('52: ' + data.userInfo);
						console.log(data.userInfo);
						//var data_w = data.userInfo;
						
						/*returnWithOptionBet(false, bet_type, data_w.xuTaiCounter, data_w.xuXiuCounter, 
								data_w.xuTaiBudget, data_w.xuXiuBudget, data_w.xuBudget, data_w.xuGate, 
								data_w.gemTaiCounter, data_w.gemTaiBudget, data_w.gemXiuCounter, 
								data_w.gemXiuBudget, data_w.gemBudget, data_w.gemGate, '');*/
						returnTotalMBet(bet_type, userId, data.userInfo);
                    }else{
						returnWithOptionBet(false, bet_type, data.xuTaiCounter, data.xuXiuCounter, 
									data.xuTaiBudget, data.xuXiuBudget, 0, gate__, 
									data.gemTaiCounter, data.gemTaiBudget, data.gemXiuCounter, 
									data.gemXiuBudget, 0, gate__, optionBet);
									
						//Test
						console.log('51: '+data);
						console.log(data);
						console.log("Xu: "+data.message + " -> TAI : " + data.xuTaiCounter + ' - XIU : ' + data.xuXiuCounter + ' - TAI BUDGET : ' +  data.xuTaiBudget + 
						' - XIU BUDGET : ' + data.xuXiuBudget);
						console.log("Gem: "+data.message + " -> TAI : " + data.gemTaiCounter + ' - XIU : ' + data.gemXiuCounter + ' - TAI BUDGET : ' +  data.gemTaiBudget + 
						' - XIU BUDGET : ' + data.gemXiuBudget);					
						// else if (data.type == 4)
						// var flag = data.message;
					}
					/*returnWithOptionBet(bet_type, data.xuTaiCounter, data.xuXiuCounter, 
									data.xuTaiBudget, data.xuXiuBudget, xuOverBetBudget, xuUnderBetBudget, 
									data.gemTaiCounter, data.gemTaiBudget, data.gemXiuCounter, 
									data.gemXiuBudget, gemOverBetBudget, gemUnderBetBudget, optionBet);*/
		
					if(!data.message.localeCompare('T')){
						
						//Test
						// console.log('Tai');
						document.getElementById('lblTai').innerHTML = data.xuTaiCounter + ' người';
						document.getElementById('lblTotalMoneyTai').innerHTML = data.xuTaiBudget + ' Xu';
					}
					else if(!data.message.localeCompare('X')){
						
						//Test
						// console.log('Xiu');
						document.getElementById('lblXiu').innerHTML = data.xuXiuCounter + ' người';
						document.getElementById('lblTotalMoneyXiu').innerHTML = data.xuXiuBudget + ' Xu';
					}
					break;
				case 6:
					var serverMessage = data.message;
					var optionBet ='';
					var gate__ = 0;
                    if (!serverMessage) {
                        // is emtpy
                    }else{
						sessionid(serverMessage);
						
						//Test
                        output('<span class="username-msg">' + serverMessage + '</span>');
                    }
					if(data.userInfo != null){
						console.log(data.userInfo);
						//var data_w = data.userInfo;
						
						/*returnWithOptionBet(false, bet_type, data_w.xuTaiCounter, data_w.xuXiuCounter, 
								data_w.xuTaiBudget, data_w.xuXiuBudget, data_w.xuBudget, data_w.xuGate, 
								data_w.gemTaiCounter, data_w.gemTaiBudget, data_w.gemXiuCounter, 
								data_w.gemXiuBudget, data_w.gemBudget, data_w.gemGate, '');*/
						returnTotalMBet(bet_type, userId, data.userInfo);
                    }else{
						returnWithOptionBet(false, bet_type, data.xuTaiCounter, data.xuXiuCounter, 
									data.xuTaiBudget, data.xuXiuBudget, 0, gate__, 
									data.gemTaiCounter, data.gemTaiBudget, data.gemXiuCounter, 
									data.gemXiuBudget, 0, gate__, optionBet);
									
						//Test
						console.log("Xu: "+data.message + " -> TAI : " + data.xuTaiCounter + ' - XIU : ' + data.xuXiuCounter + ' - TAI BUDGET : ' +  data.xuTaiBudget + 
						' - XIU BUDGET : ' + data.xuXiuBudget);
						console.log("Gem: "+data.message + " -> TAI : " + data.gemTaiCounter + ' - XIU : ' + data.gemXiuCounter + ' - TAI BUDGET : ' +  data.gemTaiBudget + 
						' - XIU BUDGET : ' + data.gemXiuBudget);					
						// else if (data.type == 4)
						// var flag = data.message;
					}
					/*var xuOverBetBudget = data.xuTaiBudget, xuUnderBetBudget = data.xuXiuBudget, 
						gemOverBetBudget = data.gemTaiBudget, gemUnderBetBudget = data.gemXiuBudget;
					returnCounter(bet_type, data.xuTaiCounter, data.xuXiuCounter, data.gemTaiCounter, data.gemXiuCounter);
					returnBudget(bet_type, data.xuTaiBudget, data.xuXiuBudget, xuOverBetBudget, xuUnderBetBudget, 
									data.gemTaiBudget, data.gemXiuBudget, gemOverBetBudget, gemUnderBetBudget);*/
					statistic(data.statisticResult);
					
					//Test
                    // output('<span class="connect-msg"> THỐNG KÊ :' + data.statisticResult + '</span>');
                    //console.log('Type 6 - ' + data.statisticResult);
                    //document.getElementById('lblConnection').innerHTML = 'Connections : ' + data.connectionCount;
					//console.log('Type 6 - ' + data.xuTaiCounter + ' người Xu.--'+data.xuTaiBudget + ' Xu.--'+data.xuXiuCounter + ' người Xu.--'+data.xuXiuBudget + ' Xu.');
					//console.log('Type 6 - ' + data.gemTaiCounter + ' người Gem.--'+data.gemTaiBudget + ' Gem.--'+data.gemXiuCounter + ' người Gem.--'+data.gemXiuBudget + ' Gem.');
					break;
				case 7:
					//if(bet_type==6){
						if (data.xuReturnMoney != '0') {
							$('.tx_taixiu_guide').text('+' + numberWithCommas(data.xuReturnMoney)).show();
							setTimeout(function () {
								$('.tx_taixiu_guide').hide();
							}, 5000);
						}

						if (data.xuRewardMoney != '0') {
							setTimeout(function () {
								$('.tx_taixiu_guide').text('+' + numberWithCommas(data.xuRewardMoney)).show();
								setTimeout(function () {
									$('.tx_taixiu_guide').hide();
								}, 5000);
							}, 6000);
						}
					//}else if(bet_type==9){
						if (data.gemReturnMoney != '0') {
							setTimeout(function () {
								$('.tx_taixiu_guide').text('+' + numberWithCommas(data.gemReturnMoney)).show();
								setTimeout(function () {
									$('.tx_taixiu_guide').hide();
								}, 5000);
							}, 9000);
						}

						if (data.gemRewardMoney != '0') {
							setTimeout(function () {
								$('.tx_taixiu_guide').text('+' + numberWithCommas(data.gemRewardMoney)).show();
								setTimeout(function () {
									$('.tx_taixiu_guide').hide();
								}, 5000);
							}, 12000);
						}
					//}
		
					//Test
					output('<span class="send-msg">' + ' (XU) RETURN MONEY : ' + data.xuReturnMoney + ' Xu</span>');
                    output('<span class="connect-msg">' + ' (XU) REWARD MONEY : ' + data.xuRewardMoney + ' Xu</span>');
                    output('<span class="send-msg">' + ' (GEM) RETURN MONEY : ' + data.gemReturnMoney + ' Xu</span>');
                    output('<span class="connect-msg">' + ' (GEM) REWARD MONEY : ' + data.gemRewardMoney + ' Xu</span>');
                    console.log('Xu Return : ' + data.xuReturnMoney + ' , Xu Reward : ' + data.xuRewardMoney + ' , Gem Return : ' + data.gemReturnMoney + ' , Gem Reward : ' + data.gemRewardMoney);
					break;
				case 8:
					chenthoigian(data.value);
					chenso(data.dice1, data.dice2, data.dice3);
					var w_d = 0;
					if (data.winner == '1') {
						w_d = 1;
					} else if (data.winner == '2') {
						w_d = 2;
					}
					activeWinner(data.value, true, w_d, data.statisticResult, data.total);
					
					//Test
					// output('<span class="connect-msg"> THỐNG KÊ :' + data.statisticResult + '</span>');
                    //console.log('Type 8 - ' + data.statisticResult);
					//console.log('--'+data.statisticResult);
                    output('<span class="username-msg"> Case8: ' + data.value + '</span> (' + data.message + ')');
                    output('<span class="send-msg">' + ' RESULT : ' + data.dice1 + ' +' + data.dice2 + '+ ' + data.dice3 
                        + ' = ' + data.total + ' ('  + data.winner  + ')</span>');
					break;
				case 9:
					console.log('SWITCH');
					if(data.userInfo != null){
						console.log(data.userInfo);
						var data_w = data.userInfo;
						console.log("Xu/Gem: "+bet_type);
						returnWithOptionBet(true, bet_type, data_w.xuTaiCounter, data_w.xuXiuCounter, 
									data_w.xuTaiBudget, data_w.xuXiuBudget, data_w.xuBudget, data_w.xuGate, 
									data_w.gemTaiCounter, data_w.gemTaiBudget, data_w.gemXiuCounter, 
									data_w.gemXiuBudget, data_w.gemBudget, data_w.gemGate, '');
					}  
					break;
				default:
					console.log('case default');
			}
		});

		socket_taixiu.on('disconnect', function () {
			output('<span class="tx_disconnect-msg">The client has disconnected on xu!</span>');
			console.log('The client has disconnected on xu!');
		});
	}catch(err){
		console.log(err);
		//sendDisconnect();
	}
    
	$('#tx_gameTaiXiu .pk_btClose').on('click', function () {
        //sendDisconnect();
    });
	
	$('.tx_bet input, .numeric').numeric();
	
    $('.tx_bet input').on('keypress', function (event) {//change focusout
        var n = $(this).attr('name');
        if (event.which == 13) {
            if (n == 'tx_valuebetOver') {
                betOnTai($(this).val());
                $(this).val('');
            }
            if (n == 'tx_valuebetUnder') {
                betOnXiu($(this).val());
                $(this).val('');
            }
        }
    });

    $('.tx_bet input').on('focus', function () {//change focusout
        if ($(this).val() == 0 || $(this).val() == '') {
            $(this).val('');
        }
    });

    $('.tx_bet input').on('focusout', function () {//change focusout
        //if ($(this).val() == 0 || $(this).val() == '') {
            $(this).val(0);
        //}
    });

    $('.tx_use-xu, .tx_use-gem').on('click', function () {
        $('.tx_title.tx_active').removeClass('tx_active');
        $(this).parent().toggleClass('tx_toggle');
		$('.tx_inputbetvalue').toggleClass('toogle_value_xu');
        if ($(this).parent().hasClass('tx_toggle')) {
            bet_type = 9;
        } else {
            bet_type = 6;
        }
		var jsonObject = {"userId": userId, "requestType":9};
		socket_taixiu.emit('taixiu_game_event', jsonObject);
        //statistic();
    });

    function statistic(statisticResult) {
		//data.statisticResult
		//console.log(statisticResult);
		var re = jQuery.parseJSON(statisticResult);
		if (re) {
			var i = 0;
			$('.tx_history_statistic .tx_list-dice-small').empty();
			$.each(re, function (key, value) {
				var ob = $(this);
				if (i < 22) {
					if (i == 0 && ob[0].winner > 0) {
						i = 1;
					}
					if (i > 0) {
						var w = '';
						var ac = '';
						var title = '';
						if (ob[0].winner == 1) {
							w = 'tx_tai';
							title = 'Tài';
						}
						if (ob[0].winner == 2) {
							w = 'tx_xiu';
							title = 'Xỉu';
						}
						if (i == 1) {
							ac = 'tx_bounceactive';
						}
						if (w != '') {
							var pr = '<li class="' + w + '" title="' + title + '">' +
								'<span class="' + ac + '"></span><!--bounceactive-->' +
								'</li>';
							$('.tx_history_statistic .tx_list-dice-small').prepend(pr);
						}
					}
				} else {
					return true;
				}
				i++;
			});
		}

    }

    function activeWinner(c, win_c, w_d, statisticResult, total) {
        if (c <= 2) {
            var ac = $('.tx_bet').find('.tx_title');
            ac.removeClass('tx_active');
			//sendDisconnect();
			
        } else if (c <= 26 && win_c == true) {
            if (w_d == 1) {
                activeWinner($('#tx_betOver .tx_title'));
                $('#tx_betOver .tx_title').addClass('tx_active');
            } else if (w_d == 2) {
                $('#tx_betUnder .tx_title').addClass('tx_active');
            }
			if(c >= 25 && check_s === false){
				check_s = true;
				//console.log('KKKKKKKKKKKKKKKKKKK');
				$('.tx_taixiu_guide').text(total).show();
				if (show_guide != null)
					clearTimeout(show_guide00);
				show_guide00 = setTimeout(function () {
					$('.tx_taixiu_guide').hide();
				}, 4000);
			}
			//sendDisconnect();
			if(check_h == false){
				statistic(statisticResult);
				check_h = true;
			}
        }
		/*if(check_h == false){
			statistic(statisticResult);
			check_h = true;
		}*/
    }

    function sessionid(data_) {
        var d = data_;
        d = d.substring((d.indexOf("#") + 1), (d.indexOf("-")));
        $('#tx_sessionid').text('@' + d);
    }

    //Budget
    function overBetBudget(data_) {
		console.log('Tai: '+data_);
        $('#tx_betOver .tx_betvalueofuser').text(data_);
    }

    function underBetBudget(data_) {
		console.log('Xiu: '+data_);
        $('#tx_betUnder .tx_betvalueofuser').text(data_);
    }
	
	function overTotalBudget(data_) {
        $('#tx_betOver .tx_totalbet').text(data_);
    }

    function underTotalBudget(data_) {
        $('#tx_betUnder .tx_totalbet').text(data_);
    }

    function overCounter(data_) {
        $('#tx_betOver .tx_user').text(data_);
    }

    function underCounter(data_) {
        $('#tx_betUnder .tx_user').text(data_);
    }

    function sendDisconnect() {
        socket_taixiu.disconnect();
    }

    function betOnTai(betMoney) {
		var message = $('#tx_msg').val();
	    $('#tx_msg').val('');
		var jsonObject = {"bet": 1,
			"userId": userId,
			"betMoney": parseInt(betMoney),
			"betType": bet_type};
		console.log(bet_type);
	    socket_taixiu.emit('taixiu_game_event', jsonObject);
    }

    function betOnXiu(betMoney) {
		var message = $('#tx_msg').val();
		$('#tx_msg').val('');
		var jsonObject = {"bet": 2,
			"userId": userId,
			"betMoney": parseInt(betMoney),
			"betType": bet_type};
		console.log(bet_type);
		socket_taixiu.emit('taixiu_game_event', jsonObject);
    }

    function output(message) {
        var currentTime = "<span class='tx_time'>" + moment().format('HH:mm:ss.SSS') + "</span>";
        var element = $("<div>" + currentTime + " " + message + "</div>");
        $('#tx_console').prepend(element);
    }

	 function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(".");
    }
	
    $(document).keydown(function (e) {
        if (e.keyCode == 13) {
            $('#tx_send').click();
        }
    });

	function returnTotalMBet(betMoney, userId, data__){
		console.log('TTTTTTTTTTTTTTTTTTTTT');
		console.log(data__.xuBudget);
		console.log(data__.userId);
		//if(data__.userId == userId){// 
			switch(betMoney) {
				case 6:
					console.log('case xu');
					if(data__.xuGate == 1){
						console.log(data__.xuBudget);
						overBetBudget(numberWithCommas(data__.xuBudget));
					}else if(data__.xuGate == 2){
						underBetBudget(numberWithCommas(data__.xuBudget));
					}
					if(data__.xuBudget >0){
						$('.tx_taixiu_guide').text(numberWithCommas(data__.xuBudget)).show();
						if (show_guide != null){
							clearTimeout(show_guide);
						}	
						show_guide = setTimeout(function () {
							$('.tx_taixiu_guide').hide();
						}, 3000);
					}
					break;
				case 9:
					console.log('case gem');
					if(data__.gemGate == 1){
						overBetBudget(numberWithCommas(data__.gemBudget));
					}else if(data__.gemGate == 2){
						underBetBudget(numberWithCommas(data__.gemBudget));
					}
					if(data__.xuBudget >0){
						$('.tx_taixiu_guide').text(numberWithCommas(data__.gemBudget)).show();
						if (show_guide != null){
							clearTimeout(show_guide);
						}	
						show_guide = setTimeout(function () {
							$('.tx_taixiu_guide').hide();
						}, 3000);
					}
					break;
				default:
					console.log('case default');
			}
		//}
	}
	
	function returnWithOptionBet(ch_,betMoney, xuTaiCounter, xuXiuCounter, 
									xuTaiBudget, xuXiuBudget, xuBudget, xuGate, 
									gemTaiCounter, gemTaiBudget, gemXiuCounter, 
									gemXiuBudget,  gemBudget, gemGate, optionBet){
		switch(betMoney) {
			case 6:
				console.log('case xu'+xuGate);
				if(optionBet==''){
					overCounter(numberWithCommas(xuTaiCounter));
					overTotalBudget(numberWithCommas(xuTaiBudget));
					underCounter(numberWithCommas(xuXiuCounter));
					underTotalBudget(numberWithCommas(xuXiuBudget));
					if(ch_===true){
						if(xuGate==1){
							overBetBudget(numberWithCommas(xuBudget));//
							underBetBudget(numberWithCommas(0));//
						}else if(xuGate==2){
							overBetBudget(numberWithCommas(0));//
							underBetBudget(numberWithCommas(xuBudget));//
						}else if(xuGate==0){
							overBetBudget(numberWithCommas(0));//
							underBetBudget(numberWithCommas(0));
						}
					}
				}else{
					if(optionBet=='T'){
						overCounter(numberWithCommas(xuTaiCounter));
						overTotalBudget(numberWithCommas(xuTaiBudget));
						if(ch_===true){
							overBetBudget(numberWithCommas(xuBudget));
						}
					}else if(optionBet=='X'){
						underCounter(numberWithCommas(xuXiuCounter));
						underTotalBudget(numberWithCommas(xuXiuBudget));
						if(ch_===true){
							underBetBudget(numberWithCommas(xuBudget));
						}
					}
				}
				break;
			case 9:
				console.log('case gem' + gemGate);
				if(optionBet==''){
					overCounter(numberWithCommas(gemTaiCounter));
					overTotalBudget(numberWithCommas(gemTaiBudget));
					//overBetBudget(numberWithCommas(gemOverBetBudget));
					underCounter(numberWithCommas(gemXiuCounter));
					underTotalBudget(numberWithCommas(gemXiuBudget));
					//underBetBudget(numberWithCommas(gemUnderBetBudget));
					if(ch_===true){
						if(gemGate==1){
							overBetBudget(numberWithCommas(gemBudget));//
							underBetBudget(numberWithCommas(0));//
						}else if(gemGate==2){
							overBetBudget(numberWithCommas(0));//
							underBetBudget(numberWithCommas(gemBudget));//
						}else if(gemGate==0){
							overBetBudget(numberWithCommas(0));//
							underBetBudget(numberWithCommas(0));
						}
					}
				}else{
					if(optionBet=='T'){
						overCounter(numberWithCommas(gemTaiCounter));
						overTotalBudget(numberWithCommas(gemTaiBudget));
						if(ch_===true){
							overBetBudget(numberWithCommas(gemBudget));
						}
					}else if(optionBet=='X'){
						underCounter(numberWithCommas(gemXiuCounter));
						underTotalBudget(numberWithCommas(gemXiuBudget));
						if(ch_===true){
							underBetBudget(numberWithCommas(gemBudget));
						}
					}
				}
				break;
			default:
				console.log('case default');
		}
	}
	
	function returnCounter(betMoney, xuTaiCounter, xuXiuCounter, gemTaiCounter, gemXiuCounter){
		switch(betMoney) {
			case 6:
				console.log('case xu');
				overCounter(numberWithCommas(xuTaiCounter));
				underCounter(numberWithCommas(xuXiuCounter));
				break;
			case 9:
				console.log('case gem');
				overCounter(numberWithCommas(gemTaiCounter));
				underCounter(numberWithCommas(gemXiuCounter));
				break;
			default:
				console.log('case default');
		}
	}
	function returnBudget(betMoney, xuTaiBudget, xuXiuBudget, xuOverBetBudget, xuUnderBetBudget, gemTaiBudget, gemXiuBudget, gemOverBetBudget, gemUnderBetBudget){
		switch(betMoney) {
			case 6:
				console.log('case xu');
				overBetBudget(numberWithCommas(xuOverBetBudget));
				underBetBudget(numberWithCommas(xuUnderBetBudget));
				overTotalBudget(numberWithCommas(xuTaiBudget));
				underTotalBudget(numberWithCommas(xuXiuBudget));
				break;
			case 9:
				console.log('case gem');
				overBetBudget(numberWithCommas(gemOverBetBudget));
				underBetBudget(numberWithCommas(gemUnderBetBudget));
				overTotalBudget(numberWithCommas(gemTaiBudget));
				underTotalBudget(numberWithCommas(gemXiuBudget));
				break;
			default:
				console.log('case default');
		}
	}
});