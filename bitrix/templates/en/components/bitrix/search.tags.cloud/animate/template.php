<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])):
?>



	<div id="tags" <?=$arParams["WIDTH"]?>>
		<ul><?
		foreach ($arResult["TAGS_CHAIN"] as $tags):
			?><li><a href="<?=$tags["TAG_PATH"]?>" rel="nofollow"><?=$tags["TAG_NAME"]?></a></li> <?
			?><li>[<a href="<?=$tags["TAG_WITHOUT"]?>" class="search-tags-link" rel="nofollow">x</a>]</li>  <?
		endforeach;?>
		</ul>
	</div>

<?
endif;

if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])):
?>
<div id="myCanvasContainer">
<canvas width="275" height="275" id="myCanvas">
  <p>In Internet Explorer versions up to 8, things inside the canvas are inaccessible!</p>
	<div id="tags" <?=$arParams["WIDTH"]?>><ul><?
		
		foreach ($arResult["SEARCH"] as $key => $res)
		{
		?><li><a href="<?=$res["URL"]?>" data-size="<?=$res["FONT_SIZE"]?>" style="font-size: <?=$res["FONT_SIZE"]?>px; color: #<?=$res["COLOR"]?>;" rel="nofollow"><?=$res["NAME"]?></a></li><?
		}
	?></ul></div>

</canvas>
</div>
<?
endif;
?>

<script type="text/javascript">
 $(document).ready(function() {
  $('#myCanvas').tagcanvas({
    outlineThickness : 1,
	weight: true,
	textColour: null,
	minBrightness: 0,
	weightFrom: 'data-size',
	shape: 'sphere',
	animTiming: 'Linear',
	initial: [0.02,-0.03],
    maxSpeed : 0.05,
    depth : 1.1,
	reverse: true
  }) 
  // your other jQuery stuff here...
});
 </script>