$(document).ready(function(){

  if(!localStorage.getItem('summer_discount'))
  {
	$('.shared-components-Banner-banner-module').show();
  }
});

$(document).on("click", ".shared-components-Banner-banner-module__close", function() {
  localStorage.setItem('summer_discount', false);
  $('.shared-components-Banner-banner-module').hide();

});
