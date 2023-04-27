<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-trainers course-detail__container">
    <div class="course-trainers__header">
        <div class="course-trainers__title"><?=Loc::getMessage('TITLE_TRAINERS')?></div>
    </div>
    <div class="course-trainers__main">
        <?foreach ($arResult['trainers'] as $trainer) {?>
            <div class="course-trainers__item">
                <div class="course-trainers-item">
                    <a href="<?=$trainer['link']?>" class="course-trainers-item__view">
                        <img src="<?=$trainer['detailPicture']?>" alt="" class="course-trainers-item__image">
                    </a>
                    <div class="course-trainers-item__content">
                        <a href="<?=$trainer['link']?>" class="course-trainers-item__name"><?=$trainer['fullName']?></a>
                        <div class="course-trainers-item__position"><?=$trainer['position']?></div>
                        <div class="course-trainers-item__info">
                            <div class="course-trainers-item__description">
                                <?=$trainer['shortDescription']?><br>
                                <?=$trainer['detailText']?>
                            </div>
                            <div class="course-trainers-item__more">
                                <span><?=Loc::getMessage('')?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</div>