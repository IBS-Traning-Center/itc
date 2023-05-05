<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<!DOCTYPE html>
<html lang="ru">

<head>

    <meta property="og:url" content="<?=$APPLICATION->GetCurDir()?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?$APPLICATION->ShowTitle()?>" />
    <meta charset="UTF-8">
    <?$APPLICATION->ShowHeadStrings()?>
    <title>
    <?$APPLICATION->ShowTitle()?>
    </title>
    <link href="/quiz/css/all.css?check=45" rel="stylesheet" type="text/css">
    <link href="/quiz/css/form.css?check=46" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="/quiz/js/scrollTo.js"></script>
    <script src="/quiz/js/jquery.nav.js"></script>
    <script src="/quiz/js/parallax.min.js"></script>
    <script src="/quiz/js/bPopup.js"></script>
    <script src="/quiz/js/main.js?rest=1114"></script>
    <script type="text/javascript">
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-9384348-1', 'auto');
        ga('send', 'pageview');

        /*var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-9384348-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        //ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();*/
    </script>
</head>

<body>
    <?$elementID=$APPLICATION->IncludeComponent("bitrix:news.detail", "landing-quiz", array(
	"IBLOCK_TYPE" => "ig_land",
	"IBLOCK_ID" => "164",
	"ELEMENT_ID" => "",
	"ELEMENT_CODE" => $_REQUEST["CODE"],
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "PREVIEW_PICTURE",
		1 => "DETAIL_TEXT",
		2 => "DETAIL_PICTURE",
		3 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "DESCRIPTION",
		2 => "",
	),
	"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "Y",
	"GROUP_PERMISSIONS" => array(
		0 => "1",
		1 => "2",
	),
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "",
	"PAGER_TEMPLATE" => "",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"USE_SHARE" => "Y",
	"SHARE_HIDE" => "N",
	"SHARE_TEMPLATE" => "",
	"SHARE_HANDLERS" => array(
	),
	"SHARE_SHORTEN_URL_LOGIN" => "",
	"SHARE_SHORTEN_URL_KEY" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

    <?if (strlen($_REQUEST["FORM_RESULT_ID"]) > 0) {?>
        <?header('Location: https://kahoot.it/');?>
    <?/*
    <div class="popup" id="success">
        <div class="popup-t">
            <a href="#" class="close"></a>
            <h3>Вы успешно зарегистрированы!</h3>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#success').bPopup({
                modalColor: '#14202b',
                closeClass: 'close'
            });
            ga('send', 'event', 'register', 'agile-courses', 'succes');
        })
    </script>
    */?>
    <?}?>

    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter23056159 = new Ya.Metrika({
                        id: 23056159,
                        webvisor: true,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {}
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div><img src="//mc.yandex.ru/watch/23056159" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
</body>

</html>