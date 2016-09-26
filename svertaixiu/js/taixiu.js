/**
 * Created by troic on 4/19/2016.
 */
var game = new Phaser.Game(400, 400, Phaser.CANVAS, 'tx_canvas_tai_xiu', {
    preload: preload,
    create: create,
    update: update,
    reSize: resize
}, true);
var platforms;
var cursors;
var blurX, blurY;

var iScale = [0.5, 0.5, 0.5];
var linhtinh = [1, 1, 1];
var run = [true, true, true];
var isFalling = false;
var xucxac, xucxac_trai, xucxac_phai;
var boxucxac = [];
var counter = 30;
var text;
var game_loop;

function chenso(soa, sob, soc) {
    if (boxucxac[0] != null) {
        boxucxac[0].khung = soa - 1;
        boxucxac[1].khung = sob - 1;
        boxucxac[2].khung = soc - 1;
    }
}

function chenthoigian(time) {
    counter = time;
}
function resize() {
    console.log('vao resize');
}
function preload() {
    game.load.spritesheet('xucxac', '/svertaixiu/assets/xuc xac.png', 205, 205);
    game.load.spritesheet('xucxac-kq', '/svertaixiu/assets/xuc xac-kq.png', 235, 239);
    game.load.script('filterX', 'https://cdn.rawgit.com/photonstorm/phaser/master/filters/BlurX.js');
    game.load.script('filterY', 'https://cdn.rawgit.com/photonstorm/phaser/master/filters/BlurY.js');
    // game.stage.disableVisibilityChange = true;
    // game.stage.disablePauseScreen = false;
    // game.onPause.add(dungGame, this);
    // game.onResume.add(tiepTucGame, this);

    //game.scale.scaleMode = Phaser.ScaleManager.RESIZE;
    // game.scale.forceLandscape = true;
    // game.scale.parentIsWindow = true;

    //game.scale.refresh();

    //game.scale.pageAlignHorizontally = true;
    //game.scale.pageAlignVertically = true;
    // using RESIZE scale mode
    //game.scale.scaleMode = Phaser.ScaleManager.RESIZE;
    //game.scale.setScreenSize(true);

    boxucxac = [];
}

function dungGame() {
    console.log('vao dung game');
    // game.time.events.remove(game_loop);
}
function tiepTucGame() {
    console.log('tiep tuc game');
    //  game.time.events.add(game_loop);
}

function create() {
    game.stage.disableVisibilityChange = true;
    game.physics.startSystem(Phaser.Physics.ARCADE);
    //game.stage.backgroundColor = "#4488AA";
    /*var circle = new Phaser.Circle(150, 160, 150);
     var graphics = game.add.graphics(0, 0);
     graphics.lineStyle(5, 0x06052C, 1);
     graphics.beginFill(0xCBCCCB, 1);
     graphics.drawCircle(circle.x, circle.y, circle.diameter);*/

    platforms = game.add.group();
    platforms.enableBody = true;
    /*xuc xac*/
    xucxac = game.add.sprite(200, 100, 'xucxac');
    game.physics.arcade.enable(xucxac);
    xucxac.animations.add('xoay', [1, 0, 3, 2, 4, 5], 24, true);
    game.add.tween(xucxac).to({ angle: -45 }, 0, Phaser.Easing.Linear.None, true);
    boxucxac[0] = xucxac;
    boxucxac[0].vitrix = 42;//27
    boxucxac[0].vitriy = 47;//32
    /*het xuc xac*/

    /*xucxac trai*/
    xucxac_trai = game.add.sprite(50, 50, 'xucxac');
    game.physics.arcade.enable(xucxac_trai);
    xucxac_trai.animations.add('xoay', [0, 1, 2, 3, 4, 5], 24, true);
    game.add.tween(xucxac_trai).to({ angle: -75 }, 0, Phaser.Easing.Linear.None, true);
    boxucxac[1] = xucxac_trai;
    boxucxac[1].vitrix = 28;//17
    boxucxac[1].vitriy = 91;//78
    /*xucxac phai*/
    xucxac_phai = game.add.sprite(200, 100, 'xucxac');
    game.physics.arcade.enable(xucxac_phai);
    xucxac_phai.animations.add('xoay', [1, 2, 3, 0, 4, 5], 24, true);
    game.add.tween(xucxac_phai).to({ angle: -15 }, 0, Phaser.Easing.Linear.None, true);
    boxucxac[2] = xucxac_phai;
    boxucxac[2].vitrix = 65;//52
    boxucxac[2].vitriy = 71;//50

    setAlphaXucXac(0);
    // setAlphaXucXac(1);

    cursors = game.input.keyboard.createCursorKeys();

    text = game.add.text(game.world.centerX, game.world.centerY, '', {
        font: "100px VNI-Avo-Bold",
        fill: "#F8F8F8",
        align: "center"
    });
    text.anchor.setTo(0.5, 0.5);
    //game_loop = game.time.events.loop(Phaser.Timer.SECOND, updateCounter, this);
}
function setAlphaXucXac(value) {
    for (var i = 0; i < 3; i++) {
        boxucxac[i].alpha = value;
    }
}
function updateCounter() {
    // counter--;
    //if (counter == 0 || counter == 90) {
    //    text.fill = '#F8F8F8';
    //} else
    text.fill = '#000';
    if (counter < 30) {
        if (counter < 25) {
            text.alpha = 1;
            setAlphaXucXac(0);
            $('#tx_canvas_tai_xiu').css("z-index", 2);
        }
        showtimeontext(counter);
    }
    else {
        text.alpha = 1;
        if ((counter - 30) < 6){
            text.fill = '#ff0000';
            $('#tx_canvas_tai_xiu').css("z-index", 500);
        }
        showtimeontext(counter - 30);
    }
    if (counter == 30) {
        for (var i = 0; i < 3; i++) {
            boxucxac[i].loadTexture('xucxac', 0, false);
            setTimeout(function (i) {
                boxucxac[i].animations.play('xoay');
                boxucxac[i].alpha = 1;
                run[i] = true;
            },1000,i);
        }
        text.alpha = 0;
    }
    if (counter == 0) {
        //counter = 90;
        text.alpha = 0.5;
        setAlphaXucXac(0);
        // setAlphaXucXac(1);
    }
    if (counter <= -9999) {
        counter = 0;
        text.alpha = 0;
        setAlphaXucXac(0);
        // setAlphaXucXac(1);
    }


}
function showtimeontext(time) {
    if (time < 10) {
        if (time >= 0) {
            text.setText('00:0' + time);
        }
    }
    else
        text.setText('00:' + time);
}
function updatexucxac(vitri) {
    boxucxac[vitri].filters = null;
    if (run[vitri] == true) {
        if (iScale[vitri] > 1){
            linhtinh[vitri] *= -1;
            isFalling = true;
        }
        if(isFalling){
            iScale[vitri] += 0.01 * linhtinh[vitri];
        } else {
            iScale[vitri] += 0.005 * linhtinh[vitri];
        }
        boxucxac[vitri].scale.setTo(iScale[vitri]);
        boxucxac[vitri].x = boxucxac[vitri].vitrix + boxucxac[vitri].vitrix / iScale[vitri];
        boxucxac[vitri].y = boxucxac[vitri].vitriy + boxucxac[vitri].vitriy / iScale[vitri];
        if (iScale[vitri] < 0.5) {
            run[vitri] = false;
            iScale[vitri] = 0.5;
            linhtinh[vitri] = 1;
            isFalling = false;
            var stopFrame = boxucxac[vitri].khung;
            boxucxac[vitri].loadTexture('xucxac-kq', stopFrame, true)
            boxucxac[vitri].scale.setTo(0.4);
        }
    }
}
function update() {
    updateCounter();

    updatexucxac(0);
    updatexucxac(1);
    updatexucxac(2);
}