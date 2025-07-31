<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
h2#description, h2#themes, h2#auditory, h2#goals {
height:30px;
}
</style>
<div id="content" class="bg not-main-page gray">
    <div class="frame course-main-info">
        <div class="row clearfix">

                <div class="descr-wrap margin-b-35" >
                    <h2 id="description">Описание</h2>
			<?if($arResult['PROPERTIES']['DESCRIPTION']['VALUE']) {?>
                    		<?=htmlspecialchars_decode($arResult['PROPERTIES']['DESCRIPTION']['VALUE']['TEXT'])?>
			<?}?>
                </div>


                <div class="descr-wrap margin-b-35">
                    <h2 id="themes">Содержание курса</h2>
                    	<?if($arResult['PROPERTIES']['CONTENT']['VALUE']) {?>
                    		<?=htmlspecialchars_decode($arResult['PROPERTIES']['CONTENT']['VALUE']['TEXT'])?>
			<?}?>
                </div>

                <div class="desr-wrap margin-b-35">
                    <h2 id="auditory">Целевая аудитория</h2>
                    	<?if($arResult['PROPERTIES']['PEOPLE']['VALUE']) {?>
                    		<?=htmlspecialchars_decode($arResult['PROPERTIES']['PEOPLE']['VALUE']['TEXT'])?>
			<?}?>
                </div>

                <div class="desr-wrap margin-b-35">
                      <h2 id="goals">Связанные курсы</h2>
                    	<?if($arResult['PROPERTIES']['RELATED']['VALUE']) {?>
                    		<?=htmlspecialchars_decode($arResult['PROPERTIES']['RELATED']['VALUE']['TEXT'])?>
			<?}?>
                </div>


        </div>
    </div>
</div>

