<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?CModule::IncludeModule("iblock");?>
<?$arFilter = Array('IBLOCK_ID'=>105, 'GLOBAL_ACTIVE'=>'Y');
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
$arFilter[">DATE_CREATE"]=date('d.m.Y', strtotime('-1 day'))." 00:00:00";
$arFilter["<DATE_CREATE"]=date('d.m.Y')." 23:59:59";

$arSelect = Array('ID','NAME','DESCRIPTION','ELEMENT_CNT','DATE_CREATE' );
$arNavStartParams = array( 
    'nPageSize' => 15,        // zapisei na stranice
); 
$obSection = CIBlockSection::GetList(Array('created'=>'desc'), $arFilter, true, $arSelect, $arNavStartParams);
while($arrResult = $obSection->GetNext()){
	print_r($arFilter[">DATE_CREATE"]);
	if ($arrResult['ELEMENT_CNT']>'0'){
		
		$arFiltere = Array('IBLOCK_ID'=>$IBLOK_ID, 'SECTION_ID'=>$arrResult['ID'], 'ACTIVE_DATE'=>'Y', 'ACTIVE'=>'Y');
		$arSelecte = Array('ID','NAME','PREVIEW_TEXT','DETAIL_TEXT','DATE_CREATE', 'CODE' );
		$res = CIBlockElement::GetList(Array('created'=>'asc'),$arFiltere, false, false, $arSelecte);
		while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arrResult['ELEMENT'][] = $arFields;
		}
	
	$Klient[]=$arrResult;
	}
	
}
$kolvoKlientov=count($Klient);?>

<?

foreach ($Klient as $key=>$value){?>
	<?if ($value['ELEMENT_CNT']>'0') {?>
	<?$string.='<div>'.$value["DATE_CREATE"].'</div><div style="margin-bottom: 40px;"><div>';?>
	
	<?foreach ($value['ELEMENT'] as $item) {
					$string.='<div><span>'.$item['NAME'].':</span> '.$item['PREVIEW_TEXT'].'</div>';
				}?>
				<?
				$string.='</div></div>';
				?>
	<?}?>
<?}?>
<?print_r($string);?>
<?if (intval($kolvoKlientov)>0) {
$arEventFields = array(
    "DIALOGS"                  => $string,
   
    );
//$arrSITE =  CAdvContract::GetSiteArray($CONTRACT_ID);
//CEvent::Send("ONLINE_KONS", "ru", $arEventFields);
}?>