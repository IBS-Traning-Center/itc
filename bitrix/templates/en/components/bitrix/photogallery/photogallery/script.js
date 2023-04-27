if (typeof jsUtils != "object")
{
	var jsUtils =
	{
		arEvents: Array(),
	
		addEvent: function(el, evname, func, capture)
		{
			if(el.attachEvent) // IE
				el.attachEvent("on" + evname, func);
			else if(el.addEventListener) // Gecko / W3C
				el.addEventListener(evname, func, false);
			else
				el["on" + evname] = func;
			this.arEvents[this.arEvents.length] = {'element': el, 'event': evname, 'fn': func};
		},
	
		removeEvent: function(el, evname, func)
		{
			if(el.detachEvent) // IE
				el.detachEvent("on" + evname, func);
			else if(el.removeEventListener) // Gecko / W3C
				el.removeEventListener(evname, func, false);
			else
				el["on" + evname] = null;
		},
	
		removeAllEvents: function(el)
		{
			for(var i in this.arEvents)
			{
				if(this.arEvents[i] && (el==false || el==this.arEvents[i].element))
				{
					jsUtils.removeEvent(this.arEvents[i].element, this.arEvents[i].event, this.arEvents[i].fn);
					this.arEvents[i] = null;
				}
			}
			if(el==false)
				this.arEvents.length = 0;
		 },
	
		GetRealPos: function(el)
		{
			if(!el || !el.offsetParent)
				return false;
			var res = [];
			res["left"] = el.offsetLeft;
			res["top"] = el.offsetTop;
			var objParent = el.offsetParent;
			while(objParent && objParent.tagName != "BODY")
			{
				res["left"] += objParent.offsetLeft;
				res["top"] += objParent.offsetTop;
				objParent = objParent.offsetParent;
			}
			res["right"]=res["left"] + el.offsetWidth;
			res["bottom"]=res["top"] + el.offsetHeight;
	
			return res;
		},
	
		FindChildObject: function(obj, tag_name, class_name, recursive)
		{
			if(!obj)
				return null;
			var tag = tag_name.toUpperCase();
			var cl = (class_name? class_name.toLowerCase() : null);
			var n = obj.childNodes.length;
			for(var j=0; j<n; j++)
			{
				var child = obj.childNodes[j];
				if(child.tagName && child.tagName.toUpperCase() == tag)
					if(!class_name || child.className.toLowerCase() == cl)
						return child;
				if(recursive == true)
				{
					var deepChild;
					if((deepChild = jsUtils.FindChildObject(child, tag_name, class_name, true)))
						return deepChild;
				}
			}
			return null;
		},
	
		FindParentObject: function(obj, tag_name, class_name)
		{
			if(!obj)
				return null;
			var o = obj;
			var tag = tag_name.toUpperCase();
			var cl = (class_name? class_name.toLowerCase() : null);
			while(o.parentNode)
			{
				var parent = o.parentNode;
				if(parent.tagName && parent.tagName.toUpperCase() == tag)
					if(!class_name || parent.className.toLowerCase() == cl)
						return parent;
				o = parent;
			}
			return null;
		},
	
		FindNextSibling: function(obj, tag_name)
		{
			if(!obj)
				return null;
			var o = obj;
			var tag = tag_name.toUpperCase();
			while(o.nextSibling)
			{
				var sibling = o.nextSibling;
				if(sibling.tagName && sibling.tagName.toUpperCase() == tag)
					return sibling;
				o = sibling;
			}
			return null;
		},
	
		FindPreviousSibling: function(obj, tag_name)
		{
			if(!obj)
				return null;
			var o = obj;
			var tag = tag_name.toUpperCase();
			while(o.previousSibling)
			{
				var sibling = o.previousSibling;
				if(sibling.tagName && sibling.tagName.toUpperCase() == tag)
					return sibling;
				o = sibling;
			}
			return null;
		},
	
		IsIE: function()
		{
			return (document.attachEvent && !this.IsOpera());
		},
	
		IsOpera: function()
		{
			return (navigator.userAgent.toLowerCase().indexOf('opera') != -1);
		},
	
		ToggleDiv: function(div)
		{
			var style = document.getElementById(div).style;
			if(style.display!="none")
				style.display = "none";
			else
				style.display = "block";
			return (style.display != "none");
		},
	
		urlencode: function(s)
		{
			return escape(s).replace(new RegExp('\\+','g'), '%2B');
		},
	
		OpenWindow: function(url, width, height)
		{
			var w = screen.width, h = screen.height;
			if(this.IsOpera())
			{
				w = document.body.offsetWidth;
				h = document.body.offsetHeight;
			}
			window.open(url, '', 'status=no,scrollbars=yes,resizable=yes,width='+width+',height='+height+',top='+Math.floor((h - height)/2-14)+',left='+Math.floor((w - width)/2-5));
		},
	
		SetPageTitle: function(s)
		{
			document.title = phpVars.titlePrefix+s;
			var h1 = document.getElementsByTagName("H1");
			if(h1)
				h1[0].innerHTML = s;
		},
	
		LoadPageToDiv: function(url, div_id)
		{
			var div = document.getElementById(div_id);
			if(!div)
				return;
			CHttpRequest.Action = function(result)
			{
				CloseWaitWindow();
				document.getElementById(div_id).innerHTML = result;
			}
			ShowWaitWindow();
			CHttpRequest.Send(url);
		},
	
		trim: function(s)
		{
			var r, re;
			re = /^[ \r\n]+/g;
			r = s.replace(re, "");
			re = /[ \r\n]+$/g;
			r = r.replace(re, "");
			return r;
		},
	
		Redirect: function(args, url)
		{
			var e = null, bShift = false;
			if(args.length > 0)
				e = args[0];
			if(!e)
				e = window.event;
			if(e)
				bShift = e.shiftKey;
	
			if(bShift)
				window.open(url);
			else
			{
				ShowWaitWindow();
				window.location=url;
			}
		},
	
		False: function(){return false;},
	
		AlignToPos: function(pos, w, h)
		{
			var x = pos["left"], y = pos["bottom"];
	
			var body = document.body;
			if((body.clientWidth + body.scrollLeft) - (pos["left"] + w) < 0)
			{
				if(pos["right"] - w >= 0 )
					x = pos["right"] - w;
				else
					x = body.scrollLeft;
			}
	
			if((body.clientHeight + body.scrollTop) - (pos["bottom"] + h) < 0)
			{
				if(pos["top"] - h >= 0)
					y = pos["top"] - h;
				else
					y = body.scrollTop;
			}
	
			return {'left':x, 'top':y};
		},
	
		// evaluate js string in window scope
		EvalGlobal: function(script)
		{
			if (window.execScript)
				window.execScript(script, 'javascript');
			else
				window.eval(script);
		},
	
		GetStyleValue: function(el, styleProp)
		{
			if(el.currentStyle)
				var res = el.currentStyle[styleProp];
			else if(window.getComputedStyle)
				var res = document.defaultView.getComputedStyle(el, null).getPropertyValue(styleProp);
			return res;
		},
		
		arCustomEvents: {},
	
		addCustomEvent: function(eventName, eventHandler, arParams, handlerContextObject)
		{
			if (!this.arCustomEvents[eventName])
				this.arCustomEvents[eventName] = [];
	
			if (!arParams)
				arParams = [];
	
			this.arCustomEvents[eventName].push(
				{
					handler: eventHandler,
					arParams: arParams,
					obj: handlerContextObject
				}
			);
		},
	
		removeCustomEvent: function(eventName, eventHandler)
		{
			if (!this.arCustomEvents[eventName])
				return;
	
			for (var i = 0, l = this.arCustomEvents[eventName].length; i < l; i++)
			{
				if (this.arCustomEvents[eventName][i].handler == eventHandler)
				{
					delete this.arCustomEvents[eventName][i];
					return;
				}
			}
	
			return;
		},
	
		onCustomEvent: function(eventName, arEventParams)
		{
			if (!this.arCustomEvents[eventName])
				return;
	
			if (!arEventParams)
				arEventParams = [];
	
			var h;
			for (var i = 0, l = this.arCustomEvents[eventName].length; i < l; i++)
			{
				h = this.arCustomEvents[eventName][i];
				if (!h.handler)
					continue;
	
				if (h.obj)
					h.handler.call(h.obj, h.arParams, arEventParams);
				else
					h.handler(h.arParams, arEventParams);
			}
		}
	}
}
jsUtils.LoadPageToDiv = function(url, div_id)
{
	var div = document.getElementById(div_id);
	if(!div)
		return;
	CHttpRequest.Action = function(result)
	{
		PCloseWaitMessage();
		document.getElementById(div_id).innerHTML = result;
	}
	PShowWaitMessage();
	CHttpRequest.Send(url);
};
jsUtils.Redirect = function(args, url)
{
	var e = null, bShift = false;
	if(args.length > 0)
		e = args[0];
	if(!e)
		e = window.event;
	if(e) 
		bShift = e.shiftKey;

	if(bShift) 
		window.open(url); 
	else 
	{
		PShowWaitMessage();
		window.location=url;
	}
};
jsUtils.GetBodySize = function()
{
	var res = jsUtils.GetWindowSize();
	return 	{"width" : res["scrollWidth"], "height" : res["scrollHeight"]};
};
jsUtils.GetWindowSize = function()
{
	var innerWidth, innerHeight;

	if (self.innerHeight) // all except Explorer
	{
		innerWidth = self.innerWidth;
		innerHeight = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight) // Explorer 6 Strict Mode
	{
		innerWidth = document.documentElement.clientWidth;
		innerHeight = document.documentElement.clientHeight;
	}
	else if (document.body) // other Explorers
	{
		innerWidth = document.body.clientWidth;
		innerHeight = document.body.clientHeight;
	}

	var scrollLeft, scrollTop;
	if (self.pageYOffset) // all except Explorer
	{
		scrollLeft = self.pageXOffset;
		scrollTop = self.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop) // Explorer 6 Strict
	{
		scrollLeft = document.documentElement.scrollLeft;
		scrollTop = document.documentElement.scrollTop;
	}
	else if (document.body) // all other Explorers
	{
		scrollLeft = document.body.scrollLeft;
		scrollTop = document.body.scrollTop;
	}

	var scrollWidth, scrollHeight;

	if ( (document.compatMode && document.compatMode == "CSS1Compat"))
	{
		scrollWidth = document.documentElement.scrollWidth;
		scrollHeight = document.documentElement.scrollHeight;
	}
	else
	{
		if (document.body.scrollHeight > document.body.offsetHeight)
			scrollHeight = document.body.scrollHeight;
		else
			scrollHeight = document.body.offsetHeight;

		if (document.body.scrollWidth > document.body.offsetWidth || 
			(document.compatMode && document.compatMode == "BackCompat") ||
			(document.documentElement && !document.documentElement.clientWidth)
		)
			scrollWidth = document.body.scrollWidth;
		else
			scrollWidth = document.body.offsetWidth;
	}

	return  {"innerWidth" : innerWidth, "innerHeight" : innerHeight, "scrollLeft" : scrollLeft, "scrollTop" : scrollTop, "scrollWidth" : scrollWidth, "scrollHeight" : scrollHeight};
};
var jsUtilsPhoto = jsUtils;
/************************************************/

function pJCFloatDiv() 
{
	var _this = this;
	this.floatDiv = null;
	this.x = this.y = 0;

	this.Show = function(div, left, top, dxShadow, bSubstrate, bIframe)
	{
		var zIndex = parseInt(div.style.zIndex);
		if(zIndex <= 0 || isNaN(zIndex))
			zIndex = 100;
		div.style.zIndex = zIndex;
		div.style.left = left + "px";
		div.style.top = top + "px";

		if(jsUtilsPhoto.IsIE() && bIframe != "N")
		{
			var frame = document.getElementById(div.id+"_frame");
			if(!frame)
			{
				frame = document.createElement("IFRAME");
				frame.src = "javascript:''";
				frame.id = div.id+"_frame";
				frame.style.position = 'absolute';
				frame.style.zIndex = zIndex-1;
				document.body.appendChild(frame);
			}
			frame.style.width = div.offsetWidth + "px";
			frame.style.height = div.offsetHeight + "px";
			frame.style.left = div.style.left;
			frame.style.top = div.style.top;
			frame.style.visibility = 'visible';
		}

		/*shadow*/
		if(isNaN(dxShadow))
			dxShadow = 5;
		if(dxShadow > 0)
		{
			var img = document.getElementById(div.id+'_shadow');
			if(!img)
			{
				if(jsUtilsPhoto.IsIE())
				{
		 			img = document.createElement("DIV");
		 			img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+photoVars.templatePath+"images/shadow.png',sizingMethod='scale')";
				}
				else
				{
		 			img = document.createElement("IMG");
					img.src = photoVars.templatePath + 'images/shadow.png';
				}
				img.id = div.id+'_shadow';
				img.style.position = 'absolute';
				img.style.zIndex = zIndex-2;
				document.body.appendChild(img);
			}
			img.style.width = div.offsetWidth+'px';
			img.style.height = div.offsetHeight+'px';
			img.style.left = parseInt(div.style.left)+dxShadow+'px';
			img.style.top = parseInt(div.style.top)+dxShadow+'px';
			img.style.visibility = 'visible';
		}
		
		if (bSubstrate != "N")
		{
			var substrate = document.getElementById("photo_substrate");
			if(!substrate)
			{
				substrate = document.createElement("DIV");
				substrate.id = 	"photo_substrate";
				substrate.style.zIndex = zIndex-3;
				substrate.style.position = 	'absolute';
				substrate.style.display = 'none';
				substrate.style.visibility = 'hidden';
				substrate.style.background = 'white';
				substrate.style.opacity = '0.5';
				if (substrate.style.MozOpacity)
					substrate.style.MozOpacity = '0.5';
				else if (substrate.style.KhtmlOpacity)
					substrate.style.KhtmlOpacity = '0.5';
				if (jsUtilsPhoto.IsIE())
				{
			 		substrate.style.filter += "progid:DXImageTransform.Microsoft.Alpha(opacity=50)";
				}
				document.body.appendChild(substrate);
			}
			substrate.style.display = 'block';
			substrate.style.left = 0;
			substrate.style.top = 0;
			var WindowSize = jsUtilsPhoto.GetWindowSize();
			substrate.style.width = WindowSize["scrollWidth"] + "px";
			substrate.style.height = WindowSize["scrollHeight"] + "px";
			substrate.style.visibility = 'visible';
		}
	}
		
	this.Close = function(div)
	{
		if(!div)
			return;
		var sh = document.getElementById(div.id+"_shadow");
		if(sh)
			sh.style.visibility = 'hidden';

		var frame = document.getElementById(div.id+"_frame");
		if(frame)
			frame.style.visibility = 'hidden';
			
		var substrate = document.getElementById("photo_substrate");
		if(substrate)
		{
			substrate.style.display = 'none';
			substrate.style.visibility = 'hidden';
		}
	}
		
	this.Move = function(div, x, y, dxShadow)
	{
		if(!div)
			return;
			
		var left = parseInt(div.style.left)+x;
		var top = parseInt(div.style.top)+y;
		div.style.left = left+'px';
		div.style.top = top+'px';

		this.AdjustShadow(div, dxShadow);
	}
	
	this.AdjustShadow = function(div, dxShadow)
	{
		var sh = document.getElementById(div.id+"_shadow");
		if(sh)
		{
			if(isNaN(dxShadow))
				dxShadow = 5;

			sh.style.width = div.offsetWidth+'px';
			sh.style.height = div.offsetHeight+'px';
			sh.style.left = parseInt(div.style.left)+dxShadow+'px';
			sh.style.top = parseInt(div.style.top)+dxShadow+'px';
		}

		var frame = document.getElementById(div.id+"_frame");
		if(frame)
		{
			frame.style.width = div.offsetWidth + "px";
			frame.style.height = div.offsetHeight + "px";
			frame.style.left = div.style.left;
			frame.style.top = div.style.top;
		}
	}

	this.StartDrag = function(e, div)
	{
		if(!e)
			e = window.event;
		this.x = e.clientX + document.body.scrollLeft;
		this.y = e.clientY + document.body.scrollTop;
		this.floatDiv = div;

		jsUtilsPhoto.addEvent(document, "mousemove", this.MoveDrag);
		document.onmouseup = this.StopDrag;
		if(document.body.setCapture)
			document.body.setCapture();
		
		var b = document.body;
	    b.ondrag = jsUtilsPhoto.False;
	    b.onselectstart = jsUtilsPhoto.False;
	    b.style.MozUserSelect = _this.floatDiv.style.MozUserSelect = 'none';
	    b.style.cursor = 'move';
    }

	this.StopDrag = function(e)
	{
		if(document.body.releaseCapture)
			document.body.releaseCapture();
		
		jsUtilsPhoto.removeEvent(document, "mousemove", _this.MoveDrag);
		document.onmouseup = null;
		this.floatDiv = null;

		var b = document.body;
		b.ondrag = null;
		b.onselectstart = null;
		b.style.MozUserSelect = _this.floatDiv.style.MozUserSelect = '';
	    b.style.cursor = '';
	}

	this.MoveDrag = function(e)
	{
		var x = e.clientX + document.body.scrollLeft;
		var y = e.clientY + document.body.scrollTop;
		if(_this.x == x && _this.y == y)
			return;
	
		_this.Move(_this.floatDiv, (x - _this.x), (y - _this.y));
		_this.x = x;
		_this.y = y;
	}
}
var pjsFloatDiv = new pJCFloatDiv();

/************************************************/

function PhotoPopupMenu()
{
	var _this = this;
	this.active = null;
	
	this.PopupShow = function(div, pos)
	{
		this.PopupHide();
		if(!div)
			return;
		if (typeof(pos) != "object")
			pos = {};
			
		this.active = div.id;
	    div.ondrag = jsUtilsPhoto.False;
		
		jsUtilsPhoto.addEvent(document, "keypress", _this.OnKeyPress);
		
		div.style.width = div.offsetWidth + 'px';
		div.style.visibility = 'visible';
		
		var res = jsUtilsPhoto.GetWindowSize();
		pos['top'] = parseInt(res["scrollTop"] + res["innerHeight"]/2 - div.offsetHeight/2);
		pos['left'] = parseInt(res["scrollLeft"] + res["innerWidth"]/2 - div.offsetWidth/2);
		pjsFloatDiv.Show(div, pos["left"], pos["top"]);

/*	    div.onselectstart = jsUtilsPhoto.False;
	    div.style.MozUserSelect = 'none';
*/	}

	this.PopupHide = function()
	{
		var div = document.getElementById(_this.active);
		if(div)
		{
			pjsFloatDiv.Close(div);
			div.parentNode.removeChild(div);
		}

		this.active = null;
//		jsUtilsPhoto.removeEvent(document, "click", _this.CheckClick);
		jsUtilsPhoto.removeEvent(document, "keypress", _this.OnKeyPress);
	}

	this.CheckClick = function(e)
	{
		var div = document.getElementById(_this.active);
		
		if(!div)
		{
			return;
		}

		if (div.style.visibility != 'visible')
			return;
			
		if (!jsUtilsPhoto.IsIE() && e.target.tagName == 'OPTION')
			return false;
			
		var x = e.clientX + document.body.scrollLeft;
		var y = e.clientY + document.body.scrollTop;

		/*menu region*/
		var posLeft = parseInt(div.style.left);
		var posTop = parseInt(div.style.top);
		var posRight = posLeft + div.offsetWidth;
		var posBottom = posTop + div.offsetHeight;
		if(x >= posLeft && x <= posRight && y >= posTop && y <= posBottom)
			return;

		if(_this.controlDiv)
		{
			var pos = jsUtilsPhoto.GetRealPos(_this.controlDiv);
			if(x >= pos['left'] && x <= pos['right'] && y >= pos['top'] && y <= pos['bottom'])
				return;
		}
		_this.PopupHide();
	}

	this.OnKeyPress = function(e)
	{
		if(!e) e = window.event
		if(!e) return;
		if(e.keyCode == 27)
			_this.PopupHide();
	},

	this.IsVisible = function()
	{
		return (document.getElementById(this.active).style.visibility != 'hidden');
	}
}

PhotoMenu = new PhotoPopupMenu();