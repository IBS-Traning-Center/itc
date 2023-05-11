function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
$(document).ready(function(){
	//$('.block').pngFix();
	//$(".block img").css("float","right");
	//$(".block img").css("padding","0");
	//$(".block img").css("margin","0");
});




