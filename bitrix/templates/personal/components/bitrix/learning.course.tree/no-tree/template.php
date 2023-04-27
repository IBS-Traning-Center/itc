<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult["ITEMS"])):?>

<div class="side-nav">
	<ul>
	<?
		$bracketLevel = 0;
		foreach ($arResult["ITEMS"] as $arItem):
			if ( $arItem["DEPTH_LEVEL"] <= $bracketLevel )
			{
				$deltaLevel = $bracketLevel - $arItem['DEPTH_LEVEL'] + 1;
				echo str_repeat("</ul></li>", $deltaLevel);
				$bracketLevel -= $deltaLevel;
			}
		?>
		<?//print_r($_SERVER["REQUEST_URI"])?>
					<?//print_r($arItem["URL"].' '.$_SERVER["REQUEST_URI"])?>
		<?if (stristr($_SERVER["REQUEST_URI"], $arItem["URL"])) {?>

			<?$arItem["SELECTED"]="Y"?>
		<?} else {?>
			<?if ($arItem["TYPE"] == "LE") {?>
				<?if($arItem["LESSON_ID"]==$_REQUEST["LESSON_ID"]) {?>
					<?$arItem["SELECTED"]="Y"?>
				<?}?>
			<?}?>
		<?}?>
		<?if ($arItem["TYPE"] == "CH"):
			$bracketLevel++;
		?>
			<li<?if($arItem["CHAPTER_OPEN"] === false):?> class="close"<?elseif($arItem["SELECTED"] === true):?> class="selected"<?endif?>>
				
				<a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$arItem["NAME"]?></a>
				<ul>
		<?elseif($arItem["TYPE"] == "LE"):?>
			<li <?if($arItem["SELECTED"]):?> class="active"<?endif?>>
			
				<a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$arItem["NAME"]?></a>
			</li>
		<?elseif($arItem["TYPE"] == "CD"):?>
			<li <?if($arItem["SELECTED"]):?> class="active"<?endif?>>
				
				<a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$arItem["NAME"]?></a>
			</li>
		<?elseif($arItem["TYPE"] == "TL"):?>
			<li <?if($arItem["SELECTED"]):?> class="active"<?endif?>>
				
				<a href="<?=$arItem["URL"]?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$arItem["NAME"]?></a>
			</li>
		<?endif?>

	<?endforeach?>

	</ul>
</div>

<script type="text/javascript">
	var JMenu = new JCMenu('<?=(array_key_exists("LEARN_MENU_".$arParams["COURSE_ID"],$_COOKIE ) ? CUtil::JSEscape($_COOKIE["LEARN_MENU_".$arParams["COURSE_ID"]]) :"")?>', '<?=$arParams["COURSE_ID"]?>');
</script>

<?endif?>