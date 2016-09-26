<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
    <title>Tuquy9.com - Ba Cay Chương</title>
    <link rel="stylesheet" href="/sver3caychuong/css/stylesheet.css">
    <!--<script type="text/javascript" src="js/phaser.min.js_2"></script>-->
    <script type="text/javascript" src="/sver3caychuong/js/dat.gui.min.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/phaser.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/shake.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/moment.min.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/sver3caychuong/js/jquery-ui.js"></script>
</head>
<body>
<!--test-->
    <input type="hidden" id="bet3cayValue" value="<?php echo $_POST["bet3cayValue"]?>" />
    <input type="hidden" id="bet3cayRoomLimit" value="<?php echo $_POST["bet3cayRoomLimit"]?>" />
    <input type="hidden" id="bet3cayType" value="<?php echo $_POST["bet3cayType"]?>" />
    <input type="hidden" id="bet3cayRoomChannel" value="<?php echo $_POST["bet3cayRoomChannel"]?>" />
    <input type="hidden" id="token3cay" value="<?php echo tokenEncode($_SESSION["username"])?>" />
    <div id="bacaybg">
        <div id="bacay"></div>
    </div>
    <div class="popupbg">
        <div id="popupNapGem" class="popup">
            <div class="hClButton">X</div>
            <ul class="navMenu">
                <li class="navItem"><a class="active thecao" href="#">Thẻ cào</a></li>
                <li class="navItem"><a class="chuyenkhoan" href="#">Chuyển khoản</a></li>
                <li class="navItem"><a class="tigia" href="#">Tỉ giá</a></li>
            </ul>
            <div class="contentTheCao" id="thecao">
                <a class="thecao_box"></a>
                <a class="thecao_box"></a>
                <a class="thecao_box"></a>
                <a class="thecao_box"></a>
                <a class="thecao_box"></a>
            </div>
            <div class="contentChuyenKhoan" id="chuyenkhoan">
                <table>
                    <tr>
                        <td>Chọn ngân hàng</td>
                        <td><input type="text" class="txtSideButton" /><input type="button" value="&#x025BE" style="font-size: 1.3em; padding: 0 2% 2% 2%;" class="sideButton"/></td>
                    </tr>
                    <tr>
                        <td>Số tiền nạp</td>
                        <td><input type="text" class="txtSideButton" /><input type="button" value="VND" class="sideButton"/></td>
                    </tr>
                    <tr>
                        <td>Số gem nhận được</td>
                        <td>
                            <input type="text" class="txt" /></td>
                    </tr>
                    <tr>
                        <td>Mã xác nhận</td>
                        <td>
                             <input type="text" class="txt" /><input type="button" value="Capcha" class="btnCapcha"/>              
                            </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a id="napngay" ></a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tigia" id="tigiacard">
                <span>
                        <td>Coming Soon.....</td>
                </span>
            </div>
        </div>
    </div>
    <script src="/sver3caychuong/js/bacay.js"></script>
    <script type="text/javascript">
        $('.popup').draggable({scroll: false});
        $('#popupNapGem>.hClButton').click(function(){
            $('.popupbg').removeClass('popupDim');
            $(this).parent().css({'visibility':'hidden'});
            $('.thecao').click();
        });
        $('.navItem a').click(function(){
            $('.active').css({ 'width' : '', 'background-color' : '#250101','font-weight' : '','font-style' : ''});
            $('.active').removeClass('active');
            var widthMenu = $('.navMenu').width();
            $(this).addClass('active');
            $(this).css({'background-color' : '#ec2c2c','font-weight' : '900','font-style' : 'italic','width': widthMenu*49.95/100+'px','text-align': 'center'});

            //check if click on 'chuyen khoan' -> 'chuyen khoan ngan hang'
            var className = $(this).attr('class');
            if(className.indexOf('chuyenkhoan') > -1){
                $(this).html('Chuyển khoản ngân hàng');
                $('#thecao').hide();
                $('#chuyenkhoan').show();
                $('#tigiacard').hide();
            } else if(className.indexOf('thecao') > -1) {
                $('.chuyenkhoan').html('Chuyển khoản');
                $('#chuyenkhoan').hide();
                $('#thecao').show();
                $('#tigiacard').hide();
            } else if(className.indexOf('tigia') > -1) {
                $('.chuyenkhoan').html('Chuyển khoản');
                $('#chuyenkhoan').hide();
                $('#thecao').hide();
                $('#tigiacard').show();
                //show tigia
            }


        });
        var widthMenu = $('.navMenu').width();
        $('.navItem:nth-child(1) a').css({'background-color' : '#ec2c2c','font-weight' : '900','font-style' : 'italic','width': widthMenu/2+'px','text-align': 'center'});

        //
        $('#thecao').show();
        $('#chuyenkhoan').hide();
        $('#tigiacard').hide();
    </script>
</body>

</html>