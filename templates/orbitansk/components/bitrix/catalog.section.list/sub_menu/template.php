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
$countSub = false;
?>

	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult["SECTIONS"] as $arSection)
	{
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if ($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"]) {
		echo "\n", str_repeat("\t", $arSection["DEPTH_LEVEL"] - $TOP_DEPTH), "";
	} elseif ($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"]) {
		echo "</li>"; //sub
	} else {
		while ($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"] AND $CURRENT_DEPTH == 2) {
			echo "</li>";
			echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), "", "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH - 1);
			$CURRENT_DEPTH--;
		}
		echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), $CURRENT_DEPTH . "-" . $arSection["DEPTH_LEVEL"] . "</li>"; //delete
	}

	$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(" . $arSection["ELEMENT_CNT"] . ")" : "";


	if ($_REQUEST['SECTION_ID'] == $arSection['ID']) {
		$link = '<b>' . $arSection["NAME"] . $count . '</b>';
		$strTitle = $arSection["NAME"];
	} else {
		$link = '<a class="catalog-top__sub-menu_link" href="' . $arSection["SECTION_PAGE_URL"] . '">' . $arSection["NAME"] . $count . '</a>';
	}

	echo "\n", str_repeat("\t", $arSection["DEPTH_LEVEL"] - $TOP_DEPTH);
	if ($arSection["DEPTH_LEVEL"]==2){
	?>

		<li class="catalog-top__sub-menu_list" id="<?= $this->GetEditAreaId($arSection['ID']); ?>"><?= $link ?>
			<?
			$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
			}else {
				if($countSub){
					echo "</ul></nav></div>";
				}
				$countSub=true;
				echo '<div class="catalog-top__sub-menu ';
				echo $arSection[CODE];
 				echo '" data-sub="menu"><nav class="catalog-top__sub"><ul class="catalog-top__sub-lists list_coll">';
			}

			while ($CURRENT_DEPTH > $TOP_DEPTH) {
				echo "</li>";
				echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), "", "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH - 1);
				$CURRENT_DEPTH--;
			}
			} ?>

<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>
