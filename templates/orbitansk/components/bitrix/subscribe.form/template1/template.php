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
?>
<?
$frame = $this->createFrame("subscribe-form", false)->begin();
?>
	<form action="<?=$arResult["FORM_ACTION"]?>">
		<div><?=GetMessage("subscr_form_email_p")?></div>
		<input  class="form-control footer__input-email" type="text" name="sf_EMAIL" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>"  placeholder="<?=GetMessage("subscr_form_email_title")?>"/>
		<input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" class="btn btn-input-default btn-sm footer__input-btn" />
	</form>
<?
$frame->beginStub();
?>
	<form action="<?=$arResult["FORM_ACTION"]?>">
		<div><?=GetMessage("subscr_form_email_p")?></div>
<input type="text" name="sf_EMAIL" class="form-control footer__input-email" value="" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=GetMessage("subscr_form_email_title")?>"/>
<input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" class="btn btn-input-default btn-sm footer__input-btn" />
	</form>
<?
$frame->end();
?>

