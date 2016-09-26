/**
 * Created by troic on 4/14/2016.
 */
var game = new Phaser.Game(1366, 768, Phaser.AUTO, 'bacay', {
    preload: preload,
    create: create,
    update: update
}, true);

var cursors;
var thu_tu_van, ngoc_diem, tien_ga, bo_truc, bo_user, menu, chat,
    bg_tien_ga, ngoc_ga, truc_ngoc, truc_text, phat_luong, show_phat_luong, show_notification,
    sang_tien, show_sang_tien,
    rung_vao_ga, vao_ga, truc_point, chuong_cai, xu_or_gem, game_time, tien_cuoc_tam_thoi,
    notification, is_da_lat_bai = false;
var giaTriKhoiTaoGame;
var quan_ly_vaoga;
var style_game_point = {font: '13px UTMAvo', fill: '#fff', align: 'left'};
var style_truc_point = {
    font: '28px UTMAvo-Italic',
    fill: '#000',
    align: 'center',
    stroke: '#FCFF00',
    wordWrap: true,
    wordWrapWidth: '55px'
};
var style_truc_point_get = {
    font: '28px UTMAvo-Italic',
    fill: '#000',
    align: 'right',
    boundsAlignH: 'right',
    stroke: '#FCFF00',
    wordWrap: true,
    wordWrapWidth: 200,
    backgroundColor: 'rgb(89, 15, 15)'
};

var num_tien_ga;
var bobai = [];
var cropRect;
var pie;
var show_truc = false;
var green = 255, red = 0;

var userId = $('#token3cay').val();
var roomId = '';
var link_goc = ' http://115.84.183.203:9999/chuong3cay-0.0.6-SNAPSHOT/c3c';
var socket = io.connect('http://115.84.183.203:9394');
var channel;
var channel_main = 'main_c3c_channel';
socket.on('connect', function () {
    var jsonObject = {
        "userId": userId,
        "requestType": 60
    };
    socket.emit(channel_main, jsonObject);
});

socket.on(channel_main, function (data) {
    if (data.type == 2) {
        if (data.findRoomResponse != null) {
            console.log(data.findRoomResponse);
            channel = data.findRoomResponse.roomId;
            setSocketRunning();
        }
    } else if (data.type == 23) {
        console.log(data.message);
    }
});

function setSocketRunning() {
    socket.on(channel, function (data) {
        switch (data.type) {
            case 0: //Type: 0 -> Waiting before New Game
                console.log('00' + data.message);
                break;
            case 1: //Type: 1 -> Start Game
                console.log('01' + data.message);
                thu_tu_van.setText('@' + data.message.substr(14));
                if (data.room != null) {
                    console.log('START PHASE');
                    console.log(data.room);
                    reloadVaoGa(true);
                    giaTriKhoiTaoGame = data.room;
                    if (giaTriKhoiTaoGame.running == true) {
                        setInputParameter();
                    } else {
                        console.log('chua chay game');
                    }
                    reloadTrucDiem();
                    for (var jj = 0; jj < 8; jj++) {
                        traQuanBaiVeViTriCu(jj);
                        bo_user.getAt(jj).game_dat_ga = false;
                        bo_user.getAt(jj).game_is_win = false;
                        bo_user.getAt(jj).game_pet_ga.alpha = 0;
                        bo_user.getAt(jj).game_vong_xoay_thang.alpha = 0;
                    }

                    reloadVaoGa(true);

                    //tat phat luong
                    phat_luong.alpha = 0;
                    show_phat_luong = false;
                    sang_tien.alpha = 0;
                    show_sang_tien = false;

                    //remove time if have
                    game.time.events.remove(game_time);
                    resetloading(0.0031, 1);
                    game_time = game.time.events.loop(50, thoiGian, this);
                }
                break;
            case 2: //Type: 2 -> Notification
                console.log('02' + data.message);
                break;
            case 3: //Type: 3 -> Connect to Room
                console.log('03' + data.message);
                if (data.room != null) {
                    console.log('JOIN ROOM');
                    console.log(data.room);
                }
                break;
            case 4: //Type: 4 -> Timer
                console.log('04' + data.timer + ' ' + data.message);
                if (data.timer == 6) {//hien dat cuoc
                    show_truc = true;
                    reloadVaoGa(false);
                } else if (data.timer == 21) {
                    show_truc = false;
                    //tat vong xoay
                    game.world.remove(pie);
                    hienDatCuocNhungNguoiChuaDat();
                }

                break;
            case 5: //Type: 5 -> Draw Card
                console.log(data.room);
                for (var i = 0; i < data.room.slots.length; i++) {
                    for (var j = 0; j < 8; j++) {
                        if (bo_user.getAt(j).game_username.text == data.room.slots[i].userId) {
                            var card0 = data.room.slots[i].cards[0];
                            var card1 = data.room.slots[i].cards[1];
                            var card2 = data.room.slots[i].cards[2];
                            hienquanbai(j, card0.iQuan + 9 * card0.iNut,
                                card1.iQuan + 9 * card1.iNut,
                                card2.iQuan + 9 * card2.iNut, false);
                            break;
                        }
                    }
                }
                break;
            case 6: //Type: 6 -> End Game
                //console.log('06' + data.message);
                game.world.remove(pie);
                break;
            case 9: //Type: 9 -> Waiting for Flip
                console.log('09');
                console.log(data);
                break;
            case 10: //Type: 10 -> Flip Card and Calculate
                console.log('10');
                console.log(data.room);
                for (var i = 0; i < data.room.slots.length; i++) {
                    for (var j = 0; j < 8; j++) {
                        if (bo_user.getAt(j).game_username.text == data.room.slots[i].userId) {
                            var card0 = data.room.slots[i].cards[0];
                            var card1 = data.room.slots[i].cards[1];
                            var card2 = data.room.slots[i].cards[2];
                            hienquanbai(j, card0.iQuan + 9 * card0.iNut,
                                card1.iQuan + 9 * card1.iNut,
                                card2.iQuan + 9 * card2.iNut, true);
                            bo_user.getAt(j).game_latbai.alpha = 1;
                            //thang
                            bo_user.getAt(j).game_latbai.getAt(1).setText(numberWithCommas(data.room.slots[i].diem));
                            if (data.room.slots[i].win == true) {
                                bo_user.getAt(j).game_is_win = true;

                                if (bo_user.getAt(j).game_phia_tren == true) {
                                    bo_user.getAt(j).game_latbai.getAt(0).loadTexture('thang', 0, false);
                                } else {
                                    bo_user.getAt(j).game_latbai.getAt(0).loadTexture('thangduoi', 0, false);
                                }
                                bo_user.getAt(j).game_vong_xoay_thang.alpha = 1;
                                bo_user.getAt(j).game_latbai.getAt(1).addColor('#dc1919', 0);
                            } else {
                                if (bo_user.getAt(j).game_phia_tren == true) {
                                    bo_user.getAt(j).game_latbai.getAt(0).loadTexture('thua', 0, false);
                                } else {
                                    bo_user.getAt(j).game_latbai.getAt(0).loadTexture('thuaduoi', 0, false);
                                }
                                bo_user.getAt(j).game_latbai.getAt(1).addColor('#ffffff', 0);
                            }
                            datcuoc(j, 0, false);
                            break;
                        }
                    }
                }
                if (data.room.specialCase == 'Phát Lương') {
                    show_phat_luong = true;
                    phat_luong.alpha = 0;
                    phat_luong.scale.setTo(4, 4);
                }

                if (data.room.specialCase == 'Sập Làng') {
                    show_sang_tien = true;
                    sang_tien.alpha = 0;
                    sang_tien.scale.setTo(4, 4);
                }

                /*var pos = game.rnd.integerInRange(0, 7);
                 bo_user.getAt(pos).game_is_cuop_chuong = true;
                 bo_user.getAt(pos).game_cuop_chuong.alpha = 1;
                 bo_user.getAt(pos).game_vuong_mien.alpha = 1;*/

                break;
            case 11: //Type: 11 -> User place BetMoney
                // console.log('11' + data.message);
                if (data.message.indexOf('Success') > -1) {
                    if (data.betUser != null) {
                        // console.log('nhan thong tin dat cuoc');
                        console.log(data.betUser);
                        truTienCaCuoc(data.betUser, 0);
                    }
                }
                break;
            case 12: //Type: 12 -> Gop Ga
                if (data.message.indexOf('Success') > -1) {
                    console.log(data.betUser);
                    // diChuyenGa(3);
                    //console.log(data.betUser, 1);
                    truTienCaCuoc(data.betUser, 1);
                } else {
                    showNotification(data.message);
                }
                // console.log('12' + data.message);
                break;
            case 15: //Type: 15 -> Reward for Ga Budget
                console.log('15');
                console.log(data.room);
                var lucky = data.room.gaLuckyPlayer;
                showNotification(lucky.userId + ' đã thắng gà: ' + lucky.gaMoney);
                hienGaVeChoNguoiThang(lucky);
                break;
            case 16:
                console.log('16');
                console.log(data.message);
                console.log(data.room);

                break;
            case 23:
                console.log('23' + data.message);
                break;
        }
    });
}

function hienGaVeChoNguoiThang(lucky) {
    for (var i = 0; i < 8; i++) {
        if (bo_user.getAt(i).game_username.text == lucky.userId) {
            var tween = game.add.tween(ngoc_ga);
            tween.to({
                x: bo_user.getAt(i).game_default_x_coin,
                y: bo_user.getAt(i).game_default_y_coin
            }, 1000, 'Linear', true, 0);
            tween.onComplete.add(function () {
                //ngoc_ga.alpha = 0;
                ngoc_ga.x = ngoc_ga.game_x_default;
                ngoc_ga.y = ngoc_ga.game_y_default;
                reloadVaoGa(true);
                bo_user.getAt(i).game_points.setText(numberWithCommas(lucky.totalMoney));
            }, this);
            break;
        }
    }
    // bo_user.getAt(pos).game_coin_pet_ga.x = bo_user.getAt(pos).game_default_x_coin;
    // bo_user.getAt(pos).game_coin_pet_ga.y = bo_user.getAt(pos).game_default_y_coin;
    // bo_user.getAt(pos).game_dat_ga = true;
    // bo_user.getAt(pos).game_coin_pet_ga.alpha = 1;
    // bo_user.getAt(pos).game_pet_ga.alpha = 1;
    // var tween = game.add.tween(bo_user.getAt(pos).game_coin_pet_ga);
    // tween.to({x: ngoc_ga.x, y: ngoc_ga.y}, 1000, 'Linear', true, 0);
    // tween.onComplete.add(function () {
    //     num_tien_ga += min_xu;
    //     tien_ga.setText(numberWithCommas(num_tien_ga));
    //     bo_user.getAt(pos).game_coin_pet_ga.alpha = 0;
    // }, this);

}
function connectGame() {
    // $.ajax({
    //     type: 'POST',
    //     dataType: 'text',
    //     beforeSend: function (xhr) {
    //         xhr.setRequestHeader("Content-Type", "application/json");
    //     },
    //     url: link_goc + '/findRoom',
    //     data: '{"userId":"' + userId + '","type":6,"betRoomLimit":"5K"}',
    //     // data: {userId: "yamiah", type: 6, betRoomLimit: "5K"},
    //     success: function (data) {
    //         console.log(data);
    //         giaTriKhoiTaoGame = JSON.parse(data);
    //         // for (var i = 0; i < giaTriKhoiTaoGame.slots.length; i++) {
    //         //     giaTriKhoiTaoGame.slots[i].avatar = 'ava2';
    //         //     // {name: 'Dan_te_te', xu: 8796000, gem: 54646, avatar: 'ava2', is_me: false}];
    //         // }
    //         console.log('nho xoa running = true');
    //         roomId = giaTriKhoiTaoGame.roomId;
    //         setSocketRunning();
    //         giaTriKhoiTaoGame.running = true;
    //
    //         giaTriKhoiTaoGame.slots[0].is_me = true;
    //         if (giaTriKhoiTaoGame.running == true) {
    //             setInputParameter();
    //         } else {
    //             console.log('chua chay game');
    //         }
    //     },
    //     error: function (data) {
    //         console.log(data);
    //     }
    // });
    var jsonObject = {
        "userId": userId,
        "betRoomLimit": $('#bet3cayRoomLimit').val(),
        "type": $('#bet3cayType').val(),
        "requestType": 50
    };
    socket.emit(channel_main, jsonObject);
}

//For game
var is_gem = false, min_xu = 5000, max_xu = 10000;

function preload() {

    //game.load.spritesheet('bobai', 'assets/bobai.png', 153, 215, 52);
    game.load.image('bg', '/sver3caychuong/assets/3cay_bg.jpg');
    game.load.image('vaoga', '/sver3caychuong/assets/3cay_vaoga.png');
    game.load.image('tienga', '/sver3caychuong/assets/3cay_tienga.png');
    game.load.image('ngocga', '/sver3caychuong/assets/3cay_ngocga.png');
    game.load.image('thuongga', '/sver3caychuong/assets/3cay_thuongga.png');

    game.load.image('ngoc', '/sver3caychuong/assets/3cay_ngoc.png');
    game.load.image('thuong', '/sver3caychuong/assets/3cay_thuong.png');
    game.load.image('menu', '/sver3caychuong/assets/3cay_menu.png');
    game.load.image('chat', '/sver3caychuong/assets/3cay_chat.png');
    game.load.image('truc', '/sver3caychuong/assets/3cay_truc.png');
    game.load.image('trucdiem', '/sver3caychuong/assets/3cay_truc_diem.png');
    game.load.image('trucngoc', '/sver3caychuong/assets/3cay_truc_ngoc.png');
    game.load.image('user', '/sver3caychuong/assets/3cay_user.png');
    game.load.image('sangtien', '/sver3caychuong/assets/3cay_ca_lang_sang_tien.png');
    game.load.image('phatluong', '/sver3caychuong/assets/3cay_phat_luong.png');
    //game.load.image('user', 'http://profile.rikvip.com/Content/img_ava/10.png');
    game.load.image('ava2', '/sver3caychuong/assets/3cay_ava2.png');
    game.load.image('ava1', '/sver3caychuong/assets/3cay_ava1.png');
    game.load.image('coin', '/sver3caychuong/assets/3cay_coin.png');
    game.load.image('vuongmien', '/sver3caychuong/assets/3cay_vuong_mien.png');
    game.load.image('vongthang', '/sver3caychuong/assets/3cay_cuop_chuong.png');


    game.load.image('thang', '/sver3caychuong/assets/3cay_thang.png');
    game.load.image('thangduoi', '/sver3caychuong/assets/3cay_thang_duoi.png');
    game.load.image('thua', '/sver3caychuong/assets/3cay_thua.png');
    game.load.image('thuaduoi', '/sver3caychuong/assets/3cay_thua_duoi.png');
    game.load.image('bgtienpet', '/sver3caychuong/assets/3cay_bg_tien_pet.png');
    game.load.image('matsaudo', '/sver3caychuong/assets/3cay_mat_sau_do.png');
    game.load.image('matsauden', '/sver3caychuong/assets/3cay_mat_sau_den.png');
    game.load.image('xacnhan', '/sver3caychuong/assets/3cay_xacnhan.png');
    game.load.image('icga', '/sver3caychuong/assets/3cay_ic_ga.png');
    game.load.image('iccai', '/sver3caychuong/assets/3cay_ic_cai.png');
    game.load.spritesheet('bobai', '/sver3caychuong/assets/3cay_bo_bai.png', 153, 215, 38);
    num_tien_ga = 0;
    rung_vao_ga = false;
}

// function setInputParameter(id_match, gem, min_coin, max_coin, is_chuong) {
function setInputParameter() {
    is_gem = giaTriKhoiTaoGame.type != 6;

    min_xu = giaTriKhoiTaoGame.betLimitMetric[0];
    max_xu = giaTriKhoiTaoGame.betLimitMetric[4];

    ngoc_diem.setText(numberWithCommas(min_xu) + ' - ' + numberWithCommas(max_xu) + ' ');
    bo_truc.getAt(1).getAt(1).setText(numberWithCommas(giaTriKhoiTaoGame.betLimitMetric[1]) + ' ');
    bo_truc.getAt(2).getAt(1).setText(numberWithCommas(giaTriKhoiTaoGame.betLimitMetric[2]) + ' ');
    bo_truc.getAt(3).getAt(1).setText(numberWithCommas(giaTriKhoiTaoGame.betLimitMetric[3]) + ' ');
    // bo_truc.getAt(1).getAt(1).setText(numberWithCommas(min_xu + (max_xu - min_xu) / 4) + ' ');
    // bo_truc.getAt(2).getAt(1).setText(numberWithCommas(min_xu + (max_xu - min_xu) / 2) + ' ');
    // bo_truc.getAt(3).getAt(1).setText(numberWithCommas(min_xu + (max_xu - min_xu) * 3 / 4) + ' ');

    tien_cuoc_tam_thoi = giaTriKhoiTaoGame.betLimitMetric[0];
    if (is_gem == true) {
        xu_or_gem.loadTexture('ngoc', 0, false);
        ngoc_ga.loadTexture('ngocga', 0, false);
        for (var i = 0; i < 8; i++) {
            bo_user.getAt(i).game_coin.loadTexture('ngoc', 0, false);
            bo_user.getAt(i).game_coin_pet_ga.loadTexture('ngocga', 0, false);
        }
    } else {
        xu_or_gem.loadTexture('thuong', 0, false);
        ngoc_ga.loadTexture('thuongga', 0, false);
        for (var ii = 0; ii < 8; ii++) {
            bo_user.getAt(ii).game_coin.loadTexture('thuong', 0, false);
            bo_user.getAt(ii).game_coin_pet_ga.loadTexture('thuongga', 0, false);
        }
    }
    setPlayers();

    taoChuongCai(giaTriKhoiTaoGame.chuongUserId);
}

function setPlayers() {
    // var players = [{name: 'Duc_Tran', xu: 123000, gem: 99999, avatar: 'ava1', is_me: false},
    //     {name: 'Phuong_siro', xu: 9000, gem: 6461321, avatar: 'ava2', is_me: false},
    //     {name: 'Mr_Viet8888', xu: 12000, gem: 31658, avatar: 'ava1', is_me: false},
    //     {name: 'TaiVanNang', xu: 10003000, gem: 9687612, avatar: 'ava2', is_me: false},
    //     {name: 'Daigiachanthoi_vn', xu: 765444000, gem: 4897612, avatar: 'ava1', is_me: true},
    //     {name: 'Ti_phu_999', xu: 622100, gem: 13216, avatar: 'ava2', is_me: false},
    //     {name: 'Pham_Nhat_Vuong', xu: 4687498320, gem: 98797, avatar: 'ava1', is_me: false},
    //     {name: 'Dan_te_te', xu: 8796000, gem: 54646, avatar: 'ava2', is_me: false}];
    var players = giaTriKhoiTaoGame.slots;

    var j = 0;
    if (players.length > 3) {
        while (players[3].userId != userId) {
            var temp = players.pop();
            players.unshift(temp);
        }
        for (j = 0; j < players.length; j++) {
            showPlayer(players[j], j);
        }
    } else {
        for (j = 0; j < players.length; j++) {
            if (players[j].userId == userId)
                showPlayer(players[j], 3);
            else
                showPlayer(players[j], j);
        }
    }
}

function showPlayer(user, pos_show) {
    bo_user.getAt(pos_show).loadTexture(user.imageUrl, 0, false);
    // if (is_gem == true) {
    //     bo_user.getAt(pos_show).game_points.setText(numberWithCommas(user.gem));
    // } else {
    bo_user.getAt(pos_show).game_points.setText(numberWithCommas(user.totalMoney));
    // }
    bo_user.getAt(pos_show).game_username.setText(user.userId);
    bo_user.getAt(pos_show).game_username.alpha = 1;
    bo_user.getAt(pos_show).game_points.alpha = 1;
    bo_user.getAt(pos_show).game_coin.alpha = 1;
}

function create() {
    game.stage.disableVisibilityChange = true;
    game.physics.startSystem(Phaser.Physics.ARCADE);
    var bg = game.add.sprite(0, 0, 'bg');
    cursors = game.input.keyboard.createCursorKeys();
    //phan thong tin phia tren
    thu_tu_van = game.add.text(62, 17, '', {font: '25px SharnayItalic', fill: '#fff', align: 'center'});
    xu_or_gem = game.add.sprite(15, 49, 'ngoc');
    ngoc_diem = game.add.text(59, 53, '', {font: '25px UTMAvo-Italic', fill: '#fff', align: 'center'});

    //phan thong tin vao ga
    createVaoGa();

    //phan menu
    createMenu();

    //Phan nguoi dung
    createUsers();

    //tao chuong cai
    createChuong();

    //createCircleLoading(3);

    //game_time = game.time.events.loop(50, thoiGian, this);

    //phan truc chon tien
    taoBoTruc();

    //tao notification
    createNotification();

    //phat luong sang tien
    createPhatLuongSangTien();
}
function createNotification() {
    var style = {
        font: '31px UTMAvo', fill: '#fff',
        wordWrap: true, wordWrapWidth: 500, align: "center"
    };
    notification = game.add.text(683, 384 + 150, "Bạn chưa đặt với Chương", style);
    notification.anchor.set(0.5);
    notification.alpha = 0;
    game.physics.enable(notification, Phaser.Physics.ARCADE);
}

function createCircleLoading(pos) {
    /*
     *  pie = new PieProgress(game, game.world.centerX, game.world.centerY, 32);
     game.world.add(pie);
     game.add.tween(pie).to({progress: 0}, 2000, Phaser.Easing.Quadratic.InOut, true, 0, Infinity, true);
     game.add.tween(pie).to({radius: 64}, 1000, Phaser.Easing.Back.InOut, true, 1000, Infinity, true);
     game.time.events.loop(500, function() {
     pie.color = game.rnd.pick(["#f00", "#0f0", "#00f", "#ff0", "#0ff", "#f0f", "#fff"]);
     }, this);
     */
    pie = new PieProgress(game, bo_user.getAt(pos).x + 60, bo_user.getAt(pos).y + 60, 32);
    game.world.add(pie);
    var gui = new dat.GUI();
    // dat.GUI.toggleHide();
    gui.add(pie, 'progress', 0, 1);
    gui.add(pie, 'radius', 20, 128);
    gui.add(pie, 'weight', 0, 1);
    gui.addColor(pie, 'color');
    pie.progress = 0;
    pie.weight = 0.10;
    pie.radius = 71;
    pie.red = 0;
    pie.green = 255;
    pie.progress = 0;
    pie.so_goc = 0.01;
    pie.so_mau = 1;
    pie.color = 'rgb(' + pie.red + ',' + pie.green + ',0)';
    //pie.alpha = 0;
    resetloading(0.0031, 1);
}
function createChuong() {
    chuong_cai = game.add.sprite(669, 370, 'iccai');
    chuong_cai.scale.setTo(1.3);
    chuong_cai.anchor.setTo(0.5);
    //game.physics.arcade.enable(chuong_cai);
    game.physics.enable(chuong_cai, Phaser.Physics.ARCADE);
}
function createUsers() {
    bo_user = game.add.group();
    bo_user.add(taoNguoiDung(431, 114, openuserMot, '', 'user', 0, true, 431 + 40, 114 + 130, 431 - 115, 114 - 30));
    bo_user.add(taoNguoiDung(192, 200, openuserHai, '', 'user', 0, true, 192 + 110, 200 + 100, 192 + 130, 200 + 30));
    bo_user.add(taoNguoiDung(192, 472, openuserBa, '', 'user', 0, false, 192 + 110, 472 - 10, 192 + 130, 472 - 30));
    bo_user.add(taoNguoiDung(431, 562, openuserBon, '', 'user', 0, false, 431 + 40, 562 - 50, 431 + 125, 562));
    bo_user.add(taoNguoiDung(824, 562, openuserNam, '', 'user', 0, false, 824 + 40, 562 - 50, 824 - 115, 562));
    bo_user.add(taoNguoiDung(1049, 472, openuserSau, '', 'user', 0, false, 1049 - 60, 472 - 10, 1049 - 115, 472 - 10));
    bo_user.add(taoNguoiDung(1049, 200, openuserBay, '', 'user', 0, true, 1049 - 60, 200 + 100, 1049 - 115, 200 + 30));
    bo_user.add(taoNguoiDung(824, 114, openuserTam, '', 'user', 0, true, 824 + 40, 114 + 130, 824 + 125, 114 - 30));

    var pos = 3;
    bo_user.getAt(pos).game_me = true;
    bo_user.getAt(pos).game_bobai_chuong.getAt(0).scale.setTo(0.5, 0.5);
    bo_user.getAt(pos).game_bobai_chuong.getAt(1).scale.setTo(0.5, 0.5);
    bo_user.getAt(pos).game_bobai_chuong.getAt(2).scale.setTo(0.5, 0.5);
}
function createMenu() {
    menu = game.add.button(20, 692, 'menu', openmenu, this, 2, 1, 0);
    chat = game.add.button(165, 692, 'chat', openchat, this, 2, 1, 0);
    chat.visible = false; // tinh nang cap nhat sau
}
function createPhatLuongSangTien() {
    phat_luong = game.add.sprite(523 + 160, 444 + 46, 'phatluong');
    phat_luong.alpha = 0;
    phat_luong.anchor.setTo(0.5);
    phat_luong.scale.x *= -1;
    sang_tien = game.add.sprite(523 + 160, 444 + 46, 'sangtien');
    sang_tien.alpha = 0;
    sang_tien.anchor.setTo(0.5);
    sang_tien.scale.x *= -1;

}
function createVaoGa() {
    quan_ly_vaoga = game.add.group();

    vao_ga = game.add.button(580, 325, 'vaoga', openvaoga, this, 2, 1, 0);
    vao_ga.onInputOver.add(overvaoga, this);
    vao_ga.onInputOut.add(outvaoga, this);

    bg_tien_ga = game.add.sprite(565, 386, 'tienga');
    ngoc_ga = game.add.sprite(588, 397, 'thuongga');
    ngoc_ga.game_x_default = ngoc_ga.x;
    ngoc_ga.game_y_default = ngoc_ga.y;
    game.physics.arcade.enable(ngoc_ga);
    tien_ga = game.add.text(710, 420, '0', {font: '21px UTMAvo', fill: '#fff', align: 'center'});
    tien_ga.anchor.set(0.5);

    quan_ly_vaoga.add(vao_ga);
    quan_ly_vaoga.add(bg_tien_ga);
    quan_ly_vaoga.add(ngoc_ga);
    quan_ly_vaoga.add(tien_ga);
//    quan_ly_vaoga.alpha = 0;
    quan_ly_vaoga.visible = false;
}

function reloadVaoGa(isReload) {
    quan_ly_vaoga.visible = isReload != true;
    tien_ga.setText('0');
    num_tien_ga = 0;
}

function thoiGian() {
    if (pie.progress < 1) {
        //pie.progress += 0.0033;
        //pie.progress += 0.01;
        pie.progress += pie.so_goc;
        if (pie.red < 255) {
            pie.red += pie.so_mau;
            pie.green -= pie.so_mau;
            pie.color = 'rgb(' + pie.red + ',' + pie.green + ',0)';
        }
    } else {
       // game.time.events.remove(game_time);
        //pie.progress = 0;
    }
}

function resetloading(goc, mau) {
    pie.red = 0;
    pie.green = 255;
    pie.progress = 0;
    pie.so_goc = goc;
    pie.so_mau = mau;
    //game.time.events.add(game_time);
}

function reloadToanBoNhuBanDau() {
    reloadVaoGa(true);
    reloadThangThua();
    reloadTrucDiem();
    //reloadBoBai();
}
function reloadThangThua() {

}
function taoChuongCai(name) {
    for (var i = 0; i < bo_user.length; i++) {
        if (bo_user.getAt(i).game_username.text == name) {
            var tween = game.add.tween(chuong_cai);
            tween.to({x: bo_user.getAt(i).x + 62, y: bo_user.getAt(i).y + 80}, 1000, 'Linear', true, 0);

            createCircleLoading(i);
            break;
        }
    }
}

function diChuyenGa(pos) {
    bo_user.getAt(pos).game_coin_pet_ga.x = bo_user.getAt(pos).game_default_x_coin;
    bo_user.getAt(pos).game_coin_pet_ga.y = bo_user.getAt(pos).game_default_y_coin;
    bo_user.getAt(pos).game_dat_ga = true;
    bo_user.getAt(pos).game_coin_pet_ga.alpha = 1;
    bo_user.getAt(pos).game_pet_ga.alpha = 1;
    var tween = game.add.tween(bo_user.getAt(pos).game_coin_pet_ga);
    tween.to({x: ngoc_ga.x, y: ngoc_ga.y}, 1000, 'Linear', true, 0);
    tween.onComplete.add(function () {
        num_tien_ga += min_xu;
        tien_ga.setText(numberWithCommas(num_tien_ga));
        bo_user.getAt(pos).game_coin_pet_ga.alpha = 0;
    }, this);
}

function outvaoga() {
    vao_ga.x = 580;
    vao_ga.y = 325;
}
function overvaoga() {
    rung_vao_ga = true;
    shake = new Phaser.Plugin.Shake(game);
    game.plugins.add(shake);
    shake.shake(5, vao_ga);
}
function taoBoTruc() {
    setGiaTriTruc(min_xu, max_xu);
    var xacnhan = game.add.button(1234, 609 + 83, 'xacnhan', xacnhantiencuoc, this, 2, 1, 0);
    truc_ngoc = game.add.button(1236, 609, 'trucngoc', showPointForPetting, this, 2, 1, 0);//game.add.group();
    //truc_ngoc.add(game.add.sprite(1236, 609, 'trucngoc'));
    truc_ngoc.inputEnabled = true;
    truc_ngoc.input.enableDrag();
    truc_ngoc.input.allowHorizontalDrag = false;
    truc_ngoc.events.onDragStart.add(showPointForPetting);
    truc_ngoc.events.onDragUpdate.add(updatePointForPetting);
    truc_ngoc.events.onDragStop.add(hidePointForPetting);
    truc_text = game.add.text(truc_ngoc.x - 120, truc_ngoc.y, '', style_truc_point_get);
    truc_text.addColor('#ffffff', 0);
    var truc = game.add.sprite(1282, 200/*178*/, 'truc');
    var diemmot = taoDiemTrenTruc(1224, 494, ' ');
    var diemhai = taoDiemTrenTruc(1224, 378/*372*/, ' ');
    var diemba = taoDiemTrenTruc(1224, 252/*239*/, ' ');
    var diembon = taoDiemTrenTruc(1224, 126/*105*/, 'Tất tay ');
    bo_truc = game.add.group();
    bo_truc.add(truc);
    bo_truc.add(diemmot);
    bo_truc.add(diemhai);
    bo_truc.add(diemba);
    bo_truc.add(diembon);
    bo_truc.add(truc_ngoc);
    bo_truc.add(xacnhan);
}
function reloadTrucDiem() {
    truc_ngoc.x = 1236;
    truc_ngoc.y = 609;
    tien_cuoc_tam_thoi = giaTriKhoiTaoGame.betLimitMetric[0];
}
function showPointForPetting() {
    truc_text.alpha = 1;
}


function updatePointForPetting() {
    if (truc_ngoc.y > 125 && truc_ngoc.y < 609) {
        var phan_tram = 1 - (truc_ngoc.y - 126) / (609 - 126);
        phan_tram = Math.round(phan_tram * 100);
        tien_cuoc_tam_thoi = min_xu + phan_tram * (max_xu - min_xu) / 100;
        truc_text.setText(numberWithCommas(tien_cuoc_tam_thoi) + ' ');
        truc_text.y = truc_ngoc.y;
        game.world.bringToTop(truc_text);
    }
}
function hidePointForPetting() {
    truc_text.y = truc_ngoc.y;
    truc_text.alpha = 0;
}

function xacnhantiencuoc() {
    show_truc = false;
    truc_point = tien_cuoc_tam_thoi;
    // console.log('tien dat cuoc: ' + truc_point);
    // $.ajax({
    //     type: 'POST',
    //     dataType: 'text',
    //     beforeSend: function (xhr) {
    //         xhr.setRequestHeader("Content-Type", "application/json");
    //     },
    //     url: link_goc+'/placeBet',
    //     data: '{"userId":"' + userId + '","betMoney":' + truc_point + '}',
    //     success: function (data) {
    //         console.log(data);
    //         var result = JSON.parse(data);
    //         datcuoc(3, result.betMoney);
    //     },
    //     error: function (data) {
    //         console.log(data);
    //     }
    // });
    var jsonObject = {
        "userId": userId,
        "betMoney": truc_point,
        "requestType": 70
    };
    socket.emit(channel, jsonObject);
}
function setGiaTriTruc(min, max) {
    truc_point = min;
    truc_point.max = max;
    truc_point.min = min;
}

function taoNguoiDung(x, y, callback, name, avatarlink, coin, phiatren, x_coin, y_coin, x_bobai, y_bobai) {
    var style_username = {font: '17px UTMAvo', fill: '#fff', align: 'center'};
    var style_diem_latbai = {font: '90px UTMAvo', align: 'center'};

    //var user = dynamicLoadImage(game, x, y, avatarlink, callback);
    var user = game.add.button(x, y, avatarlink, callback, this, 2, 1, 0);
    user.game_phia_tren = phiatren;
    //tien cuoc
    var coin_pet = game.add.group();
    coin_pet.add(game.add.sprite(x_coin + 35, y_coin + 12, 'bgtienpet'));
    coin_pet.add(game.add.sprite(x_coin - 5, y_coin, 'coin'));
    coin_pet.add(game.add.text(x_coin + 45, y_coin + 15, numberWithCommas(min_xu), style_game_point));
    user.game_coin_pet = coin_pet;
    user.game_coin_pet.getAt(0).anchor.set(0.5);
    user.game_coin_pet.getAt(2).anchor.set(0.5);
    user.game_coin_pet.alpha = 0;

    var latbai = game.add.group();

    if (user.game_phia_tren == true) {
        user.game_username = game.add.text(user.x + 58, user.y - 38, name, style_username);
        user.game_points = game.add.text(user.x + 43, user.y - 25, numberWithCommas(coin), style_game_point);
        user.game_coin = game.add.sprite(user.x + 4, user.y - 29, 'thuong');
        latbai.add(game.add.sprite(user.x + 4, user.y + 6, 'thang'));
    } else {
        user.game_username = game.add.text(user.x + 58, user.y + 144, name, style_username);
        user.game_points = game.add.text(user.x + 43, user.y + 157, numberWithCommas(coin), style_game_point);
        user.game_coin = game.add.sprite(user.x + 4, user.y + 152, 'thuong');
        latbai.add(game.add.sprite(user.x + 4, user.y - 38, 'thangduoi'));
    }
    user.game_coin.scale.setTo(0.7);
    user.game_username.alpha = 0;
    user.game_points.alpha = 0;
    user.game_coin.alpha = 0;

    var bobaichuong = game.add.group();
    bobaichuong.add(game.add.sprite(x_bobai + 0, y_bobai, 'bobai'));
    bobaichuong.add(game.add.sprite(x_bobai + 15, y_bobai, 'bobai'));
    bobaichuong.add(game.add.sprite(x_bobai + 30, y_bobai, 'bobai'));

    bobaichuong.getAt(0).scale.setTo(0.3, 0.3);
    bobaichuong.getAt(0).game_x_def = x_bobai + 0;
    bobaichuong.getAt(1).scale.setTo(0.3, 0.3);
    bobaichuong.getAt(1).game_x_def = x_bobai + 15;
    bobaichuong.getAt(2).scale.setTo(0.3, 0.3);
    bobaichuong.getAt(2).game_x_def = x_bobai + 30;

    bobaichuong.getAt(0).frame = 36;
    bobaichuong.getAt(1).frame = 37;
    bobaichuong.getAt(2).frame = 36;
    user.game_bobai_chuong = bobaichuong;
    user.game_bobai_chuong.visible = false;


    latbai.add(game.add.text(user.x + 61, user.y + 62, '' + 8, style_diem_latbai));
    latbai.getAt(1).anchor.setTo(0.5);
    latbai.alpha = 0;
    user.game_latbai = latbai;

    user.game_vong_xoay_thang = game.add.sprite(user.x + 60, user.y + 60, 'vongthang');
    user.game_vong_xoay_thang.anchor.setTo(0.5);
    user.game_vong_xoay_thang.alpha = 0;

    user.game_vuong_mien = game.add.sprite(user.x + 3, user.y - 50, 'vuongmien');
    user.game_vuong_mien.alpha = 0;

    //tien cuoc ga
    user.game_coin_pet_ga = game.add.sprite(x + 40, y + 40, 'thuongga');
    user.game_username.anchor.set(0.5);
    game.physics.enable(user.game_coin_pet_ga, Phaser.Physics.ARCADE);
    //game.physics.arcade.enable(user.game_coin_pet_ga);
    user.game_coin_pet_ga.alpha = 0;
    //set ic ga
    user.game_pet_ga = game.add.sprite(user.x + 80, user.y + 60, 'icga');
    user.game_pet_ga.scale.setTo(1.3);
    user.game_pet_ga.alpha = 0;

    user.game_default_x_coin = user.game_coin_pet_ga.x;
    user.game_default_y_coin = user.game_coin_pet_ga.y;
    return user;
}

function taoDiemTrenTruc(width, height, name) {
    var trucdiem = game.add.sprite(width, height, 'trucdiem');
    var tructext = game.add.text(width + 59, height + 43, name, style_truc_point);
    tructext.anchor.set(0.5);
    var group = game.add.group();
    group.add(trucdiem);
    group.add(tructext);
    game.world.bringToTop(trucdiem);
    return group;
}

function openuserMot() {
    console.log('vi tri: mot');
}
function openuserHai() {
    console.log('vi tri: 2');
}
function openuserBa() {
    //var pos = game.rnd.integerInRange(0, 7);
    //hienquanbai(pos, 34, 4, 18, false);
}
function openuserBon() {
    console.log('vi tri: 4');
    // hienquanbai(3, 34, 4, 18, true);
}
function openuserNam() {
    console.log('vi tri: 5');
}
function openuserSau() {
    console.log('vi tri: 6');
}
function openuserBay() {
    console.log('vi tri: 7');
}
function openuserTam() {
    console.log('vi tri: 8');
}
function openuse() {
    console.log('mo user');
}

function openvaoga() {
    //var pos = game.rnd.integerInRange(0, 7);
    var jsonObject = {
        "userId": userId,
        "requestType": 80
    };
    socket.emit(channel, jsonObject);
}
function openmenu() {
    /*  var pos = game.rnd.integerInRange(0, 7);
     bo_user.getAt(pos).game_is_cuop_chuong = true;
     bo_user.getAt(pos).game_cuop_chuong.alpha = 1;
     bo_user.getAt(pos).game_vuong_mien.alpha = 1;
     pos = game.rnd.integerInRange(0, 7);
     bo_user.getAt(pos).game_latbai.alpha = 1;
     //thang
     if (bo_user.getAt(pos).game_phia_tren == true) {
     bo_user.getAt(pos).game_latbai.getAt(0).loadTexture('thang', 0, false);
     bo_user.getAt(pos).game_latbai.getAt(1).setText(numberWithCommas(4));
     bo_user.getAt(pos).game_latbai.getAt(1).addColor('#dc1919', 0);
     } else {
     bo_user.getAt(pos).game_latbai.getAt(0).loadTexture('thuaduoi', 0, false);
     bo_user.getAt(pos).game_latbai.getAt(1).setText(numberWithCommas(3));
     bo_user.getAt(pos).game_latbai.getAt(1).addColor('#ffffff', 0);
     }*/


}
function latBaiTruoc() {
    is_da_lat_bai = true;
}
function openchat() {
    console.log('open chat');


    // resetloading(0.01, 3);
    //resetloading(0.0033, 1);
    // var pos = game.rnd.integerInRange(0, 7);
    // hienquanbai(pos, 34, 4, 18, true);

    //taoChuongCai(game.rnd.integerInRange(0, 7));

}
function hienquanbai(vitrihien, quana, quanb, quanc, latbai) {
    if (latbai == true) {
        bo_user.getAt(vitrihien).game_bobai_chuong.getAt(0).frame = quana;
        bo_user.getAt(vitrihien).game_bobai_chuong.getAt(1).frame = quanb;
        bo_user.getAt(vitrihien).game_bobai_chuong.getAt(2).frame = quanc;
        bo_user.getAt(vitrihien).game_lat_bobai = true;
    } else {
        bo_user.getAt(vitrihien).game_lat_bobai = false;
        bo_user.getAt(vitrihien).game_bobai_chuong.getAt(1).x = bo_user.getAt(vitrihien).game_bobai_chuong.getAt(1).game_x_def;
        bo_user.getAt(vitrihien).game_bobai_chuong.getAt(2).x = bo_user.getAt(vitrihien).game_bobai_chuong.getAt(2).game_x_def;
        if (quana < 18)
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(0).frame = 36;
        else
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(0).frame = 37;
        if (quanb < 18)
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(1).frame = 36;
        else
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(1).frame = 37;
        if (quanc < 18)
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(2).frame = 36;
        else
            bo_user.getAt(vitrihien).game_bobai_chuong.getAt(2).frame = 37;
    }
    bo_user.getAt(vitrihien).game_bobai_chuong.visible = true;
}

function update() {
    if (show_truc == false) {
        if (bo_truc.x < 200) {
            bo_truc.x += 10;
        }
    } else {
        if (bo_truc.x > 0) {
            bo_truc.x -= 10;
        }
    }
    if (truc_ngoc.y < 126) {
        truc_ngoc.y = 126;
    }
    if (truc_ngoc.y > 608)
        truc_ngoc.y = 608;

    for (var i = 0; i < bo_user.length; i++) {
        if (bo_user.getAt(i).game_is_win == true) {
            bo_user.getAt(i).game_vong_xoay_thang.angle += 2;
        }
        if (bo_user.getAt(i).game_lat_bobai == true) {
            hienanimationcholatbai(i, 1, 70);
        }
    }

    if (show_phat_luong == true) {
        bienHoaToNho(phat_luong);
    } else if (show_sang_tien == true) {
        bienHoaToNho(sang_tien);
    }
}
function bienHoaToNho(input) {
    if (input.alpha < 1)
        input.alpha += 0.05;
    if (input.scale.x > 1) {
        input.scale.x -= 0.1;
        input.scale.y -= 0.1;
    }
}

function hienanimationcholatbai(pos, do_lech, do_dai_lech) {

    if (bo_user.getAt(pos).game_bobai_chuong.getAt(1).x <
        bo_user.getAt(pos).game_bobai_chuong.getAt(1).game_x_def +
        (do_dai_lech * bo_user.getAt(pos).game_bobai_chuong.getAt(1).scale.x / 2)) {
        bo_user.getAt(pos).game_bobai_chuong.getAt(1).x += do_lech;
    }
    if (bo_user.getAt(pos).game_bobai_chuong.getAt(2).x <
        bo_user.getAt(pos).game_bobai_chuong.getAt(2).game_x_def +
        (do_dai_lech * bo_user.getAt(pos).game_bobai_chuong.getAt(1).scale.x)) {
        bo_user.getAt(pos).game_bobai_chuong.getAt(2).x += do_lech;
    }
}

function datcuoc(pos, bet, is_datcuoc) {
    if (is_datcuoc == true) {
        bo_user.getAt(pos).game_coin_pet.alpha = 1;
    } else {
        bo_user.getAt(pos).game_coin_pet.alpha = 0;
    }
    bo_user.getAt(pos).game_coin_pet.getAt(2).text = bet;
}

function hienDatCuocNhungNguoiChuaDat() {
    for (var i = 0; i < 8; i++) {
        if (bo_user.getAt(i).game_username.text != '' && bo_user.getAt(i).game_coin_pet.alpha == 0) {
            bo_user.getAt(i).game_coin_pet.getAt(2).text = min_xu;
            bo_user.getAt(i).game_coin_pet.alpha = 1;
        }
    }
}
function themTienVaoGa() {
    num_tien_ga += 5000;
    // console.log(num_tien_ga);
    tien_ga.setText(numberWithCommas(num_tien_ga));
}
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
}

function exitGame() {
    $.ajax({
        type: 'POST',
        dataType: 'text',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Content-Type", "application/json");
        },
        url: link_goc + '/leftRoom',
        data: '{"userId":"' + userId + '"}',
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function getLimitByType() {
    $.ajax({
        type: 'GET',
        dataType: 'text',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Content-Type", "application/json");
        },
        url: link_goc + '/getLimitByType',
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function showNotification(text) {
    // show_notification = true;
    var style = {
        font: '31px UTMAvo', fill: '#fff',
        wordWrap: true, wordWrapWidth: 500, align: "center"
    };
    var notification = game.add.text(683, 534, text, style);
    notification.anchor.set(0.5);
    // notification.alpha = 0;
    game.physics.enable(notification, Phaser.Physics.ARCADE);
    // notification.setText(text);
    //  notification.alpha = 1;
    //  notification.x = 683;
    //  notification.y = 384 + 150;
    var tween = game.add.tween(notification);
    tween.to({x: 683, y: 384}, 2000, 'Linear', true, 0);
    tween.onComplete.add(function () {
        //notification.alpha = 0;
        game.world.remove(notification);
    }, this);
}

function truTienCaCuoc(thongtincuoc, mode) {
    if (mode == 0) { // ca cuoc
        for (var j = 0; j < 8; j++) {
            if (bo_user.getAt(j).game_username.text == thongtincuoc.userId) {
                bo_user.getAt(j).game_points.setText(numberWithCommas(thongtincuoc.totalMoney));
                showNotification(thongtincuoc.userId + ' đã cược ' + thongtincuoc.betMoney);
                datcuoc(j, thongtincuoc.betMoney, true);
                break;
            }
        }
    } else if (mode == 1) { // vao ga
        for (var jj = 0; jj < 8; jj++) {
            if (bo_user.getAt(jj).game_username.text == thongtincuoc.userId) {
                bo_user.getAt(jj).game_points.setText(numberWithCommas(thongtincuoc.totalMoney));
                showNotification(thongtincuoc.userId + ' đã vào gà thành công');
                diChuyenGa(jj);
                break;
            }
        }
    }
}

function traQuanBaiVeViTriCu(pos) {
    bo_user.getAt(pos).game_bobai_chuong.getAt(1).x = bo_user.getAt(pos).game_bobai_chuong.getAt(1).game_x_def;
    bo_user.getAt(pos).game_bobai_chuong.getAt(2).x = bo_user.getAt(pos).game_bobai_chuong.getAt(2).game_x_def;
    bo_user.getAt(pos).game_bobai_chuong.visible = false;
    bo_user.getAt(pos).game_latbai.alpha = 0;
}

//// Vong circle

var PieProgress = function (game, x, y, radius, color, angle, weight) {
    this._radius = radius;
    this._progress = 1;
    this._weight = weight || 0.25;
    this._color = color || "#fff";
    this.bmp = game.add.bitmapData((this._radius * 2) + (this._weight * (this._radius * 0.6)), (this._radius * 2) + (this._weight * (this._radius * 0.6)));
    Phaser.Sprite.call(this, game, x, y, this.bmp);
    this.anchor.set(0.5);
    this.angle = angle || -90;
    this.updateProgress();
};
PieProgress.prototype = Object.create(Phaser.Sprite.prototype);
PieProgress.prototype.constructor = PieProgress;
PieProgress.prototype.updateProgress = function () {
    var progress = this._progress;
    progress = Phaser.Math.clamp(progress, 0.00001, 0.99999);
    this.bmp.clear();
    this.bmp.ctx.strokeStyle = this.color;
    this.bmp.ctx.lineWidth = this._weight * this._radius;
    this.bmp.ctx.beginPath();
    this.bmp.ctx.arc(this.bmp.width * 0.5, this.bmp.height * 0.5, this._radius - 15, 0, (Math.PI * 2) * progress, false);
    this.bmp.ctx.stroke();
    this.bmp.dirty = true;
};

PieProgress.prototype.updateBmdSize = function () {
    this.bmp.resize((this._radius * 2) + (this._weight * (this._radius * 0.75)), (this._radius * 2) + (this._weight * (this._radius * 0.75)));
};

Object.defineProperty(PieProgress.prototype, 'color', {
    get: function () {
        return this._color;
    },
    set: function (val) {
        this._color = val;
        this.updateProgress();
    }
});

Object.defineProperty(PieProgress.prototype, 'radius', {
    get: function () {
        return this._radius;
    },
    set: function (val) {
        this._radius = (val > 0 ? val : 0);
        this.updateBmdSize();
        this.updateProgress();
    }
});

Object.defineProperty(PieProgress.prototype, 'progress', {
    get: function () {
        return this._progress;
    },
    set: function (val) {
        this._progress = Phaser.Math.clamp(val, 0, 255);
        this.updateProgress();
    }
});

Object.defineProperty(PieProgress.prototype, 'weight', {
    get: function () {
        return this._weight;
    },
    set: function (val) {
        this._weight = Phaser.Math.clamp(val, 0.01, 0.99);
        this.updateBmdSize();
        this.updateProgress();
    }
});

$(document).ready(function(){
	connectGame();
});

/*
 var PieProgress = function(game, x, y, radius, color, angle) {
 this._radius = radius;
 this._progress = 1;
 this.bmp = game.add.bitmapData(radius * 2, radius * 2);
 Phaser.Sprite.call(this, game, x, y, this.bmp);

 this.anchor.set(0.5);
 this.angle = angle || -90;
 this.color = color || "#fff";
 this.updateProgress();
 };

 PieProgress.prototype = Object.create(Phaser.Sprite.prototype);
 PieProgress.prototype.constructor = PieProgress;

 PieProgress.prototype.updateProgress = function() {
 var progress = this._progress;
 progress = Phaser.Math.clamp(progress, 0.00001, 0.99999);

 this.bmp.clear();
 this.bmp.ctx.fillStyle = this.color;
 this.bmp.ctx.beginPath();
 this.bmp.ctx.arc(this._radius, this._radius, this._radius, 0, (Math.PI * 2) * progress, true);
 this.bmp.ctx.lineTo(this._radius, this._radius);
 this.bmp.ctx.closePath();
 this.bmp.ctx.fill();
 this.bmp.dirty = true;
 };

 Object.defineProperty(PieProgress.prototype, 'radius', {
 get: function() {
 return this._radius;
 },
 set: function(val) {
 this._radius = (val > 0 ? val : 0);
 this.bmp.resize(this._radius * 2, this._radius * 2);
 this.updateProgress();
 }
 });

 Object.defineProperty(PieProgress.prototype, 'progress', {
 get: function() {
 return this._progress;
 },
 set: function(val) {
 this._progress = Phaser.Math.clamp(val, 0, 1);
 this.updateProgress();
 }
 });
 */