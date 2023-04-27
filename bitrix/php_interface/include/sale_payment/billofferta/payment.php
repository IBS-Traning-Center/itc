<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?

$ORDER_ID = IntVal($GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]);
if ((!isset($ORDER_ID) or $ORDER_ID ==0)){
	$ORDER_ID = $_REQUEST['ORDER_ID'];
}
if (!is_array($arOrder))
	$arOrder = CSaleOrder::GetByID($ORDER_ID);
?><?

/*
Данный документ учитывает только налог с мнемоническим кодом "NDS". Остальные налоги при формировании документа не отображаются

Скопируйте этот файл в папку /bitrix/admin/reports и измените по своему усмотрению

$ORDER_ID - ID текущего заказа

$arOrder - массив атрибутов заказа (ID, доставка, стоимость, дата создания и т.д.)
Следующий PHP код:
print_r($arOrder);
выведет на экран содержимое массива $arOrder.

$arOrderProps - массив свойств заказа (вводятся покупателями при оформлении заказа) следующей структуры:
array(
	"мнемонический код (или ID если мнемонический код пуст) свойства" => "значение свойства"
	)

$arParams - массив из настроек Печатных форм

$arUser - массив из настроек пользователя, совершившего заказ
*/
?><?

$bShowPodpis = true;
if ($_REQUEST['SHOWPODPIS']=="N"){
	$bShowPodpis = false;
}
$db_props = CSaleOrderPropsValue::GetOrderProps($ORDER_ID);
while ($arProps = $db_props->Fetch())
{

	if ($arProps['CODE'] == 'COMPANY'){
		$arOrderProps['COMPANY'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'COMPANY_ADR'){
		$arOrderProps['COMPANY_ADR'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'COMPANY_DOCADDRESS'){
		$arOrderProps['COMPANY_DOCADDRESS'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'INN'){
		$arOrderProps['INN'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'KPP'){
		$arOrderProps['KPP'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'FIO_RESPONS'){
		$arOrderProps['FIO_RESPONS'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'CONTACT_PERSON'){
		$arOrderProps['CONTACT_PERSON'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'FIO_RESPONS'){
		$arOrderProps['FIO_RESPONS'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'POSITION_RESPONS'){
		$arOrderProps['POSITION_RESPONS'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'EMAIL'){
		$arOrderProps['EMAIL'] = $arProps['VALUE'];
	}
	if ($arProps['CODE'] == 'offerta'){
		$arOrderProps['offerta'] = $arProps['VALUE'];
	}
}
	//iwrite($arOrderProps);
?>


<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta name='ProgId' content='Word.Document'>
<meta name='Generator' content="Microsoft Word 12">
<meta name='Originator' content="Microsoft Word 12">
<meta http-equiv=Content-Type content="text/html; charset=<?=LANG_CHARSET?>">
<title langs="ru">LUX-TR Счет-оферта</title>
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Sokolova</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>Zagvozdin</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>62</o:TotalTime>
  <o:LastPrinted>2010-05-26T09:49:00Z</o:LastPrinted>
  <o:Created>2010-08-24T07:41:00Z</o:Created>
  <o:LastSaved>2010-08-24T07:41:00Z</o:LastSaved>
  <o:Pages>2</o:Pages>
  <o:Words>1538</o:Words>
  <o:Characters>8771</o:Characters>
  <o:Company>LUXOFT</o:Company>
  <o:Lines>73</o:Lines>
  <o:Paragraphs>20</o:Paragraphs>
  <o:CharactersWithSpaces>10289</o:CharactersWithSpaces>
  <o:Version>12.00</o:Version>
 </o:DocumentProperties>
</xml><![endif]-->
<link rel='dataStoreItem' href="schet_offerta_files/item0001.xml" target="schet_offerta_files/props0002.xml">
<link rel='themeData' href="schet_offerta_files/themedata.thmx">
<link rel='colorSchemeMapping' href="schet_offerta_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:DontUseIndentAsNumberingTabStop/>
   <w:FELineBreak11/>
   <w:WW11IndentRules/>
   <w:DontAutofitConstrainedTables/>
   <w:AutofitLikeWW11/>
   <w:HangulWidthLikeWW11/>
   <w:UseNormalStyleForList/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]-->
<!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"
  DefSemiHidden="true" DefQFormat="false" DefPriority="99"
  LatentStyleCount="267">
  <w:LsdException Locked="false" Priority="0" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" Name="toc 9"/>
  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" Priority="10" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" Priority="11" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" Priority="0" Name="Hyperlink"/>
  <w:LsdException Locked="false" Priority="22" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="59" SemiHidden="false"
   UnhideWhenUsed="false" Name="Table Grid"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" SemiHidden="false"
   UnhideWhenUsed="false" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" SemiHidden="false"
   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" SemiHidden="false"
   UnhideWhenUsed="false" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" SemiHidden="false"
   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" SemiHidden="false"
   UnhideWhenUsed="false" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:204;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-1610611985 1107304683 0 0 415 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:204;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520092929 1073786111 9 0 415 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:204;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-ansi-language:RU;
	mso-fareast-language:RU;}
a:link, span.MsoHyperlink
	{mso-style-unhide:no;
	color:blue;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-noshow:yes;
	mso-style-priority:99;
	color:purple;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:"Times New Roman";
	mso-ansi-language:RU;
	mso-fareast-language:RU;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Balloon Text";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-ascii-font-family:Tahoma;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;}
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
span.GramE
	{mso-style-name:"";
	mso-gram-e:yes;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:28.4pt 35.35pt 28.4pt 35.45pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:2026514238;
	mso-list-template-ids:1334339000;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l0:level2
	{mso-level-text:"%1\.%2\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:39.6pt;
	text-indent:-21.6pt;
	mso-ansi-font-weight:bold;}
@list l0:level3
	{mso-level-text:"%1\.%2\.%3\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.2pt;
	text-indent:-25.2pt;}
@list l0:level4
	{mso-level-text:"%1\.%2\.%3\.%4\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:86.4pt;
	text-indent:-32.4pt;}
@list l0:level5
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:111.6pt;
	text-indent:-39.6pt;}
@list l0:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.8pt;
	text-indent:-46.8pt;}
@list l0:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:162.0pt;
	text-indent:-54.0pt;}
@list l0:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:187.2pt;
	text-indent:-61.2pt;}
@list l0:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:216.0pt;
	text-indent:-72.0pt;}
ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-qformat:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-bidi-font-family:"Times New Roman";}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid black 1.0pt;
	mso-border-alt:solid black .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid black;
	mso-border-insidev:.5pt solid black;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-bidi-font-family:"Times New Roman";}
</style>
<![endif]-->
<!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]-->
<!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>
<body lang='EN-US' link='blue' vlink='purple' style='tab-interval:35.4pt'>
<div class='WordSection1'>
	<p class='MsoNormal' style='margin-top:12.0pt'>
		<!--[if gte vml 1]><v:shapetype
 id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
 path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
 <v:stroke joinstyle="miter"/>
 <v:formulas>
  <v:f eqn="if lineDrawn pixelLineWidth 0"/>
  <v:f eqn="sum @0 1 0"/>
  <v:f eqn="sum 0 0 @1"/>
  <v:f eqn="prod @2 1 2"/>
  <v:f eqn="prod @3 21600 pixelWidth"/>
  <v:f eqn="prod @3 21600 pixelHeight"/>
  <v:f eqn="sum @0 0 1"/>
  <v:f eqn="prod @6 1 2"/>
  <v:f eqn="prod @7 21600 pixelWidth"/>
  <v:f eqn="sum @8 21600 0"/>
  <v:f eqn="prod @7 21600 pixelHeight"/>
  <v:f eqn="sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
 <o:lock v:ext="edit" aspectratio="t"/>
</v:shapetype><v:shape id="Picture_x0020_4" o:spid="_x0000_s1029" type="#_x0000_t75"
 style='position:absolute;margin-left:18.75pt;margin-top:11.5pt;width:174.6pt;
 height:72.7pt;z-index:-1;visibility:visible'>
 <v:imagedata src="/images_edu/payment/image001.png" o:title=""/>
</v:shape><![endif]-->
		<!--FIXED<![if !vml]><span style='mso-ignore:vglayout;position: absolute;z-index:-1;margin-left:25px;margin-top:15px;width:233px;height:97px'><img width='233' height='97' src="/images_edu/payment/image002.jpg" v:shapes="Picture_x0020_4"></span><![endif]>-->
		<!--[if mso & !supportInlineShapes & supportFields]><b><span
style='font-size:16.0pt;mso-ansi-language:EN-US'><span style='mso-element:field-begin;
mso-field-lock:yes'></span></span></b><b><span style='font-size:16.0pt'><span
 > </span></span></b><b><span style='font-size:16.0pt;
mso-ansi-language:EN-US'>SHAPE</span></b><b><span lang=RU style='font-size:
16.0pt'><span  >  </span>\* </span></b><b><span
style='font-size:16.0pt;mso-ansi-language:EN-US'>MERGEFORMAT</span></b><b><span
style='font-size:16.0pt'> </span></b><b><span style='font-size:16.0pt;
mso-ansi-language:EN-US'><span style='mso-element:field-separator'></span></span></b><![endif]-->
		<b><span style='font-size:16.0pt;mso-ansi-language:EN-US'>
		<!--[if gte vml 1]><v:group
 id="_x0000_s1026" editas="canvas" style='width:174.85pt;height:72.8pt;
 mso-position-horizontal-relative:char;mso-position-vertical-relative:line'
 coordsize="3497,1456">
 <o:lock v:ext="edit" aspectratio="t"/>
 <v:shape id="_x0000_s1027" type="#_x0000_t75" style='position:absolute;
  width:3497;height:1456' o:preferrelative="f">
  <v:fill o:detectmouseclick="t"/>
  <v:path o:extrusionok="t" o:connecttype="none"/>
  <o:lock v:ext="edit" text="t"/>
 </v:shape><w:wrap type="none"/>
 <w:anchorlock/>
</v:group><![endif]-->
		<!--FIXED<![if !vml]><img width='233' height='97' src="/images_edu/payment/image003.gif" v:shapes="_x0000_s1026 _x0000_s1027"><![endif]>--></span></b>
		<!--[if mso & !supportInlineShapes & supportFields]><b><span
style='font-size:16.0pt;mso-ansi-language:EN-US'><v:shape id="_x0000_i1025"
 type="#_x0000_t75" style='width:174.85pt;height:72.8pt'>
 <v:imagedata croptop="-65520f" cropbottom="65520f"/>
</v:shape><span style='mso-element:field-end'></span></span></b><![endif]-->
		<b><span lang='RU' style='font-size:16.0pt'><o:p></o:p></span></b>
	</p>

	<p class='MsoNormal' style='margin-top:12.0pt'>
		<span lang='RU' style='font-size: 11.0pt;mso-bidi-font-weight:bold'>Счет-оферта подлежит полной оплате, частичная оплата не принимается.<o:p></o:p></span>
	</p>
	<p class='MsoNormal' style='margin-top:12.0pt'>
		<span lang='RU' style='font-size: 11.0pt;mso-bidi-font-weight:bold'><o:p>&nbsp;</o:p></span>
	</p>
	<table class='MsoNormalTable' border='1' cellspacing='0' cellpadding='0' style='margin-left:12.5pt;border-collapse:collapse;border:none;mso-border-alt: solid black .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt; mso-border-insideh:.5pt solid black;mso-border-insidev:.5pt solid black'>
	<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Исполнитель:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border:solid black 1.0pt; border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>ООО "ИБС ИнфиниСофт"<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:1'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Место нахождения:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>Россия, 127434, г. Москва, Дмитровское шоссе, д. 9, стр.3<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:2'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>ИНН:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>7713605227<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:3'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>КПП:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>771301001<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:4'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Расч. счет:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>40702810401400010744 АО «АЛЬФА-БАНК»<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:5;mso-yfti-lastrow:yes'>
		<td width='142' valign='top' style='width:106.3pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Корр. счет:<o:p></o:p></span>
			</p>
		</td>
		<td width='558' valign='top' style='width:418.2pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<b><i style='mso-bidi-font-style:normal'><span lang='RU' style='font-size:11.0pt'>30101810200000000593, <b>БИК</b> 044525593<o:p></o:p></span></i></b>
			</p>
		</td>
	</tr>
	</table>
	<p class='MsoNormal'>
		<b><i style='mso-bidi-font-style:normal'><span lang='RU'><o:p>&nbsp;</o:p></span></i></b>
	</p>
	<p class='MsoNormal' align='center' style='text-align:center'>
		<b><span lang='RU' style='font-size:14.0pt'>Счет-оферта №  PTC.OF.<!--<input size="1" style="border:0px solid #000000;font-size:16px;font-style:bold;width: 30px;font-weight:bold;" type="text" value="&nbsp;<?=$ORDER_ID?>">--><?=$arOrderProps['offerta']?>-<?=date('Y')?> <span class='GramE'>от</span> <? echo ConvertDateTime($arOrder['DATE_INSERT_FORMAT'], "DD.MM.YYYY", "sl"); ?>   </span></b>
	</p>
	<p class='MsoNormal' align='center' style='text-align:center'>
		<b><span lang='RU' style='font-size:14.0pt'><o:p>&nbsp;</o:p></span></b>
	</p>
	<table class='MsoNormalTable' border='1' cellspacing='0' cellpadding='0' style='margin-left:12.5pt;border-collapse:collapse;border:none;mso-border-alt: solid black .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt; mso-border-insideh:.5pt solid black;mso-border-insidev:.5pt solid black'>
	<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
		<td width='75' valign='top' style='width:55.9pt;border:solid black 1.0pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Заказчик:<o:p></o:p></span>
			</p>
		</td>
		<td width='623' colspan='6' valign='top' style='width:466.9pt;border:solid black 1.0pt; border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'><?echo $arOrderProps["COMPANY"];?></span>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
		<td width='75' valign='top' style='width:55.9pt;border:solid black 1.0pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Место нахождения:<o:p></o:p></span>
			</p>
		</td>
		<td width='623' colspan='6' valign='top' style='width:466.9pt;border:solid black 1.0pt; border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'><?echo $arOrderProps["COMPANY_ADR"];?></span>
			</p>
		</td>
	</tr>
	<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
		<td width='75' valign='top' style='width:55.9pt;border:solid black 1.0pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>ИНН / КПП:<o:p></o:p></span>
			</p>
		</td>
		<td width='623' colspan='6' valign='top' style='width:466.9pt;border:solid black 1.0pt; border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'> <?echo $arOrderProps["INN"];?> / <?echo $arOrderProps["KPP"];?></span>
			</p>
		</td>
	</tr>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
		<td width='75' valign='top' style='width:55.9pt;border:solid black 1.0pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>ФИО Участника:<o:p></o:p></span>
			</p>
		</td>
		<td width='623' colspan='6' valign='top' style='width:466.9pt;border:solid black 1.0pt; border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'> <?echo $arOrderProps["CONTACT_PERSON"];?> </span>
			</p>
		</td>
	</tr>
	<!--
	<tr style='mso-yfti-irow:1'>
		<td width='75' valign='top' style='width:55.9pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Адрес:</span><span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'><o:p></o:p></span>
			</p>
			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'>e- mail:</span><span lang='RU' style='font-size: 11.0pt;mso-bidi-font-weight:bold'><o:p></o:p></span>
			</p>
		</td>
		<td width='623' colspan='6' valign='top' style='width:466.9pt;border-top:none; border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'> <?echo $arOrderProps["ZIP"];?> <?echo $arOrderProps["ADDRESS"];?>  </span>
			</p>
			<p class='MsoNormal'>
				 <span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'> <?echo $arOrderProps["EMAIL"];?></span>
			</p>
		</td>
	</tr>
	-->
	<tr style='mso-yfti-irow:2;height:27.7pt'>
		<td width='163' colspan='2' valign='top' style='width:122.0pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>

			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Наименование консультационной Услуги<o:p></o:p></span>
			</p>
		</td>
		<td width='91' valign='top' style='width:68.3pt;border-top:none;border-left:none; border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt: solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>

			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Количество<o:p></o:p></span>
			</p>
		</td>
		<td width='56' valign='top' style='width:42.35pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>
			<p class='MsoNormal' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Дата оказания услуги<o:p></o:p></span>
			</p>
		</td>
		<td width='66' valign='top' style='width:49.35pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>
			<p class='MsoNormal' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Время проведения<o:p></o:p></span>
			</p>
		</td>
		<td width='92' valign='top' style='width:69.2pt;border-top:none;border-left:none; border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt: solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>

			<p class='MsoNormal' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Цена, руб.<br /> (в том числе НДС в размере 20%)<o:p></o:p></span>
			</p>
		</td>
		<td width='229' valign='top' style='width:171.6pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:27.7pt'>

			<p class='MsoNormal' style='text-align:center'>
				<span lang='RU' style='text-align:center;font-size:11.0pt;mso-bidi-font-weight: bold'>Сумма, руб.<br /> (в том числе НДС в размере 20%)<o:p></o:p></span>
			</p>
		</td>
	</tr>

<?
//состав заказа

$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$ORDER_ID));
while ($arItems = $db_basket->Fetch())
{
		//iwrite($arItems)
		$dbBasketProps = CSaleBasket::GetPropsList(
			array("SORT" => "ASC", "ID" => "DESC"),
			array(
					"BASKET_ID" => $arItems["ID"],
					"!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")
				),
			false,
			false,
			array("NAME", "VALUE")
		);
		while($arBasketPropsTmp = $dbBasketProps->GetNext())
		{
				$arService[$arBasketPropsTmp['NAME']] = $arBasketPropsTmp["VALUE"];
		}


		?>
	<tr style='mso-yfti-irow:3'>
		<td width='163' colspan='2' valign='top' style='width:122.0pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>

			<p class='MsoNormal'>
				<span style='font-size:11.0pt;mso-ansi-language:EN-US; mso-bidi-font-weight:bold'><?echo $arItems["NAME"]; ?><o:p></o:p></span>
			</p>
		</td>
		<td width='91' valign='top' style='width:68.3pt;border-top:none;border-left:none; border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt: solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight:bold'><?echo IntVal($arItems["QUANTITY"]); ?></span>
			</p>
		</td>
		<td width='56' valign='top' style='width:42.35pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='left' style='text-align:left'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight:bold'><?=$arService["STARTDATE"]?><? if ((strlen($arService["ENDDATE"])>0) and ($arService["ENDDATE"] !== $arService["STARTDATE"])){?>&nbsp;-<br ><?=$arService["ENDDATE"]?>
				 <? } ?>
				</span>
			</p>
		</td>
		<td width='66' valign='top' style='width:49.35pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight:bold'><?=$arService["SCHEDULE_TIME"]?></span>
			</p>
		</td>
		<td width='92' valign='top' style='width:69.2pt;border-top:none;border-left:none; border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt: solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='text-align:center;font-size:11.0pt;mso-bidi-font-weight:bold'><?echo RoundEx($arItems["PRICE"], 2);    ?> </span>
			</p>
		</td>
		<td width='229' valign='top' style='width:171.6pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='text-align:center;font-size:11.0pt;mso-bidi-font-weight:bold'><?echo RoundEx($arItems["PRICE"]*$arItems["QUANTITY"], 2);    ?></span>
			</p>
		</td>
	</tr>
			<?
			$sum += doubleval(($b_PRICE)*$b_QUANTITY);
		}

		?>

	<!-- ИТОГО BLOCK -->
	<tr style='mso-yfti-irow:4'>
		<td width='310' colspan='6' valign='top' style='width:232.65pt;border:solid black 1.0pt; border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>ИТОГО<o:p></o:p></span>
			</p>
		</td>

		<!--
		<td width='92' valign='top' style='width:69.2pt;border-top:none;border-left:none; border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt: solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
		</td>
		-->
		<td width='229' valign='top' style='width:171.6pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><?echo RoundEx($arOrder["PRICE"], 2);    ?></span>
			</p>
		</td>
	</tr>
	<!-- ИТОГО END -->

	<tr style='mso-yfti-irow:5'>
		<td width='310' colspan='6' valign='top' style='width:232.65pt;border-top:none; border-left:solid black 1.0pt;border-bottom:solid windowtext 1.0pt; border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt; mso-border-alt:solid black .5pt;mso-border-bottom-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>В том числе НДС<o:p></o:p></span>
			</p>
		</td>
        <!--
		<td width='92' valign='top' style='width:69.2pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;mso-border-bottom-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal' align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><?echo RoundEx($arOrder["PRICE"]*0.20/1.20, 2);    ?></span>
			</p>
		</td>
		-->
		<td width='229' valign='top' style='width:171.6pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid black 1.0pt; mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt; mso-border-alt:solid black .5pt;mso-border-bottom-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal'  align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><?echo RoundEx($arOrder["PRICE"]*0.20/1.20, 2);    ?></span>
			</p>
		</td>
	</tr>
	<!--<tr style='mso-yfti-irow:6'>
		<td width='310' colspan='6' valign='top' style='width:232.65pt;border:solid windowtext 1.0pt; border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>ВСЕГО<o:p></o:p></span>
			</p>
		</td>-->
        <!--
		<td width='92' valign='top' style='width:69.2pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt; mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'  align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><?echo $arOrder["PRICE"];?></span>
			</p>
		</td>
		-->
		<!--
		<td width='229' valign='top' style='width:171.6pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt; mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><o:p>&nbsp;</o:p></span>
			</p>
			<p class='MsoNormal'  align='center' style='text-align:center'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'><?echo $arOrder["PRICE"];?></span>
			</p>
		</td>
	</tr>-->
	<tr style='mso-yfti-irow:7'>
		<td width='254' colspan='7' valign='top' style='width:190.3pt;border:solid windowtext 1.0pt; border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>Всего по счёту:
				 	<?
	if ($arOrder["CURRENCY"]=="RUR" || $arOrder["CURRENCY"]=="RUB")
	{
		echo Number2Word_Rus($arOrder["PRICE"]);
	}
	else
	{
		echo SaleFormatCurrency($arOrder["PRICE"], $arOrder["CURRENCY"]);
	}
	?>.</span>
			</p>
		</td>

	</tr>
	<tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes'>
		<td width='254' colspan='7' valign='top' style='width:190.3pt;border:solid windowtext 1.0pt; border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt; padding:0cm 5.4pt 0cm 5.4pt'>
			<p class='MsoNormal'>
				<span lang='RU' style='font-size:11.0pt;mso-bidi-font-weight: bold'>В том числе НДС (20%):
	<?
	if ($arOrder["CURRENCY"]=="RUR" || $arOrder["CURRENCY"]=="RUB")
	{
		echo Number2Word_Rus(RoundEx($arOrder["PRICE"]*0.20/1.20, 2));
	}
	else
	{
		echo SaleFormatCurrency($arOrder["PRICE"], $arOrder["CURRENCY"]);
	}
	?>.
	<o:p></o:p></span>
			</p>
		</td>

	</tr>
	<![if !supportMisalignedColumns]>
	<tr height='0'>
		<td width='76' style='border:none'>
		</td>
		<td width='87' style='border:none'>
		</td>
		<td width='92' style='border:none'>
		</td>
		<td width='72' style='border:none'>
		</td>
		<td width='90' style='border:none'>
		</td>
		<td width='90' style='border:none'>
		</td>
		<td width='221' style='border:none'>
		</td>
	</tr>
	<![endif]>
	</table>
	
	<p class='MsoNormal' style='margin-top:12.0pt'>
		<b><i style='mso-bidi-font-style: normal'><span lang='RU'>Оплата Счета-оферты производится в рублях РФ.<o:p></o:p></span></i></b>
	</p>
<?
	$curDateView = date("d.m.Y");
	$nextmonth = mktime(0, 0, 0, date("m"), date("d")+14,   date("Y"));
	$next2WeekDate = date("d.m.Y", $nextmonth) ;
?>

	<p class='MsoNormal' style='margin-top:12.0pt'>
		<b><i style='mso-bidi-font-style: normal'><span lang='RU'>Счет-оферта действителен к оплате до <?=$next2WeekDate?></i></b>
	</p>
<p class="MsoNormal" style="margin-top:12.0pt;margin-right:0cm;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;line-height:normal"><b><i><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU">&nbsp;</span></i></b><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU">1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Общие
положения</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">1.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Данный
документ
является
официальным предложением
(публичной
Офертой)&nbsp;<b>Общества
с
ограниченной
ответственностью
«Люксофт&nbsp;Профешнл»</b>&nbsp;(в
дальнейшем
именуемого&nbsp;<b>«Исполнитель»</b>)
и содержит
все
существенные
условия по оказанию
предлагаемых
Заказчиком,
избранных
Исполнителем
и указанных в
разделе «Наименование
консультационной
Услуги» настоящего
Счета-оферты
консультационных
Услуг (далее - «<b>оказание
консультационных
Услуг</b>»).<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">1.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<span class="GramE">В
соответствии
с пунктом 2
статьи 437
Гражданского
Кодекса
Российской
Федерации
(далее - «<b>ГК РФ</b>»)
в случае
принятия
изложенных в
настоящем документе
условий и
оплаты Услуг
по настоящему
Счету-оферте юридическое
или
физическое
лицо,&nbsp;производящее
акцепт этой
Оферты,
становится
Заказчиком (в
соответствии
с пунктом 3
статьи 438 ГК РФ
акцепт
Оферты
равносилен
заключению
договора на
условиях,
изложенных в
Оферте), а Исполнитель
и</span> Заказчик
совместно —
Сторонами
договора
Оферты.&nbsp;<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">1.3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В связи с&nbsp;<span class="GramE">вышеизложенным</span>,
внимательно
прочитайте
текст данной
публичной
Оферты. Если
Вы не
согласны с
каким-либо
пунктом
Оферты,
Исполнитель
предлагает
Вам
отказаться
от
использования
Услуг.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Термины</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">В настоящей
публичной
Оферте
нижеприведенные
термины
используются
в следующем
значении:<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<b>Оферта</b>&nbsp;–
настоящий
документ,
состоящий из
Счета-оферты,
<span style="mso-spacerun:yes">&nbsp;</span><span style="mso-spacerun:yes">&nbsp;</span>опубликованный
в сети
Интернет по
адресу: http://ibs-training.ru.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<b>Акцепт
Оферты</b>&nbsp;–
полное и
безоговорочное
принятие
Оферты путем
оплаты
Счета-оферты.
Акцептирование
Заказчиком
настоящей
Оферты
означает, что
он полностью
согласен со всеми
положениями
настоящей
Оферты. Акцепт
Оферты
создает
Договор
Оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<b>Заказчик</b>&nbsp;–
любое
физическое
или
юридическое
лицо, осуществившее
Акцепт
Оферты, и
являющееся
таким
образом
Заказчиком
Услуг
Исполнителя.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.4.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<b>Договор
Оферты</b>&nbsp;–
договор
между
Исполнителем
и Заказчиком
на оказание
консультационных
Услуг, заключенный
посредством
Акцепта
Оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">2.5.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<b>Услуга&nbsp;</b>–
консультационная
Услуга,
предлагаемая
Заказчиком,
избранная
Исполнителем
и указанная в
разделе «Наименование
консультационной
Услуги» Счета-оферты,
подробное
описание
которой находится
на
Интернет-ресурсе
по адресу:
http://ibs-training.ru &nbsp;.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Предмет
Оферты&nbsp;</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">3.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Предметом
настоящей
Оферты
является оказание
Заказчику
консультационных
Услуг в
соответствии
с условиями
настоящей Оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU"><span style="mso-field-code:&quot; HYPERLINK \0022\0022 &quot;"></span><b><span style="mso-spacerun:yes">&nbsp;</span></b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Условия
и порядок
предоставления
Услуг&nbsp;</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Оказание
консультационных
Услуг предоставляется
в полном
объеме при
условии 100% (сто
процентов) оплаты
Заказчиком
Счета-оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;На
основании
оплаченного
Счета-оферты Заказчик
формирует на
сайте http://ibs-training.ru
электронную
заявку.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Заказчик
перечисляет
денежные
средства
через<span style="mso-spacerun:yes">&nbsp;
</span>системы
электронных
платежей,
которые
поддерживает
сервис
Исполнителя.
В платежном документе
в разделе
"Назначение
платежа" должно
быть указано:
"Оказание
консультационных
Услуг по
Счету –
оферте ".
Оплата производится
в российских
рублях.
Оплата Заказчиком
счета
Исполнителя
является
акцептом
настоящей
Оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.4.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;После
проведения
Заказчиком
оплаты выставленного
счета,
зачисления
денежных средств
на расчетный
счет
Исполнителя
и формирования
электронной
заявки,
договор Оферты
вступает в
силу.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.5.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В течение
не более 5
(пяти)
рабочих дней
с момента Акцепта
Оферты
Исполнитель
предоставляет
электронное
подтверждение
о включении
Исполнителя
в
консультационный
план.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.6.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Исполнитель
обязуется
обеспечить
Заказчику
предоставление
консультационной
Услуги,
указанной в
настоящем
Счете-оферте,
в
соответствии
с описанием
выбранной
консультационной
Услуги,
содержащимся
на
Интернет-ресурсе
по адресу:
http://ibs-training.ru.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.7.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Исполнитель
обязуется
оказать
Услуги качественно
и в срок.
Оказание
Услуг осуществляется
на русском
языке.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.8.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Раздаточные
материалы
при оказании
консультационной
Услуги
предоставляются
Заказчику
непосредственно
на месте предоставления
Услуги и в
период её
предоставления
в случае,
предусмотренном
программой
консультации.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.9.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Исполнитель
имеет право
самостоятельно
определять
специалистов
и их
количество
для оказания
консультационных
Услуг по
договору
Оферты, а
также график
их работы. В
случае необходимости,
Исполнитель
имеет право привлекать
для
исполнения
обязательств
по договору
Оферты
третьих лиц,
за действия
которых он несёт
ответственность
перед
Заказчиком.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.10.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;Исполнитель
вправе
перенести
сроки оказания
Услуг при
условии
предварительного
согласования
переноса
сроков с
Заказчиком.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.11.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;Заказчик
обязуется
своевременно
принимать
оказанные
Исполнителем
Услуги в
соответствии
с ст. 5
настоящей
Оферты и
оплачивать Услуги
Исполнителя
в
соответствии
с п. 4.3 настоящего
Счета-оферты.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.12.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;По
письменному
требованию
Заказчика Исполнитель
может
оформить
печатную
версию
Оферты с
подписями Сторон,
равную &nbsp;по
юридической
силе настоящему
договору-оферте.</span><span lang="EN-US" style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-ansi-language:EN-US;
mso-fareast-language:RU"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">13. Заказчик обязуется:
</span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
color:black">извещать
Исполнителя
о причинах
отсутствия
на занятиях;
соблюдать
правила
учредительных
документов,
правила
внутреннего распорядка
и иные
локальные
нормативные акты
Исполнителя;
бережно
относиться к
имуществу
Исполнителя,
соблюдать
тишину,
порядок и
правила
этикета в
помещениях
Исполнителя.</span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">4.14.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;Письменным
требованием
Заказчика о
подписании
бумажного
экземпляра
настоящей Оферты
считается
доставка в
офис Исполнителя
подписанной
Заказчиком в
двух
экземплярах печатной
версии
настоящей
Оферты,
содержащей
реквизиты
Заказчика.
Адрес для
отправки: &nbsp;127434,
г. Москва,
Дмитровское&nbsp;шоссе<span class="GramE">., </span>д. 9, стр3.&nbsp;<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">5.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Порядок
приемки и
сдачи Услуг</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">5.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В течение
5 (пяти)
рабочих
дней&nbsp;<span class="GramE">с
даты
окончания</span>&nbsp;соответствующей
Услуги
Исполнитель
направляет
Заказчику
подписанный
Акт сдачи-приемки
Услуг, а
Заказчик в
течение 3
(трех) рабочих
дней со дня
получения
Акта сдачи-приемки
обязан
направить
Исполнителю
подписанный
Заказчиком
Акт
сдачи-приемки
или мотивированный
отказ от
приемки
оказанных Услуг.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">5.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В случае
мотивированного
отказа Заказчика
от
подписания
Акта
сдачи-приемки
Сторонами
составляется
двухсторонний
Акт с перечнем
необходимых
изменений и
сроков их исполнения.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">5.3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В случае
если в
соответствии
с п. 5.1 настоящей
Оферты,
Заказчиком
не будет
возвращен один
экземпляр
Акта
сдачи-приемки
и не представлен
мотивированный
отказ от
приемки
оказанных
Услуг,
обязательство
Исполнителя
по оказанию
Услуг будет считаться
исполненным
в полном
объеме, а Услуги,
оказанные по
договору
Оферты,
принятыми
Заказчиком в
полном
объеме.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Особые
условия&nbsp;</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Исполнитель
делает все
возможное,
чтобы
обеспечить
качественное
и
бесперебойное
предоставление
Услуг
Заказчику.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;<span class="GramE">Исполнитель
не несет
ответственности
за нарушение
условий
договора
Оферты, если
такое
нарушение
вызвано
действием
обстоятельств
непреодолимой
силы
(форс-мажор),
включая:
действия
органов
государственной
власти,
пожар,
наводнение,
землетрясение,
другие
стихийные
действия,
отсутствие
электроэнергии
и/или сбои
работы
компьютерной
сети,
забастовки,
гражданские
волнения, беспорядки,
болезнь
преподавателя,
любые иные
обстоятельства,
не
ограничиваясь
перечисленным,
которые
могут
повлиять на
выполнение
Исполнителем
условий
настоящей
публичной Оферты
и</span> <span class="GramE">неподконтрольные</span>
Исполнителю.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.3.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;В случае
невозможности
оказания
Услуг по вине
Исполнителя,
Исполнитель
обязуется
произвести
возврат
денежных
средств, оплаченных
Заказчиком. <span style="mso-spacerun:yes">&nbsp;</span><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU"><span style="mso-spacerun:yes">&nbsp;</span></span></b><span style="font-size:
9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:black;mso-fareast-language:RU"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.4.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Заказчик
обязуется использовать
раздаточные
материалы
Услуги
только в
индивидуальном
порядке. Заказчик
обязуется не предоставлять
доступ к
раздаточным
материалам
третьим лицам.
Материалы
Услуги
защищены
авторским
правом и
являются
собственностью
Исполнителя.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.5.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;<span class="GramE">Заказчику
запрещается
распространять
или иным образом
использовать
(публиковать,
размещать на
Интернет-сайтах,
копировать,
передавать
или
перепродавать
третьим
лицам) в коммерческих
или
некоммерческих
целях предоставляемые
Исполнителем
Заказчику
материалы в
рамках
настоящего
договора
Оферты,
создавать на их
основе
информационные
продукты, а
также
использовать
эти
материалы
каким-либо иным
образом,
кроме как для
личного/внутреннего
пользования.</span><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.6.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Участнику&nbsp;видеопрезентации&nbsp;запрещается
осуществлять
запись&nbsp;видеопрезентации&nbsp;любыми
способами (в
том числе, на
жесткий диск
компьютера,
либо
посредством
видеоаппаратуры)
без
специального
на то
разрешения
Исполнителя.&nbsp;<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.7.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Услуги
предоставляются
для
личного/внутреннего&nbsp;&nbsp;использования
Заказчиком.
Запрещается
передавать реквизиты
доступа на
видео
презентацию&nbsp;&nbsp;третьим
лицам, либо
для
совместного
использования
Заказчика с
третьими
лицами без специального
на то
разрешения
Исполнителя<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.8.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Заказчик
и
Исполнитель
обязуются
обеспечивать
конфиденциальность
учетных данных
Заказчика.
Если иное
прямо не
предусмотрено
законодательством,&nbsp;&nbsp;Исполнитель
не несет ответственности
за ущерб
любого рода,
понесенный
Заказчиком в
связи с
разглашением
Заказчиком
своих
учетных
данных.
Исполнитель
не несет
ответственности
за ущерб любого
рода, понесенный
Заказчиком
из-за
разглашения
учетных
данных
Заказчика
вследствие
несанкционированного
доступа
третьих лиц к
техническим
ресурсам,
предоставляемым
Исполнителем.
Исполнитель
имеет доступ
к информации
Заказчика
исключительно
в целях
технического
обеспечения
Услуг.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.9.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;Ничто в
настоящей
Оферте не
может пониматься
как
установление
между
Исполнителем
и Заказчиком
агентских
отношений,
трудовых
отношений,
отношений
товарищества,
отношений по
совместной
деятельности,
отношений
личного
найма.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:-18.0pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">6.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">10.</span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">
Исполнитель
вправе
собирать,
использовать,
передавать,
хранить или
иным образом
обрабатывать
(далее по
тексту –
«Обработка»)
информацию,
предоставленную
Заказчиком,
которая может
быть
отнесена к
Персональным
данным физических
лиц (далее по
тексту –
«Персональные
данные) в целях
оказания
Услуг
Заказчику.
Исполнитель
производит
Обработку
Персональных
данных в
соответствии
с применимым
законодательством
и
внутренними документами
о защите
персональных
данных.
Исполнитель
производит
Обработку
Персональных
данных, включая
трансграничную
передачу, при
условии соблюдения
требований,
предъявляемых
законодательством
для такой
передачи, а
также при
условии
обеспечения
технических,
организационных
и иных мер
безопасности
на уровне,
предписываемом
применимым
законодательством.</span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU"><o:p>&nbsp;</o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">7.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ответственность
сторон</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal;tab-stops:0cm"><b><span style="font-size:9.0pt;font-family:
&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;
mso-fareast-language:RU">7.1.</span></b><span style="font-size:9.0pt;
font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;
color:black;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;</span><span class="GramE"><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
color:black">В случае
если услуги
не были
оказаны
Исполнителем
по
уважительной
причине
(например,
болезнь
преподавателя
или иные
форс-мажорные
обстоятельства,
указанные в
п. 6.2 настоящей Оферты)
и
Исполнитель
своевременно
о уведомил
Заказчика о
невозможности
оказания Услуг
в указанный в
настоящей
Оферте срок,
то
Исполнитель
возвращает
Заказчику только
сумму предоплаты,
внесенную за
неоказанные
Услуги, без
возмещения
убытков. </span></span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:black"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">7.2</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
color:black">. </span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">В
случае если <span class="GramE">Заказчик</span> /
Обучающийся
не посетил занятия
полностью
или частично
без уведомления
об этом
Исполнителя
посредством
электронной
почты или
факсом не
менее чем за 3
(три) рабочих
дня до начала
обучения и
при условии
отсутствия
вины Исполнителя,
предварительная
оплата
Заказчику не
возвращается.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:-14.2pt;
line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">7</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">.3. </span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Сторона,
просрочившая
исполнение,
возмещает
другой
стороне
понесенные
убытки. Сумма
такого
возмещения
не может
превышать 10% от
цены
договора.</span><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU"><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p>&nbsp;</o:p></span></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;text-indent:-18.0pt;line-height:normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU">8.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:
&quot;Times New Roman&quot;;color:black;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Срок
действия и
изменение
договора
Оферты</b><o:p></o:p></span></p>

<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">8.1.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Договор
Оферты
вступает в
силу с момента
Акцепта Оферты
и действует
до
выполнения
Сторонами своих
обязательств.<o:p></o:p></span></p>

<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
normal"><b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">8.2.</span></b><span style="font-size:9.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;mso-fareast-language:
RU">&nbsp;&nbsp;&nbsp;Все споры
и
разногласия
решаются
путем переговоров
Сторон. В
случае если
разногласия
и споры не
могут быть
разрешены
Сторонами в
течение
одного
месяца путем
переговоров,
данные споры
разрешаются
Сторонами
путем
обращения в
Арбитражный
суд г. Москвы.<o:p></o:p></span></p>
<p class=MsoNormal style='margin-top:12.0pt'><b><i style='mso-bidi-font-style:
normal'><span lang=RU><o:p>&nbsp;</o:p></span></i></b></p>

<p class=MsoBodyTextIndent style='margin-left:0cm;text-indent:0cm'><b
style='mso-bidi-font-weight:normal'><span lang=RU style='font-size:11.0pt;
font-family:"Times New Roman","serif"'>От Исполнителя:<span
 >                                    </span><span
 >            </span><span
 >        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>От Заказчика:<o:p></o:p></span></b></p>

<!--
<h2 align=left style='text-align:left'><span lang=RU style='font-family:"Times New Roman","serif";
font-weight:normal'>ООО «<span class=SpellE>Люксофт</span> <span class=SpellE>Сервисиз</span>»<span
 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?echo $arOrderProps["COMPANY"];?> <o:p></o:p></span></h2>
-->
<p class=a style='text-align:justify;tab-stops:333.15pt'><span lang=RU style='font-size:11.0pt;font-family:"Times New Roman","serif";layout-grid-mode:both'><b>ООО «ИБС ИнфиниСофт»</b><br /> <img width="350" style="float:left" border="0" alt="" src="/images/offerta/Litviniva_Luxoft_Professional_Director.jpg"><!--, Литвинова Елена Николаевна--><span
 >&nbsp;</span><?echo $arOrderProps["POSITION_RESPONS"]?></span></p>



 <?if ($bShowPodpis){?>
       <p style="margin-top: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$arOrderProps['FIO_RESPONS']?> ______________</p></span>
        <div style="clear:both"></div>
 <?} else {?>
    <br />
<p class=a style='text-align:justify;tab-stops:333.15pt'>

<span lang="RU" style="font-size:11.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;layout-grid-mode:
both">Литвинова Е. Н._________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$arOrderProps['FIO_RESPONS']?> _______________________________</span>
</p>
 
<?}?>

<p class=MsoNormal style='margin-left:2.0pt;text-align:justify'><span lang=RU
style='font-size:11.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-top:12.0pt'><b><i style='mso-bidi-font-style:
normal'><span lang=RU><o:p>&nbsp;</o:p></span></i></b></p>

</div>
</body>
</html>