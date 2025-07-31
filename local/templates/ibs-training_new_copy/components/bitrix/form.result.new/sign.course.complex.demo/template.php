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

<div class="sign-course-complex-block demo">
	<div class="top-sign-course-complex">
		<h4><?= Loc::getMessage('SIGN_COURSE_TITLE') ?></h4>
        <div class="close-course-modal demo"><?= Functions::buildSVG('close_course_modal', $templateFolder . '/images') ?></div>
	</div>
	<div class="questions-block">
		<?php if ($arResult["FORM_NOTE"]) : ?>
			<p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
		<?php endif; ?>
		<?php if ($arResult["isFormNote"] != "Y") : ?>
			<?=$arResult["FORM_HEADER"]?>
			<div class="form-table data-table">
				<?php if ($arResult['FORM_DESCRIPTION']) : ?>
					<div class="question-block">
						<span class="f-16"><?= $arResult['FORM_DESCRIPTION'] ?></span>
					</div>
				<?php endif; ?>
				<?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
					<?php
					$value = false;

					switch ($questionId) {
                        case 'course_name_crm':
                            if ($arParams['LEAD_NAME']) {
                                $value = $arParams['LEAD_NAME'];
                            }
                            else {
                                if ($arParams['COURSE_SIGN']) {
                                    $value = 'Демо-уроки. Программа: ' . $arParams['COURSE_SIGN'] . ' ';
                                }
                                if ($arParams['COURSE_NAME']) {
                                    $value = $value . $arParams['COURSE_NAME'];
                                }
                            }
                            break;
                        case 'demo_code':
                            if ($arParams['DEMO_SIGN']) {
                                $value = $arParams['DEMO_SIGN'];
                            }
                            break;
					}
					?>
					<?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
						<?php echo $question['HTML_CODE']; ?>
					<?php else : ?>
						<div class="question-block <?= $questionId ?>">
							<?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>
                                <input
                                    <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                    name="form_checkbox_<?= $questionId ?>[]"
                                    type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                    id="<?= $question['STRUCTURE'][0]['ID'] ?>"
                                    value="<?= $question['STRUCTURE'][0]['ID'] ?>">
                                <span><?= $question['CAPTION'] ?></span>
                            <?php else : ?>
                                <input
                                    class="inputtext sign-course-form-input <?= $questionId ?> <?= isset($arResult['FORM_ERRORS'][$questionId]) ? 'has-error' : '' ?>"
                                    <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                    <?= ($questionId == 'client_id') ? 'id="clientID"' : '' ?>
                                    placeholder="<?= $question['CAPTION'] ?> <?= ($question['REQUIRED'] == 'Y') ? '*' : '(не обязательно)' ?>"
                                    name="form_text_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                    type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                    value="<?= $value ?: '' ?>">
                            <?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<input class="submit-sig-course-complex" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
			</div>
			<?=$arResult["FORM_FOOTER"]?>
		<?php endif; ?>
	</div>
</div>

<?php if ($arResult['FORM_NOTE']) : ?>
    <script>
        let closeCourseModal = document.querySelector('.close-course-modal.demo');
        let backgroundModal = document.querySelector('.background-modal');
        let signCourseComplexBlock = document.querySelector('.sign-course-complex-block.demo');

        if (
            closeCourseModal &&
            backgroundModal &&
            signCourseComplexBlock
        ) {
            signCourseComplexBlock.style.display = 'block';

            closeCourseModal.addEventListener('click', () => {
                backgroundModal.style.display = 'none';
                signCourseComplexBlock.style.display = 'none';
            });
        }
    </script>
<?php endif; ?>