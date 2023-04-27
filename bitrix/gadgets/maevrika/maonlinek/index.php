<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init(array("jquery"));
$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="/bitrix/tools/maevrika/css/maevrika_analitika_style.css?'.time().'">');
$APPLICATION->AddHeadString('<script type="text/javascript" src="/bitrix/tools/maevrika/css/maevrika_analitika_js.js"></script>');

?>

<?//massive tabs
$aTabs = array(
    array(
        'DIV'   => 'edit1',
        'TAB'   => GetMessage("TABS_M_TAB1"),
        'ICON'  => 'fileman_settings',
        'TITLE' => GetMessage("TABS_M_TITLE1")
    ),
	array(
        'DIV'   => 'edit2',
        'TAB'   => GetMessage("TABS_M_TAB2"),
        'ICON'  => 'fileman_settings',
        'TITLE' => GetMessage("TABS_M_TITLE2")
    ),
);
 
/**
 * set tabs
 */
$oTabControl = new CAdmintabControl( 'oTabControl', $aTabs );
$oTabControl->Begin();
?>

<?//first tab
$oTabControl->BeginNextTab();?>
<tr><td>
<?CModule::IncludeModule("iblock");

   $iblocks = CIBlock::GetList(Array("id" => "desc"), Array("TYPE" => "onlinek", "ACTIVE"=>"Y"));

   while($arr=$iblocks->Fetch()) 
   {      
    $arIBlock[]=$arr["ID"];
   }

if (is_array($_REQUEST["arDelete"])){
$kolDel=0;
	foreach ($_REQUEST["arDelete"] as $delValue){
		$z=CIBlockSection::Delete($delValue);
		if ($z>0) $kolDel++;
	}
echo '<span class="notetext">'.GetMessage("TABS_M_UDALENI").' '.$kolDel.' </span><br/><br/>';
}

$IBLOK_ID=$arIBlock[0];
$kolvo_na_str=10;

$Poname='%'.$_REQUEST['arFilteres']['poname'].'%';
$Poanons='%'.$_REQUEST['arFilteres']['poanons'].'%';
$Poip='%'.$_REQUEST['arFilteres']['poip'].'%';


$arFilter = Array('IBLOCK_ID'=>$IBLOK_ID, 'GLOBAL_ACTIVE'=>'Y');
if (strlen($Poanons)>0){
	$resan = CIBlockElement::GetList(Array('created'=>'asc'),Array('PREVIEW_TEXT'=>$Poanons), false, false, Array('IBLOCK_SECTION_ID'));
	while($ob = $resan->GetNextElement()){
			$arResi[] = $ob->GetFields();
		}
	$secId0=array("0");
	foreach ($arResi as $valio){
		$secId0[]=$valio['IBLOCK_SECTION_ID'];
	}
	$secId=array_unique($secId0);
	$arFilter += Array("ID"=>$secId);
}
if (strlen($Poname)>0){$arFilter += Array("NAME"=>$Poname);}
if (strlen($Poip)>0){$arFilter += Array("DESCRIPTION"=>$Poip);}

$arSelect = Array('ID','NAME','DESCRIPTION','ELEMENT_CNT','DATE_CREATE' );
$arNavStartParams = array( 
    'nPageSize' => $kolvo_na_str,        // zapisei na stranice
); 
$obSection = CIBlockSection::GetList(Array('created'=>'desc'), $arFilter, true, $arSelect, $arNavStartParams);
while($arrResult = $obSection->GetNext()){
	//if ($arrResult['ELEMENT_CNT']>'0'){
		$arFiltere = Array('IBLOCK_ID'=>$IBLOK_ID, 'SECTION_ID'=>$arrResult['ID'], 'ACTIVE_DATE'=>'Y', 'ACTIVE'=>'Y');
		$arSelecte = Array('ID','NAME','PREVIEW_TEXT','DETAIL_TEXT','DATE_CREATE', 'CODE' );
		$res = CIBlockElement::GetList(Array('created'=>'asc'),$arFiltere, false, false, $arSelecte);
		while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arrResult['ELEMENT'][] = $arFields;
		}
	//}
	$Klient[]=$arrResult;
	
}
$kolvoKlientov=count($Klient);
?>
<form name="kliodel" action="" method="post" id="klio">
<table cellspacing="0" cellpadding="0" id="list_kliento">
<?
foreach ($Klient as $key=>$value){?>

	<tr>
	<td class="klint_data_create"><?=$value["DATE_CREATE"]?></td>
	<td class="klint"><a href="/bitrix/admin/iblock_section_admin.php?IBLOCK_ID=<?=$IBLOK_ID?>&type=onlinek&lang=ru&find_section_section=<?=$value["ID"]?>" target="_blank"><?=$value["NAME"]?></a></td>
	<td class="razgovor"><?if ($value['ELEMENT_CNT']>'0') {?>
				<a href="javascript:void(0);" class="soderganie"><?=GetMessage("TABS_M_SODERGANIE")?></a>
				<div class="soderganie">
				<?foreach ($value['ELEMENT'] as $item){?>
					<div class="rech"><span class="rech_name"><?=$item['NAME']?></span>(<?=$item['DATE_CREATE']?>):<br/> <?=$item['PREVIEW_TEXT']?></div>
				<?}?>
				</div>
				
			<?}else{echo GetMessage("TABS_M_NOSODERGANIE");}?>
	</td>
	<td class="ip"><?=$value["DESCRIPTION"]?></td>
	<td class="klientdel"><?if (CModule::IncludeModule("statistic")){?>
			<div class="anali"><a href="/bitrix/admin/guest_list.php?PAGEN_1=1&SIZEN_1=20&lang=ru&set_filter=Y&find_ip=<?=$value["DESCRIPTION"]?>" target="_blank"><?=GetMessage("TABS_M_ANALITIKA")?></a></div>	
		<?}else{echo GetMessage("TABS_M_ANALITIKANO");}?>
	</td>
	<td class="klientdel"><label for="poklientdel<?=$value["ID"]?>"><?=GetMessage("TABS_M_DELETE")?></label><input id="poklientdel<?=$value["ID"]?>" name="arDelete[<?=$value["ID"]?>]" type="checkbox" value="<?=$value["ID"]?>" ></td>
	<td class="dobavit_chel"><a href="javascript:void(0);" class="dobavit_polzovatelya"><?=GetMessage("TABS_K_DOBAV")?></a></td>
	</tr>
	
<?}?>
</table>
<?$navStr = $obSection->GetPageNavStringEx($navComponentObject, GetMessage("TABS_M_STR"), ".default"); 
echo $navStr; 
?>
<div class="clear"></div>
<input type="submit" name="del_klios" value="<?=GetMessage("TABS_M_FOREVER")?>" class="udalit_klienta" />
</form>



</td></tr>

<?//two tab
$oTabControl->BeginNextTab();?>
<tr><td>
<form name="filterpo" action="" method="get" id="filya">
<label for="poname"><?=GetMessage("TABS_M_FORM_NAME")?></label><input type="text" id="poname" name="arFilteres[poname]" value="<?=$_REQUEST['arFilteres']['poname']?>" /><br/>
<label for="poanons"><?=GetMessage("TABS_M_FORM_ANONS")?></label><input type="text" id="poanons" name="arFilteres[poanons]" value="<?=$_REQUEST['arFilteres']['poanons']?>" /><br/>
<label for="poip"><?=GetMessage("TABS_M_FORM_IP")?></label><input type="text" id="poip" name="arFilteres[poip]" value="<?=$_REQUEST['arFilteres']['poip']?>" /><br/>
<input type="submit" name="set_filter" value="<?=GetMessage("TABS_M_FORM_FILTR")?>" class="filtrovat_klienta" />
</form>

</td></tr>

<?
$oTabControl->Buttons();?>
<?$oTabControl->End();?>

<?//end tabs
$oTabControl->EndTab();?>
<div class="dobav_polza">
<div class="errortwo"></div>
<form action="" method="post" name="doba" >
	<table border="0" cellpadding="0" cellspacing="0" class="form_table_dobavit">
	<tbody>
	<tr><td><?=GetMessage("TABS_K_DOBA_NAME")?><sup>1</sup></td><td style="padding:7px 0 7px 20px;"><input name="NEW_NAME" id="new_name" type="text" value=""/></td></tr>
	<tr><td><?=GetMessage("TABS_K_DOBA_FON")?><sup>2</sup></td><td style="padding:7px 0 7px 20px;"><input name="NEW_PHONE" id="new_phone" type="text" value="" /></td></tr>
	<tr><td><?=GetMessage("TABS_K_DOBA_MAIL")?><sup>2</sup></td><td style="padding:7px 0 7px 20px;"><input name="NEW_EMAIL" id="new_email" type="text" value="" /></td></tr>
	<tr><td><?=GetMessage("TABS_K_DOBA_DOPINFO")?></td><td style="padding:7px 0 7px 20px;"><textarea name="NEW_DESCRIPTION" id="new_description"></textarea></td></tr>
	<tr><td>&nbsp;</td><td style="padding:7px 0 7px 20px;"><a href="javascript:void(0);" class="submitFormAddPo"><?=GetMessage("TABS_K_DOBA_OTPRAVIT")?></a></td></tr>
	<tr><td colspan="2" class="poyasnenie">
		<span>1</span> - <?=GetMessage("TABS_K_DOBA_POYAS1")?><br/>
		<span>2</span> - <?=GetMessage("TABS_K_DOBA_POYAS2")?>.
	</td></tr>
	</tbody></table>
</form>
</div>