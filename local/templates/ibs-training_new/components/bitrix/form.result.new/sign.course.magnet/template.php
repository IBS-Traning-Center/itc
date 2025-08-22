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
<div class="sign-course-magnet-block">
	<div class="top-sign-course-magnet">
		<h4><?= $arParams['MAGNET_BUTTON_NAME'] ?></h4>
        <div class="close-course-magnet-modal"><?= Functions::buildSVG('close_course_modal', $templateFolder . '/images') ?></div>
	</div>
	<div class="questions-block">
		<?php if ($arResult["FORM_NOTE"]) : ?>
			<p class="f-20 success-text"><?= $arResult["FORM_NOTE"] ?></p>
		<?php endif; ?>
		<?php if ($arResult["isFormNote"] != "Y") : ?>
			<?=$arResult["FORM_HEADER"]?>
			<div class="form-table data-table">
				<?php foreach ($arResult["QUESTIONS"] as $questionId => $question) : ?>
					<?php
					$value = false;

					switch ($questionId) {
						case 'course_name':
                            			if ($arParams['COURSE_SIGN']) {
           			                     $value = $arParams['COURSE_SIGN'] . ' ';
                            			}
                            			if ($arParams['COURSE_NAME']) {
              			                  $value = $value . $arParams['COURSE_NAME'];
                            			}
               			             break;
                    			    case 'course_name_crm':
                       			     if ($arParams['MAGNET_LEAD_NAME']) {
                       			         $value = $arParams['MAGNET_LEAD_NAME'];
                     			       }      
                      			      break;
                      			  case 'magnet_code':
          			                  if ($arParams['MAGNET_CODE']) {
      			                          $value = $arParams['MAGNET_CODE'];
       			                     }
         			           break;
					}
					?>
					<?php if ($question['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
                  			      <?php if ($value) : ?>
                    			        <input
                    			            name="form_hidden_<?= $question['STRUCTURE'][0]['ID'] ?>"
                   			             type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                   			             id="<?= $question['STRUCTURE'][0]['ID'] ?>"
                   			             value="<?= $value ?: '' ?>">
                  			      <?php else : ?>
                   			             <?php echo $question['HTML_CODE']; ?>
                  			      <?php endif; ?>
					<?php else : ?>
						<?php if ($questionId == 'email') : ?>
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
                                    type="<?= $question['STRUCTURE'][0]['FIELD_TYPE'] ?>"
                                    value="<?= $value ?: '' ?>">
                            <?php endif; ?>
						</div>
						<?php if ($questionId == 'phone') : ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<input class="submit-sig-course-magnet" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
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

<?php if ($arResult['FORM_NOTE']) : ?>
    <script>
        let closeCourseModal = document.querySelector('.close-course-magnet-modal');
        let backgroundModal = document.querySelector('.background-modal');
        let signCourseMagnetBlock = document.querySelector('.sign-course-magnet-block');

        if (
            closeCourseModal &&
            backgroundModal &&
            signCourseMagnetBlock
        ) {
            signCourseMagnetBlock.style.display = 'block';

            closeCourseModal.addEventListener('click', () => {
                backgroundModal.style.display = 'none';
                signCourseMagnetBlock.style.display = 'none';
            });
        }
    </script>
<?php endif; ?>