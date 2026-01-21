<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="header">
        <strong class="logo"><a href="/?utm_source=luxoft-training&utm_medium=referral&utm_campaign=soft-labs-2020">LUXOFT TRAINING</a></strong>
        <?/*<a href="#overlay-form" class="btn">Зарегистрироваться</a>*/?>
</div>
<div id="main">
<div id="main">
    <div class="banner" data-parallax="scroll" style="background-image: url('<?=$arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"]?>')">
        <div class="wrapper">
            <p class="banner__title"><?=$arResult["PROPERTIES"]["BANNER_TITLE"]["VALUE"]?></p>
            <h1><?=$arResult["NAME"]?></h1>
            <?if(strlen($arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"])>0) {?>
                <p class="banner__date"><?=$arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"]?></br>
                <?if(strlen($arResult["PROPERTIES"]["TIME_START"]["VALUE"])>0 && strlen($arResult["PROPERTIES"]["TIME_END"]["VALUE"])>0) {?>
                    <?=$arResult["PROPERTIES"]["TIME_START"]["VALUE"]?>-<?=$arResult["PROPERTIES"]["TIME_END"]["VALUE"]?></p>
                <?}?>
            <?}?>
            <?/*<a href="#overlay-form" class="btn">Зарегистрироваться</a>*/?>
        </div>
    </div>
    <?CModule::IncludeModule("catalog")?>
    <div class="person-background">
        <div class="person" id="s1">
        <?if(strlen($arResult["PREVIEW_PICTURE"]["SRC"])>0) {?>
            <div class="image">
                <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="">
            </div>
        <?}?>
            <div class="holder">
                <?if(strlen($arResult["PROPERTIES"]["QUIZ_TITLE"]["VALUE"])>0) {?>
                    <h2 class="holder__title"><?=$arResult["PROPERTIES"]["QUIZ_TITLE"]["VALUE"]?></h2>
                <?}?>
                <?if(strlen($arResult["PROPERTIES"]["QUIZ_DESCRIPTION"]["VALUE"]["TEXT"])>0) {?>
                 <?=htmlspecialchars_decode($arResult["PROPERTIES"]["QUIZ_DESCRIPTION"]["VALUE"]["TEXT"])?>
                <?}?>
            </div>
        </div>
    </div>
</div>

