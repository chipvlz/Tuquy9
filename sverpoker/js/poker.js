/**
 * Created by troic on 4/14/2016.
 */
var pk_game = new Phaser.Game(765, 215, Phaser.AUTO, 'pk_minipokernamquanbai', {
    preload: preload,
    create: create,
    update: update
});

// var cursors;
var pk_bobai = [];
var pk_stop_now = true;
var pk_dung_tai = [];
var pk_showresult = [];
var pk_thutu = 0;
var pk_item = 0;

function preload() {
    pk_game.load.spritesheet('pk_bobai', '/sverpoker/assets/bobai.png', 153, 215, 52);
}

function create() {
    pk_game.stage.disableVisibilityChange = true;
    pk_game.physics.startSystem(Phaser.Physics.ARCADE);
    // platforms = pk_game.add.group();
    // platforms.enableBody = true;

    for (var i = 0; i < 5; i++) {
        pk_bobai[i] = [];
        pk_bobai[i][0] = pk_game.add.sprite(i * 153 , 0, 'pk_bobai');
        pk_bobai[i][0].frame = 0;
        pk_bobai[i][0].scale.setTo(0.9,1);
        //pk_bobai[i][0].anchor.setTo(0.5);
        pk_bobai[i][1] = pk_game.add.sprite(i * 153, -215, 'pk_bobai');
        pk_bobai[i][1].frame = 1;
        pk_bobai[i][1].scale.setTo(0.9,1);
        //pk_bobai[i][1].anchor.setTo(0.5);
    }
    // cursors = pk_game.input.keyboard.createCursorKeys();
    for (var ii = 0; ii < 5; ii++)
        pk_showresult[ii] = false;
}

function update() {
    for (var i = 0; i < 5; i++) {
        if (pk_showresult[i] == false) {
            pk_bobai[i][0].y += 30;
            pk_bobai[i][1].y += 30;
            if (pk_bobai[i][0].y > pk_game.height) {
                pk_bobai[i][0].y = -215;
                pk_bobai[i][0].frame = pk_game.rnd.integerInRange(0, 51);
            }
            if (pk_bobai[i][1].y > pk_game.height) {
                pk_bobai[i][1].y = -215;
                pk_bobai[i][1].frame = pk_game.rnd.integerInRange(0, 51);
            }

            if(pk_stop_now == true){
                if (pk_thutu == 60) {
                    hienhienhien(pk_item);
                    pk_showresult[pk_item] = true;
                    ++pk_item;
                    pk_thutu=0;
                }
                pk_thutu+=4;
            }
        }
    }
}

function hienhienhien(i) {
    pk_bobai[i][0].y = 0;
    pk_bobai[i][0].frame = pk_dung_tai[i];
    pk_bobai[i][1].y = -215;
}
//function hienketqua() {
//    if(pk_item < 5) {
//        if (pk_thutu == (pk_item * 60)) {
//            hienhienhien(pk_item);
//            pk_showresult[pk_item] = true;
//            ++pk_item;
//        }
//        pk_thutu++;
//    }
//}

function dunglai(stop, a, b, c, d, e) {
    pk_stop_now = stop;
    pk_dung_tai[0] = a;
    pk_dung_tai[1] = b;
    pk_dung_tai[2] = c;
    pk_dung_tai[3] = d;
    pk_dung_tai[4] = e;

    if (pk_stop_now == true) {
        pk_thutu = 0;
        pk_item  = 0;
    }else{
        for(var i=0;i<5;i++){
            pk_showresult[i] = false;
        }
    }
}