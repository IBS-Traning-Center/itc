/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: RU
 */
jQuery.extend(jQuery.validator.messages, {
        required: "Это поле необходимо заполнить.",
        remote: "Пожалуйста, введите правильное значение.",
        email: "Пожалуйста, введите корректный Email.",
        url: "Пожалуйста, введите корректный URL.",
        date: "Пожалуйста, введите корректную дату.",
        dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
        number: "Пожалуйста, введите число.",
        digits: "Пожалуйста, вводите только цифры.",
        creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
        equalTo: "Пожалуйста, введите такое же значение ещё раз.",
        accept: "Пожалуйста, выберите файл с правильным расширением.",
        maxlength: jQuery.validator.format("Пожалуйста, введите не больше {0} символов."),
        minlength: jQuery.validator.format("Пожалуйста, введите не меньше {0} символов."),
        rangelength: jQuery.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
        range: jQuery.validator.format("Пожалуйста, введите число от {0} до {1}."),
        max: jQuery.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
        min: jQuery.validator.format("Пожалуйста, введите число, большее или равное {0}.")
});


function SetPrintCSS(isPrint)
{
   var link;

   if (document.getElementsByTagName)
      link = document.getElementsByTagName('link');
   else if (document.all)
      link = document.all.tags('link');
   else
      return;

   for (var index=0; index < link.length; index++)
   {
      if (link[index].title == 'print')
         link[index].disabled = !isPrint;
   }
}

if (document.location.hash == '#print')
   SetPrintCSS(true);

//function ActivationBasketOver() {
var s,bs;
var sDealer = new Array() // structure dealer;
$(document).ready(function(){
	isIE = $.browser.msie && (parseInt($.browser.version)<8);
	if(isIE) {
		//alert($.browser.version);
		$('#basketList').appendTo('body').addClass('lameBasket').hide();
		$('#basketList').css('left',540);
		$('#basketList').css('z-index','700');
	}
});
//}

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

 	$('.cart-oferta input#agree_oferta').live('change', function() {
       var bChecked = $('.cart-oferta input#agree_oferta').attr('checked');
          if (bChecked){
                $("input#basketOrderButton2").attr("disabled","").removeClass("button_disabled").addClass("button_enabled");
          } else {
                $("input#basketOrderButton2").attr("disabled","disabled").removeClass("button_enabled").addClass("button_disabled");
          }
	});

    /**Google Adsense Events**/

    $('.js-tracking-every').click(function(){
        /*_gaq.push(['_trackEvent', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name')]);
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        return true;*/
    });
    $('.js-tracking button, .js-tracking input[type="submit"], a.js-tracking, div.js-tracking').one("click", function(){
        /*_gaq.push(['_trackEvent', $(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name')]);
        yaCounter23056159.reachGoal($(this).attr('data-action'));
		//pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
        console.log($(this).attr('data-type') + $(this).attr('data-action') + $(this).attr('data-name') );
        return true;*/
    });
    /* Facebook Likes tracking */

    var exsistingFbAsyncInit = window.fbAsyncInit;
    if (exsistingFbAsyncInit == null)
        window.fbAsyncInit = function ()
        {
            FB.Event.subscribe('edge.create', function (targetUrl)
            {
                //_gaq.push(['_trackSocial','facebook', 'like', targetUrl]);
                //alert('You liked the URL1: ' + targetUrl);
                pageTracker._trackEvent('Facebook','Like', targetUrl);
            });
        };
    else
        window.fbAsyncInit = function ()
        {
            exsistingFbAsyncInit();
            FB.Event.subscribe('edge.create', function (targetUrl)
            {
                //_gaq.push(['_trackSocial','facebook', 'like', targetUrl]);
               //alert('You liked the URL2: ' + targetUrl);
                pageTracker._trackEvent('Facebook','Like', targetUrl);
            });
        };
});