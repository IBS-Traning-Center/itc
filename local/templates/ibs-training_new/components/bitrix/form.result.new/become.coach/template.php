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
		<?php if ($arResult["isFormNote"] != "Y") : ?>
			<?=$arResult["FORM_HEADER"]?>
			<div class="form-table data-table">
				<?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
					<?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
						<?php echo $question['HTML_CODE']; ?>
					<?php else : ?>
                        <?php if ($questionId == 'resume_file') : ?>
                            <div class="file-block">
                                <input
                                    class="inputfile input-type-file"
                                    name="form_file_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                    id="form_file_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                    type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                    <?= ($question['REQUIRED'] == 'Y') ? 'required' : '' ?>
                                >
                                <label
                                    class="label-type-file"
                                    for="form_file_<?= $question['STRUCTURE'][0]['ID'] ?>"
                                >
                                    <div class="icons-block">
                                        <div class="default">
                                            <?= Functions::buildSVG('file_icon', $templateFolder . '/images') ?>
                                        </div>
                                        <div class="added-file">
                                            <?= Functions::buildSVG('added', $templateFolder . '/images') ?>
                                        </div>
                                    </div>
                                    <div class="text-info">
                                        <span class="f-16"><?= $question['CAPTION'] ?></span>
                                        <i class="file-size f-16"></i>
                                    </div>
                                </label>
                                <div class="remove-file">
                                    <?= Functions::buildSVG('remove', $templateFolder . '/images') ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php if ($questionId == 'name' || $questionId == 'email' || $questionId == 'job_title') : ?>
                                <div class="flex-question-block">
                            <?php endif; ?>
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
                                        type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>">
                                <?php endif; ?>
                            </div>
                            <?php if ($questionId == 'last_name' || $questionId == 'phone'  || $questionId == 'city') : ?>
                                </div>
                            <?php endif; ?>
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
<div class="background-modal"></div>
<?php if ($arResult['FORM_NOTE']) : ?>
    <script>
        let closeCourseModal = document.querySelector('.close-course-modal');
        let backgroundModal = document.querySelector('.background-modal');
        let signCourseComplexBlock = document.querySelector('.sign-course-complex-block');

        if (
            closeCourseModal &&
            backgroundModal &&
            signCourseComplexBlock
        ) {
            signCourseComplexBlock.style.display = 'block';
            backgroundModal.style.display = 'block';

            closeCourseModal.addEventListener('click', () => {
                backgroundModal.style.display = 'none';
                signCourseComplexBlock.style.display = 'none';
            });
        }

        let openButtonsReserv = document.querySelectorAll('.trainer-modal');

        if (
            openButtonsReserv &&
            backgroundModal &&
            signCourseComplexBlock
        ) {
            openButtonsReserv.forEach(button => {
                button.addEventListener('click', () => {
                    signCourseComplexBlock.style.display = 'block';
                    backgroundModal.style.display = 'block';
                });
            });
        }
    </script>
<?php endif; ?>