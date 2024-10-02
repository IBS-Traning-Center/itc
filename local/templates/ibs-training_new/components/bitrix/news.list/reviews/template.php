<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true){
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */ 
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;
?>

<div class="reviews-content">
	<?php if($arParams["DISPLAY_TOP_PAGER"]) : ?>
		<?=$arResult["NAV_STRING"]?><br />
	<?php endif;?>
	<div class="reviews-content-wrap">
		<?php foreach($arResult["ITEMS"] as $arItem) : ?>
			<?php 
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="review-item">
		        <?php if ($arItem['VIDEO']) : ?>
		            <div class="reviews-video">
		                <video muted="" loop="" disablepictureinpicture="" webkit-playsinline="" playsinline="" pip="false">
		                    <source src="<?= $arItem['VIDEO'] ?>#t=0.001">
		                </video>
		                <div class="custom-controls">
		                    <div class="buttons-block">
		                        <div class="start-video-btn">
		                            <?= Functions::buildSVG('start-btn-icon', $templateFolder . '/images') ?>
		                        </div>
		                        <div class="stop-video-btn">
		                            <?= Functions::buildSVG('stop-btn-icon', $templateFolder . '/images') ?>
		                        </div>
		                    </div>
		                    <div class="current-video-time" data-review-id="<?= $key ?>">
		                        <div class="current-video-time_back"></div>
		                        <span class="f-20"><?= $arItem['REVIEW_USER_NAME_VALUE'] ?></span>
		                    </div>
		                </div>
		            </div>
		        <?php elseif ($arItem['PREVIEW_TEXT'] || $arItem['USER_REVIEW_VALUE']) : ?>
		            <div class="review-text-block">
		                <div class="main-text">
		                    <span class="f-20"><?= ($arItem['PREVIEW_TEXT'])? $arItem['PREVIEW_TEXT'] : $arItem['USER_REVIEW_VALUE']?></span>
		                </div>
		            </div>
		            <div class="user-info-block">
						<div class="micro-elem">
		                    <?= Functions::buildSVG('micro_elem', $templateFolder . '/images') ?>
		                </div>
		                <?php if ($arItem['PREVIEW_PICTURE']) : ?>
		                    <div class="user-image" style="background-image: url('<?= CFile::GetPath($arItem["PREVIEW_PICTURE"]); ?>')"></div>
		                <?php endif; ?>
						<?php if($arItem['USER_REVIEW_VALUE']):?>
							<div class="user-text-info">
		                	    <span class="full-name f-20"><?= $arItem['USER_NAME_VALUE'] . ' ' . $arItem['USER_SURNAME_VALUE'] ?></span>
		                	</div>
						<?php else : ?>
							<div class="user-text-info">
		                	    <span class="full-name f-20"><?= $arItem['REVIEW_USER_NAME_VALUE'] ?></span>
		                	    <span class="company-name f-20"><?= $arItem['NAME'] ?></span>
		                	</div>
						<?php endif; ?>
		            </div>
		        <?php endif; ?>
		    </div>
			<div class="review-item review-modal">
					<div class="review-modal-title-wrap">
						<div class="review-modal-title"><?= Loc::getMessage('REVIEW_MODAL_TITLE')?></div>
						<div class="review-modal-close"><?=Functions::buildSVG('icon-close', SITE_TEMPLATE_PATH. '/assets/images/icons')?></div>
					</div>
				<?php if ($arItem['VIDEO']) : ?>
		            <div class="reviews-video">
		                <video muted="" loop="" disablepictureinpicture="" webkit-playsinline="" playsinline="" pip="false">
		                    <source src="<?= $arItem['VIDEO'] ?>#t=0.001">
		                </video>
		                <div class="custom-controls">
		                    <div class="buttons-block">
		                        <div class="start-video-btn">
		                            <?= Functions::buildSVG('start-btn-icon', $templateFolder . '/images') ?>
		                        </div>
		                        <div class="stop-video-btn">
		                            <?= Functions::buildSVG('stop-btn-icon', $templateFolder . '/images') ?>
		                        </div>
		                    </div>
		                    <div class="current-video-time" data-review-id="<?= $key ?>">
		                        <div class="current-video-time_back"></div>
		                        <span class="f-20"><?= $arItem['REVIEW_USER_NAME_VALUE'] ?></span>
		                    </div>
		                </div>
		            </div>
		        <?php elseif ($arItem['PREVIEW_TEXT'] || $arItem['USER_REVIEW_VALUE']) : ?>
		            <div class="review-text-block">
		                <div class="main-text">
		                    <span class="f-20">
								<?php if($arItem['DETAIL_TEXT']) : ?>
									<?= ($arItem['DETAIL_TEXT'])?>
								<?php elseif ($arItem['PREVIEW_TEXT'] || $arItem['USER_REVIEW_VALUE']) : ?>
									<?= ($arItem['PREVIEW_TEXT'])? $arItem['PREVIEW_TEXT'] : $arItem['USER_REVIEW_VALUE']?>
								<?php endif; ?>
							</span>
		                </div>
		            </div>
		            <div class="user-info-block">
						<div class="micro-elem">
		                    <?= Functions::buildSVG('micro_elem', $templateFolder . '/images') ?>
		                </div>
		                <?php if ($arItem['PREVIEW_PICTURE']) : ?>
		                    <div class="user-image" style="background-image: url('<?= CFile::GetPath($arItem["PREVIEW_PICTURE"]); ?>')"></div>
		                <?php endif; ?>
						<?php if($arItem['USER_REVIEW_VALUE']):?>
							<div class="user-text-info">
		                	    <span class="full-name f-20"><?= $arItem['USER_NAME_VALUE'] . ' ' . $arItem['USER_SURNAME_VALUE'] ?></span>
		                	</div>
						<?php else : ?>
							<div class="user-text-info">
		                	    <span class="full-name f-20"><?= $arItem['REVIEW_USER_NAME_VALUE'] ?></span>
		                	    <span class="company-name f-20"><?= $arItem['NAME'] ?></span>
		                	</div>
						<?php endif; ?>
		            </div>
		        <?php endif; ?>
			</div>
		<?php endforeach;?>
	</div>
	<div class="reviews-content-shadow"></div>
	<?php if($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
		<?=$arResult["NAV_STRING"]?>
	<?php endif;?>
</div>