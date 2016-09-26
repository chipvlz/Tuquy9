<?php 
 if (!$_SESSION['islogin']) { ?>
    <div class="cmdButton">
    	<a href="javascript:;" id="cmdLogin">ĐĂNG NHẬP</a>                    	
    </div>
    <div class="cmdButton">
    	<a href="javascript:;" id="cmdRegister">ĐĂNG KÝ</a>                    	
    </div>
<?php }else{ ?>
    <div class="cmdButton" style="width: 50px; margin-left: 10px;">
    	<a href="javascript:;" id="cmdLogout">
    	   <img alt="" src="data:image/png;base64,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" style="width: 40px; height: 40px; margin-top: 5px;">
    	</a>                    	
    </div>
    <div id="box_avatar" style="background-image: url('<?php echo ($_SESSION['avatar'] != "" ? $_SESSION['avatar'] : "avatar/default.png")?>')"></div>
    <div id="box_profileinfo"><?php echo $_SESSION['username']?></div>
    <div id="box_virtualmoney" class="box_money">
        <label><?php echo number_format($_SESSION['virtualmoney'])?></label>
        <a href="javascript:;" class="btn_addmoney"></a>
    </div>
    <div id="box_realmoney" class="box_money">
        <label><?php echo number_format($_SESSION['realmoney'])?></label>
        <a href="javascript:;" class="btn_addmoney"></a>
    </div>
<?php }?>

<div class="cmdShare">
	<a href="javascript:;" id="cmdHouseMoney"></a>                    	
</div>
<div class="cmdShare">
	<a href="https://www.facebook.com/Game-b%C3%A0i-T%E1%BB%A9-qu%C3%BD-9-525943014251817" id="cmdFacebook"></a>                    	
</div>
<div class="cmdShare">
	<a href="javascript:;" id="cmdDoithuong"></a>                    	
</div>
<div class="clear"></div>
<?php if (!$_SESSION['islogin']) { ?>
    <div id="imglogo">
    <iframe src="/images/logo11.html" style="width: 250px;height: 180px; border: none"></iframe>
    </div> 
<?php }?>
<script>
$('#cmdLogin').click(function(e){
	e.preventDefault();
    e.stopPropagation();
	showpopup("login");
});
$('#cmdRegister').click(function(e){
	e.preventDefault();
    e.stopPropagation();
	showpopup("register");
});

$("#cmdLogout").click(function(e){
	e.preventDefault();
    e.stopPropagation();
    showpopup("confimlogout");
});

//napgem popup - qkm 
$(".btn_addmoney").click(function(e){
	e.preventDefault();
    e.stopPropagation();
    showpopup("napgem");
});
$("#cmdHouseMoney").click(function(e){
	e.preventDefault();
    e.stopPropagation();
    showpopup("napgem");
});
$("#cmdDoithuong").click(function(e){
	e.preventDefault();
    e.stopPropagation();
    showpopup("doithuong");
});
//taikhoan popup - qkm
$("#box_avatar").click(function(e){
	e.preventDefault();
    e.stopPropagation();
    showpopup("taikhoan");
});

</script>