$(document).ready(function(){

  if(!localStorage.getItem('footer_banner'))
  {
	$('.shared-components-Banner-banner-module').show();
  }
});

$(document).on("click", ".shared-components-Banner-banner-module__close", function() {
  localStorage.setItem('footer_banner', false);
  $('.shared-components-Banner-banner-module').hide();

});
