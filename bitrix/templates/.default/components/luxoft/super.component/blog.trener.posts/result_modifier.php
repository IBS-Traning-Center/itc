<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("iblock")) return;
if (!strlen($arParams['ELEMENT_ID'])>0) {
	$arSelect = Array("ID", "PROPERTY_BLOG_ID");
	$arFilter = Array("IBLOCK_ID"=>56, "CODE"=>$arParams['ELEMENT_CODE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	  $arFieldsExpert = $ob->GetFields();
		//iwrite($arFieldsExpert);
	}
	$arParams['ELEMENT_ID'] = $arFieldsExpert["ID"];
}








if (!CModule::IncludeModule("blog")) return;


$arParams['BLOG_ID']  = $arFieldsExpert["PROPERTY_BLOG_ID_VALUE"];
//iwrite($arParams['BLOG_ID']);
if (strlen($arParams['BLOG_ID'])>0) {



$arBlog = CBlog::GetByID($arParams['BLOG_ID']);
if(is_array($arBlog))
    //iwrite($arBlog);


$arSort = Array("DATE_PUBLISH" => "DESC", "NAME" => "ASC");
$arFilter = Array(
	"BLOG_ID" => $arParams['BLOG_ID'],
	"PUBLISH_STATUS" => "P",
    );	

$dbPosts = CBlogPost::GetList(
        $arSort,
        $arFilter,
false,
array("nTopCount" => $arParams['COUNT'])
    );
while ($arPost = $dbPosts->Fetch())
{
    //iwrite($arPost);
    $arPostN["ID"] =  $arPost["ID"];
    $arPostN["NAME"] =  $arPost["TITLE"];
    $arPostN["DATE_PUBLISH"] =  FormatDate("d.m.Y", MakeTimeStamp($arPost["DATE_PUBLISH"]));
    $arPostN["URL"] =  $arBlog["URL"];
    $arResult['POSTS'][] = $arPostN;

}

	
	}

?>