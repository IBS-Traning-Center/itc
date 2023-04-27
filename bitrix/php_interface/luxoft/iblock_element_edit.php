

<form method="POST" action="<?=htmlspecialchars("iblock_element_edit.php?type=".urlencode($type)."&lang=".LANG."&IBLOCK_ID=".$IBLOCK_ID."&find_section_section=".intval($find_section_section));?>" ENCTYPE="multipart/form-data" name="form_element">
<?=bitrix_sessid_post()?>
<?echo GetFilterHiddens("find_");?>
<input type="hidden" name="Update" value="Y">
<input type="hidden" name="from" value="<?echo htmlspecialchars($from)?>">
<input type="hidden" name="WF" value="<?echo htmlspecialchars($WF)?>">
<input type="hidden" name="return_url" value="<?echo $return_url?>">
<input type="hidden" name="ID" value="<?echo $ID?>">
<input type="hidden" name="IBLOCK_SECTION_ID" value="<?echo IntVal($IBLOCK_SECTION_ID)?>">

<?
$bTab2 = ($arIBTYPE["SECTIONS"]=="Y");
$bTab4 = CModule::IncludeModule("workflow");

$aTabs = array();
$aTabs[] = array("DIV" => "edit1", "TAB" => "Общие", "ICON"=>"iblock_element", "TITLE"=>"Создание вакансии. Общие параметры.");
$aTabs[] = array("DIV" => "edit5", "TAB" => "RU", "ICON"=>"iblock_element", "TITLE"=>"Описание вакансии и требования RU");
$aTabs[] = array("DIV" => "edit6", "TAB" => "EN", "ICON"=>"iblock_element", "TITLE"=>"Descriptions EN");
//$aTabs[] = array("DIV" => "edit7", "TAB" => "DE", "ICON"=>"iblock_element", "TITLE"=>"Descriptions DE");

//$aTabs[] = array("DIV" => "edit5", "TAB" => GetMessage("IBEL_E_TAB_PREV"), "ICON"=>"iblock_element", "TITLE"=>GetMessage("IBEL_E_TAB_PREV_TITLE"));
//$aTabs[] = array("DIV" => "edit6", "TAB" => GetMessage("IBEL_E_TAB_DET"), "ICON"=>"iblock_element", "TITLE"=>GetMessage("IBEL_E_TAB_DET_TITLE"));
if($bTab2) $aTabs[] = array("DIV" => "edit2", "TAB" => $arIBTYPE["SECTION_NAME"], "ICON"=>"iblock_element_section", "TITLE"=>$arIBTYPE["SECTION_NAME"]);
//$aTabs[] = array("DIV" => "edit3", "TAB" => GetMessage("IBLOCK_EL_TAB_MO"), "ICON"=>"iblock_element_params", "TITLE"=>GetMessage("IBLOCK_EL_TAB_MO_TITLE"));
//if($bTab4) $aTabs[] = array("DIV" => "edit4", "TAB" => GetMessage("IBLOCK_EL_TAB_WF"), "ICON"=>"iblock_element_wf", "TITLE"=>GetMessage("IBLOCK_EL_TAB_WF_TITLE"));

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$customTabber->SetErrorState($bVarsFromForm);
$tabControl->AddTabs($customTabber);
$tabControl->Begin();

$tabControl->BeginNextTab();
?>
        <?
        if($ID>0):
                $p = CIblockElement::GetByID($ID);
                $pr = $p->ExtractFields("prn_");
        endif;
        ?>
        <tr>
                <td width="40%"><?echo GetMessage("IBLOCK_ACTIVE")?></td>
                <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE=="Y")echo " checked"?>></td>
        </tr>
        <tr>
                <td><?echo GetMessage("IBLOCK_ACTIVE_PERIOD")?>(<?echo CLang::GetDateFormat("SHORT");?>)</td>
                <td><?echo CalendarPeriod("ACTIVE_FROM", $str_ACTIVE_FROM, "ACTIVE_TO", $str_ACTIVE_TO, "form_element", "N", "", "", "19")?></td>
        </tr>
        <tr>
                <td>Название вакансии:</td>
                <td>
                        <input type="text" name="NAME" size="50" maxlength="255" value="<?echo $str_NAME?>">
                </td>
        </tr>
        <?if(count($PROP)>0):?>
                <tr class="heading">
                        <td colspan="2"><?echo GetMessage("IBLOCK_ELEMENT_PROP_VALUE");?></td>
                </tr>
                <?
                foreach($PROP as $prop_code=>$prop_fields):
                        $prop_values = $prop_fields["VALUE"];
                 // echo "$prop_fields[$prop_code]<br>";
               //   echo "$prop_fields[cities]<br>";
                 // echo "$prop_fields are $prop_code<br>";
                ?>
        <?if(($prop_fields["ID"]==1) OR ($prop_fields["ID"]==2) OR ($prop_fields["ID"]==3) OR ($prop_fields["ID"]==4) OR ($prop_fields["ID"]==5)OR ($prop_fields["ID"]==8) OR ($prop_fields["ID"]==11) OR ($prop_fields["ID"]==12)):?>
                <tr>
                        <td valign="top"><?echo htmlspecialcharsex($prop_fields["NAME"]);?>:</td>
                        <td><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_values, ((!$bVarsFromForm) && ($ID<=0)), $bVarsFromForm);?></td>
                </tr>
        <?endif?>
                <?endforeach;?>
        <?endif?>

        <!-- разная дрянь           -->
    <?if ($WF=="Y" || $view=="Y"):?>
        <tr style="display:none">
                <td><?=GetMessage("IBLOCK_WF_STATUS")?></td>
                <td nowrap>
                <?echo SelectBox("WF_STATUS_ID", CWorkflowStatus::GetDropDownList("N", "desc"), "", $str_WF_STATUS_ID);?></td>
        </tr>
    <?endif?>

    <tr style="display:none">
                <td width="40%"><?echo GetMessage("IBLOCK_SORT")?></td>
                <td width="60%">
                        <input type="text" name="SORT" size="7" maxlength="10" value="<?echo $str_SORT?>">
                </td>
        </tr>
        <?if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y"):?>
        <tr style="display:none">
                <td><?echo GetMessage("IBLOCK_EXTERNAL_CODE")?></td>
                <td>
                        <input type="text" size="20" name="XML_ID" maxlength="255" value="<?echo $str_XML_ID?>">
                </td>
        </tr>
        <?endif?>
        <!-- конец разная дрянь           -->
        <?
        if ($view!="Y" && CModule::IncludeModule("catalog") && CCatalog::GetByID($IBLOCK_ID))
        {
                include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/admin/templates/product_edit.php");
        }
        ?>
<!--RU 2 begin -->
<?
$tabControl->BeginNextTab();
?>

        <?if(count($PROP)>0):?>
                <tr class="heading">
                        <td colspan="2"><?echo GetMessage("IBLOCK_ELEMENT_PROP_VALUE");?></td>
                </tr>
                <?
                foreach($PROP as $prop_code=>$prop_fields):
                        $prop_values = $prop_fields["VALUE"];
                ?>
        <?if(($prop_fields["ID"]==6) OR ($prop_fields["ID"]==7)):?>
                <tr>
                        <td valign="top"><?echo htmlspecialcharsex($prop_fields["NAME"]);?>:</td>
                        <td><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_values, ((!$bVarsFromForm) && ($ID<=0)), $bVarsFromForm);?></td>
                </tr>
        <?endif?>
                <?endforeach;?>
        <?endif?>



<?
$tabControl->EndTab();
?>
<!--RU end -->
<!--EN 3 begin -->
<?
$tabControl->BeginNextTab();
?>
                <?if(count($PROP)>0):?>
                <tr class="heading">
                        <td colspan="2"><?echo GetMessage("IBLOCK_ELEMENT_PROP_VALUE");?></td>
                </tr>
                <?
                foreach($PROP as $prop_code=>$prop_fields):
                        $prop_values = $prop_fields["VALUE"];
                ?>
        <?if(($prop_fields["ID"]==9) OR ($prop_fields["ID"]==10)):?>
                <tr>
                        <td valign="top"><?echo htmlspecialcharsex($prop_fields["NAME"]);?>:</td>
                        <td><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_values, ((!$bVarsFromForm) && ($ID<=0)), $bVarsFromForm);?></td>
                </tr>
        <?endif?>
                <?endforeach;?>
        <?endif?>



<?
$tabControl->EndTab();
?>
<!--EN end -->




<?
$tabControl->Buttons();
?>
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="save" value="<?echo GetMessage("IBLOCK_EL_SAVE")?>">
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> class="button" type="submit" name="apply" value="<?echo GetMessage('IBLOCK_APPLY')?>">
<input <?if ($view=="Y" || $prn_LOCK_STATUS=="red") echo "disabled";?> type="submit" class="button" name="dontsave" value="<?echo GetMessage("IBLOCK_EL_CANC")?>">
<?
$tabControl->End();
?>

</form>

