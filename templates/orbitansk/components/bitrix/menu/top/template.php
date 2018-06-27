<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<nav class="top-navigation__menu navbar">
                    <div class="collapse navbar-collapse" id="collapseExample">
                        <ul class="top-navigation__nav">
			<?
			$previousLevel = 0;
			foreach($arResult as $arItem):
			?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>
			<li<?if($arItem["CHILD_SELECTED"] !== true):?> class="dropdown"<?endif?>>
				<a class="top-navigation__menu_item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				<ul class="top-navigation__subnav dropdown-menu">

					<?else:?>

						<?if ($arItem["PERMISSION"] > "D"):?>
							<li>
								<div class="item-text"><a class="top-navigation__menu_item" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
							</li>
						<?endif?>

					<?endif?>

					<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

					<?endforeach?>

					<?if ($previousLevel > 1)://close last item tags?>
						<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
					<?endif?>

</ul>
                    </div>
                </nav>
<?endif?>