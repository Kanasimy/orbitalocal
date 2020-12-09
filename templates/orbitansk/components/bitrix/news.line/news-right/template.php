<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<h3 class="blue">Новости</h3>

	<?foreach($arResult["ITEMS"] as $arItem):?>

<div class="news__item">
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<h5 id="<?=$this->GetEditAreaId($arItem['ID']);?>"><small class="news__data"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?>&nbsp;&nbsp;</small><?echo $arItem["NAME"]?></h5>
	<p><?echo strip_tags($arItem[PREVIEW_TEXT]);?> <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">далее...</a></p>
</div>
	<?endforeach;?>

