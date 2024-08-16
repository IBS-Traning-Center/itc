<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?//phpinfo();
?>
	
	<?$cp = $this->__component; 

	if (is_object($cp))
	{
   
    $cp->arResult['PREVIEW_TEXT'] = $arResult["PREVIEW_TEXT"];
    $cp->SetResultCacheKeys(array('PREVIEW_TEXT'));
	
    $arResult['MY_TITLE'] = $cp->arResult['MY_TITLE'];
	}?>
	<?$c_time= strtotime($arResult["PROPERTIES"]["countdown_time"]["VALUE"])-time()?>
    <?$time=seconds2times($c_time)?>
     <?foreach ($time as $key=>$tm) {?>
        <?if (strlen($tm)==0) {?>
            <?$time[$key]="00";?>
        <?} elseif (strlen($tm)==1) {?>
            <?$time[$key]="0".$tm;?>
        <?}?>
    <?}?>
    <?if (intval($c_time)>0) {?>
    <?$strtime=$time[3].":".$time[2].":".$time[1].":".$time[0]?>
	<script type="text/javascript">
            $(function(){

                $('#counter').countdown({
                    digitWidth: 41,
                    digitHeight: 60,
                    digitImages: 3,
                    image: '/images/flippers.png',
                    startTime: '<?=$strtime?>'
                });
                
            })
        </script>
    <?}?>
	
   <?
   global $main_header;
   ?>
    <? $main_header=$APPLICATION->GetPageProperty("main_header");


    ?>
	
        
	
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
        <div class="time-n-comment"><?=$arResult["DISPLAY_ACTIVE_FROM"]?><span class="wathers"><i class="fa fa-eye" aria-hidden="true"></i> <?=$arResult["SHOW_COUNTER"]?></span> </div>
	<?endif;?>
	
	<?/*foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
	<?endforeach;*/?>

	<?
	$publication = $arResult['DETAIL_TEXT'];
	?>
	<div class="clearfix border-btm">
	
		<?//print_r($arResult["PROPERTIES"]["trainert_name"]);?>
		<?
		if (intval($arResult["PROPERTIES"]["trainert_name"]["VALUE"])>0) { 
			$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "NAME");
			$arFilter = Array("IBLOCK_ID"=> 23, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_trainert_name" => $arResult["PROPERTIES"]["trainert_name"]["VALUE"], "!ID"=> $arResult["ID"]);
			$res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=> "DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);
			while($ob = $res->GetNextElement())
			{
			 $arFields = $ob->GetFields();
			 $arTrainer[]=$arFields;
			 $arNot[]=$arFields["ID"];
			 /*echo  "<pre>";
			 print_r($arFields);*/
			}
		}
		$arNot[]=$arResult["ID"];
		?> 
		<?
		$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PAGE_URL", "NAME");
		$arFilter = Array("IBLOCK_ID"=> 23, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "!ID"=>  $arNot);
		$res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=> "DESC"), $arFilter, false, Array("nPageSize"=>10), $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $arFields = $ob->GetFields();
		 $arNews[]=$arFields;

		 /*echo  "<pre>";
		 print_r($arFields);*/
		}
		?> 
	
	<div class="addition-right-text-wrap">
		<?if (is_array($arTrainer) && count($arTrainer)>0 && intval($arResult["PROPERTIES"]["trainert_name"]["VALUE"])>0) {?>
		<div class="list-of-news-small">
			<div class="title-news-small">Другие статьи автора</div>
			<?foreach ($arTrainer as $publ) {?>
				<a href="<?=$publ["DETAIL_PAGE_URL"]?>"><?=$publ["NAME"]?></a>
			<?}?>
		</div>
		<?}?>
		
		<div class="list-of-news-small">
			<div class="title-news-small">Последние статьи в блоге</div>
			<?foreach ($arNews as $publ) {?>
				<a href="<?=$publ["DETAIL_PAGE_URL"]?>"><?=$publ["NAME"]?></a>
			<?}?>
		</div>

	</div>
	
	<div class="div-text-item-wrap">
        <div class="telegram-banner">
            <a href="https://t.me/IBS_Training_Center" target="_blank" rel="nofollow noopener" class="telegram-banner__icon">
                <img src="/local/templates/ibs-training/assets/images/telegram_logo_icon.png" alt="IBS Training Center Telegram">
            </a>
            <div class="telegram-banner__text">Подписывайтесь на наш канал в Telegram:<br />
                больше материалов экспертов, анонсы бесплатных вебинаров и задачки для IT-специалистов</div>
            <a href="https://t.me/IBS_Training_Center" target="_blank" rel="nofollow noopener" class="telegram-banner__button">
                <span>Подписаться</span>
            </a>
        </div>
        <style>
            .telegram-banner {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .telegram-banner__icon {
                display: block;
                min-width: 100px;
                width: 100px;
            }
            .telegram-banner__icon img {
                width: 100%;
                height: 100%;
                max-width: 100%;
                max-height: 100%;
            }
            .telegram-banner__text {
                padding: 0 20px;
                font-size: 18px;
                font-weight: 600;
                line-height: 1.4;
                color: #333333;
            }
            .telegram-banner__button {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px 20px;
                width: 165px;
                height: 54px;
                border-radius: 30px;
                border: 1px solid transparent;
                background-color: #3390ec;
                color: #fff;
                font-weight: 600;
                line-height: 1;
                transition: all 0.25s;
            }
            .telegram-banner__button:hover {
                color: #3390ec;
                background-color: #ffffff;
                border-color: #3390ec;
                transition: all 0.25s;
            }
            @media (max-width: 1079px) {
                .telegram-banner__icon {
                    display: none;
                }
                .telegram-banner__text {
                    padding: 0;
                    font-size: 16px;
                }
            }
            @media (max-width: 767px) {
                .telegram-banner {
                    flex-direction: column;
                    align-items: flex-start;
                }
                .telegram-banner__text {
                    font-size: 15px;
                    margin-bottom: 15px;
                }
            }
        </style>
    <?=$publication?>
	</div>
	



