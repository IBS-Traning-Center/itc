<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<h2>Полезные ссылки: </h2>
<p>
	<a target="_blank" href="http://ibs-training.ru.ru/subscribe/">Подписка по России</a>
</p>
<p>
	<a target="_blank" href="http://ibs-training.ru.ru/subscribe-news/">Подписка по Украине</a>
</p>
<p>
	<a target="_blank" href="http://ibs-training.ru.ru/subscribe-s/">Подписка Санкт-Петербург</a>
</p>
<p>
	<a target="_blank" href="http://ibs-training.ru.ru/current-budget/">Счета пользователей</a>
</p>
<?$APPLICATION->SetTitle("Проверка email на существование в базе подписчиков");?>
	<?if (strlen($_REQUEST['email'])==0) {?>
		<form method="POST">
			<h3>Укажите список email (разделитель - перенос строки)</h3>
			<textarea style="width: 100%; height: 300px;" name="email"></textarea><br/>
			<input type="submit" value="Проверить" name="submit"/>
		</form>
	<?} else {?>
		<?//echo  nl2br(trim($_REQUEST['email']))?>
		<?CModule::IncludeModule("subscribe")?>
		<?$myArray = preg_split('/<br[^>]*>/i', nl2br(trim($_REQUEST['email'])))?>
		<?//echo "<pre>"?>
		<?//print_r ($myArray)?>
		<?$count=count($myArray)?>
		<?foreach ($myArray as $email) {?>
			<?$subscr = CSubscription::GetList(
				array("ID"=>"ASC"),
				array("EMAIL"=>$email)
			);
			if (($subscr_arr = $subscr->Fetch())) {
				//echo $email.'- exist<br/>';
			} else {
				$arDont[]=$email;
			}?>
			
		<?}?>
		<?echo "<h2>Проверно: ".$count." email из них ".count(array_unique($arDont))." несуществующих</h2>"?>
		<h3>Список несуществующих в базе: </h3>
			<?=implode('<br/>', array_unique($arDont));?>
	<?}?>
<br/>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>