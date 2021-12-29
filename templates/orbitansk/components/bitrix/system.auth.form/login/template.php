<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>



<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
    ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?if($arResult["FORM_TYPE"] == "login"):?>
<div class="">
                <div class="top-line__login" id="login" data-toggle="modal" data-target="#loginModal">
                    <svg class="icons icon-log-in">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#log-in"></use>
                    </svg>
Войти
</div>
<div class="top-line__registration" id="registration">
    <svg class="icons icon-user">
        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#user"></use>
    </svg>
    <a style="color:#fff" href="<?=$arResult["REGISTER_URL"]?>">Регистрация</a></div>
</div>
    <? else:
    ?>

    <form action="<?=$arResult["AUTH_URL"]?>">
        <div class="top-line__login">
            <svg class="icons icon-log-in">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#log-in"></use>
            </svg><input type="submit" class="link" name="logout_butt" value="Выйти" />
        </div>
        <div class="top-line__registration">
            <svg class="icons icon-user">
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#user"></use>
            </svg>
            <a class="top-line__registration__profile" href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_LOGIN"]?></a>
            </div>
        <?foreach ($arResult["GET"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <input type="hidden" name="logout" value="yes" />
    </form>
<?endif?>


