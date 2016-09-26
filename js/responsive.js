(function(d)
	{
	var f=
		{
	}
	,bt=
		{
		width:1000,height:580,minScale:0.3,maxScale:1.2
	};
	f.wrap=$('.container #wrap');
	f.canvas=$('canvas');
	f.content=$('.resizeable');
	d.onResize=function()
		{
		try
			{
			f.content=$('.resizeable');
			var e=d.innerWidth||document.body.clientWidth||document.documentElement.clientWidth,t=d.innerHeight||document.body.clientHeight||document.documentElement.clientHeight;
			var n=bt.width,r=bt.height;
			var a=Math.min(e/n,t/r),a=Math.max(a,bt.minScale),a=Math.min(a,bt.maxScale);
			var b='zoom';
			d.currentZoom=a;
			f.wrap.css('width',(a*n)+'px');
			f.wrap.css('height',(a*r)+'px');
			if(f.content&&void 0===f.content[0].style.zoom||navigator.userAgent.match(/(edge|msie|opera|iphone|ipod|ipad|android)/gi))
				{
				var o="translate(-50%, -50%) scale("+a+") translate(50%, 50%)";
				f.content.css("-webkit-transform",o);
				f.content.css("-moz-transform",o);
				f.content.css("-ms-transform",o);
				f.content.css("-o-transform",o);
				f.content.css("transform",o);
				b='transform'
			}
			else if(f.content)
				{
				f.content.css("zoom",a)
			}
//			if(f.canvas)
//				{
//				f.canvas.css('width',a*bt.width);
//				f.canvas.css('height',a*bt.height);
//				f.canvas.css('background-size',a*bt.width+'px '+a*bt.height+'px')
//			}
			var c=$('#iframe');
			if(c.length>0)
				{
				c[0].contentWindow.postMessage(
					{
					key:'resize',zoom:a,type:b
				}
				,'*')
			}
		}
		catch(e)
			{
			console.log("Resize error!",e)
		}
	};
	$(document).ready(function()
		{
		$(d).resize(onResize);
		$(d).trigger('resize')
	}
	)
}
)(this);