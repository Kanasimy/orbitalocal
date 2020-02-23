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
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

    <div class="input-group catalog-nav__search">
        <input  id="filter_input" type="text" class="form-control" aria-label="..." value="<?=$_REQUEST['arrFilter_ff']['NAME']?><?=$_REQUEST['arrFilter_pf']['CML2_ARTICLE']?>">
        <div class="input-group-btn">
            <select id="filter_select"  class="selectpicker">
                <option value="arrFilter_pf[CML2_ARTICLE]">Поиск по коду</option>
                <option value="arrFilter_ff[NAME]">Поиск по названию</option>
            </select>
        </div><!-- /btn-group -->
        <span class="input-group-btn">
        <button name="set_filter" class="btn btn-input" type="submit">
            <svg class="catalog-nav__btn icons icon-search">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#search"></use>
            </svg>
        </button>
      </span>
    </div><!-- /input-group -->
    <input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
</form>
<script type="text/javascript">
   var select = document.getElementById('filter_select'),
       input = document.getElementById('filter_input');

   n = select.options.selectedIndex;
   valueSelect = select.options[n].value;
   input.setAttribute('name',valueSelect);

   select.onchange = function () {
       n = select.options.selectedIndex;
       valueSelect = select.options[n].value;
       input.setAttribute('name',valueSelect);
   };

</script>

