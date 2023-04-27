<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult as $key=>$arBlog) {?>
    <?$ID = $arBlog["BLOG_OWNER_ID"];
    $arUser = CBlogUser::GetByID($ID, BLOG_BY_USER_ID);
    if(is_array($arUser))
        $arResult[$key]["PICTURE"]=CFile::GetFileArray($arUser["AVATAR"]);
    ?>
<?}?>