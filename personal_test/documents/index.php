<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои документы");
?>
<?if (!$USER->IsAuthorized()) {?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
		"REGISTER_URL" => "register.php",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "profile.php",
		"SHOW_ERRORS" => "Y" 
		)
	);?>
<?} else {?>
	<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	$userId = $USER->GetID();

	$connection = Bitrix\Main\Application::getConnection();
	$sqlHelper = $connection->getSqlHelper();

	$today = date('d.m.Y');
	$sql = "SELECT * FROM certificates WHERE user_id = '" . $userId . "' ORDER BY date_from DESC";
	$recordset = $connection->query($sql);
	while ($record = $recordset->fetch()) {
		if ((strtotime($today) <= strtotime($record['date_to'])) || ('' == $record['date_to'])) {
			$certificate['NUMBER'] = $record['certificate_number'];
			$certificate['TYPE'] = $record['certificate_type'];
			$certificate['LEVEL'] = $record['certification_level'];
			$certificate['DATE_FROM'] = $record['date_from'];
			$certificate['DATE_TO'] = $record['date_to'];
			$certificate['LINK'] = $record['link'];
			$arResult['CERTIFICATES'][] = $certificate;
		}
	}
	?>

	<div class="courses">
		<div class="heading">
			<h2>Мои документы</h2>
		</div>
		<?if ($arResult['CERTIFICATES']) {?>
			<div class="courses">
				<ul class="list order-list">
					<?foreach ($arResult["CERTIFICATES"] as $certificate) {?>
						<li>
							<div class="description">
								<div class="info">
									<h3><a><?=$certificate["TYPE"]?> <?=$certificate["LEVEL"]?></a></h3>
									<p><?=$certificate["NUMBER"]?></p>
								</div>
								<div class="more">
									<p><strong><a href="https://ibs-training.ru/cert/<?=$certificate["LINK"]?>">Открыть документ</a></strong></p>
									<span class="date">
										<?if ($certificate["DATE_TO"] == "") {?>
											<?=$certificate["DATE_FROM"]?>, сертификат бессрочный
										<?} else {?>
											<?=$certificate["DATE_FROM"]?> - <?=$certificate["DATE_TO"]?>
										<?}?>
									</span>
								</div>
							</div>
						</li>
					<?}?>
				</ul>
			</div>
		<?} else {?>
			<h3 style="font-size: 16px; font-weight: bold; margin: 10px;">Документов не найдено</h3>
		<?}?>
	</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>