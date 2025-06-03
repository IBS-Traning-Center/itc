<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="course-section-list">
    <ul>
        <?
        $CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
        foreach($arResult["SECTIONS"] as $arSection):
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
                echo "<ul>";
            elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
                echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
            $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
            ?>
            <li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><div class="main-course-link"><a href="<?=$arSection["SECTION_PAGE_URL"]?>">
                        <?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?></a></div>
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><div class="double-arrow"></div></a>

                <div style="display:block; font-size: 18px; float:right;"><?=$arSection["ELEMENT_CNT"]?> <?=getCountVal($arSection["ELEMENT_CNT"], array("курс","курса","курсов"))?></div><?endif;?>
                <div class='clear'></div>
            </li>
        <?endforeach?>
    </ul>
</div>


