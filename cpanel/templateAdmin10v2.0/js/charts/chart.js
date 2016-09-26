$(function () {
    var sin = [], cos = [];
    for (var i = 0; i < 21; i += 0.5) {
        sin.push([i, i*2]);
        cos.push([i, Math.cos(i)]);
    }

    var plot = $.plot($(".chart"),
           [ { data: sin, label: "Đăng ký"}, { data: cos, label: "Đăng nhập" } ], {
               series: {
                   lines: { show: true },
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true },
               yaxis: { min: 0, max: 45 },
			   xaxis: { min: 0, max: 20 }
             });

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
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    showTooltip(item.pageX, item.pageY,
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        }
    });

    $('input[type="button"]').click(function() {
    	alert(daydiff(parseDate($('#fromDate').val()), parseDate($('#toDate').val())));
    });

//    $(".chart").bind("plotclick", function (event, pos, item) {
//        if (item) {
//            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
//            plot.highlight(item.series, item.datapoint);
//        }
//    });
});
