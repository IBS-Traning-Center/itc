$(document).ready(function() {
	mSlide();
	clearInput();
	$('.plus-btn').click(function(){
			openid=$(this).attr('data-open');
					if ($(this).hasClass('clicked')) {
						$(openid).slideUp();
						$(openid).removeClass("open");
						$(this).removeClass('clicked');
					} else {
						$(openid).slideDown();
						$(openid).addClass("open");
						$(this).addClass('clicked');
					}
	});
	$('.category-inp').change(function(){

		if ($(this).attr('data-inner')!=undefined) {
			openid=$(this).attr('data-inner');
			if ($(this).attr('checked')=='checked') {
				$(openid).find('input:checkbox').attr('checked', 'checked').trigger('refresh');
			} else {
				$(openid).find('input:checkbox').removeAttr('checked').trigger('refresh');
			}
		}
		if ($(this).parent().parent().hasClass('indent')) {
			indent=$(this).parent().parent();
			t=0;
			indent.find('input:checkbox').each(function(){

				if ($(this).attr('checked')!="checked") {
					console.info($(this));
					t++;
				}
				if (t==0){
					indent.prev().find('input:checkbox').attr('checked', 'checked').trigger('refresh');
				} else {
					indent.prev().find('input:checkbox').removeAttr('checked').trigger('refresh');
				}
			})


		}
	});
	$(".courses .order-list .actions .del").click(function(){
		$(this).parent().parent().slideUp(100);
		return false;
	})
	$('select, input:checkbox, input:radio').styler();
	$(".openModal").click(function(){
		$('.popup').bPopup({
			closeClass:'close',
			positionStyle: 'absolute',
			follow: false,
		});
	})
	$(".openFormModal").click(function(){
		$('.formpopup input[name="form_hidden_667"]').val($('.usermail').text());
		$('.formpopup input[name="form_hidden_668"]').val($(this).attr('data-name'));
		$('.formpopup input[name="form_hidden_692"]').val($(this).attr('data-trener'));
		$('.formpopup input[name="form_hidden_693"]').val($(this).attr('data-email'));
		$('.formpopup').bPopup({
			closeClass:'close'
		});
	})
	$('#tabs .tab-content').hide();
	$('#tabs .tab-content:first').show();
	$('#tabs ul li:first').addClass('active');
	$('#tabs ul li a').click(function(){
		$('#tabs ul li').removeClass('active');
		$(this).parent().addClass('active');
		var currentTab = $(this).attr('href');
		$('#tabs .tab-content').hide();
		$(currentTab).show();
		return false;
	});
	$(".profile-form .bottom-buttons .openModal").click(function(){
		return false;
	})

	$('.js-tracking-every').click(function(){
        _gaq.push(['_trackEvent', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name')]);
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        return true;
    });
    $('.js-tracking button, .js-tracking input[type="submit"], a.js-tracking, div.js-tracking').one("click", function(){
        _gaq.push(['_trackEvent', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name')]);
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
       console.log($(this).attr('data-type') + $(this).attr('data-action') + $(this).attr('data-name') );
        return true;
    });

	setTimeout(function () {
		fn_bind_change();
	}, 300)
	$('[name="form-rassylka"] #search_field').autocomplete({
		source: function (request, response) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'search.php?type=' + $('.choose').val(),
				data: {
					maxRows: 12, // показать первые 12 результатов
					nameStartsWith: request.term // поисковая фраза
				},
				success: function (data) {
					response($.map(data, function (item) {
						return {
							id: item.id, // ссылка на страницу товара
							label: item.title_ru // наименование товара
						}
					}));
				}
			});
		},
		select: function (event, ui) {
			// по выбору - перейти на страницу товара
			// Вы можете делать вывод результата на экран
			$('.email-list').val('');
			ID = ui.item.id;
			$('.selectedid').val(ID);
			$.getJSON("maills.php?id=" + ID, function (data) {
				$('.email-list').val(data.title);
			});
			//return false;
		},
		minLength: 3 // начинать поиск с трех символов
	});

	function fn_bind_change() {
		$('.type').change(function () {
			$.get("visual.php?id=" + $('.type').val(), function (data) {
				$('.change').html(data);
			});
			$('#search_field').val('');
		});
	}

});

function rNotif() {
	$('.notif-readed').click(function() {
		$( ".offclass" ).fadeOut();
		$.get( "ajax/notif-unactive.php?ID="+$(this).attr('data-id'), function( data ) {
			$( ".offclass" ).html( data );
			$( ".offclass" ).fadeIn();
			mSlide();
			rNotif();
	  })
	});
}
function mSlide(){
	var textHeight = $(".message .info p").height();
	$(".message .info").ellipsis({live:'true'});
	$('.message .info').prepend('<span class="arrow down"></span>');
	$(".message .info .arrow").click(function(){
		if ($(this).hasClass('down')){
			$(this).parents('.message').find('.info').animate({
				'height':textHeight
			}, 300);
			$(this).removeClass('down');
		} else {

			$(this).parents('.message').find('.info').animate({
				'height':33
			}, 300);
			$(this).addClass('down');
		}
	})
}
function clearInput(){
	jQuery('input[type="text"], textarea').each(function(){
		var defaultText = jQuery(this).val();
		jQuery(this).attr({title:defaultText});
	});
	/*jQuery('input[type="text"], textarea').focus(function(){
		if (jQuery(this).val() === jQuery(this).attr('title')){
			jQuery(this).val('');
		}
	});*/
	/*jQuery('input[type="text"], textarea').blur(function(){
		if (jQuery(this).val() === ''){
			jQuery(this).val(jQuery(this).attr('title'));
		};
	});*/
}
