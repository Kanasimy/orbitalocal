<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


// additional video
$arResult["VIDEO"] = array();
if (isset($arResult["PROPERTIES"]["FILES"]["VALUE"]) && is_array($arResult["PROPERTIES"]["FILES"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["FILES"]["VALUE"] as $FILE) {
        $FILE = CFile::GetFileArray($FILE);
        if (is_array($FILE) && $FILE["CONTENT_TYPE"] === "video/mp4")
            $arResult["VIDEO"][] = $FILE;
    }
}

// additional photo
$arResult["MORE_PHOTO"] = array();
if (isset($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $FILE) {
        $FILE = CFile::GetFileArray($FILE);
        if (is_array($FILE))
            $arResult["MORE_PHOTO"][] = $FILE;
    }
}

$arResult['MORE_PHOTO_COUNT'] = sizeof( $arResult['MORE_PHOTO'] );
