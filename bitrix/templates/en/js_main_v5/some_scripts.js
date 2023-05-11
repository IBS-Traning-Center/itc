function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
$(document).ready(function(){
	isIE = $.browser.msie && (parseInt($.browser.version)<8);
	var s,bs;
	$('.basketSmall a').live('mouseover', function() {
		clearTimeout(bs);
		if(isIE) {
			var zIndexNumber = 1000;
			$('#header div').each(function() {
				$(this).css('zIndex', zIndexNumber);
				zIndexNumber -= 10;
			});
		}
		$('#basketList').show();
	});
	$('.basketSmall a').live('mouseout', function() {
		bs = setTimeout("$('#basketList').hide()",500);
	});
    $('.basketList').live('mouseover', function() {
		clearTimeout(bs);
	});
    $('.basketList').live('mouseout', function() {
		bs = setTimeout("$('#basketList').hide()",500);
	});
 	$('#basketList li a').live('mouseover', function() {
 		clearTimeout(bs);
	});
 	$('#basketList li a').live('mouseout', function() {
		clearTimeout(bs);
	});

});





