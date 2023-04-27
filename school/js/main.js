$(document).ready(function(){

if(window.innerWidth < 768 || screen.width < 768) // background img for mobile device
{
	$banner_mobile = document.getElementById('banner-mobile-bg');
	$url = $banner_mobile.style.backgroundImage;
	if($url)
	{
		$banner = document.getElementsByClassName('banner');
		if($banner.length > 0)
			$banner[0].style.backgroundImage = $url;
	}

}

    popup();
    $('#nav').onePageNav();
    topScroll();
	/*$('.submit').click(function() {
		$(this).parents('form').submit();
	});*/
	var currentHash;
	currentHash = window.location.hash.slice(1);
	if (currentHash === 'reg') {
		$('#header .btn').trigger('click');
		console.info(currentHash);
		
	}
    $('.map')
        .click(function(){
            $(this).find('iframe').addClass('clicked')})
        .mouseleave(function(){
            $(this).find('iframe').removeClass('clicked')});
})

var lastScrollLeft = 0;
$(window).scroll(function(){
    var documentScrollLeft = $(document).scrollLeft();
    if (lastScrollLeft != documentScrollLeft) {
        lastScrollLeft = documentScrollLeft;
    }
    $('#header').css('left', -documentScrollLeft);
    if ($(window).scrollTop() > $('#header').outerHeight()){
        $('.top').fadeIn();
    } else {
        $('.top').fadeOut();
    }
})

function topScroll(){
    $('a.top').click(function(){
        $('html, body').animate({
            scrollTop: 0
        }, 750);
        return false;
    })
}

function popup(){
    $('.btn').click(function(){
        var link = $(this).attr('href');
        if (link.replace('#', '').length > 0){
            $(link).bPopup({
                modalColor: '#14202b',
                closeClass:'close'
            });
            console.log(link.replace('#', '').length)
            return false;
        }
    })
}