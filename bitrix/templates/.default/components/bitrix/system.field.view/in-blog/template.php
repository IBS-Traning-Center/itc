<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$first = true;
//iwrite($arResult);
//iwrite($arParams);
foreach ($arResult["VALUE"] as $res):
	if (!$first):
		?><span class="fields separator">/</span><?
	else:
		$first = false;	
	endif;

	if (StrLen($arParams['arUserField']['PROPERTY_VALUE_LINK']) > 0)
		$res = '<a href="'.str_replace('#VALUE#', urlencode($res), $arParams['arUserField']['PROPERTY_VALUE_LINK']).'">'.$res.'</a>';

?><span class="fields"><?if ($arResult['INFO_EXPERT']['EXPERT_CODE']){?><a href="/about/experts/<?=$arResult['INFO_EXPERT']['EXPERT_CODE']?>.html">Перейти на страницу эксперта</a><? } else { ?><?=$res?><? } ?></span><?
endforeach;?>
