<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?=ShowError($arResult["ERROR_MESSAGE"]);?>
<?=ShowNote($arResult["OK_MESSAGE"]);?>

<?if (!empty($arResult["VOTE"]) && !empty($arResult["QUESTIONS"]) ):?>
<h2>Благодарим Вас за участие!</h2>
<p>Ваш код для скидки: <strong>CP-6B9QS-8YU11IU</strong></p>
<p>
* Скидка предоставляется на курсы из открытого расписания по Бизнес и Системному анализу при условии регистрации и оплаты до 31 июля 2013. </p>
<?endif?>

<?
	global $USER;
	if ($USER->IsAuthorized()) {
?>
<?if (!empty($arResult["VOTE"]) && !empty($arResult["QUESTIONS"]) ):?>
<br /><br /><br /><h2>Статистика голосований: (доступно авторизованным пользователям) </h2>
<div class="voting-result-box">

	<?foreach ($arResult["QUESTIONS"] as $arQuestion):?>

		<?if ($arQuestion["IMAGE"] !== false):?>
			<img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" />
		<?endif?>

		<b><?=$arQuestion["QUESTION"]?></b><br />

		<?if ($arQuestion["DIAGRAM_TYPE"] == "circle"):?>

			<table class="vote-answer-table">
				<tr>
					<td width="160"><img width="150" height="150" src="<?=$componentPath?>/draw_chart.php?qid=<?=$arQuestion["ID"]?>&dm=150" /></td>
					<td>
						<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
							<table class="vote-bar-table">
								<tr>
									<td><div class="vote-bar-square" style="background-color:#<?=$arAnswer["COLOR"]?>"></div></td>
									<td><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</td>
									<td><?=$arAnswer["MESSAGE"]?></td>
								</tr>
							</table>
						<?endforeach?>
					</td>
				</tr>
			</table>

		<?else://histogram?>

			<table width="100%" class="vote-answer-table">
			<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
				<tr>
					<td width="30%"><?=$arAnswer["MESSAGE"]?></td>
					<td width="70%">
						<table class="vote-bar-table">
							<tr>
								<td style="width:<?=($arAnswer["BAR_PERCENT"])?>%;background-color:#<?=$arAnswer["COLOR"]?>"></td>
								<td style="width:<?=(100-$arAnswer["BAR_PERCENT"])?>%;" class="answer-counter"><nobr><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</nobr></td>
							</tr>
						</table>
					</td>
				</tr>
			<?endforeach?>
			</table>

		<?endif?>
		<br />
	<?endforeach?>



</div>

<?endif?>

<? } ?>