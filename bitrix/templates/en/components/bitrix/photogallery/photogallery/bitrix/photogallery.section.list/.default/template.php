<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arParams["WORD_LENGTH"] = (intVal($arParams["WORD_LENGTH"]) > 0 ? intVal($arParams["WORD_LENGTH"]) : 17);

if ($arResult["SECTIONS_CNT"] > 0 && is_array($arResult["SECTIONS"]))
{
	?><?=$arResult["NAV_STRING"]?><?
	
	?><div class="photo-albums"><?
	foreach ($arResult["SECTIONS"] as $res):

	?><div class="photo-album"><?
		?><div class="photo-album-img"><?
		?><table cellpadding="0" cellspacing="0" class="shadow"><?
			?><tr class="t"><td colspan="2" rowspan="2"><?
				?><div class="outer" style="width:<?=($arParams["ALBUM_PHOTO_THUMBS_SIZE"] + 38)?>px;"><?
					?><div class="tool" style="height:<?=$arParams["ALBUM_PHOTO_THUMBS_SIZE"]?>px;"></div><?
					?><div class="inner"><?
						?><a href="<?=$res["LINK"]?>" <?
							?>title="<?=htmlspecialChars($res["~NAME"])?><?=htmlspecialChars(!empty($res["DESCRIPTION"]) ? ", ".$res["DESCRIPTION"] : "")?>"><?
							if (!empty($res["PICTURE"]["SRC"])):
								?><img src="<?=$res["PICTURE"]["SRC"]?>" border="0" <?
									?>width="<?=$arParams["ALBUM_PHOTO_THUMBS_SIZE"]?>" <?
									?>height="<?=$arParams["ALBUM_PHOTO_THUMBS_SIZE"]?>" <?
									?>alt="<?=htmlspecialChars($res["~NAME"])?>" /><?
							else:
								?><img src="<?=$templateFolder?>/images/no_image.gif" border="0" <?
									?>width="<?=$arParams["ALBUM_PHOTO_THUMBS_SIZE"]?>" <?
									?>height="<?=$arParams["ALBUM_PHOTO_THUMBS_SIZE"]?>" <?
									?>alt="no image" /><?
							endif;
						?></a><?
					?></div><?
				?></div><?
			?></td><td class="t-r"><div class="empty"></div></td></tr><?
			?><tr class="m"><td class="m-r"><div class="empty"></div></td></tr><?
			?><tr class="b"><td class="b-l"><div class="empty"></div></td><td class="b-c"><div class="empty"></div></td><td class="b-r"><div class="empty"></div></td></tr><?
		?></table><?
		?></div><?
		
	?><div class="photo-album-info"><?
		?><div class="name" id="photo_album_name_<?=$res["ID"]?>" style="width:<?=($arParams["ALBUM_PHOTO_THUMBS_SIZE"] + 38)?>px;"><?
			?><a href="<?=$res["LINK"]?>" title="<?=htmlspecialChars(empty($res["~DESCRIPTION"]) ? $res["~NAME"] : $res["~DESCRIPTION"])?>"><?
				?><?=(strLen($res["NAME"]) > $arParams["WORD_LENGTH"] ? htmlspecialChars(subStr($res["~NAME"], 0, ($arParams["WORD_LENGTH"]-3)))."..." : $res["NAME"])?><?
			?></a><?
		?></div><?
		?>sdfsdf<div class="photos"><?=GetMessage("P_PHOTOS_CNT")?>: <?
			?><a href="<?=$res["LINK"]?>"><?
				?><?=$res["ELEMENTS_CNT"]?><?
			?></a><?
		?></div><?
		?><div class="photo-album-cnt-album"><?
		if (intVal($res["SECTIONS_CNT"]) > 0):
			?><?=GetMessage("P_ALBUMS_CNT")?>: <a href="<?=$res["LINK"]?>"><?=$res["SECTIONS_CNT"]?></a><?
		else:
			?><?=GetMessage("P_ALBUMS_CNT_NO");?><?
		endif;
		?></div><?
	?></div><?
	
	?></div><?
	endforeach;
	?></div><?
	?><?=$arResult["NAV_STRING"]?><?
}
?><div class="empty-clear"></div>