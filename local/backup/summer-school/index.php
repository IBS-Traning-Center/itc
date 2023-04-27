<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta property="og:url" content="<?=$APPLICATION->GetCurDir()?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?$APPLICATION->ShowTitle()?>" />
    <meta charset="windows-1251">
    <?$APPLICATION->ShowHeadStrings()?>
    <title>
        <?$APPLICATION->ShowTitle()?>
    </title>
    <link href="/summer-school/css/all.css?check=45" rel="stylesheet" type="text/css">
    <link href="/summer-school/css/form.css?check=46" rel="stylesheet" type="text/css">
    <link href="/local/assets/css/2020_style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="/school/js/scrollTo.js"></script>
    <script src="/school/js/jquery.nav.js"></script>
    <script src="/school/js/parallax.min.js"></script>
    <script src="/school/js/bPopup.js"></script>
    <script src="/school/js/main.js?rest=1114"></script>
    <script src="/local/assets/libs/jquery.validate/jquery.validate.min.js"></script>
    <script src="/local/assets/libs/jquery.validate/additional-methods.min.js"></script>
    <script src="/local/assets/js/form.js"></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N8N8SHJ');</script>
    <!-- End Google Tag Manager -->

    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-9384348-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8N8SHJ" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?
    $elementID = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "school",
        array(
            "IBLOCK_TYPE" => "ig_land",
            "IBLOCK_ID" => "178",
            "ELEMENT_ID" => "",
            "ELEMENT_CODE" => $_REQUEST["CODE"],
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array("*"),
            "PROPERTY_CODE" => array("*"),
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
            "SHARE_HANDLERS" => array(),
            "SHARE_SHORTEN_URL_LOGIN" => "",
            "SHARE_SHORTEN_URL_KEY" => "",
            "AJAX_OPTION_ADDITIONAL" => ""
        ),
        false
    ); ?>

    <?if (intval($_REQUEST["FORM_RESULT_ID"])>0) {?>
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
    <?}?>

    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 986037442;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <!-- Google Code for tawk.to Chat Conversion -->
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {};
        Tawk_API.onChatStarted = function(){

            window.google_trackConversion({
                google_conversion_id : 986037442,
                google_remarketing_only : true
            });
            ga('send', 'event', 'show_tawk', 'tawk');
            dataLayer.push({'event':'showTawk'});
        };
    </script>
</body>
</html>
