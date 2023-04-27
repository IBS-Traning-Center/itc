<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult["COURSES"])):?>
<div class="learning-course-list">
	<?foreach($arResult["COURSES"] as $arCourse):?>
		<div class="uno-course">
            <a href="<?=$arCourse["COURSE_DETAIL_URL"]?>" class="course-name"><?=$arCourse["NAME"]?></a>
            <div class="clearfix"></div>
            <div class="desript"><?=$arCourse["PREVIEW_TEXT"]?></div>
        </div>
		<div class="separate-line"></div>
	<?endforeach;?>
</div>
	<?=$arResult["NAV_STRING"]?>
<?endif?>