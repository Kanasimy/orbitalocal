<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="windows-1251">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?$APPLICATION->ShowMeta("keywords")?>
	<?$APPLICATION->ShowMeta("description")?>
    <link rel="icon" href="../../favicon.ico">
    <title><?$APPLICATION->ShowTitle()?></title>
	<?
	$APPLICATION->ShowHead();
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/banner.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/main.css');
	$APPLICATION->SetAdditionalCSS('https://fonts.googleapis.com/css?family=Roboto:400,700|Ubuntu+Condensed');
	?>
    <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(47080869, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47080869" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</head>
<body>
<!--декор-->
<div class="elka"></div>
<?$APPLICATION->ShowPanel()?>
<?if($USER->IsAdmin()):?>
<?endif?>
<div class="container">
<header>
        <div class="row top-line">
        <div class="col-md-8 col-lg-9">
		<!--Contacts-->
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH."/include/top-line.php",
				"EDIT_TEMPLATE" => ""
			),
		false
		);?>
		<!--End Contacts-->
        </div>
        <div class="col-md-4 col-lg-3 top-line__log-form">
            <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","login",Array(
                    "REGISTER_URL" => "register.php",
                    "FORGOT_PASSWORD_URL" => "",
                    "PROFILE_URL" => "profile.php",
                    "SHOW_ERRORS" => "Y"
                )
            );?>
        </div>
        </div>
        <div class="row top-navigation">
            <div class="col-md-3">
                <a href="/">
                    <svg class="top-navigation__logo logo">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#logo"></use>
                </svg>
                </a>
            </div>
            <div class="col-md-6 col-sm-9">
      <?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	"search_header_catalog", 
	array(
		"USE_SUGGEST" => "Y",
		"PAGE" => "#SITE_DIR#catalog/search.php",
		"COMPONENT_TEMPLATE" => "search_header_catalog"
	),
	false
);?>
                <a id="top" name="top"></a>
            </div>
            <div class="col-md-3 col-sm-3">
                <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "short", Array(
	"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH_TO_AUTHORIZE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
                <!-- Toggle get grouped for better mobile display -->
                <button type="button" class="navbar-toggle collapsed top-navigation__navbar-toggle" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="sr-only">Μενώ</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "top"
	),
	false
);?>
            </div>
        </div>
    <?$dir=explode('/', $APPLICATION->GetCurDir());
    if(CSite::InDir('/index.php')){?>
    <!--Banner-->
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH."/include/banner.php",
            "EDIT_TEMPLATE" => ""
        ),
        false
    ); }?>
    <!--End Banner-->
</header>
<section class="content">
    <div class="row">
        <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"top", 
	array(
		"START_FROM" => "0",
		"PATH" => "/",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "top"
	),
	false
);?>
    </div>
    <div class="row">
            <?$dir=explode('/', $APPLICATION->GetCurDir());
            if($dir['1']!=='catalog' && $dir['1']!=='personal'){?>
            <div class="col-md-9">
            <?}
            else{ ?>
                <div class="col-md-12">
            <? }; ?>
                    <?if ($curPage != SITE_DIR."index.php"&&!CSite::InDir('/catalog/')):?>
                        <h1><?=$APPLICATION->ShowTitle(false);?></h1>
                    <?endif?>
