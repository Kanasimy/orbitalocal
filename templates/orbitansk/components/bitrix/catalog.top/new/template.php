<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2 class="blue">Новинки</h2>
<div class="row popular">
    <div class="owl-carousel owl-carousel-popular">
<!--FIXME-->
    <!--Убрать количество товаров в строку, не используется, TD_WIDTH, LINE_ELEMENT_COUNT-->
	<?foreach($arResult["ROWS"] as $arItems):?>

		<?foreach($arItems as $arElement):?>
		<?if(is_array($arElement) && is_array($arElement["DETAIL_PICTURE"])):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
		?>
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="popular__item" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <div class="popular__icon popular__icon-blue">
                    <span class="popular__new">new</span>
                </div>
					<?if(is_array($arElement["DETAIL_PICTURE"])):?>
                            <img class="popular__image" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" width="100%"  loading="lazy"/>
					<?endif?>

                    <div class="popular__header">
						<?=$arElement["NAME"]?>
					</div>

                <?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):?>
                        <?foreach($arElement["OFFERS"] as $arOffer):?>
                            <?foreach($arParams["OFFERS_FIELD_CODE"] as $field_code):?>
                                <?echo GetMessage("IBLOCK_FIELD_".$field_code)?>:&nbsp;<?
                                    echo $arOffer[$field_code];?><br />
                            <?endforeach;?>
                            <?foreach($arOffer["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                                <?=$arProperty["NAME"]?>:&nbsp;<?
                                    if(is_array($arProperty["DISPLAY_VALUE"]))
                                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                    else
                                        echo $arProperty["DISPLAY_VALUE"];?><br />
                            <?endforeach?>
                            <?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
                                <?if($arPrice["CAN_ACCESS"]):?>
                                    <?=$arResult["PRICES"][$code]["TITLE"];?>++++:&nbsp;
                                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                            <?=$arPrice["PRINT_VALUE"]?><?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                        <?else:?>
                                            <?=$arPrice["PRINT_VALUE"]?>
                                        <?endif?>

                                <?endif;?>
                            <?endforeach;?>

                            <?if($arParams["DISPLAY_COMPARE"]):?>
                                <a href="<?echo $arOffer["COMPARE_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;
                            <?endif?>
                            <?if($arOffer["CAN_BUY"]):?>
                                <?if($arParams["USE_PRODUCT_QUANTITY"]):?>
                                    <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                                        <div><?echo GetMessage("CT_BCT_QUANTITY")?>:</div>
                                        <div>
                                            <input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
                                        </div>
                                        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                                        <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
                                        <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
                                        <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
                                    </form>
                                <?else:?>

                                        <a href="<?echo $arOffer["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
                                        &nbsp;<a href="<?echo $arOffer["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>

                                <?endif;?>
                            <?elseif(count($arResult["PRICES"]) > 0):?>
                                <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
                            <?endif?>

                        <?endforeach;?>
                <?else:?>
                    <?if($arElement["CAN_BUY"]):?>
                        <?if($arParams["USE_PRODUCT_QUANTITY"] || count($arElement["PRODUCT_PROPERTIES"])):?>
                            <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">

                                <?if($arParams["USE_PRODUCT_QUANTITY"]):?>
                                    <?echo GetMessage("CT_BCT_QUANTITY")?>:
                                    <input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
                                <?endif;?>
                                <?foreach($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
                                    <?echo $arElement["PROPERTIES"][$pid]["NAME"]?>:
                                    <?if(
                                        $arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
                                        && $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
                                    ):?>
                                        <?foreach($product_property["VALUES"] as $k => $v):?>
                                            <label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label>
                                        <?endforeach;?>
                                    <?else:?>
                                        <select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
                                            <?foreach($product_property["VALUES"] as $k => $v):?>
                                                <option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
                                            <?endforeach;?>
                                        </select>
                                    <?endif;?>


                                <?endforeach;?>

                                <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                                <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
                                <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
                                <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD")?>">
                            </form>
                        <?else:?>
                            <!--button  class="btn btn-default" type="submit" formaction="<?echo $arElement["BUY_URL"]?>">
                                <?echo GetMessage("CATALOG_BUY")?>
                                <?
                                $productID=$arElement['ID'];
                                $renewal= 'N';
                                $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);

                            if (!$arPrice || count($arPrice) <= 0) {
                                if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, 1, $USER->GetUserGroupArray())) {
                                    $quantity = $nearestQuantity;
                                    $arPrice = CCatalogProduct::GetOptimalPrice($productID, 1, $USER->GetUserGroupArray(), $renewal);
                                }
                            }?>

                                <!--вывод цены-->

                                <!--span class="price">
                                | <? print_r($arPrice[RESULT_PRICE][DISCOUNT_PRICE])?> р
                                </span>

                                <?if(is_array($arElement["PRICE_MATRIX"])):?>
                                    <?if(count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
                                        <?=GetMessage("CATALOG_QUANTITY") ?>
                                    <?endif;?>
                                    <?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
                                        <?=$arType["NAME_LANG"] ?>
                                    <?endforeach?>
                                    <?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>

                                        <?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>

                                            <?if(IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
                                            elseif(IntVal($arQuantity["QUANTITY_FROM"]) > 0)
                                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
                                            elseif(IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                                echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
                                            ?>

                                        <?endif;?>
                                        <?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>

                                            <?if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"])
                                                echo FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]).' '.FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);
                                            else
                                                echo FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);
                                            ?>

                                        <?endforeach?>

                                    <?endforeach?>
                                <?endif?>
                            </button-->
                        <?endif;?>
                    <?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
                        <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
                    <?endif?>
                <?endif;?>
			</a>
		<?endif;?>
		<?endforeach?>
	<?endforeach?>

</div>
</div>
