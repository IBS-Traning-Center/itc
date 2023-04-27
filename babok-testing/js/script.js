$(document).ready(function() {
	$("input[placeholder], textarea[placeholder]").each(function(i, e){
		if ($(this).hasClass("search-inp")) {
		
		} else {
			if($(e).val() == "")
			{
				$(e).val($(e).attr("placeholder"));
			}
			$(e).blur(function(){
			if($(this).val()=="")
			  $(this).val($(e).attr("placeholder"));
			}).focus(function(){
			if($(this).val() == $(e).attr("placeholder"))
			$(this).val("");
			});
		}
	});
	$(window).scroll(function() {
        if ($(window).scrollTop() > 0) {
			$('#top-section').addClass('down');
		} else {
			$('#top-section').removeClass('down');
		}
		$('.nav.main li').removeClass('active');
		$('.nav.main li a').each(function() {
			href=$(this).attr('href');
			topitem=$(href).offset();
			if ($(window).scrollTop()> topitem.top - 132) {
				$('.nav.main li').removeClass('active');
				$(this).parent().addClass('active');
				
			} else {
				
			}
		});
    }); 
	bindRole();
	bindSearch();
	bindShowMore();
	$('.type-list a').click(function() {
		if ($(this).hasClass('active')) {
			$($(this).attr('data-check')).prop("checked", false);
			$(this).removeClass('active');
		} else {
			$($(this).attr('data-check')).prop("checked", true);
			$(this).addClass('active');
		}
		$.get('?' + $(this).parents('form').serialize(), function(data) {
			$('.change-wrap').html(data);
				bindRole();
				bindShowMore();
			})
			return false;
	});
	function bindRole() {
		$('.role-sel a').bind('click', function() {
			$($(this).attr('data-click')).trigger('click');
			//console.info($(this).attr('data-click'));
			return false;
		});
	}
	function bindSearch() {
		$('.search-inp').keyup(function() {
			$.get('?' + $(this).parents('form').serialize(), function(data) {
				$('.change-wrap').html(data);
				bindRole();
				bindShowMore();
			})
		});
	}
	function bindShowMore() {
		$('.buy-more-info').click(function() {
			open=$(this).attr("href");
			$('.tabs').hide();
			$('.test-item').removeClass('opened');
			$(this).parents('.test-item').addClass('opened');
			if ($(open).parent().hasClass('opened')) {
				$(open).show();
			} else {
				$('.items-description').removeClass('opened');
				$('.items-description').hide();
				$(open).parent().slideDown('fast');
				$(open).parent().addClass('opened');
				$(open).show();
			}
			return false;
		});
		$('.close-button').click(function() {
			$('.tabs').hide();
			$('.items-description').hide();
			$('.items-description').removeClass('opened');
			$('.test-item').removeClass('opened');
			return false;
		});
	}
	
	$('.tabs-nav a').click(function() {
		$('.tabs-nav li').removeClass('active');
		$(this).parent().addClass('active');
		$('.type-list').addClass('hidden');
		$($(this).attr('href')).removeClass('hidden');
		return false;
	});
	$('.nav.main li a').click(function() {
		href=$(this).attr('href');
		topitem=$(href).offset()
		$("html, body").animate({ scrollTop: topitem.top - 130 }, 500);
		return false;
	}); 

	$("#slider").slider({
		value: 1,
		max: 10,
		min: 1,
		step: 1, 
		create: function( event, ui ) {
			val = $( "#slider" ).slider("value");
			$( "#slider .ui-slider-handle" ).html( val );
			$( ".slider_count" ).html( val );
		},
		slide: function( event, ui ) {
			val2 = $( "#slider_1" ).slider("value");
			if (val2==1) {
				koef=0;
			} else if (val2>=2 && ui.value<5) {
				koef=(val2-1)*50;
				console.info(koef);
			} else if (val2>=5) {
				koef=200;
			}
			$('.big-price span').text(val2*ui.value*(998-koef));
			$( "#slider .ui-slider-handle" ).html( ui.value );
			$( ".slider_count" ).html( ui.value );			
		}
	});
	$("#slider_1").slider({
		value: 1,
		max: 10,
		min: 1,
		step: 1, 
		create: function( event, ui ) {
			val = $( "#slider_1" ).slider("value");
			$( "#slider_1 .ui-slider-handle" ).html( val );
			$( ".slider_1_count" ).html( val );
		},
		slide: function( event, ui ) {
			val1 = $( "#slider" ).slider("value");
			if (ui.value==1) {
				koef=0;
			} else if (ui.value>=2 && ui.value<5) {
				koef=(ui.value-1)*50;
				console.info(koef);
			} else if (ui.value>=5) {
				koef=200;
			}
			$('.big-price span').text((val1*ui.value*(998-koef)));
			$( "#slider_1 .ui-slider-handle" ).html( ui.value );
			$( ".slider_1_count" ).html( ui.value );				
		}
	});
	bn_BasketShow();
	bn_Delete();
	function bn_BasketShow() {
		$('.basket-heading').click(function() {
			fix_bask=$(this).parents('.fixed-basket');
			if ($(fix_bask).hasClass('open')) {
				$(fix_bask).removeClass('open');
			} else {
				$(fix_bask).addClass('open');
			}
		});
		bn_Delete();
		
	}
	function bn_Delete() {
		$('.delete-icon').click(function() {
			$.get( $(this).attr('href'), function() {
				$.get( '', {AJAX_TWO: "Y"}, function(data) {
					$('.fixed-basket').html(data);
					bn_BasketShow();
					
				})
			});
			
			return false;
		});
	}
	bn_Buy();
	function bn_Buy() {
		$('.buy-wrapper .buy-link').click(function() {
			$.get( $(this).attr('data-link'), function() {
				$.get( '', {AJAX_TWO: "Y"}, function(data) {
					$('.fixed-basket').html(data);
					bn_BasketShow();
				})
			});
			return false;
		});
		
	}
	$('.next').click(function() {
		$('.fixed-basket').removeClass('open');
	});
});