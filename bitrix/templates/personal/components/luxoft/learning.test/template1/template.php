<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="pict-test-wrap">
	<img src="<?=$arResult["TEST"]["PICTURE"]["SRC"]?>" width="100%"/>
	<div class="test-name">
		<?=$arResult["TEST"]["NAME"]?>
	</div>
</div>
<?if ($arResult["NON_AUTHORIZED"]!="Y") {?>
<div class="test-main-pad">
<?php if (sizeof($arResult["ACCESS_ERRORS"])):?>

	<?php foreach ($arResult["ACCESS_ERRORS"] as $error):?>
		<p><font class="errortext"><?php echo $error?></font></p>
	<?php endforeach?>

<?php else:?>

	<?if (!empty($arResult["QUESTION"])):?>
	<?php if (is_array($arResult["INCORRECT_QUESTION"])):?>
		<div id="learn-test-message">
			<?php if ($arResult["INCORRECT_QUESTION"]["ID"] != $arResult["QUESTION"]["ID"]):?>
				<?=GetMessage("INCORRECT_QUESTION_NAME");?>: <?php echo $arResult["INCORRECT_QUESTION"]["NAME"]?><br />
			<?php endif?>
			<?=GetMessage("INCORRECT_QUESTION_MESSAGE");?>: <?php echo $arResult["INCORRECT_QUESTION"]["INCORRECT_MESSAGE"]?>
		</div>
	<?php endif?>
	
	<?/*<div class="learn-test-tabs"><?=GetMessage("LEARNING_QUESTION_TITLE");?>&nbsp;

	<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2 && $arResult["NAV"]["PREV_NOANSWER"] != $arResult["NAV"]["PREV_QUESTION"] && $arResult["NAV"]["PREV_NOANSWER"]):?>

		<a class="previous" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_NOANSWER"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_NOANSWER_TITLE")?>">&lsaquo;&lsaquo;</a>
		<a class="first" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_TITLE")?>">&lsaquo;</a>

	<?elseif ($arResult["NAV"]["PREV_QUESTION"]):?>
		<a class="previous" href="<?=$arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_PREVIOUS_TITLE")?>">&lsaquo;</a>
	<?endif?>


	<?while($arResult["NAV"]["START_PAGE"] <= $arResult["NAV"]["END_PAGE"]):?>

		<?if ($arResult["NAV"]["START_PAGE"] == $arResult["NAV"]["PAGE_NUMBER"]):?>
			<a class="selected" title="<?=GetMessage("LEARNING_QBAR_CURRENT_TITLE")?>">&nbsp;<?=$arResult["NAV"]["START_PAGE"]?>&nbsp;</a>
		<?elseif ($arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["ANSWERED"] == "Y"):?>

			<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2):?>
				<a href="<?=$arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["URL"]?>" class="answered" title="<?=GetMessage("LEARNING_QBAR_ANSWERED_TITLE")?>">&nbsp;<?=$arResult["NAV"]["START_PAGE"]?>&nbsp;</a>
			<?else:?>
				<a class="disabled" title="<?=GetMessage("LEARNING_QBAR_ANSWERED_TITLE")?>">&nbsp;<?=$arResult["NAV"]["START_PAGE"]?>&nbsp;</a>
			<?endif?>

		<?else:?>

			<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 0):?>
			<a title="<?=GetMessage("LEARNING_QBAR_NOANSWERED_TITLE")?>">&nbsp;<?=$arResult["NAV"]["START_PAGE"]?>&nbsp;</a>
			<?else:?>
			<a title="<?=GetMessage("LEARNING_QBAR_NOANSWERED_TITLE")?>" href="<?=$arResult["QBAR"][$arResult["NAV"]["START_PAGE"]]["URL"]?>">&nbsp;<?=$arResult["NAV"]["START_PAGE"]?>&nbsp;</a>
			<?endif?>

		<?endif;?>

	<?
	$arResult["NAV"]["START_PAGE"]++;
	endwhile;
	?>

	<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 2 && $arResult["NAV"]["NEXT_NOANSWER"] != $arResult["NAV"]["NEXT_QUESTION"] && $arResult["NAV"]["NEXT_NOANSWER"]):?>

		<a class="last" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_TITLE")?>">&rsaquo;</a>
		<a class="next" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_NOANSWER"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_NOANSWER_TITLE")?>">&rsaquo;&rsaquo;</a>

	<?elseif ($arResult["NAV"]["NEXT_QUESTION"]):?>
		<a class="next" href="<?=$arResult["QBAR"][$arResult["NAV"]["NEXT_QUESTION"]]["URL"]?>" title="<?=GetMessage("LEARNING_QBAR_NEXT_TITLE")?>">&rsaquo;</a>
	<?endif?>

	<?if ($arResult["TEST"]["TIME_LIMIT"]>0 && $arParams["SHOW_TIME_LIMIT"] == "Y"):?>
		<div id="learn-test-timer" title="<?=GetMessage("LEARNING_TEST_TIME_LIMIT");?>"><?=$arResult["SECONDS_TO_END_STRING"]?></div>
		<script type="text/javascript">
			var clockID = null; clockID = setTimeout("UpdateClock(<?=$arResult["SECONDS_TO_END"]?>)", 950);
		</script>
	<?endif?>

	</div>
	*/?>


	<div class="learn-question-cloud">
		<div class="learn-question-number"><?=GetMessage("LEARNING_QUESTION_TITLE")?> <span><?=$arResult["NAV"]["PAGE_NUMBER"]?></span> <?=GetMessage("LEARNING_QUESTION_OF");?> <?=$arResult["NAV"]["PAGE_COUNT"]?>
		</div>
		<div class="learn-question-name"><?=$arResult["QUESTION"]["NAME"]?><?if ($arResult["QUESTION"]["QUESTION_TYPE"] == "M"):?> (выберите все
правильные варианты ответов из предложенных)<?endif?>
			<?if (strlen($arResult["QUESTION"]["DESCRIPTION"]) > 0):?>
				<br /><br /><?=$arResult["QUESTION"]["DESCRIPTION"]?>
			<?endif?>

			<?if ($arResult["QUESTION"]["FILE"] !== false):?>
				<br /><br /><img src="<?=$arResult["QUESTION"]["FILE"]["SRC"]?>" width="<?=$arResult["QUESTION"]["FILE"]["WIDTH"]?>" height="<?=$arResult["QUESTION"]["FILE"]["HEIGHT"]?>" />
			<?endif?>
		</div>
	</div>
	<form class="learn_test_answer" name="learn_test_answer" action="<?=$arResult["ACTION_PAGE"]?>" method="post">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="TEST_RESULT" value="<?=$arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["ID"]?>">
		<input type="hidden" name="<?=$arParams["PAGE_NUMBER_VARIABLE"]?>" value="<?=($arResult["NAV"]["PAGE_NUMBER"] + 1)?>">
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />

		<?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "T"):?>
			<textarea name="answer" rows="5" cols="60"><?php echo (isset($arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"]) ? $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"][0] : "")?></textarea><br />
		<?php elseif ($arResult["QUESTION"]["QUESTION_TYPE"] == "R"):?>
			<?php for ($i = 0; $i < sizeof($arResult["QUESTION"]["ANSWERS"]); $i++):?>
				<div class="sorting">
				<?php echo $i+1?>.
				<select name="answer[]">
					<option value="0">&nbsp;</option>
					<?php for ($j = 0; $j < sizeof($arResult["QUESTION"]["ANSWERS"]); $j++):?>
						<option value="<?php echo $arResult["QUESTION"]["ANSWERS"][$j]["ID"]?>" <?php echo ($arResult["QUESTION"]["ANSWERS"][$j]["ID"] == $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"][$i] ? " selected" : "")?>><?php echo $arResult["QUESTION"]["ANSWERS"][$j]["ANSWER"]?></option>
					<?php endfor?>
				</select>
				</div>
			<?php endfor?>
		<?php else:?>
			<?foreach($arResult["QUESTION"]["ANSWERS"] as $arAnswer):?>

				<?if ($arResult["QUESTION"]["QUESTION_TYPE"] == "M"):?>
					<label><input id="answer<?=$arAnswer["ID"]?>" type="checkbox" name="answer[]" value="<?=$arAnswer["ID"]?>" <?if (in_array($arAnswer["ID"], $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"])):?>checked <?endif?>/>&nbsp;<?=$arAnswer["ANSWER"]?></label><br />
					<div class='clearfix'></div>
				<?elseif ($arResult["QUESTION"]["QUESTION_TYPE"] == "S"):?>
					<input style="float: left; margin-right: 6px;" id="answer<?=$arAnswer["ID"]?>" type="radio" name="answer" value="<?=$arAnswer["ID"]?>" <?if (in_array($arAnswer["ID"], $arResult["QBAR"][$arResult["NAV"]["PAGE_NUMBER"]]["RESPONSE"])):?>checked <?endif?>/>&nbsp;<label for="answer<?=$arAnswer["ID"]?>" style="width: 800px; float: left;"><?=$arAnswer["ANSWER"]?></label><br />
					<div class='clearfix'></div>
				<?endif?>

			<?endforeach?>
		<?php endif?>

		<br />
		<div class="nav-buttons">
		<?if ($arResult["TEST"]["PASSAGE_TYPE"] > 0 && $arResult["NAV"]["PREV_QUESTION"]):?>
			<input type="submit" class="previous orange" name="previous" onClick="javascript:window.location='<?=CUtil::JSEscape($arResult["QBAR"][$arResult["NAV"]["PREV_QUESTION"]]["URL"])?>'; return false;" value="" />
		<?else :?>
			<input type="submit" class="previous" disabled name="previous" value="" />
		<?endif?>
		<?//print_r($arResult["NAV"]);?>
		<?if ($arResult["NAV"]["PAGE_NUMBER"]!=$arResult["NAV"]["END_PAGE"]) {?>
			<input type="submit" class="next orange" name="next" value=""<?if ($arResult["TEST"]["PASSAGE_TYPE"] == 0):?> OnClick="return <?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "R"):?>checkSorting('<?=GetMessage("LEARNING_INVALID_SORT_CONFIRM")?>');<?php else:?>checkForEmpty('<?php if ($arResult["QUESTION"]["QUESTION_TYPE"] == "T"):?><?=GetMessage("LEARNING_EMPTY_RESPONSE_CONFIRM")?><?php else:?><?=GetMessage("LEARNING_NO_RESPONSE_CONFIRM")?><?php endif?>');<?php endif?>"<?endif?>>
		<?} else {?>
			<input type="submit" disabled class="next orange" name="next" value="" />
		<?}?>
		</div>
		&nbsp;&nbsp;&nbsp;
		<?php
		if ($arResult["NAV"]["PAGE_NUMBER"]==$arResult["NAV"]["END_PAGE"]) {?>
			<input style="margin: 0 auto; display: block;"  class="orange" type="submit" name="finish" value="Отправить" onClick="return confirm('<?=GetMessage("LEARNING_BTN_CONFIRM_FINISH")?>')">
			<?php
		}
		?>
		<input type="hidden" name="ANSWERED" value="Y">

	</form>
	<?php if (intval($arResult["TEST"]["CURRENT_INDICATION"]) > 0):?>
		<div><?php if ($arResult["TEST"]["CURRENT_INDICATION_PERCENT"] == "Y"):?><?=GetMessage("LEARNING_CURRENT_RIGHT_COUNT")?> - <?php echo $arResult["COMPLETE_PERCENT"]?>%.<?php endif?><?php if ($arResult["TEST"]["CURRENT_INDICATION_MARK"] == "Y" && $arResult["CURRENT_MARK"]):?> <?=GetMessage("LEARNING_CURRENT_MARK")?> - <?php echo $arResult["CURRENT_MARK"]?>.<?php endif?></div>
	<?php endif?>

	<?elseif ($arResult["TEST_FINISHED"] === true):?>

		<?ShowError($arResult["ERROR_MESSAGE"]);?>
		<?php if ($arResult["ATTEMPT"]["COMPLETED"]):?>
			<?php if ($arResult["ATTEMPT"]["COMPLETED"] == "N"):?>
				<?php ShowError(GetMessage("LEARNING_TEST_FAILED"))?>
			<?php elseif ($arResult["ATTEMPT"]["COMPLETED"] == "Y"):?>
				<b><?php ShowNote(GetMessage("LEARNING_TEST_PASSED"));?></b>
			<?php endif?>
		<?php endif?>
		<?php if (intval($arResult["TEST"]["FINAL_INDICATION"]) > 0):?>
			<table class="learn-result-table data-table">
				<?php if ($arResult["TEST"]["FINAL_INDICATION_CORRECT_COUNT"] == "Y"):?>
					<tr>
						<th><?php echo GetMessage("LEARNING_RESULT_QUESTIONS_COUNT")?></th>
						<td><?php echo $arResult["ATTEMPT"]["QUESTIONS"]?></td>
					</tr>
					<tr>
						<th><?php echo GetMessage("LEARNING_RESULT_RIGHT_COUNT")?></th>
						<td><?php echo $arResult["ATTEMPT"]["CORRECT_COUNT"]?></td>
					</tr>
				<?php endif?>
				<?php if ($arResult["TEST"]["FINAL_INDICATION_SCORE"] == "Y"):?>
				<tr>
					<th><?php echo GetMessage("LEARNING_RESULT_MAX_SCORE")?></th>
					<td><?php echo $arResult["ATTEMPT"]["MAX_SCORE"]?></td>
				</tr>
				<tr>
					<th><?php echo GetMessage("LEARNING_RESULT_SCORE")?></th>
					<td><?php echo $arResult["ATTEMPT"]["SCORE"]?> (<?php echo round($arResult["ATTEMPT"]["SCORE"] / $arResult["ATTEMPT"]["MAX_SCORE"] * 100)?>%)</td>
				</tr>
				<?php endif?>
				<?php if ($arResult["ATTEMPT"]["MARK"]):?>
					<?php if ($arResult["TEST"]["FINAL_INDICATION_MARK"] == "Y"):?>
						<tr>
							<th><?php echo GetMessage("LEARNING_RESULT_MARK")?></th>
							<td><?php echo $arResult["ATTEMPT"]["MARK"]?></td>
						</tr>
					<?php endif?>
					<?php if ($arResult["ATTEMPT"]["MESSAGE"] && $arResult["TEST"]["FINAL_INDICATION_MESSAGE"] == "Y"):?>
						<tr>
							<th><?php echo GetMessage("LEARNING_RESULT_MESSAGE")?></th>
							<td><?php echo $arResult["ATTEMPT"]["MESSAGE"]?></td>
						</tr>
					<?php endif?>
				<?php endif?>
			</table>
		<?php endif?>
		<p style="margin-top: 10px; font-size: 14px;">С результатами  пройденного теста Вы можете ознакомиться в <a href="/personal_test/testing_results/?TEST_ID=<?=$arResult["TEST"]["ID"]?>">личном кабинете</a></p>

		

	<?elseif (strlen($arResult["ERROR_MESSAGE"]) > 0):?>

		<?ShowError($arResult["ERROR_MESSAGE"]);?>
		<br />
		
		<form name="learn_test_start" method="post" action="<?=$arResult["ACTION_PAGE"]?>">
		<?=bitrix_sessid_post()?>
		<p>Для того, чтобы приступить к выполнению теста "<?=$arResult["TEST"]["NAME"]?>", нажмите кнопку "Начать"</p>
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />
		<input type="submit" name="next" value="<?=GetMessage("LEARNING_BTN_CONTINUE")?>">
		</form>

	<?else:?>

		

		<?if ($arResult["TEST"]["PREVIOUS_TEST_ID"] > 0 && $arResult["TEST"]["PREVIOUS_TEST_SCORE"] > 0 && $arResult["TEST"]["PREVIOUS_TEST_LINK"]):?>
			<?=str_replace(array("#TEST_LINK#", "#TEST_SCORE#"), array('"'.$arResult["TEST"]["PREVIOUS_TEST_LINK"].'"', $arResult["TEST"]["PREVIOUS_TEST_SCORE"]), GetMessage("LEARNING_PREV_TEST_REQUIRED"))?>
			<br />
		<?endif?>

		<br />
		<form name="learn_test_start" method="post" action="<?=$arResult["ACTION_PAGE"]?>">
		<?=bitrix_sessid_post()?>
		<p style="font-size: 14px;">Для того чтобы приступить к выполнению теста "<?=$arResult["TEST"]["NAME"]?>", нажмите кнопку "Начать"</p>
		<input type="hidden" name="back_page" value="<?=$arResult["SAFE_REDIRECT_PAGE"]?>" />
		<input type="submit" name="next" value="<?=GetMessage("LEARNING_BTN_START")?>">
		</form>

	<?endif?>
<?php endif?>
</div>
<?}?>
