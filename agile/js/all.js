jQuery(document).ready(function(){

    $(".scroll-top").on('click',function(){
        $('html, body').animate({ scrollTop: 0 }, 750);
    });

    $(window).scroll(function(){
        if($(this).scrollTop() >= 200){
            $(".scroll-top").fadeIn();
        } else {
            $(".scroll-top").fadeOut();
        }
    });

    $('.header-nav').singlePageNav({
        offset: $('.header-nav').outerHeight(),
        currentClass: 'active'
    });
	
	
	

});