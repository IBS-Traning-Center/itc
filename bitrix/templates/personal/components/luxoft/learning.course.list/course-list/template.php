<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult["COURSES"])):?>
<div class="learning-course-list">
	<?foreach($arResult["COURSES"] as $arCourse):?>
<?//if ($arCourse["NAME"]!="Системный аналитик") {?>
		<?if ($arCourse["SORT"]=="100") {?>
			<div class="course-heading">Разработка ПО</div>
		<?} elseif ($arCourse["SORT"]=="200") {?>
			<div class="course-heading">Тестирование ПО</div>
		<?} elseif ($arCourse["SORT"]=="300") {?>
			<div class="course-heading">Soft skills</div>
		<?} elseif ($arCourse["SORT"]=="400") {?>
			<div class="course-heading">Основы финансовых рынков</div>
		<?} elseif ($arCourse["SORT"]=="500") {?>
			<div class="course-heading">Тесты</div>
		<?}?>
		<div class="uno-course">
            <a href="<?=$arCourse["COURSE_DETAIL_URL"]?>" class="course-name"><?=$arCourse["NAME"]?></a>
            <div class="clearfix"></div>
            <div class="desript"><?=$arCourse["PREVIEW_TEXT"]?></div>
        </div>
		<div class="separate-line"></div>
<?//}?>
	<?endforeach;?>
</div>
	<?=$arResult["NAV_STRING"]?>
<?endif?>