<div class="modalcontainer" style="width: 700px; margin-top: 20px;">
    <span class="modal_title">Đổi thưởng</span>
    <!--body of popup-->
    <div class="divinput" style="width: 590px; height: 390px; padding-left:10px; padding-right:10px;padding-bottom:0dp;background: url('../images/rectang_f.png') no-repeat; background-size: 100%;">
            <ul class="navMenu_home">
                <li class="navItem_home"><a href="javascript:;" rel="tabQuyche" style="padding: 5px 0;">Quy chế đổi</a></li>
                <li class="navItem_home"><a href="javascript:;" rel="tabThecao" style="padding: 5px 0;">Thẻ cào</a></li>
                <li class="navItem_home"><a href="javascript:;" rel="tabChuyenkhoan" style="padding: 5px 0;">Chuyển khoản</a></li>
                <li class="navItem_home"><a href="javascript:;" rel="tabLichsu" style="padding: 5px 0;">Lịch sử</a></li>
            </ul>
            
            <div class="contentTheCao_home banktabcontent" id="tabQuyche">
                <img alt="" src="/images/quy_che_doi_thuong.png" style="width: 600px;">
            </div>
            
            <div class="contentChuyenKhoan_home banktabcontent" id="tabThecao">
                2
            </div>
            
            <div class="tigia banktabcontent" id="tabChuyenkhoan">
                3
            </div>
            
            <div class="banktabcontent" id="tabLichsu">
                4
            </div>
    </div>
</div>
<script>
$('.navItem_home a').click(function(){
	$('.navItem_home a').removeClass("focusedTab");
	$(this).addClass("focusedTab");

	$(this).closest('div').find('div').hide();
	$(this).closest('div').find('#' + $(this).attr('rel')).show();
});
$('.navItem_home:nth-child(1) a').addClass('focusedTab');
$('#tabQuyche').show();
</script>