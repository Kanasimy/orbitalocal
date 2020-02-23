<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

$quantity=1;
$productID=$item['ID'];
$renewal= 'N';

$arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $USER->GetUserGroupArray(), $renewal);
if (!$arPrice || count($arPrice) <= 0) {
    if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, $quantity, $USER->GetUserGroupArray())) {
        $quantity = $nearestQuantity;
        $arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $USER->GetUserGroupArray(), $renewal);
    }
}
echo "<pre style='display: none'>";
print_r($arPrice);
echo "</pre>";


if ($haveOffers)
{
	$showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
	$showProductProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];
	$showPropsBlock = $showDisplayProps || $showProductProps;
	$showSkuBlock = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && !empty($item['OFFERS_PROP']);
}
else
{
	$showDisplayProps = !empty($item['DISPLAY_PROPERTIES']);
	$showProductProps = $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']);
	$showPropsBlock = $showDisplayProps || $showProductProps;
	$showSkuBlock = false;
}



$timeCreateSection = MakeTimeStamp($item["TIMESTAMP_X"], "DD.MM.YYYY HH:MI:SS");
$threeDay = time() - (3 * 24 * 60 * 60);//Три дня назад
if($timeCreateSection>$threeDay) {
	$item['STIKER'] = "new";
}
$db = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arResult['IBLOCK_ID'], 'ID'=>$item['ID']), false, false, array('SHOW_COUNTER'));
if ($i = $db->Fetch())
	/*Количество просмотров";*/
    if($i['SHOW_COUNTER']>300 && !$price['PERCENT']>0){
		$item['STIKER']="popular";
	}
?>
<pre style="display:none">+++<?print_r($USER->GetUserGroupArray())?></pre>
<div class="col-sm-3">
	<div class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
		<div class="catalog-item__checkbox">
			<input id="tovar_<?=$item['ID']?>" name="tovar_<?=$item['ID']?>" value="<?=$item['ID']?>" type="checkbox">
			<label for="tovar_<?=$item['ID']?>"></label>
			<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"></svg></div>
	</div>
	<div class="catalog-item__images-box">
		<?if($item['STIKER']=="popular"){?>
		<div class="catalog__icon catalog__icon-red">
			<svg class="icons icon-hot popular__icon-hot">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#hot"></use>
			</svg>
		</div>
		<? } ?>


		<a class="catalog-item__images" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
		   data-entity="image-wrapper">

			<span class="product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
				  style="display: <?=($showSlider ? '' : 'none')?>;"
				  data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
				<?
				if ($showSlider)
				{
					foreach ($morePhoto as $key => $photo)
					{
						?>
						<span class="product-item-image-slide item <?=($key == 0 ? 'active' : '')?>"
							  style="background-image: url(<?=$photo['SRC']?>);">
						</span>
						<?
					}
				}
                $bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
				?>
			</span>
			<span class="product-item-image-original" id="<?=$itemIds['PICT']?>"
				  style="background-image: url(<?=$bgImage?>); display: <?=($showSlider ? 'none' : '')?>;">
			</span>
			<?
			if ($item['SECOND_PICT'])
			{

				?>
				<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
					  style="background-image: url(<?=$bgImage?>); display: <?=($showSlider ? 'none' : '')?>;">
				</span>
				<?
			}

			if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
			{
				?>
				<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
					 style="display: <?=($price['PERCENT'] > 0 ? '' : 'none')?>;">
					<span><?=-$price['PERCENT']?>%</span>
				</div>
				<?
			}

			if ($item['LABEL'])
			{
				?>
				<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
					<?
					if (!empty($item['LABEL_ARRAY_VALUE']))
					{
						foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
						{
							?>
							<div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
								<span title="<?=$value?>"><?=$value?></span>
							</div>
							<?
						}
					}
					?>
				</div>
				<?
			}
			?>
			<div class="product-item-image-slider-control-container" id="<?=$itemIds['PICT_SLIDER']?>_indicator"
				 style="display: <?=($showSlider ? '' : 'none')?>;">
				<?
				if ($showSlider)
				{
					foreach ($morePhoto as $key => $photo)
					{
						?>
						<div class="product-item-image-slider-control<?=($key == 0 ? ' active' : '')?>" data-go-to="<?=$key?>"></div>
						<?
					}
				}
				?>
			</div>
			<?
			if ($arParams['SLIDER_PROGRESS'] === 'Y')
			{
				?>
				<div class="product-item-image-slider-progress-bar-container">
					<div class="product-item-image-slider-progress-bar" id="<?=$itemIds['PICT_SLIDER']?>_progress_bar" style="width: 0;"></div>
				</div>
				<?
			}
			?>
		</a>
	</div>
</div>
<div class="col-sm-9">
	<div class="row">
		<div class="col-sm-8">
			<div class="catalog-item__description">
				<h5><a class="catalog-item__header" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>"><?=$productTitle?></a></h5>
			</div>
		</div>
		<div class="col-sm-4">
			<?
			foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
			{
				switch ($blockName)
				{
					case 'price': ?>

						<?
						break;

					case 'quantityLimit':
						if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
						{
							if ($haveOffers)
							{
								if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
								{
									?>
									<div class="product-item-info-container product-item-hidden"
										 id="<?=$itemIds['QUANTITY_LIMIT']?>"
										 style="display: none;"
										 data-entity="quantity-limit-block">
										<div class="product-item-info-container-title">
											<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
											<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
										</div>
									</div>
									<?
								}
							}
							else
							{
								if (
									$measureRatio
									&& (float)$actualItem['CATALOG_QUANTITY'] > 0
									&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
									&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
								)
								{
									?>
									<div class="product-item-info-container product-item-hidden" id="<?=$itemIds['QUANTITY_LIMIT']?>">
										<div class="product-item-info-container-title">
											<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
											<span class="product-item-quantity" data-entity="quantity-limit-value">
												<?
												if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
												{
													if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
													{
														echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
													}
													else
													{
														echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
													}
												}
												else
												{
													echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
												}
												?>
											</span>
										</div>
									</div>
									<?
								}
							}
						}

						break;

					case 'quantity':
						if (!$haveOffers)
						{
							if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY'])
							{
								?>
								<div class="catalog-item__count" data-entity="quantity-block">
									<div class="product-item-amount">
										<div class="product-item-amount-field-container input-group">
											<span class="input-group-btn"><a class="catalog-item__count_btn product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"
																			 href="javascript:void(0)" rel="nofollow">
											</a></span>
											<input class="form-control" id="<?=$itemIds['QUANTITY']?>" type="tel"
												   name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
												   value="<?=$measureRatio?>">
											<span class="input-group-btn"><a class="input-group-btn product-item-amount-field-btn-plus catalog-item__count_btn" id="<?=$itemIds['QUANTITY_UP']?>"
																			 href="javascript:void(0)" rel="nofollow">
											</a></span>

										</div>
										<div class="product-item-amount-description-container">
												<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
													<?=$actualItem['ITEM_MEASURE']['TITLE']?>
												</span>
											<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
										</div>
									</div>
								</div>
								<?
							}
						}
						elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						{
							if ($arParams['USE_PRODUCT_QUANTITY'])
							{
								?>
								<div class="product-item-info-container" data-entity="quantity-block">
									<div class="product-item-amount">
										<div class="product-item-amount-field-container">
											<a class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"
											   href="javascript:void(0)" rel="nofollow">
											</a>
											<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="tel"
												   name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
												   value="<?=$measureRatio?>">
											<a class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP']?>"
											   href="javascript:void(0)" rel="nofollow">
											</a>
											<div class="product-item-amount-description-container">
												<span id="<?=$itemIds['QUANTITY_MEASURE']?>"></span>
												<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
											</div>
										</div>
									</div>
								</div>
								<?
							}
						}

						break;

					case 'buttons':
						?>

						<?
						break;

					case 'compare':
						if (
							$arParams['DISPLAY_COMPARE']
							&& (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						)
						{
							?>
							<div class="product-item-compare-container">
								<div class="product-item-compare">
									<div class="checkbox">
										<label id="<?=$itemIds['COMPARE_LINK']?>">
											<input type="checkbox" data-entity="compare-checkbox">
											<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
										</label>
									</div>
								</div>
							</div>
							<?
						}

						break;
				}
			}
			?>
		</div>
	</div>
	<div class="row">
        <pre style="display: none">price: <?php print_r($price)?></pre>
		<div class="catalog-item__select">
			<div class="col-sm-4 col-xs-6">
                <div class="catalog-item__short-info">
                <span class="catalog-item__article">
					 </span>
                    <div class="catalog-item__kod">
                        <? if($item['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE']){?>
                        <div>Код: <strong>
                                <?=$item['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE']?>
                            </strong>
                        </div><?}?>
                        <? if($item['PROPERTIES']['CML2_TRAITS']['VALUE']['5']){?><div>Артикул: <?=$item['PROPERTIES']['CML2_TRAITS']['VALUE']['5']?></div><?}?>
                        <? if($item['PROPERTIES']['CML2_BAR_CODE']['VALUE']){?><div>Штрих-Код: <?=$item['PROPERTIES']['CML2_BAR_CODE']['VALUE']?></div><?}?>

                    </div>
                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div class="catalog-item__short-info">
					<div class="catalog-item__short-info_min">
						мин. кол-во
						<div class="catalog-item__short-info_value">
							<?=$item['DISPLAY_PROPERTIES']['CML2_TRAITS']['VALUE'][3] ?>
						</div>
					</div>
                    <div class="catalog-item__short-info_in-box">
                        в коробке
                        <div class="catalog-item__short-info_value">
                            <?=$item['DISPLAY_PROPERTIES']['CML2_TRAITS']['VALUE'][4] ?> шт.
                        </div>
                    </div>
				</div>
				<div class="catalog-item__price" data-entity="price-block">
					<?
					if ($arParams['SHOW_OLD_PRICE'] === 'Y')
					{
						?>
							<? if(!($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE']) ) {?>
                            <span class="price catalog-item__price_old catalog-item__price_old-line-through" id="<?=$itemIds['PRICE_OLD']?>">
                                <span class="price catalog-item__price_old">
                                    <?=$price['PRINT_RATIO_BASE_PRICE']?>
                                </span>
                            </span>
						<?}
					}
					?>
					<span class="price catalog-item__price_new" id="<?=$itemIds['PRICE']?>">
								<?
								if (!empty($price))
								{
									if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
									{
										echo Loc::getMessage(
											'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
											array(
												'#PRICE#' => $price['PRINT_RATIO_PRICE'],
												'#VALUE#' => $measureRatio,
												'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
											)
										);
									}
									else
									{
										echo $price['PRINT_RATIO_PRICE'];
									}
								}
								?>
							</span>
				</div>
			</div>
			<div class="col-sm-4 catalog-item__mobile-row">
				<div class="catalog-item__presence">
                    <? if($item[CATALOG_QUANTITY]){?>в наличии<?} else {?>
                    в пути <?}?>
				</div>
				<div class="catalog-item__price-mobile" data-entity="price-block">
					<?
					if ($arParams['SHOW_OLD_PRICE'] === 'Y')
					{
						?>
						<span class="price catalog-item__price_old" id="<?=$itemIds['PRICE_OLD']?>"
							<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
									<?=$price['PRINT_RATIO_BASE_PRICE']?>
								</span>&nbsp;
						<?
					}
					?>
					<span class="price catalog-item__price_new" id="<?=$itemIds['PRICE']?>">
								<?
								if (!empty($price))
								{
									if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
									{
										echo Loc::getMessage(
											'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
											array(
												'#PRICE#' => $price['PRINT_RATIO_PRICE'],
												'#VALUE#' => $measureRatio,
												'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
											)
										);
									}
									else
									{
										echo $price['PRINT_RATIO_PRICE'];
									}
								}
								?>
							</span>
				</div>
				<div class="product-item-info-container" data-entity="buttons-block">
					<?
					if (!$haveOffers)
					{
						if ($actualItem['CAN_BUY'])
						{
							?>
							<div class="catalog-item__btn" id="<?=$itemIds['BASKET_ACTIONS']?>">
								<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
								   href="javascript:void(0)" rel="nofollow">
									<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
								</a>
							</div>
							<?
						}
						else
						{
							?>
							<div class="product-item-button-container">
								<?
								if ($showSubscribe)
								{
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.product.subscribe',
										'',
										array(
											'PRODUCT_ID' => $actualItem['ID'],
											'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
											'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
											'DEFAULT_DISPLAY' => true,
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
								}
								?>
								<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
								   href="javascript:void(0)" rel="nofollow">
									<?=$arParams['MESS_NOT_AVAILABLE']?>
								</a>
							</div>
							<?
						}
					}
					else
					{
						if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
						{
							?>
							<div class="product-item-button-container">
								<?
								if ($showSubscribe)
								{
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.product.subscribe',
										'',
										array(
											'PRODUCT_ID' => $item['ID'],
											'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
											'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
											'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
								}
								?>
								<a class="btn btn-default <?=$buttonSizeClass?>"
								   id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
								   style="display: <?=($actualItem['CAN_BUY'] ? 'none' : '')?>;">
									<?=$arParams['MESS_NOT_AVAILABLE']?>
								</a>
								<div id="<?=$itemIds['BASKET_ACTIONS']?>" style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;">
									<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
									   href="javascript:void(0)" rel="nofollow">
										<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
									</a>
								</div>
							</div>
							<?
						}
						else
						{
							?>
							<div class="product-item-button-container">
								<a class="btn btn-default <?=$buttonSizeClass?>" href="<?=$item['DETAIL_PAGE_URL']?>">
									<?=$arParams['MESS_BTN_DETAIL']?>
								</a>
							</div>
							<?
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
