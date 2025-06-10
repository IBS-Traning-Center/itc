<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$index = 1;?>
<table width="100%" cellspacing="0" class="info_1">
	<tbody>
		<tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
    		<td class="client_speak_name">
    			<p><strong>
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" /></a>
					<?else:?>
						<img class="" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" />
					<?endif;?>
				<?endif?>
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<span class="client_name"><?echo $arItem["NAME"]?></span>
  				<?endif;?>
				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
				<?endif?>
				</strong>
	    		<!--<br /><span class="cabout">Отзыв на курсы</span></p>-->
	    		<?
	    		//сделаем запрос к инфоблоку отзывов
				$arGroupBy = Array();
				$arSelectFields = Array("ID", "PROPERTY_NAME",  "PROPERTY_SURNAME", "PROPERTY_SURNAME", "PROPERTY_REVIEW");
				$arFilter = Array("IBLOCK_ID"=>61, "PROPERTY_CLIENT"=>$arItem["ID"]);
				$arOrder = Array("DATE_CREATE"=>"desc");
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelectFields);
				$otzyv_number = 0;
				while($ar_fields = $res->GetNext())
				{
					$etr_id= $ar_fields["ID"];
                    //print_r($ar_fields);
                    $otzyv_author_name = $ar_fields["PROPERTY_NAME_VALUE"];
                    $otzyv_author_surname = $ar_fields["PROPERTY_SURNAME_VALUE"];
                    $otzyv_author_desc = $ar_fields["PROPERTY_REVIEW_VALUE"];
                    $otzyv_number = $otzyv_number + 1;
                    continue;
				}
	    		?>
	    		<?if ($otzyv_number>0) { ?>
	    		<p class="client_speak">
				<span class="course_name">UML-моделирование предметной области (основы)</span><br />
	    		<span class="author_name"><?=$otzyv_author_surname?> <?=$otzyv_author_name?>:</span><br /><?=$otzyv_author_desc?></p>
	    		<? } ?>
           </td>
<?if ( $index % 2 == 0 )  {?>
    	</tr>
    	<tr><? } ?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
<?$index = $index + 1 ;?>
<?endforeach;?>
      	</tr>
	</tbody>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<!--
<table width="100%" cellspacing="0" class="info_1">
	<tbody>
    	<tr>
    		<td class="client_speak_name">
        		<p><strong><img src="/images/clients/client_deutschebank_small.jpg">Daniel Marovitz,</strong>
          		<br />Управляющий директор по производству и технологиям Deutsche Bank</p>
				<p  class="client_speak">"Нас привлекла компетенция команды Luxoft. Более 60% сотрудников Luxoft – опытные специалисты, работающие в IT свыше 7 лет; более 80% – дипломированные специалисты или имеют кандидатскую степень. Они работают с такими лидерами рынка, как Boeing и Dell. В Luxoft мы встретили экспертов готовых с пристрастием допрашивать клиента, то, в чем Вы так нуждаетесь при осуществлении сложных комплексных проектов."</p>
       		</td>
       		<td class="client_speak_name">
        		<p><strong><img src="/images/clients/client_renesans_small.gif">Ярослав Медокс,</strong>
          		<br />Директор департамента развития информационных систем КБ Ренессанс Кредит</p>
				<p class="client_speak">"Компания Luxoft проявила себя как компетентный и надежный партнер, обладающий глубокими знаниями в области банковских технологий и способный найти подход к решению самых сложных задач. Cозданный фундамент нашего сотрудничества позволит и в будущем развивать и совершенствовать современные эффективные инструментарии, используемые в КБ Ренессанс Кредит."</p>
       		</td>
		</tr>
	</tbody>
</table>
-->