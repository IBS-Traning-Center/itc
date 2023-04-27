<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опрос для клиентов Luxoft Training");
?><?if ($_REQUEST["submit-f"]) {?>
	<?foreach ($_REQUEST["question"] as $key=>$question) {?>
		<?if ((is_array($question) && strlen($question[0])>0)) {?>
			<?$arQuest=GetIBlockElement($key);?>
			<?$html.="<h3>".$arQuest["NAME"].":</h3>";?>
			<?$result=implode(", ", $question);?>
			<?$html.=$result;?>
			<?$html.="<br/><br/><br/>"?>
		<?} elseif (strlen($question)) {?>
			<?$html.="<h3>".$arQuest["NAME"].":</h3>";?>
			<?$html.=$question;?>
			<?$html.="<br/><br/><br/>"?>
		<?}?>
	<?}?>
	<?$arEventFields["TEXT"]=$html;?>
	<?CEvent::Send("POLL_RESULT", SITE_ID, $arEventFields);?>
	<?LocalRedirect($APPLICATION->GetCurDir()."?success=Y");?>
<?}?>
<?if ($_REQUEST["success"]=="Y") {?>
	<h2>Большое спасибо, что уделили нам время. Нам очень важно ваше мнение! </h2>
<?} else {?>
<?
$arFilter = Array("IBLOCK_ID"=>148, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arFields["PROPERTIES"]=$ob->GetProperties();
$arQuestion[]=$arFields;

}?>
<form>
<?foreach ($arQuestion as $question) {?>
<div data-id="<?=$question["ID"]?>" class="q<?=$question["ID"]?> question-section <?if ($question["PROPERTIES"]["HIDDEN"]["VALUE"]=="Да") {?>hidden<?}?>">
<h2><?=$question["NAME"]?></h2>
<?if ($question["PROPERTIES"]["TYPE"]["VALUE"]=="Чекбокс список") {?>
	<?foreach ($question["PROPERTIES"]["VARIANTS"]["VALUE"] as $key=>$variant)  {?>
	<label><input  <?if (intval($question["PROPERTIES"]["VARIANTS"]["DESCRIPTION"][$key])>0) {?>class="checkbox changer"  data-id="<?=intval($question["PROPERTIES"]["VARIANTS"]["DESCRIPTION"][$key])?>"<?} else {?> class="checkbox"<?}?> type="checkbox" name="question[<?=$question["ID"]?>][]" value="<?=$variant?>" /> <?=$variant?></label>
		<?if ($question["PROPERTIES"]["VARIANTS"]["DESCRIPTION"][$key]=="TEXT") {?>
			<input type="text" name="question[<?=$question["ID"]?>][]"/>
		<?}?>
	<br/>
	<?}?>
<?} elseif ($question["PROPERTIES"]["TYPE"]["VALUE"]=="Текстовый") {?>
	<textarea name="question[<?=$question["ID"]?>]" style="height: 100px; width: 100%; box-sizing: border-box"></textarea>	
<?}?>
</div>

<?}?>
<input type="submit" name="submit-f" class="btn-link" value="Отправить"/>
</form>
<script>
	$(document).ready(function() {
		$('.checkbox.changer').change(function() {
			if ($(this).prop("checked")==true) {
			$('.q'+$(this).data("id")).removeClass('hidden');
		} else {
			$('.q'+$(this).data("id")).addClass('hidden');
		}
		});
	})s;
</script>
<?}?>
<?/*
print_r($arQuestion);
*/
?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>