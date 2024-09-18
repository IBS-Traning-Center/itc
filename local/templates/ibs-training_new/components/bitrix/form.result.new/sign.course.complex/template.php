<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/**
 * @var array $arResult
 * @var array $arParams
 * @var string $templateFolder
 */

?>

<div class="sign-course-complex-block">
	<div class="top-sign-course-complex">
		<h4><?= Loc::getMessage('SIGN_COURSE_TITLE') ?></h4>
        <div class="close-course-modal"><?= Functions::buildSVG('close_course_modal', $templateFolder . '/images') ?></div>
	</div>
	<div class="questions-block">
		<?php if ($arResult["FORM_NOTE"]) : ?>
			<p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
		<?php endif; ?>
		<div class="select-dates-block" <?= ($arResult["FORM_NOTE"]) ? 'style="display: none"' : '' ?>>
			<div class="select-dates-content">
				<span class="f-16"><?= Loc::getMessage('OPEN_DATES_TITLE') ?></span>
				<?= (!empty($arParams['DATES'])) ? Functions::buildSVG('down-arrow-icon', $templateFolder . '/images') : '' ?>
			</div>
			<?php if (!empty($arParams['DATES'])) : ?>
				<div class="select-dates-dropdown-block">
					<div class="select-date">
						<span class="f-16"><?= Loc::getMessage('OPEN_DATES_TITLE') ?></span>
					</div>
					<?php foreach ($arParams['DATES'] as $date) : ?>
						<div class="select-date">
							<span class="f-16"><?= $date ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
        <?php if (!empty($arParams['TARIFFS'])) : ?>
            <div class="select-tariffs-block" <?= ($arResult["FORM_NOTE"]) ? 'style="display: none"' : '' ?>>
                <div class="select-tariffs-content">
                    <span class="f-16"><?= $arParams['TARIFFS'][0] ?></span>
                    <?= Functions::buildSVG('down-arrow-icon', $templateFolder . '/images') ?>
                </div>
                <div class="select-tariffs-dropdown-block">
                    <?php foreach ($arParams['TARIFFS'] as $tariff) : ?>
                        <div class="select-tariff">
                            <span class="f-16"><?= $tariff ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
		<?php if ($arResult["isFormNote"] != "Y") : ?>
			<?=$arResult["FORM_HEADER"]?>
			<div class="form-table data-table">
				<?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
					<?php
					$value = false;

					switch ($questionId) {
						case 'course_id':
							if ($arParams['COURSE_ID']) {
								$value = $arParams['COURSE_ID'];
							}
							break;
						case 'date':
							$value = 'Открытая дата';
							break;
                        case 'tariff':
                            if (!empty($arParams['TARIFFS'])) {
                                $value = $arParams['TARIFFS'][0];
                            }
                            break;
					}
					?>
					<?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
						<?php echo $question['HTML_CODE']; ?>
					<?php else : ?>
						<?php if ($questionId == 'email' || $questionId == 'job') : ?>
							<div class="flex-question-block">
						<?php endif; ?>
						<div class="question-block <?= $questionId ?>">
							<input
								class="inputtext sign-course-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
								<?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
								placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
								name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
								type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
								value="<?= $value ?: '' ?>">
						</div>
						<?php if ($questionId == 'phone' || $questionId == 'city') : ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<input class="submit-sig-course-complex" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				<?php if ($arResult['FORM_DESCRIPTION']) : ?>
					<div class="under-main-feedback-form">
						<span class="f-16"><?= $arResult['FORM_DESCRIPTION'] ?></span>
					</div>
				<?php endif; ?>
			</div>
			<?=$arResult["FORM_FOOTER"]?>
		<?php endif; ?>
	</div>
</div>