<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>



<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
    ShowMessage($arResult['ERROR_MESSAGE']);
?>

<? if ($arResult["FORM_TYPE"] == "login"): ?>

    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
          action="<?= $arResult["AUTH_URL"] ?>">
        <div class="modal-body">
            <?
            if ($arResult["BACKURL"] <> ''): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?endif ?>
            <?
            foreach ($arResult["POST"] as $key => $value): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
            <?endforeach ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="AUTH"/>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="USER_LOGIN">Ваш логин:</label>
                        <input class="form-control" type="text" name="USER_LOGIN" value="" placeholder="Ваш логин"/>
                        <script>
                            BX.ready(function () {
                                var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                if (loginCookie) {
                                    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                    var loginInput = form.elements["USER_LOGIN"];
                                    loginInput.value = loginCookie;
                                }
                            });
                        </script>
                    </div>
                    <div class="form-group"><label for="USER_PASSWORD">Ваш пароль:</label>
                        <input class="form-control" type="password" name="USER_PASSWORD" autocomplete="off"/></div>
                    <?
                    if ($arResult["SECURE_AUTH"]): ?>
                        <noscript>
                            <p class="text-warning bx_auth_secure">
                                Пароль будет отправлен в открытом виде. Включите JavaScript в браузере, чтобы
                                зашифровать пароль перед отправкой.
                            </p>
                        </noscript>
                        <script type="text/javascript">
                            document.getElementById('bx_auth_secure').style.display = 'inline-block';
                        </script>
                    <?endif ?>
                    <?
                    if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                        <ul class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
                            <li><input id="USER_REMEMBER" name="USER_REMEMBER" type="checkbox" value="Y">
                                <label for="USER_REMEMBER">Запомнить пароль</label></li>
                        </ul>


                    <?endif ?>
                    <?
                    if ($arResult["CAPTCHA_CODE"]): ?>
                        Введите слово на картинке:
                        <input type="hidden" name="captcha_sid" value="<?
                        echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                        echo $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>
                        <input type="text" name="captcha_word" value=""/>

                    <?endif ?>
                </div>
                <div class="col-sm-6"><?
                    if ($arResult["AUTH_SERVICES"]): ?>
                        <div class="bx-auth-lbl">Войти через</div>
                        <hr>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
                            array(
                                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                                "SUFFIX" => "form",
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                        ?>
                    <?endif ?></div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" name="Login" class="btn btn-primary" value="Войти"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            <a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>"
               rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a>
        </div>
    </form>

    <?
    if ($arResult["AUTH_SERVICES"]): ?>
        <?
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
            array(
                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                "AUTH_URL" => $arResult["AUTH_URL"],
                "POST" => $arResult["POST"],
                "POPUP" => "Y",
                "SUFFIX" => "form",
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );
        ?>
    <?endif ?>

    <?
elseif ($arResult["FORM_TYPE"] == "otp"):
    ?>

    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
          action="<?= $arResult["AUTH_URL"] ?>">
        <?
        if ($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <?endif ?>
        <input type="hidden" name="AUTH_FORM" value="Y"/>
        <input type="hidden" name="TYPE" value="OTP"/>
        <table width="95%">


            <?
            echo GetMessage("auth_form_comp_otp") ?>
            <input type="text" name="USER_OTP" value="" autocomplete="off" placeholder="Ваш логин"/>

            <?
            if ($arResult["CAPTCHA_CODE"]):?>


                <?
                echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:
                <input type="hidden" name="captcha_sid" value="<?
                echo $arResult["CAPTCHA_CODE"] ?>"/>
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                echo $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>
                <input type="text" name="captcha_word" value=""/>

            <?endif ?>
            <?
            if ($arResult["REMEMBER_OTP"] == "Y"):?>

                <input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y"/>
                <label for="OTP_REMEMBER_frm">Забыли пароль?</label>

            <?endif ?>

            <input type="submit" name="Login" value="Войти"/>
            <a href="<?= $arResult["AUTH_LOGIN_URL"] ?>" rel="nofollow">Авторизация</a>


    </form>

    <?
else:
    ?>

    <form action="<?= $arResult["AUTH_URL"] ?>">


        <?= $arResult["USER_NAME"] ?>
        [<?= $arResult["USER_LOGIN"] ?>]
        <a href="<?= $arResult["PROFILE_URL"] ?>" title="<?= GetMessage("AUTH_PROFILE") ?>">Мой профиль</a>


        <? foreach ($arResult["GET"] as $key => $value):?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
        <? endforeach ?>
        <input type="hidden" name="logout" value="yes"/>
        <input type="submit" name="logout_butt" value="Выйти"/>


    </form>
<? endif ?>


