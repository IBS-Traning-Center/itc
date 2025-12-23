<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

use Bitrix\Main\Type\DateTime;
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
$application = \Bitrix\Main\Application::getInstance();
$request = $application->getContext()->getRequest();
$aurhorization_code = $request->getQuery('code');
if ($aurhorization_code) {
	$httpClient = new \Bitrix\Main\Web\HttpClient();
	$url = 'https://api.hh.ru/openapi/redoc#section/Avtorizaciya/Poluchenie-access-i-refresh-tokenov';
	$postData = [
		'aurhorization_code' => $aurhorization_code
	];
	$response = $httpClient->post($url, $postData);
	$access_token = $response->getPost("access_token");

	if ($access_token) {
		$name = 'Authorization';
		$value = 'Bearer ' . $access_token;
		$httpClient->setHeader($name, $value, true);

		$url = 'https://api.hh.ru/external_certificates/user';
		$hh_user_id = $httpClient->get($url);

		if ($hh_user_id) {
			$user_id = $USER->GetID();
			$sql = "INSERT hh_users (user_id, hh_user_id) VALUES ('" . $user_id . "', '" . $hh_user_id . "')";
			$recordset = $connection->query($sql);
			if ($record = $recordset->fetch()) {
				$sql = "SELECT * FROM certificates WHERE user_id = '" . $user_id . "'";
				$recordset = $connection->query($sql);
				
				//передача сертификатов hh
				$access_token_app = '1';
				$name = 'Authorization';
				$value = 'Bearer ' . $access_token_app;

				$httpClient->setHeader($name, $value, true);

				while ($record = $recordset->fetch()) {
					$provider_id = '';
					$program_id = '';
					$link = "https://ibs-training.ru/cert/" . $record['link'];
					$date_from = new DateTime($record['date_from'], 'd.m.Y');

					$postData = [
						'certification_provider_id' => $provider_id,
						'ceritification_program_id' => $program_id,
						'ceritificate_link' => $link,
						'certificate_id' => $record['certificate_number'],
						'issued_at' => $date_from->format('Y-m-d\TH:i:sP'),
						'user_id' => $hh_user_id,
					];

					if ('' != $record['date_to']) {
						$date_to = new DateTime($record['date_to'], 'd.m.Y');
						$postData['expires_at'] = $date_to->format('Y-m-d\TH:i:sP');
					}

					$url = 'https://api.hh.ru/external_certificates';
					$result = $httpClient->post($url, $postData);
					if ($result) {
						$sql= "UPDATE certificates SET sent_to_hh = TRUE WHERE id = '" . $record['id'] . "'";
						$set = $connection->query($sql);
					}
				}
			}
		}
	}
}
?>

<div class="offclass">
<?GLOBAL $arRegK?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "notification", array(
	"IBLOCK_TYPE" => "edu_const",
	"IBLOCK_ID" => "106",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrfilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "DESCRIPTION",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>

<div class="discount">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.account", "acc", array(
	"SET_TITLE" => "N"
	),
	false
);?>
</div>
<div class="schedule">
<?$APPLICATION->IncludeComponent("edu:events.calendar.custom", "edu_calendar_trainings", array(
	"IBLOCK_TYPE" => "edu",
	"PROPERTY_CITYCHECK" => "0",
	"IBLOCK_ID" => "9",
	"MONTH_VAR_NAME" => "month",
	"YEAR_VAR_NAME" => "year",
	"WEEK_START" => "1",
	"SHOW_YEAR" => "N",
	"SHOW_TIME" => "N",
	"TITLE_LEN" => "200",
	"SHOW_CURRENT_DATE" => "Y",
	"SHOW_MONTH_LIST" => "N",
	"NEWS_COUNT" => "0",
	"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
	"AJAX_MODE" => "Y",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"DATE_FIELD" => "PROPERTY_STARTDATE",
	"TYPE" => "EVENTS",
	"SET_TITLE" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>
<div class="courses">
	<div class="heading">
						<h2>Рекомендуемые курсы</h2>
						<a class="openModal" href="javascript:void(0)">Настроить выбор курсов</a>
	</div>
	<?
	$data  = date("Y-m-d");
	$GLOBALS["arrFilter"] =array("ID"=>$arRec, "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data);
	GLOBAL $arLinked;
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"edu_ru_all_city_schedule_cources_cal",
		Array(
			"IBLOCK_TYPE" => "edu",	
			"IBLOCK_ID" => "9",	
			"NEWS_COUNT" => "5",	
			"SORT_BY1" => "PROPERTY_startdate",	
			"SORT_ORDER1" => "ASC",	
			"SORT_BY2" => "SORT",	
			"SORT_ORDER2" => "ASC",	
			"FILTER_NAME" => "arrFilter",	
			"ADDIT_ARRAY" => $arLinked,		
			"FIELD_CODE" => array(	
								0 => "",
								1 => "",
							),
							"SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
							"PROPERTY_CODE" => array(	
								0 => "course_СЃode",
								1 => "startdate",
								2 => "enddate",
								3 => "schedule_time",
								4 => "schedule_description",
								5 => "schedule_price",
								6 => "schedule_duration",
								7 => "hot_checkbox",
								8 => "prschedule_startdate",
								9 => "prschedule_enddate",
								10 => "prschedule_time",
								11 => "prschedule_desc",
								12 => "",
							),
							"CHECK_DATES" => "N",	
							"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	
							"AJAX_MODE" => "N",	
							"AJAX_OPTION_SHADOW" => "Y",	
							"AJAX_OPTION_JUMP" => "N",	
							"AJAX_OPTION_STYLE" => "Y",	
							"AJAX_OPTION_HISTORY" => "N",	
							"CACHE_TYPE" => "Y",	
							"CACHE_TIME" => "3600",	
							"CACHE_FILTER" => "Y",	
							"PREVIEW_TRUNCATE_LEN" => "",	
							"ACTIVE_DATE_FORMAT" => "d.m.Y",	
							"DISPLAY_PANEL" => "N",	
							"SET_TITLE" => "N",	
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	
							"ADD_SECTIONS_CHAIN" => "N",	
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",	
							"PARENT_SECTION" => "",	
							"PARENT_SECTION_CODE" => "",	
							"DISPLAY_TOP_PAGER" => "N",	
							"DISPLAY_BOTTOM_PAGER" => "N",	
							"PAGER_TITLE" => "",	
							"PAGER_SHOW_ALWAYS" => "N",	
							"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",	
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "N",
							"DISPLAY_PREVIEW_TEXT" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",	
							)
						);?>
</div>

<div class="certificates">
        <h2>Сертификаты</h2>
        <?GLOBAL $arrrFilter?>
        <?$arrrFilter=array("PROPERTY_USER"=>$USER->GetID(), "!PROPERTY_CERT"=>False)?>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "cert", array(
        "IBLOCK_TYPE" => "edu_const",
        "IBLOCK_ID" => "108",
        "NEWS_COUNT" => "4",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arrrFilter",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "USER",
            1 => "CERT",
            2 => "DESCRIPTION",
            3 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
        ),
        false
    );?>
    </div>

<div class="popup">
	<?$APPLICATION->IncludeComponent(
    "luxoft:pick.recommend",
    "",
    Array(
 
    )
);?>
		
</div>
<?}?>
<script>
$(document).ready(function() {
	var randInt;
	$("a.tobasket").click(function(){
		$(this).fadeOut("fast");
		$(this).fadeIn("fast");
		var id_record = $(this).attr("id_basket");
		/*$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
		});
		randInt = Math.floor(Math.random()*100000);
		$(".basketSmall").fadeOut("slow");
	   	$(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25});
	   	//pageTracker._trackEvent('Order', 'PutToBasket', id_record);
	   	$(".basketSmall").fadeIn("slow");
		*/
		$.getJSON('/ajax/add_course_to_basket.php?action=ADD2BASKET&id='+id_record+'&quantity=1',function(data){
            $(".basketSmall").fadeOut("slow");
			alert("Курс добавлен в корзину");
            $(".basketSmall").load("/ajax/show_basket.php?rand='+randInt+'",{limit: 25}, function(){
                $(".basketSmall").fadeIn("slow");
			   
            });

        });
	   	return false;
	});
	//$(".show_tooltip").tooltip({  position: 'center right', opacity: 0.9,  effect: 'toggle' ,  offset: [25, 10] });
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>