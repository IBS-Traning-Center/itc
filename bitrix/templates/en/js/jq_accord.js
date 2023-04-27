ddaccordion.init({
	headerclass: "header_accordion",
	contentclass: "header_text",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: false,
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["closedlanguage", "openlanguage"],
	togglehtml: ["prefix", "<img src='/bitrix/templates/en/images/but_plus.gif' /> ", "<img src='/bitrix/templates/en/images/but_minus.gif'/> "],
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})