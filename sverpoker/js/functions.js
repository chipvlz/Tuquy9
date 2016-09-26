jQuery(function ($) {
    //rotation
	var userId = $('input[name="pk_token"]').val(); //'user' + Math.floor((Math.random() * 10000) + 1);
    var pull_trigger_time = 500;
    var show_result_time = 2000;
    var card0, card1, card2, card3, card4,
        reward, can, money, turn, game_start = {};
    var betType = 6, hangTien = 1;
    //var ip = '103.15.50.106:9090';
	var ip = 'localhost:9999';
	var path__ = 'minipoker-0.0.1-SNAPSHOT/minipoker';
    //var ip = '127.0.0.1:8080';
    var tieptucquay;
    var vong_lap_tu_dong;
	var check_tdq = false;
	var delayTime;
	$(document).ready(function () {
        tieptucquay = true;
        game_start = {};
        game_start.autoPlay = false;
		game_start.pk_optionap = '';
		setOnClickSpinSet(3000);
    });
	try {
		var pk_socket = io.connect('http://115.84.183.203:9294');
		//var pk_socket = io.connect('http://103.15.50.106:9294');
		//var pk_socket = io.connect('http://115.84.183.203:9294');//('http://localhost:9294');
		pk_socket.on('connect', function () {
			var jsonObject = {
				"userId": userId,
				"requestType": 50
			};
			pk_socket.emit('poker_event', jsonObject);
		});
		pk_socket.on('poker_event', function (data) {
			/*  Type: 1 -> Counting
				Type: 2 -> Notification
				Type: 3 -> Connect
				Type: 4 -> Quay tay Now  - AUTO PLAY : 0 -> FALSE , 1 -> TRUE
				Type: 5 -> Cancel Quay tay
				Type: 6 -> Draw money form jar
			*/

			var hu = $('#pk_hu');

			switch (data.type) {
				case 1:
					//console.log('Case 1');
					break;
				case 2:
					//console.log(data);
					//console.log('Case 2');
					setvaluehu_(data);
					//console.log(data);
					break;
				case 3:
					console.log('Case 3');
					layThongTinKhoiDongGame(true, data);
					//starGame(true, data);
					break;
				case 4:
					console.log('Case 4');
					console.log(data);
					var ketqua = '';
					if (data.spinResult != null && typeof data.spinResult != undefined && data.spinResult != '' && data.spinResult != 'unvalid') {
						ketqua = jQuery.parseJSON(data.spinResult);
						if (data.delay != delayTime) {
							delayTime = data.delay;
							setOnClickSpinSet(delayTime);
						}
					}
                    if (ketqua) {
						//console.log(data.spinRequest.autoPlay);						
						if (!ketqua.card0) {
							reward = ketqua.reward;
							setTimeout(truyenthamsovao(), ketqua.delay * 1000 - pull_trigger_time);
							setTimeout(hienketqua(), ketqua.delay * 1000 - pull_trigger_time);
							break;
						}
						card0 = layvitriquanbai(ketqua.card0);
						card1 = layvitriquanbai(ketqua.card1);
						card2 = layvitriquanbai(ketqua.card2);
						card3 = layvitriquanbai(ketqua.card3);
						card4 = layvitriquanbai(ketqua.card4);
						game_start.delay = ketqua.delay;
						reward = ketqua.reward;
						can = ketqua.can;
						money = ketqua.money;
						turn = ketqua.turn;
						game_start.autoPlay = data.spinRequest.autoPlay;
						setTimeout(truyenthamsovao(), ketqua.delay * 1000 - pull_trigger_time);
						setTimeout(hienketqua(), ketqua.delay * 1000 - pull_trigger_time);
						if (game_start.autoPlay == true) {
							//goiHamQuayTuDong();
							/*if(check_tdq==false){
								//goiHamQuayTuDong();
								check_tdq==true;
								clearInterval(vong_lap_tu_dong);
							}else{
								vong_lap_tu_dong = setInterval(goiHamQuayTuDong, ketqua.delay * 1000);
							}
							//goiHamQuayTuDong(game_start.pk_optionap);
							//vong_lap_tu_dong = setInterval(function(){ goiHamQuayTuDong('')}, ketqua.delay * 1800);*/
							if (check_tdq == false) {
								check_tdq == true;
								//clearInterval(vong_lap_tu_dong);
							}
							vong_lap_tu_dong = setInterval(function () { goiHamQuayTuDong('') }, ketqua.delay + 2000);
						} else {
							//game_start.pk_optionap = '';
							//goiHamQuayTuDong(game_start.pk_optionap);
							//clearInterval(vong_lap_tu_dong);
						}
                    }
					break;
				case 5:
					console.log('Case 5');
					console.log(data);
					if (data.spinRequest.autoPlay == false) {
						game_start.pk_optionap = '';
						//goiHamQuayTuDong(game_start.pk_optionap);
						clearInterval(vong_lap_tu_dong);
					}
					break;
				case 6:
					console.log('Case 6');
					break;
				default:
					console.log('case default');
			}
		});
		pk_socket.on('disconnect', function () {

		});
	} catch (err) {
		console.log(err);
		//sendDisconnect();
	}
	/*-----------------*/
	$('.pk_use-xu, .pk_use-gem').on('click', function () {
		console.log(game_start);
        if (tieptucquay && game_start.autoPlay == false) {
            $(this).parent().toggleClass('pk_toggle');
			$('.pk_gamepanel').toggleClass('fixsize_toggle');
            if ($(this).parent().hasClass('pk_toggle')) {
                //GEM
                betType = 9;
                $('.pk_money.pk_option1 span').text(game_start.betLimit.gemBetLimit1);
                $('.pk_money.pk_option2 span').text(game_start.betLimit.gemBetLimit2);
                $('.pk_money.pk_option3 span').text(game_start.betLimit.gemBetLimit3);
            } else {
                //XU
                betType = 6;
                $('.pk_money.pk_option1 span').text(game_start.betLimit.xuBetLimit1);
                $('.pk_money.pk_option2 span').text(game_start.betLimit.xuBetLimit2);
                $('.pk_money.pk_option3 span').text(game_start.betLimit.xuBetLimit3);
            }
        }
    });

	$('#pk_slot_auto').change(function () {
        if ($(this).is(":checked")) {
			var betTien = $('.pk_money.pk_active span').text();
			//setAutoPlay(betTien, betType);
			game_start.pk_optionap = '';//'auto';
			goiHamQuayTuDong('auto');
			console.log('t1');
			toggleSpinable(false);
			$(this).prop("disabled", true);
			setTimeout(function () {
				$('#pk_slot_auto').prop("disabled", false);
			}, 3000);
        } else {
			game_start.pk_optionap = '';
			clearInterval(vong_lap_tu_dong);
            cancelAutoPlay();
			console.log('t2');
			setTimeout(toggleSpinable(true), 3000);
        }
		console.log(game_start.pk_optionap);
    });

	$('.pk_money').on('click', function () {
		//console.log(tieptucquay);
        if (tieptucquay && game_start.autoPlay == false) {
            $('.pk_choose-money').find('.pk_active').removeClass('pk_active');
            $(this).toggleClass('pk_active');
            if ($(this).hasClass('pk_option1')) {
                hangTien = 1;
            } else if ($(this).hasClass('pk_option2')) {
                hangTien = 2;
            } else if ($(this).hasClass('pk_option3')) {
                hangTien = 3;
            }
        }
    });

	function setOnClickSpinSet(delaySpinnable) {
		$('.pk_buttonquay, .pk_control-drive img').on('click', function () {
			toggleSpinable(false);
			$('#pk_slot_auto').prop("disabled", true);
			$('.pk_buttonquay').css('z-index', 199);
			goiHamQuayTuDong('');
			setTimeout(function () {
				$('.pk_buttonquay').css('z-index', 399);
			}, 2000);
			setTimeout(function () {
				toggleSpinable(true);
			}, delaySpinnable);
			setTimeout(function () {
				$('#pk_slot_auto').prop("disabled", false);
			}, delaySpinnable);
		});
	}

	$('#pk_gameMiniPoker .pk_btClose').on('click', function () {
        pkSenDisconected();
    });

	function toggleSpinable(spinable) {
		if (!spinable) {
			$('.pk_buttonquay, .pk_control-drive img').css('pointer-events', 'none');
		} else {
			$('.pk_buttonquay, .pk_control-drive img').css('pointer-events', '');
		}
	}
	/*-----------------*/
	function goiHamQuayTuDong(options_) {
        if (tieptucquay == true) {
            tieptucquay = false;
			tienhanhquay(options_);
        }
    }

	function pkSenDisconected() {
        /*pk_socket.disconnect();
        $.ajax({
            type: 'GET',
            dataType: 'text',
            url: 'http://' + ip + '/'+path__+'/disconnectGame?userid=abc'
        });*/

    }

	function layvitriquanbai(vitri) {
        var nham = vitri.split('_');
        return parseInt(nham[1] * 13) + parseInt(nham[0]);
    }
	function truyenthamsovao() {
        dunglai(true, card0, card1, card2, card3, card4);
        $('#pk_hu').text(numberWithCommas(Math.round(can)));
    }

	function quay() {
        $('.pk_control-drive').addClass('pk_rotation');
        $(this).css('z-index', 206);
        dunglai(false);
    }

    function dungQuay() {
        $('.pk_control-drive').removeClass('pk_rotation');
    }

	function tienhanhquay(options_) {
        var betTien = $('.pk_money.pk_active span').text();
        var name = 'abc';
        quay();
        setTimeout(dungQuay, pull_trigger_time);
		if (options_ == 'auto') {
			setAutoPlay(betTien, betType);
			console.log('B1 auto');
		} else {
			getBet(betTien, betType);
			console.log('B2');
		}
    }
	function getBet(betAmount, type) {
		var jsonObject = {
			"userId": userId,
			"betAmount": betAmount,
			"type": type,
			"autoPlay": false,
			"requestType": 60
		};
		pk_socket.emit('poker_event', jsonObject);
	}
	function setAutoPlay(betAmount, type) {
		var jsonObject = {
			"userId": userId,
			"betAmount": betAmount,
			"type": type,
			"autoPlay": true,
			"requestType": 70
		};
		pk_socket.emit('poker_event', jsonObject);
	}

	function cancelAutoPlay() {
		clearInterval(vong_lap_tu_dong);
		//game_start.autoPlay = false;
		var jsonObject = {
			"userId": userId,
			"requestType": 80
		};
		pk_socket.emit('poker_event', jsonObject);
	}
	//set value for hu
	function setvaluehu_(data) {
		//console.log(data);
		var hu = $('#pk_hu');
        if (betType == 6) {
            switch (hangTien) {
                case 1:
                    hu.text(numberWithCommas(Math.round(data.xu1Jar)));
                    break;
                case 2:
                    hu.text(numberWithCommas(Math.round(data.xu2Jar)));
                    break;
                case 3:
                    hu.text(numberWithCommas(Math.round(data.xu3Jar)));
                    break;
            }
        } else if (betType == 9) {
            switch (hangTien) {
                case 1:
                    hu.text(numberWithCommas(Math.round(data.gem1Jar)));
                    break;
                case 2:
                    hu.text(numberWithCommas(Math.round(data.gem2Jar)));
                    break;
                case 3:
                    hu.text(numberWithCommas(Math.round(data.gem3Jar)));
                    break;
            }
        }
	}
	//get info start game
	function layThongTinKhoiDongGame(isLanDau, data) {
		console.log(data);
		if (data != null && typeof data != undefined && data != '') {
			game_start = data.spinRequest;
			game_start.betLimit = data.betLimit;
			if (isLanDau) {
				var ketqua = '';
				if (data.spinResult != null && typeof data.spinResult != undefined && data.spinResult != '' && data.spinResult != 'unvalid') {
					ketqua = jQuery.parseJSON(data.spinResult);
					delayTime = ketqua.delay;
					setOnClickSpinSet(delayTime);
				}
				if (game_start.autoPlay == true && ketqua) {
					setchecked(true);
					card0 = layvitriquanbai(ketqua.card0);
					card1 = layvitriquanbai(ketqua.card1);
					card2 = layvitriquanbai(ketqua.card2);
					card3 = layvitriquanbai(ketqua.card3);
					card4 = layvitriquanbai(ketqua.card4);
					game_start.delay = ketqua.delay;
					reward = ketqua.reward;
					can = ketqua.can;
					money = ketqua.money;
					turn = ketqua.turn;
					setTimeout(truyenthamsovao(), ketqua.delay * 1000 - pull_trigger_time);
					setTimeout(hienketqua(), ketqua.delay * 1000 - pull_trigger_time);
					vong_lap_tu_dong = setInterval(function () { goiHamQuayTuDong('') }, ketqua.delay * 1000);
				} else {
					dunglai(true, 5, 6, 7, 8, 9);
					game_start.autoPlay = false;
					cancelAutoPlay();
					setchecked(false);
				}
				caidatgiatrimacdinh(data);
				tieptucquay = true;
			} else {

			}
		} else {
			reward = 'Lỗi Kết Nối';
            hienketqua();
		}
    }
	//set auto play
	function setchecked(checked) {
        if (checked) {
            $('#pk_slot_auto').prop('checked', true);
        } else {
            $('#pk_slot_auto').prop('checked', false);
        }
    }
	//show result
	function hienketqua() {
        //reward = 'Tứ Quý';
        tieptucquay = true;
        var anno = $('.pk_annotation');
        if (reward != null && typeof reward != undefined) {
            anno.text(reward);
            switch (reward) {
                case 'Thùng phá sảnh j':
                    anno.addClass('pk_option1');
                    break;
                case 'Thùng phá sảnh':
                    anno.addClass('pk_option2');
                    break;
                case 'Tứ quý':
                    anno.addClass('pk_option3');
                    break;
                case 'Cù lũ':
                    anno.addClass('pk_option4');
                    break;
                case 'Thùng':
                    anno.addClass('pk_option5');
                    break;
                case 'Sảnh':
                    anno.addClass('pk_option6');
                    break;
                case 'Sám':
                    anno.addClass('pk_option7');
                    break;
                case 'Hai đôi':
                    anno.addClass('pk_option8');
                    break;
                case 'Đôi j trở lên':
                    anno.addClass('pk_option9');
                    break;
                case 'Dưới đôi j':
                    anno.addClass('pk_option10');
                    break;
                case 'Tiền thưởng không hợp lệ':
                    anno.addClass('pk_option12');
                    cancelAutoPlay();
                    dunglai(true, 5, 6, 7, 8, 9);
                    setchecked(false);
                    break;
            }
        } else {
            reward = 'Lỗi';
            dunglai(true, 5, 6, 7, 8, 9);
            anno.addClass('pk_option11');
        }
        anno.addClass('pk_floating');
        setTimeout(function () {
            anno.removeClass('pk_floating');
            anno[0].className = anno[0].className.replace(/\boption.*?\b/g, '');
        }, show_result_time);
    }
	//setup default value
	function caidatgiatrimacdinh(data) {
        if (data.spinRequest.autoPlay == true) {

        } else {
            $('.pk_money.pk_option1 span').text(data.betLimit.xuBetLimit1);
            $('.pk_money.pk_option2 span').text(data.betLimit.xuBetLimit2);
            $('.pk_money.pk_option3 span').text(data.betLimit.xuBetLimit3);
            betType = 6;
            $('#pk_hu').text(numberWithCommas(Math.round(data.xu1Jar)));
        }
    }
	//format number
	function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(".");
    }
});