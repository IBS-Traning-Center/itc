<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (strlen($arResult["PROPERTIES"]["REDIRECT_URL"]["VALUE"])) {
    LocalRedirect($arResult["PROPERTIES"]["REDIRECT_URL"]["VALUE"], false, '301 Moved permanently');
}
?>

<?GLOBAL $USER;?>

</div>

    <?
    $uri = $APPLICATION->GetCurUri("r1=socialicons");
    $uri_twitter = $APPLICATION->GetCurUri("r1=socialicons&r2=twt");
    ?>
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
    <script type="text/javascript"> 
        var YaShareInstance = new Ya.share({
            element: 'ya_share',
			theme: 'counter',
            elementStyle: {
						text: '',
                        type: 'button',
                        quickServices: ['', 'yaru', 'vkontakte', 'twitter', 'odnoklassniki', 'moimir']
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
        YaShareInstance.updateShareLink('http://www.luxoft-training.ru/', 'РЈР¦ Luxoft');
    </script> 
	<br/>
	<b>Расскажи друзьям: </b>
    <div id="ya_share"></div> 
	<?//echo "<pre>";?>
	<?//print_r($arResult["PREVIEW_TEXT"]);?>
	<?$APPLICATION->AddHeadString("<meta property='og:title' content='".htmlspecialchars_decode($arResult["NAME"])."'>",$bUnique=true);?>
	<?$APPLICATION->AddHeadString("<meta property='og:description' content='".htmlspecialchars_decode($arResult["PREVIEW_TEXT"])."'>", $bUnique=true);?>
	<?$APPLICATION->SetPageProperty("description", htmlspecialchars_decode($arResult["PREVIEW_TEXT"]));?>
	<?//$APPLICATION->AddChainItem($arResult["NAME"], "");?>
