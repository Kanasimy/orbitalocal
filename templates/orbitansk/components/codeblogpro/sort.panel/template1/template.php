<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
?>
<select class="selectpicker" id="sortSelect">
<?
if (!empty($arResult['SORT']['PROPERTIES'])) { ?>

    <option value="#" disabled><?= Loc::getMessage('CODEBLOGPRO_SORT_PANEL_COMPONENT_TEMPALTE_NO_SORT') ?></option>
    <? foreach ($arResult['SORT']['PROPERTIES'] as $property) { ?>
        <? if ($property['ACTIVE']) { ?>
            <option value="<?= $property['URL']; ?>" selected><?= $property['NAME']?>
                <?
            /**
             * Show sorting direction
             */
            if ($property['CODE'] != 'rand') {
                if (strpos($property['ORDER'], 'asc') !== false) {
                    echo  'по убыванию';
                }
                elseif (strpos($property['ORDER'], 'desc') !== false) {
                    echo  'по возрастанию';
                }
            }
            ?></option>
            <option value="<?= $property['URL']; ?>"><?= $property['NAME']?>
                <?
                /**
                 * Show sorting new direction
                 */
                if ($property['CODE'] != 'rand') {
                    if (strpos($property['ORDER'], 'desc') !== false) {
                        echo  'по убыванию';
                    }
                    elseif (strpos($property['ORDER'], 'asc') !== false) {
                        echo  'по возрастанию';
                    }
                }
                ?></option>

        <? } else { ?>
            <option value="<?= $property['URL']; ?>"><?= $property['NAME'] ?></option>
        <? }
    }
} ?>
</select>

