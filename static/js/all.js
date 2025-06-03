$(document).ready(function() {
	 $('.js-tracking-every').click(function(){
		ga('send', 'event', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        return true;
    });
	hljs.initHighlightingOnLoad();
    $('.js-tracking button, input[type="submit"].js-tracking, a.js-tracking, div.js-tracking').one("click", function(){
        ga('send', 'event', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        console.log($(this).attr('data-type') + $(this).attr('data-action') + $(this).attr('data-name') );
        return true;
    });
	setInterval(checkRequest, 30100);
	function checkRequest(){
		/*$.getJSON( "/ajax/check-new-course.php", function( data ) {
			console.info(data);
			if (data.success=="Y") {
				$('.course-name-req-modal').text(data.course);
				$('.message-with-new-req').fadeIn();
				setTimeout("$('.message-with-new-req').fadeOut()", 5000);
			}
		})*/
	}
	$('table').each(function() {
		if ($(this).parent().hasClass('table-responsive')) {

		} else {
			$(this).wrap("<div class='table-responsive'></div>");
		}
	});
	$(".close-menu").click(
        function() {
            $(".hidden-menu").hide();
        }
	);
	$(".menu-item-svg").click(
        function() {
            $(".hidden-menu").show();
        }
	);
	$('#subscribe-form').submit(function(){
		$.post( "/ajax/subscribe.php", $("#subscribe-form" ).serialize()).done(function( data ) {
			var obj = jQuery.parseJSON(data);
			if (obj.success=="Y") {
				$('.visible-form').css('display', 'none');
				$('.hidden-form').css('display', 'block');
			} else {
				alert('Этот email уже подписан на рассылку');
			}
		});
		return false;
	})

	$('input[type="checkbox"]:not(".no_redraw")').styler();
	$('select:not(".no_redraw")').styler();
	$('.scroll').click(function () {
		var body = $("html, body");
		var target = $($(this).attr('href'));
		var top = target.offset().top;
		body.stop().animate({scrollTop: top}, 300, 'swing');
		return false;
	});
	$('.plus-round').click(function() {
		$('.sign-in.small.scroll').trigger('click');
		$('select[name="PROPERTY[313][0]"]').val("0").trigger('refresh').trigger('change');;
		return false;
	});
	$('.icon-click').click(function() {
		if ($(this).parent().hasClass('open')) {
			$(this).parent().removeClass('open');
		} else {
			$(this).parent().addClass('open');
		}
		return false;
	});
    $('.section-click').click(function() {
        if ($(this).hasClass('uncover')) {
            $(this).removeClass('uncover');
        }
        else {
            $(this).addClass('uncover');
        }
        return false;
    });
	$('.fancy').fancybox();
	$('.contact-header .city-select ul a').click(function() {
		if ($('.map_'+$(this).data("id")).length>0) {
			$('.location-tab').removeClass('active');
			$('.map_'+$(this).data("id")).addClass('active');
		}
		//var map=BX("BX_GMAP_gm_"+$(this).data("id"));
		//google.maps.event.trigger(map, 'resize');
		$('.contact-header .city-select .title').html($(this).text()+' <i class="fa fa-caret-down" aria-hidden="true"></i>');
	});
    $('.main-filter-container .main-filter ul a').click(function() {
        $('.main-filter-container .main-filter .title').html($(this).text()+' <i class="fa fa-caret-down" aria-hidden="true"></i>');
    });
	$('.timetable-inn-header .city-select ul a').click(function() {
		if ($('#city_'+$(this).data("id")).length>0) {
			$('.timetable-inn-list').removeClass('active');
			$('.timetable-inn-list-1').removeClass('active');
			$('#city_'+$(this).data("id")).addClass('active');
			$('.timetable-inn-header .other-cities').removeClass('active');
		} else {
			$('.timetable-inn-list').removeClass('active');
			$('.timetable-inn-list-1').removeClass('active');
			$('.timetable-inn-list.empty-list').addClass('active');
			$('.timetable-inn-header .other-cities').removeClass('active');
		}
		$('.timetable-inn-header .city-select .title').html($(this).text()+' <i class="fa fa-caret-down" aria-hidden="true"></i>');
	});
	$('.timetable-inn-header .other-cities').click(function() {
		$('.timetable-inn-list').removeClass('active');
		$('.timetable-inn-list-1.all-city-list').addClass('active');
		$(this).addClass('active');
		return false;
	});
	$('a.collipse-link').click(function() {
		if ($(this).hasClass('open')) {
			$(this).parent().find('.hidden-by-link').removeClass('show');
			$(this).removeClass('open');
		} else {
			$(this).parent().find('.hidden-by-link').addClass('show');
			$(this).addClass('open');
		}
		return false;
	});
	$('a.collipse-link').click(function() {
		if ($(this).hasClass('open')) {
			$(this).parent().find('.hidden-by-link').removeClass('show');
			$(this).removeClass('open');
		} else {
			$(this).parent().find('.hidden-by-link').addClass('show');
			$(this).addClass('open');
		}
		return false;
	});
	$('.category-picker ul a').click(function() {
		id=$(this).data('id');
		$('#filter input[value="'+id+'"]').prop("checked", true);
		$('#filter').submit();
	});
	$('.selected-items a.delete-cat').click(function() {
		id=$(this).data('id');
		$('#filter input[value="'+id+'"]').prop("checked", false);
		$('#filter').submit();
	});
	$('.city-select .title, .simple-select .title').click(function() {

		if ($(this).parent().hasClass('open')) {
			$(this).parent().removeClass('open');
		} else {
			$(this).parent().addClass('open');
		}
		return false
	});
    $('.main-filter .title').click(function() {

        if ($(this).parent().hasClass('open')) {
            $(this).parent().removeClass('open');
        } else {
            $(this).parent().addClass('open');
        }
        return false
    });
	$('.trainer-changer.button').click(function() {
		$('.trainer-changer').removeClass('active');
		$(this).addClass('active');
		$('.training-slider-inner').removeClass('active');
		$('.trainer-list-'+$(this).data('open')).addClass('active');
		$('.training-slider-inner').slick('reinit');
		return false;
	});
	$('body').click(function() {
		$('.city-select, .main-filter, .simple-select').removeClass('open');
		$('.lang-selector').removeClass('show');
		$('.mask').fadeOut();
	});
	$('.menu-switcher').click(function() {
		parenting=$(this).parents('.menu-small-wrap');
		if (parenting.hasClass('shown')) {
			parenting.removeClass('shown')
		} else {
			parenting.addClass('shown')
		}
		return false;
	});
	if ($('.scroll-menu-shadow').length>0) {
		stickyNavInit();
	}
	$('.open-link a').click(function() {
		$(this).parents('.trainer-content').addClass('open');
		return false;
	});
	$('.training-slider-inner').slick({infinite: false});
	$('.client-slider .items').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [
			{
			  breakpoint: 1170,
			  settings: {
				slidesToShow: 4
			  }
			},
			{
			  breakpoint: 950,
			  settings: {
				slidesToShow: 3
			  }
			},
			{
			  breakpoint: 750,
			  settings: {
				slidesToShow: 3,
				arrows: false
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				arrows: false
			  }
			}

		]
	});
	$('.success-story-list').slick({
		autoplay: true,
		autoplaySpeed: 5000,
		slidesToShow: 6,
		slidesToScroll: 1,
		responsive: [
			{
			  breakpoint: 1170,
			  settings: {
				slidesToShow: 4
			  }
			},
			{
			  breakpoint: 950,
			  settings: {
				slidesToShow: 3
			  }
			},
			{
			  breakpoint: 750,
			  settings: {
				slidesToShow: 3,
				arrows: false
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 2,
				arrows: false
			  }
			}

		]
	});
	$('.timetable-inn-list').slick({
		 variableWidth: true,
		 infinite: false,
		 arrows: false
	});
	$('.photo-slider').slick({
		 variableWidth: true,
		 infinite: false,
		 arrows: false,
	});
	$(function(){
		$('.masonry').masonry({
		// options
			itemSelector : '.testimonal-item',
		});
	});
	if ($('.scroll-menu-shadow').length>0) {
		$(window).scroll(function() {
			scrollTop = $(window).scrollTop() + $('.header').height();
			scrollMenu= parseInt($('.height-inner').offset().top)
			if (scrollTop>scrollMenu) {
				$('.scroll-menu-shadow').addClass('fixed');
				$('.height-inner').height($('.scroll-menu-shadow').height());
			} else {
				$('.scroll-menu-shadow').removeClass('fixed');
				$('.height-inner').css('height', 'auto');
			}
		});
	}
	$('.lang-selector .trigger-show').click(function() {

		if ($(this).parent().hasClass('show')) {
			$(this).parent().removeClass('show');
		} else {
			$(this).parent().addClass('show');
		}
		return false;
	});

	$(document).on('click', '.filter-item > a', function(){


        var courses = $('.course-item').show();
        var sections = $('.section-item').show();
        var courses_lists = $('.courses-list').removeClass('hidden');
        var courses_icons = $('.section-click').addClass('uncover');

		var filter_text = this.text.toLowerCase();

		if(filter_text!= 'все') {
            // filtered courses
            var filtered_items = courses.filter(
                function (index) {
                    return !this.dataset.level.includes(filter_text)
                }).hide();

			// filtered sections
			var sections_filtered = sections.filter(
				function(){
					var c1 = $(this).find('.course-item');
					var c2 = $(c1).filter(':visible');
					var c3 = c2.length == 0;
					return c3;
				}).hide();
        }
	});

	$('.requisites__nav-item').click(function() {
        if(!$(this).hasClass('_active')) {

            $(this).addClass('_active').siblings().removeClass('_active');

            var index = $(this).index();

            $('.requisites__tab').eq(index).addClass('_active').siblings().removeClass('_active');
        }
    })

});

function stickyNavInit() {
    var stickyOffset = $('.scroll-menu-shadow').outerHeight();
	$(".sticky-nav li a[href^='#'], .sticky-nav a.sign-in,.sticky-nav .dropdown a").on('click', function(e) {
        var hash = this.hash;
        var that = $(this);
		$('.simple-select').removeClass('open');
        $('html, body').animate({
            scrollTop: parseInt($(hash).offset().top) - stickyOffset - 40
        }, 300, 'linear', function(){
            setTimeout(function(){
                $('.sticky-nav li').removeClass('active');
                that.parent().addClass('active');
            }, 100)
        });
        return false;
    });

    if (!$('.sticky-nav').hasClass('static-links')) {
        $(window).scroll(function() {
            setTimeout(function(){
                $('.sticky-nav li').removeClass('active');
            }, 20)
        });
    }
}
