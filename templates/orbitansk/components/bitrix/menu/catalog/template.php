<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="dropdown catalog-nav__select">
    <button class="btn btn-dropdown dropdown-toggle" type="button" id="catalog-nav_select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Каталог
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="catalog-nav__select">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="selected footer__link"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a class="footer__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

</ul>
</div>
<?endif?>
