<?php
//Подключаем ядро Битрикс и главный модуль
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
CModule::IncludeModule('iblock');
//Подключаем модуль sale
Loader::includeModule("sale");
$ID=json_decode($_POST["name"]);
$itog='{ "activ":[';
for ($i = 0; $i < count($ID->id); $i++) {
$prop=CIBlockElement::GetByID($ID->id[$i])->GetNextElement();
if ($i==0) {
     $itog.='"'.$prop->fields['ACTIVE'].'"';
} else{
    $itog.=', "'.$prop->fields['ACTIVE'].'"';
}
}
 echo $itog." ]}"; 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
