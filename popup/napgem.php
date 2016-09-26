<div class="modalcontainer" style="width: 700px;  margin-top:2%;">
    <span class="modal_title">Nạp Gem</span>
    <!--body of popup-->
    <div class="divinput" style="width: 590px; height: 390px; padding-left:10px; padding-right:10px;padding-bottom:0dp;background: url('../images/rectang_f.png') no-repeat; background-size: 100%;">
            <ul class="navMenu_home">
                <li class="navItem_home"><a class="active thecao" href="#">Thẻ cào</a></li>
                <li class="navItem_home"><a class="chuyenkhoan" href="#">Chuyển khoản</a></li>
                <li class="navItem_home"><a class="tigia" href="#">Tỉ giá</a></li>
            </ul>
            <div class="contentTheCao_home banktabcontent" id="thecao" style="width: 570px; height: 220px; padding-top: 50px;padding-left:10px;padding-right:10px;">
                <a class="thecao_box_home" data-type="viettel"></a>
                <a class="thecao_box_home" data-type="mobifone"></a>
                <a class="thecao_box_home" data-type="vinaphone"></a>
                <a class="thecao_box_home" data-type="gate"></a>
                <a class="thecao_box_home" data-type="bitcoin"></a>
            </div>
            <div class="contentChuyenKhoan_home banktabcontent" id="chuyenkhoan" style="width: 570px; height: 220px; padding-top: 40px;padding-left:10px;padding-right:10px;">
                <table>
                    <tr>
                        <td>Chọn ngân hàng</td>
                        <td><input type="text" class="txtSideButton" /><input type="button" value="&#x025BE" style="font-size: 1.3em; padding: 0 2% 1% 2%;" class="sideButton"/></td>
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
            <div class="tigia banktabcontent" id="tigiacard">
                <span>Coming Soon.....</span>
            </div>
            
            <div class="banktabcontent" id="thecao_detail">
                <div class="listChonseLeft">
                    <div class="itemChonseLeft" data-type="viettel">Viettel <span></span></div>
                    <div class="itemChonseLeft" data-type="mobifone">Mobifone <span></span></div>
                    <div class="itemChonseLeft" data-type="vinaphone">Vinaphone <span></span></div>
                    <div class="itemChonseLeft" data-type="gate">Gate <span></span></div>
                    <div class="itemChonseLeft" data-type="bitcoin">BitCoin <span></span></div>
                    <div class="itemChonseLeft" data-type="zing">Zing <span></span></div>
                </div>
                <div class="formChonseRight">
                    <p>Mã thẻ cào</p>
                    <input type="text" id="pincard" style="width: 270px;">
                    
                    <p>Số serial</p>
                    <input type="text" id="serialcard" style="width: 270px;">
                    
                    <img alt="" id="cmdNapGem" src="/images/cmdNapngay.png"  style="width: 140px; margin-right: 15px;">
                    <img alt="" id="cmdChinhsachVIP" src="/images/cmdChinhsachVIP.png" style="width: 140px;">
                </div>
                <div class="clear"></div>
            </div>
    </div>
</div>
<script>
$('a.thecao_box_home').click(function () {
	var type = $(this).attr('data-type');
	$('.banktabcontent').hide();
	$('#thecao_detail').show();

	$('.itemChonseLeft').removeClass('itemChonsed');
	$('.itemChonseLeft').each(function (index) {
	    if (type == $(this).attr('data-type')) 
		    $(this).addClass('itemChonsed');
	});
});
$('.itemChonseLeft').click(function () {
	$('.itemChonseLeft').removeClass('itemChonsed');
	$(this).addClass('itemChonsed');
});

$('#cmdNapGem').click(function () {
	var pincode = $('#pincard').val();
	var serial = $('#serialcard').val();
	var type = $('.itemChonsed').attr('data-type');
	
    if (pincode == "") {
        alert("Vui lòng nhập mã thẻ cào.");
        return false;
    }
    if (serial == "") {
        alert("Vui lòng nhập số serial.");
        return false;
    }	
    
    $.post( "/getservice/napgem", { pincode: pincode, serial: serial, type: type, uid: Math.random() })
    .done(function(data) {
        //console.log(data);
        if (data.status == "00") {
            alert("Nạp thẻ thành công! \n" + data.amount + "VNĐ đã được nạp vào tài khoản.");
            $('._btClose').trigger('click');
        }else{
            alert(data.description);
        } 
	});	
});

$('.navItem_home a').click(function(){
	$('.banktabcontent').hide();
    $('.active').css({ 'width' : '', 'background-color' : '#250101','font-weight' : '','font-style' : ''});
    $('.active').removeClass('active');
    var widthMenu = $('.navMenu_home').width();
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
$('.navItem_home:nth-child(1) a').css({'background-color' : '#ec2c2c','font-weight' : '900','font-style' : 'italic','width': 590/2+'px','text-align': 'center'});

 $('#thecao').show();
$('#chuyenkhoan').hide();
$('#tigiacard').hide();
</script>