<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<?
		global $main_header;
	?>
    <? $main_header=$APPLICATION->GetPageProperty("main_header");  ?>
	
        <h2><?=$arResult["NAME"]?></h2>

	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
        <h3><?=$arResult["DISPLAY_ACTIVE_FROM"]?></h3>
	<?endif;?>
	<?if (strlen($arResult['DETAIL_TEXT'])>0){?>
	<?=$arResult['DETAIL_TEXT']?>
	<? } else { ?>
	<?=$arResult['PREVIEW_TEXT']?>
	<? } ?>
	<?if (strlen($arResult['PROPERTIES']['YOUTUBE_ID']['VALUE'])>0){?>
		<br /><iframe width="515" height="370" src="http://www.youtube.com/embed/<?=$arResult['PROPERTIES']['YOUTUBE_ID']['VALUE']?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<? } ?>
	<br /><br />
    <?
    $uri = $APPLICATION->GetCurUri("r1=socialicons");
    $uri_twitter = $APPLICATION->GetCurUri("r1=socialicons&r2=twt");
    ?>
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
    <script type="text/javascript"> 
        var YaShareInstance = new Ya.share({
            element: 'ya_share',
            elementStyle: {
                        type: 'none',
                        quickServices: ['', 'yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'lj', 'moikrug', 'evernote', 'greader']
            },
            onready: function(instance) {
                        instance.updateShareLink(
                            "<?echo "http://www.luxoft-training.ru".$uri;?>",
                            "<?echo $arResult["NAME"];?>",
                            {
                               twitter: {link: '<?echo "http://www.luxoft-training.ru".$uri_twitter;?>', title: '<?echo $arResult["NAME"]." @TrainingLuxoft";?>'}
                            }
                        );
            }
        });
        YaShareInstance.updateShareLink('http://www.luxoft-training.ru/', 'УЦ Luxoft');
    </script> 
    <div id="ya_share"></div> 



