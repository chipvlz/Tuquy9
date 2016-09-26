<!DOCTYPE html>

<head>
<meta charset="utf-8">
<link href="css/style.css?v=1.0" rel="stylesheet" />
<link rel='stylesheet' id='ms_style_main-css'  href='css/masterslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='ms_template_staffcarousel-css'  href='css/ms-staff-style.css?ver=1.2' type='text/css' media='all' />

<script type='text/javascript' src='js/jquery-1.10.2.min.js'></script>

<script type='text/javascript' src='js/masterslider.min.js'></script>
<script type='text/javascript' src='js/masterslider.staff.carousel.js'></script>
	
<script src="js/responsive.js?v=1.0" defer="defer"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/load.js"></script>
<script type="text/javascript">	
function showpopup(boxpopup) {
	$.post( "/getpopup/" + boxpopup + "/" + Math.random(), function( data ) {
		$('.modal').fadeIn(300);
		$('#bodyModal').fadeOut(300, function(){
			$(this).html(data);
			$(this).fadeIn(300, function(){
				$("#username_login").focus();
				$("#fusername").focus();
				$("#username").focus();
			});
			
		});
	});
}

$(document).ready(function(){	
	$(".se-pre-con").fadeOut("slow");

    var slider = new MasterSlider();
	slider.setup('masterslider' , {
		loop:true,
		width:240,
		height:240,
		speed:20,
		view:'stf',
		preload:0,
		
		space:35,
		viewOptions:{centerSpace:1.6}
	});
	slider.control('arrows',{autohide:false});

	$('.btClose').click(function(){
		$(this).parent().fadeOut(300, function() {
			$('#bodyModal').html("");
		});
	});
	
	$( "#draggable" ).draggable({
		scroll: false
	});	
		
});
</script>  
</head>



<body scroll="no">
    <div class="container">
        <div id="wrap">
            <div id="content" class="resizeable disable-tuch">            	
                <div id="boxBanner">
                    <?php include_once 'header.php';?>                   
                </div>

                <div id="chosenGame">
    

		<div class="ms-staff-carousel ms-round">
			<div class="master-slider" id="masterslider">
			    <div class="ms-slide">
			        1  
			           
			    </div>
			    <div class="ms-slide">
			             2
			             
			    </div>
			    <div class="ms-slide">
			        
			             3          
			    </div>
			    <div class="ms-slide">
			        
			              4    
			    </div>
			    <div class="ms-slide">
			        5
			                     
			    </div>
			    <div class="ms-slide">
			        6
			                  
			    </div>
			    <div class="ms-slide">
			          
			         7
			    </div>
			     <div class="ms-slide">
			          8
			         
			    </div>
			    <div class="ms-slide">
			        9
			         
			    </div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		
</body>
</html>