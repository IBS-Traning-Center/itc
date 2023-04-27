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
	$arOrderProps[$arProps['CODE']] = $arProps['VALUE'];
}
	//iwrite($arOrderProps);
?>
<?/*echo "<pre>"?>
<?print_r($arOrder["DATE_INSERT"])?>
<?echo "</pre>"*/?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 14">
<meta name=Originator content="Microsoft Word 14">
<link rel=File-List
href="20141031_LUXOFT_umowa%20us&#322;ugi%20konsultacyjne_final%20draft.files/filelist.xml">
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>LANGIER Anna | JPGL</o:Author>
  <o:LastAuthor>Shkavro, Anton</o:LastAuthor>
  <o:Revision>3</o:Revision>
  <o:TotalTime>1713</o:TotalTime>
  <o:Created>2015-04-27T09:11:00Z</o:Created>
  <o:LastSaved>2015-04-29T09:58:00Z</o:LastSaved>
  <o:Pages>2</o:Pages>
  <o:Words>754</o:Words>
  <o:Characters>4300</o:Characters>
  <o:Company>HP</o:Company>
  <o:Lines>35</o:Lines>
  <o:Paragraphs>10</o:Paragraphs>
  <o:CharactersWithSpaces>5044</o:CharactersWithSpaces>
  <o:Version>14.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:AllowPNG/>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=dataStoreItem
href="20141031_LUXOFT_umowa%20us&#322;ugi%20konsultacyjne_final%20draft.files/item0006.xml"
target="20141031_LUXOFT_umowa%20us&#322;ugi%20konsultacyjne_final%20draft.files/props007.xml">
<link rel=themeData
href="20141031_LUXOFT_umowa%20us&#322;ugi%20konsultacyjne_final%20draft.files/themedata.thmx">
<link rel=colorSchemeMapping
href="20141031_LUXOFT_umowa%20us&#322;ugi%20konsultacyjne_final%20draft.files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:HyphenationZone>21</w:HyphenationZone>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>PL</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
  </w:Compatibility>
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
</xml><![endif]--><!--[if gte mso 9]><xml>
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
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1073786111 1 0 415 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:3 0 0 0 1 0;}
@font-face
	{font-family:"Book Antiqua";
	panose-1:2 4 6 2 5 3 5 3 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
p.MsoCommentText, li.MsoCommentText, div.MsoCommentText
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F \0417\043D\0430\043A";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
span.MsoCommentReference
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;}
p.MsoCommentSubject, li.MsoCommentSubject, div.MsoCommentSubject
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F";
	mso-style-link:"\0422\0435\043C\0430 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F \0417\043D\0430\043A";
	mso-style-next:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;
	font-weight:bold;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"\0422\0435\043A\0441\0442 \0432\044B\043D\043E\0441\043A\0438 \0417\043D\0430\043A";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-bidi-font-family:Tahoma;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:36.0pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:36.0pt;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
span.a
	{mso-style-name:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F \0417\043D\0430\043A";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;}
span.a0
	{mso-style-name:"\0422\0435\043C\0430 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F \0417\043D\0430\043A";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"\0422\0435\043A\0441\0442 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F \0417\043D\0430\043A";
	mso-style-link:"\0422\0435\043C\0430 \043F\0440\0438\043C\0435\0447\0430\043D\0438\044F";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-weight:bold;}
span.a1
	{mso-style-name:"\0422\0435\043A\0441\0442 \0432\044B\043D\043E\0441\043A\0438 \0417\043D\0430\043A";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"\0422\0435\043A\0441\0442 \0432\044B\043D\043E\0441\043A\0438";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-ascii-font-family:Tahoma;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
.MsoPapDefault
	{mso-style-type:export-only;
	margin-bottom:10.0pt;
	line-height:115%;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:70.85pt 70.85pt 70.85pt 70.85pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:19013754;
	mso-list-type:hybrid;
	mso-list-template-ids:-1357714092 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l0:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l0:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1
	{mso-list-id:553583439;
	mso-list-type:hybrid;
	mso-list-template-ids:-1357714092 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l1:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l1:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l1:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2
	{mso-list-id:577981424;
	mso-list-type:hybrid;
	mso-list-template-ids:-995706086 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l2:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3
	{mso-list-id:654918141;
	mso-list-type:hybrid;
	mso-list-template-ids:-1214636198 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l3:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l3:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4
	{mso-list-id:968634165;
	mso-list-type:hybrid;
	mso-list-template-ids:1321626690 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l4:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l4:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5
	{mso-list-id:1324164923;
	mso-list-type:hybrid;
	mso-list-template-ids:-1714793694 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l5:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l5:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l6
	{mso-list-id:1704938085;
	mso-list-type:hybrid;
	mso-list-template-ids:774767952 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l6:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l6:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l6:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l6:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l7
	{mso-list-id:1916695894;
	mso-list-type:hybrid;
	mso-list-template-ids:774767952 68485135 68485145 68485147 68485135 68485145 68485147 68485135 68485145 68485147;}
@list l7:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l7:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l7:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l7:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
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
	{mso-style-name:"\041E\0431\044B\0447\043D\0430\044F \0442\0430\0431\043B\0438\0446\0430";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin-top:0cm;
	mso-para-margin-right:0cm;
	mso-para-margin-bottom:10.0pt;
	mso-para-margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-ansi-language:PL;
	mso-fareast-language:EN-US;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=RU style='tab-interval:35.4pt'>

<div class=WordSection1>
<?$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$ORDER_ID));
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
		$city=$arService["PROPERTY_CITY_ID_NAME"];
}

?>
<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>UMOWA &#346;WIADCZENIA US&#321;UG
KONSULTACYJNYCH<o:p></o:p></span></p>

<p class=MsoNormal><span lang=PL style='font-family:"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>Zawarta w </span><span lang=EN-US style='font-family:
"Book Antiqua","serif";mso-ansi-language:EN-US'><?=$city?></span><span lang=PL
style='font-family:"Book Antiqua","serif"'> w dniu <?=date('d.m.Y', strtotime($arOrder["DATE_INSERT"]))?> pomi&#281;dzy:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>1. Pani&#261;/Panem <?=$arOrderProps["name"]?>, zamieszka&#322;&#261;/-ym w
<?=$arOrderProps["city"]?> przy ul. <?=$arOrderProps["street"]?>, kod <?=$arOrderProps["zip"]?>, posiadaj&#261;cym PESEL: <span
style='mso-spacerun:yes'> </span><?=$arOrderProps["pesel"]?>, zwan&#261;/-ym dalej „KLIENTEM”<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>a<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>2. LUXOFT POLAND spo&#322;k&#261; z ograniczon&#261;
odpowiedzialno&#347;ci&#261; z siedzib&#261; w Zabierzowie przy ul. Krakowskiej
280, kod 32-080 Zabierzow, wpisan&#261; do rejestru przedsi&#281;biorcow
Krajowego Rejestru S&#261;dowego pod numerem KRS 0000359814,
posiadaj&#261;c&#261; NIP 6762423185, REGON 121272822, reprezentowan&#261;
przez #REPRESENTOR# -#REPRESENTOR2#, na podstawie pe&#322;nomocnictwa z dnia #REPRESENT_DATE#,
ktorego odpis stanowi Za&#322;&#261;cznik nr 1 do niniejszej Umowy, zwan&#261;
dalej „LUXOFT”,<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>zwanymi dalej &#322;&#261;cznie „Stronami”, a
ka&#380;de z osobna „Stron&#261;”<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 1<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>PRZEDMIOT UMOWY<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l3 level1 lfo2'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Przedmiotem
niniejszej Umowy jest &#347;wiadczenie przez LUXOFT na rzecz KLIENTA us&#322;ug
konsultacyjnych w zamian za wynagrodzenie. <o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l3 level1 lfo2'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>&#346;wiadczenie
us&#322;ug konsultacyjnych odbywa si&#281; w j&#281;zyku polskim.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l3 level1 lfo2'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Szczego&#322;owy
zakres i program konsultacji oraz czas ich trwania i miejsce przeprowadzania
(„Program”) s&#261; okre&#347;lone w Za&#322;&#261;czniku nr 2 do niniejszej
Umowy.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l3 level1 lfo2'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>LUXOFT
ma prawo dowolnego ustalania liczby osob zaanga&#380;owanych ze strony LUXOFT w
wykonanie Umowy oraz do wyznaczania tych osob spo&#347;rod pracownikow LUXOFT
lub te&#380; mo&#380;e powierzy&#263; wykonywanie ca&#322;o&#347;ci lub
cz&#281;&#347;ci us&#322;ug obj&#281;tych Umow&#261; odpowiednio wykwalifikowanym
podmiotom trzecim, za ktorych dzia&#322;ania ponosi odpowiedzialno&#347;&#263;
wobec KLIENTA.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 2<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>O&#346;WIADCZENIA I
ZOBOWI&#260;ZANIA LUXOFT<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l7 level1 lfo3'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>LUXOFT<span
style='mso-spacerun:yes'>  </span>o&#347;wiadcza, &#380;e posiada wiedz&#281; i
do&#347;wiadczenie niezb&#281;dne do wykonania niniejszej Umowy oraz
zobowi&#261;zuje si&#281; do &#347;wiadczenia us&#322;ug wysokiej jako&#347;ci.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l7 level1 lfo3'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>LUXOFT
zobowi&#261;zuje si&#281; do &#347;wiadczenia us&#322;ug konsultacyjnych
zgodnie z Programem, w tym w szczegolno&#347;ci do:<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>a) zapewnienia warunkow technicznych
i organizacyjnych niezb&#281;dnych do przeprowadzenia konsultacji;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>b) zapewnienia odpowiedniego doboru
osob do przeprowadzenia konsultacji;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>c) potwierdzenia na pi&#347;mie, na
&#380;&#261;danie KLIENTA, faktu i zakresu przeprowadzonych konsultacji.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 3<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>O&#346;WIADCZENIA I
ZOBOWI&#260;ZANIA KLIENTA<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l6 level1 lfo5'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>KLIENT
o&#347;wiadcza, &#380;e zawarcie niniejszej Umowy nie jest zwi&#261;zane z jego
dzia&#322;alno&#347;ci&#261; gospodarcz&#261; ani zawodow&#261;.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l6 level1 lfo5'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>KLIENT
o&#347;wiadcza, &#380;e zapozna&#322; si&#281; z Programem i nie wnosi do niego
zastrze&#380;e&#324;.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l6 level1 lfo5'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>KLIENT
zobowi&#261;zuje si&#281; do zap&#322;aty Wynagrodzenia za us&#322;ugi
konsultacyjne zgodnie z postanowieniami § 4 Umowy.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 4<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>WYNAGRODZENIE<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l2 level1 lfo7'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Strony
ustalaj&#261;, &#380;e wynagrodzenie nale&#380;ne LUXOFT od KLIENTA za
us&#322;ugi &#347;wiadczone na podstawie niniejszej Umowy wynosi kwot&#281; <?=$arOrder["PRICE"]?>
(s&#322;ownie: ______________________________________________________________) euro
brutto („Wynagrodzenie”).<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l2 level1 lfo7'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Zap&#322;ata
Wynagrodzenia powinna nast&#261;pi&#263; przelewem na rachunek bankowy LUXOFT
prowadzony przez #BANK# o numerze #NUMBER#.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l2 level1 lfo7'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>KLIENT
jest zobowi&#261;zany do zap&#322;aty ca&#322;o&#347;ci Wynagrodzenia przed
rozpocz&#281;ciem &#347;wiadczenia us&#322;ug przez LUXOFT.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l2 level1 lfo7'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Wynagrodzenie
obejmuje ca&#322;o&#347;&#263; us&#322;ug &#347;wiadczonych przez LUXOFT na
rzecz KLIENTA przewidzianych w Programie. W zwi&#261;zku z
konieczno&#347;ci&#261; poniesienia przez LUXOFT kosztow zwi&#261;zanych z
wykonaniem Umowy, Strony postanawiaj&#261;, &#380;e w wypadku rezygnacji przez
KLIENTA z dalszego &#347;wiadczenia na jego rzecz us&#322;ug obj&#281;tych
Programem z przyczyn, za ktore KLIENT ponosi odpowiedzialno&#347;&#263;, KLIENT
mo&#380;e ponosi&#263; odpowiedzialno&#347;&#263; odszkodowawcz&#261;
wzgl&#281;dem LUXOFT.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 5<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>OBOWI&#260;ZYWANIE UMOWY<o:p></o:p></span></p>

<p class=MsoListParagraph style='text-align:justify;text-indent:-18.0pt;
mso-list:l1 level1 lfo6'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Umowa
zostaje zawarta na czas okre&#347;lony, konieczny dla zrealizowania us&#322;ug
przewidzianych w Programie.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 6<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>DANE OSOBOWE<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo8'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Administratorem
danych osobowych KLIENTA jest LUXOFT.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo8'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Dane
osobowe KLIENTA b&#281;d&#261; przetwarzane w celu wykonania Umowy, jak
rownie&#380; w celach marketingowych i rekrutacyjnych LUXOFT. Dane przetwarzane
b&#281;d&#261; zgodnie z Ustaw&#261; o ochronie danych osobowych. <o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo8'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>W
celach okre&#347;lonych w ust. 2 powy&#380;ej b&#281;d&#261; przetwarzane
nast&#281;puj&#261;ce dane osobowe KLIENTA:<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>a) Imi&#281;;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>b) Nazwisko;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>c) Adres e-mail;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>d) Adres zamieszkania;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>e) Numer telefonu;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify'><span lang=PL
style='font-family:"Book Antiqua","serif"'>f) Numer PESEL.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo8'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>KLIENT
ma prawo wgl&#261;du do swoich danych osobowych, ich poprawiania oraz
zg&#322;oszenia &#380;&#261;dania zaprzestania ich przetwarzania. Podanie
danych osobowych przez KLIENTA jest dobrowolne. <o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 7<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>PRAWA AUTORSKIE<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l4 level1 lfo4'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>W
przypadku, gdy w ramach wykonywania Umowy, LUXOFT przeka&#380;e KLIENTOWI
materia&#322;y lub opracowania, bez wzgl&#281;du na ich form&#281; i
no&#347;nik, na jakim si&#281; znajduj&#261;, KLIENT jest uprawniony do
korzystania z nich wy&#322;&#261;cznie na w&#322;asny u&#380;ytek osobisty.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l4 level1 lfo4'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Przekazanie
KLIENTOWI materia&#322;ow lub opracowa&#324; nie stanowi udzielenia licencji ani
przeniesienia autorskich praw maj&#261;tkowych do tych materia&#322;ow lub
opracowa&#324;.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>§ 8<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=PL
style='font-family:"Book Antiqua","serif"'>POSTANOWIENIA KO&#323;COWE<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style='text-align:justify;text-indent:-18.0pt;
mso-list:l5 level1 lfo1'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Strony
uzgadniaj&#261;, &#380;e spory zwi&#261;zane z niniejsz&#261; Umow&#261; lub
wynikaj&#261;ce z jej wykonywania b&#281;d&#261; rozstrzygane w drodze
negocjacji. Je&#380;eli w terminie 30 dni od dnia wezwania drugiej Strony do
podj&#281;cia negocjacji nie uda si&#281; osi&#261;gn&#261;&#263; porozumienia,
spor b&#281;dzie podlega&#322; rozstrzygni&#281;ciu przez s&#261;d w&#322;a&#347;ciwy
miejscowo wed&#322;ug ustawy .<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style='text-align:justify;text-indent:-18.0pt;
mso-list:l5 level1 lfo1'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Wszelkie
zmiany niniejszej Umowy wymagaj&#261; formy pisemnej pod rygorem
niewa&#380;no&#347;ci.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style='text-align:justify;text-indent:-18.0pt;
mso-list:l5 level1 lfo1'><![if !supportLists]><span lang=PL style='font-family:
"Book Antiqua","serif";mso-fareast-font-family:"Book Antiqua";mso-bidi-font-family:
"Book Antiqua"'><span style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=PL style='font-family:"Book Antiqua","serif"'>Umow&#281;
sporz&#261;dzono w dwoch jednobrzmi&#261;cych egzemplarzach, po jednym dla
ka&#380;dej ze Stron.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>KLIENT<span style='mso-tab-count:6'>                                                                    </span>W
IMIENIU I NA RZECZ LUXOFT<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'>____________________<span style='mso-tab-count:4'>                                          </span>____________________<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span lang=PL style='font-family:
"Book Antiqua","serif"'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
