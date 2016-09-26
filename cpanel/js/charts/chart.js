$(function () {
	
	function drawChart(string) {
		var objok = JSON.parse(string);
		
		
		var maxx = objok.countdays - 1;
		var maxy = objok.maxy;
		var dk = objok.listdangky;
		var dn = objok.listdangnhap;
    	//console.log(dk);
    	var dangky = [], dangnhap = [];
        for (var i = 0; i <= maxx; i ++) {
        	//dangky.push([i, maxy-i]);
        	dangky.push([i, (dk[i]==null?0:dk[i])]);
        	dangnhap.push([i, (dn[i]==null?0:dn[i])]);
        }
//console.log(dangky);
        var plot = $.plot($(".chart"),
    	           [ { data: dangky, label: "Đăng ký"}, { data: dangnhap, label: "Đăng nhập" } ], {
    	               series: {
    	                   lines: { show: true },
    	                   points: { show: true }
    	               },
    	               grid: { hoverable: true, clickable: true },
    	               yaxis: { min: 0, max: maxy },
    				   xaxis: { min: 0, max: maxx }
    	             });
	}
	
    function showTooltip(x, y, contents) {
        $('<div id="tooltip" class="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
			'z-index': '9999',
			'color': '#fff',
			'font-size': '11px',
            opacity: 0.8
        }).appendTo("body").fadeIn(200);
    }

    function parseDate(str) {
        var mdy = str.split('/');
        return new Date(mdy[2], mdy[0]-1, mdy[1]);
    }

    function daydiff(first, second) {
        return Math.round((second-first)/(1000*60*60*24));
    }
    
    
    var previousPoint = null;
    $(".chart").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));

        if ($(".chart").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];
                    var fromDate = parseDate($('#fromDate').val());
                    fromDate.setDate(fromDate.getDate() + x);
                    
                    showTooltip(item.pageX, item.pageY,
                                item.series.label + ": Ngày " + fromDate.getDate() + '/' + (fromDate.getMonth() + 1) + '/' +  fromDate.getFullYear() + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        }
    });

    $('input[type="button"]').click(function() {
    	if ($('#fromDate').val() == '' || $('#toDate').val() == '') {
    		alert("Chưa nhập khoảng thời gian cần xem");
    		return false;
    	}
    	
    	$.ajax({
            url: "/getservice/ccu",
            type: "POST",
            data: {fromDate: $('#fromDate').val(), toDate: $('#toDate').val()},
            success: function (result) {
            	//alert(result);
            	drawChart(result);            	
            },
            error: function (result) {
                alert("Lỗi???\n" + result);
            }
        });
    	
    	
    });

//    $(".chart").bind("plotclick", function (event, pos, item) {
//        if (item) {
//            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
//            plot.highlight(item.series, item.datapoint);
//        }
//    });
});
