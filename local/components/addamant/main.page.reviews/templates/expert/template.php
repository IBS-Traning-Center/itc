<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

if (!empty($arResult['TRAINERS'])) : ?>
    <div class="trainer-talent-block">
        <div class="main-page-heading"><?= Loc::getMessage('BLOCK_TITLE_TRAINER') ?></div>
        <div class="trainer-content">
            <?php if (!empty($arResult['TRAINERS'])) : ?>
                <div id="trainerContent">
                    <?php foreach ($arResult['TRAINERS'] as $key => $trainer) :
                        if($key > 1)
                        continue;?>
                        <div class="trainer-item">
                            <div class="trainer-text-block">
                                <?php if ($trainer['TEXT_EXPERT']) : ?>
                                    <span><?= unserialize($trainer['TEXT_EXPERT'])['TEXT'];?></span>
                                <?php endif; ?>
                                <div class="micro-elem"></div>
                            </div>
                            <div class="user-info-block">
                                <?php if ($trainer['DETAIL_PICTURE']) : ?>
                                    <div class="user-image">
                                        <img src="<?= CFile::GetPath($trainer["DETAIL_PICTURE"]);?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="user-text-info">
                                    <span class="full-name f-32"><?= $trainer['EXPERT_NAME'];?></span>
                                    <span class="full-short f-20"><?= $trainer['EXPERT_SHORT'];?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="trainer-item form-item">
                        <div class="trainer-expert-form">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/expert_img.php', [], ['MODE' => 'html', 'NAME' => 'Картинка Эксперты, которые уже с нами']); ?>
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/expert_description.php', [], ['MODE' => 'html', 'NAME' => 'Описание Эксперты, которые уже с нами']); ?>
                        </div>
                    </div>
                    <?php foreach ($arResult['TRAINERS'] as $key => $trainer) : 
                        if($key < 2)
                        continue;?>
                        <div class="trainer-item">
                            <div class="trainer-text-block">
                                <?php if ($trainer['TEXT_EXPERT']) : ?>
                                    <span><?= unserialize($trainer['TEXT_EXPERT'])['TEXT'];?></span>
                                <?php endif; ?>
                                <div class="micro-elem"></div>
                            </div>
                            <div class="user-info-block">
                                <?php if ($trainer['DETAIL_PICTURE']) : ?>
                                    <div class="user-image">
                                        <img src="<?= CFile::GetPath($trainer["DETAIL_PICTURE"]);?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="user-text-info">
                                    <span class="full-name f-32"><?= $trainer['EXPERT_NAME'];?></span>
                                    <span class="full-short f-20"><?= $trainer['EXPERT_SHORT'];?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
