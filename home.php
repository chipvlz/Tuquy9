<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Tuquy9 - Game bài online</title>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5, minimum-scale=0.3, user-scalable=no" />
    <meta name="Author" content="Tuquy9 App" />
    <link href="/css/animate.css?v=1.1" rel="stylesheet" />
    <link href="/css/style.css?v=1.03" rel="stylesheet" />    
	<script src="/js/jquery-1.10.2.min.js"></script>
	
	
    <script src="/js/socket.io/socket.io.js"></script>
    <script src="/js/moment.min.js"></script>
    <script type="text/javascript" src="/js/phaser.min.js"></script>
    
    
		
	<script src="/js/jquery-ui.js"></script>
	<script src="/js/jquery.ui.touch-punch.min.js"></script>
	<script src="/js/screenfull.min.js"></script>
    <script src="/js/responsive.js?v=1.0" defer="defer"></script>
    
    <link rel='stylesheet' id='ms_style_main-css'  href='/css/masterslider.css?ver=1.0' type='text/css' media='all' />
	<script type='text/javascript' src='/js/masterslider.min.js?ver=1.0'></script>	
    <script type='text/javascript' src='/js/masterslider.staff.carousel.js?ver=1.0'></script>	
    
    <script src="/js/jquery.scrollbar.min.js"></script>
    
    <script src="/js/load.js?v=1.03"></script>
    
    
</head>
<body scroll="no">    
    <div class="container">
    
        <div id="wrap">
            <div id="content" class="resizeable disable-tuch">            	
                <div id="boxBanner">
                    <?php include_once 'header.php';?>                   
                </div>
                <!-- tao popup-->


                 <!-- het tao popup-->
                <div id="chosenGame">
                    <div class="ms-staff-carousel ms-round">
						<div class="master-slider" id="masterslider">
						    <?php 
						    $sql = "SELECT * FROM gamelist WHERE id=2";
						    $rs = mysql_query($sql);
						    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
						    if ($row['actived']) {
						    ?>
                                <div class="ms-slide" data-sver="svertaixiu">
                                    <img alt="" src="images/icon_taixiu.png">
    						    </div>
						    <?php } ?>
						    
						    <?php 
						    $sql = "SELECT * FROM gamelist WHERE id=3";
						    $rs = mysql_query($sql);
						    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
						    if ($row['actived']) {
						    ?>						    
    						    <div class="ms-slide" data-sver="sver3caychuong">
                                    <img alt="" src="images/icon_3caychuong.png">                                
    						    </div>	
						    <?php }?>	
						    				    
						    <div class="ms-slide">
                                <img alt="" src="images/icon-coming.png">
						    </div>
						    <div class="ms-slide">
                                <img alt="" src="images/icon-coming.png">
						    </div>
						    <div class="ms-slide">
                                <img alt="" src="images/icon-coming.png">
						    </div>
						    
						    <?php 
						    $sql = "SELECT * FROM gamelist WHERE id=1";
						    $rs = mysql_query($sql);
						    $row = mysql_fetch_array($rs,MYSQL_ASSOC);
						    if ($row['actived']) {
						    ?>	
						    <div class="ms-slide" data-sver="sverpoker">
                                <img alt="" src="images/icon_minipoker.png">
						    </div>	
						    <?php }?>				    						    
						</div>
					</div>
					<div class="ms-nav-prev"></div>
					<div class="ms-nav-next"></div>
					<div class="mask-left"></div>
					<div class="mask-right"></div>
                </div>

				<!-- MODAL POPUP -->                
                <div class="modal">
                	<a href="javascript:;" class="_btClose"></a>
                	<div id="bodyModal">
                	   
                	</div>                  
                </div>               
				<!-- END MODAL POPUP -->   
                
                <div id="footerhome">
                    <div class="appversionnumber">VERSION 1.01</div>
                    <div class="hotlinenumber">Hotline : 0902.78.99.99 - 08.134.5678 </div>
                </div>
                
                <div id="historyBox" style="display: none; top: 160px; left: 120px; position: absolute; z-index: 99999999;">
                    <div class="hClButton">X</div>
                    <div class="hisheader">                		
                        <img src="/images/icon-history.png" align="absmiddle" /> LỊCH SỬ VÁN CHƠI		
                    </div>
                    <div class="hisContent"></div>
                </div>
                
                <div id="helpHowtoPlayTaixiu" style="display: none; width: 700px; height: 516px; top: 30px; left: 120px; position: absolute; z-index: 99999999; background: url('/images/cach-choi-taixiu.png') no-repeat; background-size: 100%;">
                	<div class="hClButton">X</div>
                </div>

                <!--popup mini poker-->

                <div id="quychetrathuongBox" style="display: none; top: 160px; left: 120px; position: absolute; z-index: 99999999;width: 940px; ">
                    <div class="hClButton">X</div>
                    <div class="hisheader">                     
                        <img src="/images/qctt_logo.png" align="absmiddle" style="margin-right: 10px;" />QUY CHẾ TRAO THƯỞNG       
                    </div>
                    <div class="hisContent" style="padding-right: 1%;">
                        
                        <div class="clear"></div>
                        
                        <div class="hisContentLeft">
                            <table class="hisTabHeader qcttGem" style="text-align: center; font-family: UTMAvoBold; font-size: 0.7em;">
                                <tr>
                                    <th style="width: 255px; border-right: 1px solid rgba(255,255,255,0.48)">NHÓM BÀI</th>
                                    <th style="width: 202px; border-right: 1px solid rgba(255,255,255,0.48)">MINH HỌA</th>
                                    <th style="width: 176px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 100 GEM</th>
                                    <th style="width: 176px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 1.000 GEM</th>
                                    <th style="width: 177px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 10.000 GEM</th>
									<th style="width:12px; border: none; background-color: rgba(255, 0, 0, .23);"></th>
                                </tr>
                            </table>
							<table class="hisTabHeader qcttXu" style="text-align: center; font-family: UTMAvoBold; font-size: 0.7em; display: none;">
                                <tr>
                                    <th style="width: 254px; border-right: 1px solid rgba(255,255,255,0.48)">NHÓM BÀI</th>
                                    <th style="width: 203px; border-right: 1px solid rgba(255,255,255,0.48)">MINH HỌA</th>
                                    <th style="width: 175px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 1000 XU</th>
                                    <th style="width: 176px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 10.000 XU</th>
                                    <th style="width: 176px; border-right: 1px solid rgba(255,255,255,0.48)">QUAY 100.000 XU</th>
									<th style="width:12px; border: none; background-color: rgba(255, 0, 0, .23);"></th>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="scrollbar-inner">
                            <div class="hisContentLeft">
                                <table class="hisTabDetail qcttGem" style="text-align: center; font-family: UTMAvoBold; font-size: 0.7em;">
                                    <tr style="border-top: none;">
                                        <td style="width: 250px; border-top: white solid 1px;">
											<p>Thùng phá sảnh J</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(nhóm 5 lá bài cùng chất từ 7 đén J)</p>
										</td>
                                        <td style="width: 190px; border-top: white solid 1px;"><img src="images/phasanhj.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
                                        <td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
										<td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Thùng phá sảnh</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(nhóm 5 lá bài cạnh nhau cùng chất)</p>
										</td>
                                        <td style="width: 190px"><img src="images/phasanh.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">100.000</td>
                                        <td style="width: 170px">1.000.000</td>
										<td style="width: 170px">10.000.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Tứ quý</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(4 lá bài giống nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/tuquy.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">15.000</td>
                                        <td style="width: 170px">150.000</td>
										<td style="width: 170px">1.500.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Cù lũ</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(bộ 3 cây giống nhau và 1 đôi)</p>
										</td>
                                        <td style="width: 190px"><img src="images/culu.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">5.000</td>
                                        <td style="width: 170px">50.000</td>
										<td style="width: 170px">500.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Thùng</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(5 lá bài cùng chất)</p>
										</td>
                                        <td style="width: 190px"><img src="images/thung.png" style="width: auto; height:80%;"></td>
										<td style="width: 170px">2.000</td>
                                        <td style="width: 170px">20.000</td>
										<td style="width: 170px">200.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Sảnh</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(5 lá bài cạnh nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/sanh.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">1.300</td>
                                        <td style="width: 170px">13.000</td>
										<td style="width: 170px">130.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Sám</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(3 lá bài giống nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/sam.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">800</td>
                                        <td style="width: 170px">8.000</td>
										<td style="width: 170px">80.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Hai đôi</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Có 2 đôi trong 5 lá bài)</p>
										</td>
                                        <td style="width: 190px"><img src="images/2doi.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">500</td>
                                        <td style="width: 170px">5.000</td>
										<td style="width: 170px">50.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Đôi J trở lên</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Có đôi J, đôi Q, đôi K, đôi A)</p>
										</td>
                                        <td style="width: 190px"><img src="images/doij.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">250</td>
                                        <td style="width: 170px">2.500</td>
										<td style="width: 170px">25.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Dưới đôi J</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Trong 5 lá bài có 1 đôi từ 2 đến 10)</p>
										</td>
                                        <td style="width: 190px"><img src="images/duoij.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">100</td>
                                        <td style="width: 170px">1.000</td>
										<td style="width: 170px">10.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
                                </table>
								<table class="hisTabDetail qcttXu" style="text-align: center; font-family: UTMAvoBold; font-size: 0.7em; display: none;">
									<tr style="border-top: none;">
                                        <td style="width: 250px; border-top: white solid 1px;">
											<p>Thùng phá sảnh J</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(nhóm 5 lá bài cùng chất từ 7 đén J)</p>
										</td>
                                        <td style="width: 190px; border-top: white solid 1px;"><img src="images/phasanhj.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
                                        <td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
										<td style="width: 170px; border-top: white solid 1px;">100% hũ</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Thùng phá sảnh</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(nhóm 5 lá bài cạnh nhau cùng chất)</p>
										</td>
                                        <td style="width: 190px"><img src="images/phasanh.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">1.000.000</td>
                                        <td style="width: 170px">10.000.000</td>
										<td style="width: 170px">100.000.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Tứ quý</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(4 lá bài giống nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/tuquy.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">150.000</td>
                                        <td style="width: 170px">1.500.000</td>
										<td style="width: 170px">15.000.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Cù lũ</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(bộ 3 cây giống nhau và 1 đôi)</p>
										</td>
                                        <td style="width: 190px"><img src="images/culu.png" style="width: auto; height:80%;"></td>
										<td style="width: 170px">50.000</td>
                                        <td style="width: 170px">500.000</td>
										<td style="width: 170px">5.000.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Thùng</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(5 lá bài cùng chất)</p>
										</td>
                                        <td style="width: 190px"><img src="images/thung.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">20.000</td>
                                        <td style="width: 170px">200.000</td>
										<td style="width: 170px">2.000.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Sảnh</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(5 lá bài cạnh nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/sanh.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">13.000</td>
                                        <td style="width: 170px">130.000</td>
										<td style="width: 170px">1.300.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Sám</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(3 lá bài giống nhau)</p>
										</td>
                                        <td style="width: 190px"><img src="images/sam.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">8.000</td>
                                        <td style="width: 170px">80.000</td>
										<td style="width: 170px">800.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Hai đôi</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Có 2 đôi trong 5 lá bài)</p>
										</td>
                                        <td style="width: 190px"><img src="images/2doi.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">5.000</td>
                                        <td style="width: 170px">50.000</td>
										<td style="width: 170px">500.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Đôi J trở lên</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Có đôi J, đôi Q, đôi K, đôi A)</p>
										</td>
                                        <td style="width: 190px"><img src="images/doij.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">2.500</td>
                                        <td style="width: 170px">25.000</td>
										<td style="width: 170px">250.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
									<tr>
                                        <td style="width: 250px;">
											<p>Dưới đôi J</p>
											<p style="font-family: UTMAvo; font-size: 0.8em;">(Trong 5 lá bài có 1 đôi từ 2 đến 10)</p>
										</td>
                                        <td style="width: 190px"><img src="images/duoij.png" style="width: auto; height:80%;"></td>
                                        <td style="width: 170px">1000</td>
                                        <td style="width: 170px">10.000</td>
										<td style="width: 170px">100.000</td>
										<td style="width:10px; border: none; background-color: rgba(255, 0, 0, .23);"></td>
                                    </tr>
								</table>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                       
                        <div class="clear"></div>
						<div style="height: 30px; padding-top: 10px; display:inline-block;"><span style="color: white; font-size: 0.8em; font-family: UTMAvoBold;">Khi người chơi quay vào nhóm bài nào sẽ nhận được thưởng tương đương.</span></div>
                        <div id="btXuSession" class="btnXuQCTT" style="float: right;"><img src="/images/icon_money2.png"><div><p>XU</p></div></div>
						<div id="btGemSession" class="btnGemQCTT active" style="float: right;"><img src="/images/icon_money1.png"><div><p>GEM</p></div></div>
                        <div class="clear"></div>
                    </div>
                </div>


                <div id="helpHowtoPlayPK" style="display: none; width: 700px; height: 516px; top: 30px; left: 120px; position: absolute; z-index: 99999999; background: url('/images/cach-choi-pk.png') no-repeat; background-size: 100%;">
                    <div class="hClButton">X</div>
                </div>

                <div id="rankingBoxPK">
                    <div class="hClButton">X</div>
                    <div class="rankingBoxTaixiuBody">                      
                        <div class="hisheader">                     
                            <img src="/images/icon-ranking.png" /> BẢNG XẾP HẠNG
                        </div>
                        <div class="rankingContentTaixiu">
                            <table class="hisTabDetail">
                                <tbody>
                                    <tr class="thead">
                                        <td style="width: 144px; text-align: center">Hạng</td>
                                        <td style="text-align: center">Tài khoản</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">Tiền tươi <p><em>(vnđ)</em></p></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">1</td>
                                        <td style="text-align: center">phuong_linh_hon</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">200. 000. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">2</td>
                                        <td style="text-align: center">Vivvv</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">1. 000. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">3</td>
                                        <td style="text-align: center">hieuboo6868</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">900. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">4</td>
                                        <td style="text-align: center">ytjyu68</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">800. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">5</td>
                                        <td style="text-align: center">vydebaohihi</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">700. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">6</td>
                                        <td style="text-align: center">DuyPham.ute</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">600. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">7</td>
                                        <td style="text-align: center">mrdungktv</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">500. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">8</td>
                                        <td style="text-align: center">mrdungktv</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">400. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">9</td>
                                        <td style="text-align: center">mrdungktv</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">300. 000</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">10</td>
                                        <td style="text-align: center">mrdungktv</td>
                                        <td style="width: 273px; text-align: center" class="noborderright">200. 000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div id="btGemSessionRanking"><img src="/images/icon_money1.png"><div><p>GEM</p></div></div>
                        <div id="btXuSessionRanking"><img src="/images/icon_money2.png"><div><p>XU</p></div></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!--end popup mini poker-->

                <div id="rankingBoxTaixiu">
                    <div class="hClButton">X</div>
                	<div class="rankingBoxTaixiuBody">                		
                		<div class="hisheader">                		
                			<img src="/images/icon-ranking.png" /> BẢNG XẾP HẠNG
                		</div>
                		<div class="rankingContentTaixiu" id="idrankingContentTaixiu">
                			
                		</div>
                		
                		<div id="btGemSessionRanking"><img src="/images/icon_money1.png"><div><p>GEM</p></div></div>
                		<div id="btXuSessionRanking"><img src="/images/icon_money2.png"><div><p>XU</p></div></div>
                		<div class="clear"></div>
                	</div>
                </div>

                <div id="chosenBetLevel">
                    <div class="hClButton">X</div>
                    <form method="post" id="bet3cayForm" action="/opengame/sver3caychuong">
                        <input type="hidden" id="bet3cayValue" name="bet3cayValue" />
                        <input type="hidden" id="bet3cayRoomLimit" name="bet3cayRoomLimit" />
                        <input type="hidden" id="bet3cayType" name="bet3cayType" value="9" />
						<input type="hidden" id="bet3cayRoomChannel" name="bet3cayRoomChannel" />
						<input type="hidden" id="token3cay" value="<?php echo tokenEncode($_SESSION["username"])?>" />
                    </form>                	
                	<div class="colLeftchatBox">
                		<label>Message</label>
                		<div class="chatBoxContent">
                			<div class="scrollbar-inner">
                				<div id="messgerBoxBody" style="height: 600px;"></div>
                			</div>
                		</div>
                		<div class="clear"></div>
                		<div class="line-opacity"></div>
                		
                		<input type="text" id="txtMessgerInput" placeholder="Cần tối thiểu 20G ...">
                		<button type="button" id="cmdSendMessger">Gửi</button>
                		<div class="clear"></div>	
                		
                		<div class="btnFiat activehover" id="cmdMessger">
                			<div class="iconFlat"></div>
                			<div class="textFlat">MESSAGE</div>
                			<div class="bgFlat"></div>
                		</div>
                		<div class="btnFiat" id="cmdFriend">
                			<div class="iconFlat"></div>
                			<div class="textFlat">BẠN BÈ</div>
                			<div class="bgFlat"></div>
                		</div>
                		<div class="btnFiat" id="cmdTopBigMoney">
                			<div class="iconFlat"></div>
                			<div class="textFlat">TOP ĐẠI GIA</div>
                			<div class="bgFlat"></div>
                		</div>		
                	</div>
                	<div class="colRightBetLevel">
                		<div class="header3caychuong">
                			<div class="contentHeader3cay">
                				<div class="txtHeader3cay">BA CÂY CHƯƠNG</div>
                				<div id="btnHeader3cayGem" class="btnActive"> 
                					<div class="iconHeader3cay"></div>
                					<span>GEM</span>
                				</div>
                				<div id="btnHeader3cayXu">
                					<div class="iconHeader3cay"></div>
                					<span>XU</span>
                				</div>
                				<div class="clear"></div>
                			</div>
                		</div>
                		<div class="line-gradian"></div>
                		
                		<div class="btnBetLevel" data-betvalue="5000" data-betroomlimit="5K">
                			<div class="textBet">5k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="10000" data-betroomlimit="10K">
                			<div class="textBet">10k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="20000" data-betroomlimit="20K">
                			<div class="textBet">20k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="30000" data-betroomlimit="30K">
                			<div class="textBet">30k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="50000" data-betroomlimit="50K">
                			<div class="textBet">50k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="65000" data-betroomlimit="65K">
                			<div class="textBet">65k</div>
                		</div>
                		<div class="btnBetLevel" data-betvalue="100000" data-betroomlimit="100K">
                			<div class="textBet">100k</div>
                		</div>
                		<div class="btnBetLevel deactived" data-betvalue="250000" data-betroomlimit="250K">
                			<div class="textBet">250k</div>
                		</div>		
                		<div class="btnBetLevel deactived" data-betvalue="500000" data-betroomlimit="500K">
                			<div class="textBet">500k</div>
                		</div>
                	</div>
                	<div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="se-pre-con_"></div>
    <div id="fullscreenIcon"></div>
    
    <?php if ($_SESSION['islogin']) { ?>
    
    <script type="text/javascript">
    openGame("sverpoker");

    //$("#historyBox").draggable({scroll: false});
//     $('.scrollbar-inner').scrollbar();
//     $('.hClButton').click(function () {
//         $(this).closest('#historyBox').hide();
//         });
    </script>
        
    <?php } ?>
    <script type="text/javascript">
    $("#historyBox, #helpHowtoPlayTaixiu, #rankingBoxTaixiu,#rankingBoxPK, #quychetrathuongBox").draggable({scroll: false});
    $('.scrollbar-inner').scrollbar();
    $('.hClButton').click(function () {
        $(this).parent().hide();
    });
    $("#btnHeader3cayGem").click(function() {
    	$("#bet3cayType").val(9);
    	$(this).addClass("btnActive");
    	$("#btnHeader3cayXu").removeClass("btnActive");
    });
    $("#btnHeader3cayXu").click(function() {
    	$("#bet3cayType").val(6);
    	$(this).addClass("btnActive");
    	$("#btnHeader3cayGem").removeClass("btnActive");
    });

    $(".btnBetLevel:not('.deactived')").click(function () {
        var _this = $(this);
		var socket = io.connect('http://115.84.183.203:9394');
		var userToken = $('#token3cay').val();
		var channel_main = 'main_c3c_channel';
		var channel;
		var betValue = _this.data("betvalue");
		var betroomlimit = _this.data("betroomlimit");
		var betType = $('#bet3cayType').val();
		console.log(userToken);
		console.log(betValue);
		console.log(betroomlimit);
		console.log(betType);

		socket.on(channel_main,function(data){
			console.log(data);
			if (data.type == 2) {
				if (data.findRoomResponse != null) {
					$("#chosenBetLevel").hide();
					channel = data.findRoomResponse.roomId;
					socket.emit('disconnect');
					socket.disconnect();
					$("#bet3cayValue").val(betValue);
        			$("#bet3cayRoomLimit").val(betroomlimit);
					$("#bet3cayRoomChannel").val(channel);
        			$("#bet3cayForm").submit();
				}
			}
		});

		var jsonObject = {
        "userId": userToken,
        "betRoomLimit": betroomlimit,
        "type": betType,
        "requestType": 50
    	};
    	socket.emit(channel_main, jsonObject);
    });

	$('#btGemSession.btnGemHis').click(function(){
		$('.gemHis').show();
		$('.xuHis').hide();
		$(this).addClass('active');
		$('#btXuSession.btnXuHis').removeClass('active');
	});

	$('#btXuSession.btnXuHis').click(function(){
		$('.gemHis').hide();
		$('.xuHis').show();
		$(this).addClass('active');
		$('#btGemSession.btnGemHis').removeClass('active');
	});

	$('#btGemSession.btnGemQCTT').click(function(){
		$('.qcttGem').show();
		$('.qcttXu').hide();
		$(this).addClass('active');
		$('#btXuSession.btnXuQCTT').removeClass('active');
	});

	$('#btXuSession.btnXuQCTT').click(function(){
		$('.qcttGem').hide();
		$('.qcttXu').show();
		$(this).addClass('active');
		$('#btGemSession.btnGemQCTT').removeClass('active');
	});
    </script>
 <!--script popup minipk
    <script type="text/javascript">
    $("#historyBox, #helpHowtoPlayTaixiu, #rankingBoxTaixiu").draggable({scroll: false});
    $('.scrollbar-inner').scrollbar();
    $('.hClButton').click(function () {
        $(this).parent().hide();
    });
    $("#btnHeader3cayGem").click(function() {
        $("#bet3cayType").val(9);
        $(this).addClass("btnActive");
        $("#btnHeader3cayXu").removeClass("btnActive");
    });
    $("#btnHeader3cayXu").click(function() {
        $("#bet3cayType").val(6);
        $(this).addClass("btnActive");
        $("#btnHeader3cayGem").removeClass("btnActive");
    });
    $(".btnBetLevel:not('.deactived')").click(function () {
        $("#chosenBetLevel").hide();
        var _this = $(this);
        $("#bet3cayValue").val(_this.data("betvalue"));
        $("#bet3cayRoomLimit").val(_this.data("betroomlimit"));
        $("#bet3cayForm").submit();
    });
    </script>-->
</body>
</html>
