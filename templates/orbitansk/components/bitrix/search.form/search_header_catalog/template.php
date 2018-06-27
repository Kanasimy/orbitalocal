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
$this->setFrameMode(true);?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="top-navigation__search">
                <input class="form-control" type="text" name="q"  value="" placeholder="Поиск по каталогу">

                    <button type="submit" name='s' class="top-navigation__btn" value="">
                        <svg class="top-navigation__btn icons icon-search">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#search"></use>
                        </svg>
                    </button>
</form>

