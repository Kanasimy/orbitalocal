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

$strTitle = "";
?>
	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult["SECTIONS"] as $arSection)
	{
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
	{
		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"";
	}
	elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
	{
		echo "</div></div>";
	}
	else
	{
		while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
		{
			echo "</div></div>";
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
			$CURRENT_DEPTH--;
		}
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</div></div>";
	}

	$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

	if ($_REQUEST['SECTION_ID']==$arSection['ID'])
	{
		$link = $arSection["NAME"].$count;
		$strTitle = $arSection["NAME"];
	}
	else
	{
		$link = $arSection["NAME"].$count;
	}

	echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
	?><div class="col-md-4 col-sm-6">
			<div class="catalog-top__item" id="<?=$arSection["CODE"]?>">
				<svg class="icon-catalog icon-<?=$arSection["CODE"]?>">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#<?=$arSection["CODE"]?>"></use>
				</svg>
		<h4 class="catalog-top__header"><?=$link?><?

		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		}

		while($CURRENT_DEPTH > $TOP_DEPTH)
		{
			echo "</div></div>";
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
			$CURRENT_DEPTH--;
		}
		?>

<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
