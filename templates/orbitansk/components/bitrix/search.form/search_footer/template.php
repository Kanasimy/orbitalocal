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
<form action="<?=$arResult["FORM_ACTION"]?>">
	<div>Поиск по сайту</div>
	<table>
		<tr>
			<td>
				<input class="form-control" type="text" name="q"  value="" placeholder="Поиск по сайту">
			</td>
			<td>
				<input type="submit" name="OK" value="искать" class="btn btn-input-default btn-sm footer__input-btn">
			</td>
		</tr>
	</table>
</form>


