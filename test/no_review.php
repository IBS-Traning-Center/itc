<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("Курсы без отзывов");?>
<?CModule::IncludeModule("iblock");?>
<?$rsBooks = CIBlockElement::GetList(
    array("NAME" => "ASC"), //Сортируем по имени
    array(
      "IBLOCK_ID" => 6,
      "ACTIVE" => "Y",
      "!ID" => CIBlockElement::SubQuery("PROPERTY_course", array(
        "IBLOCK_ID" => 61
       )),
   ),
   false, // Без группировки
   false,  //Без постранички
   array("ID", "CODE", "IBLOCK_ID", "NAME") // Выбираем только поля необходимые для показа
  );?>
  <ul>
 <?while($arBook = $rsBooks->GetNext())
    echo "<li><b>".$arBook["CODE"]."</b> ".$arBook["NAME"]."\n";?>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
