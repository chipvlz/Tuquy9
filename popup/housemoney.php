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
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <td>Số tiền nạp</td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <td>Số gem nhận được</td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <td>Mã xác nhận</td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a id="napngay"></a>
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