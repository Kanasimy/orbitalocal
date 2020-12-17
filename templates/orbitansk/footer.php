<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
</div>
<?$dir=explode('/', $APPLICATION->GetCurDir());
if($dir['1']!=='catalog'&& $dir['1']!=='personal'):?>
    <div class="col-md-3">
        <div class="sidebar row">
            <?if($APPLICATION->GetCurPage() == "/index.php"):?>
                <div class="news col-md-12 col-sm-6">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.line", 
	"news-right", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCKS" => array(
			0 => "3",
		),
		"NEWS_COUNT" => "3",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "PREVIEW_TEXT",
			3 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "/news/#SECTION_CODE#/#ELEMENT_CODE#/",
		"ACTIVE_DATE_FORMAT" => "d.m",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "news-right",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
                </div>

                <div class="col-md-12 col-sm-6">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/partners.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );?>
                </div>
            <?endif;?>
            <?
            if (!CSite::InDir('/index.php')){
                ?>
                <div class="additional-info col-md-12 col-sm-12">

                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH."/include/useful.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
                <div class="additional-info__map">
                    <img class="additional-info__img" src="<?=SITE_TEMPLATE_PATH?>/images/map.svg" alt="">
                </div>
                </div>
                <?
            }
            ?>

        </div>
    </div>
<?endif;?>
</div>
</section>
<a href="#top" class="icon-go-top"></a>

<section class="footer">
    <div class="row footer__wrapper">
        <div class="col-md-3 col-sm-6 footer__about">
            <h4 class="footer__header">О нас</h4>
            <nav>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
);?>
            </nav>
        </div>
        <div class="col-md-3 col-sm-6 footer__cabinet" >
            <h4 class="footer__header">Личный кабинет</h4>
            <nav>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom_2",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
);?>
            </nav>
        </div>
        <div class="col-md-3 col-sm-6 footer__contact">

            <div class="footer__phone">
                <svg class="icons icon-phone">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#phone"></use>
                </svg>
                <strong>(383) 363-73-14</strong>
            </div>
            <div class="footer__email">
                <svg class="icons icon-email">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#email"></use>
                </svg>
                <a href="mailto:info@orbitansc.ru"><strong>info@orbitansk.ru</strong></a>
            </div>
            <div class="footer__adress">Адрес: г. Новосибирск, Петухова,&nbsp;69Б<br />
                C 9<sup>00</sup> до 18<sup>00</sup>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 footer__logo">
            <a href="/">
                <svg class="top-navigation__logo logo">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/sprite.svg#logo_ng"></use>
                </svg>
            </a>

            <div class="footer__delivery xform-inline">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	"search_footer", 
	array(
		"USE_SUGGEST" => "Y",
		"PAGE" => "#SITE_DIR#search/index.php",
		"COMPONENT_TEMPLATE" => "search_footer"
	),
	false
);?></div>
        </div>
        <div class="col-md-9 col-sm-6 footer__info">
            <small >
                Информация, предоставленная на сайте, в том числе информация о цене товара, не является публичной офертой, определяемой положениями статьи 437 Гражданского Кодекса Российский Федерации. Для получения более подробной информации следует обращаться к менеджерам компании по указанным на сайте телефонам.
            </small>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="footer__counter">

            </div>
            <div class="footer__copyright">
                Copiright 2020
            </div>
        </div>
    </div>
</section>
<!--Scripts-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/main.min.js"></script>
</div>
<!-- Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title red" id="myModalLabel">Регистрация</h3>
            </div>
            <div class="modal-body">
                <?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	".default", 
	array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(
		),
		"SET_TITLE" => "N",
		"SHOW_FIELDS" => array(
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-primary">Регистрация</button>
            </div-->
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title red" id="myModalLabel">Войти</h3>
            </div>

                <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","modal",Array(
                        "REGISTER_URL" => "register.php",
                        "FORGOT_PASSWORD_URL" => "",
                        "PROFILE_URL" => "profile.php",
                        "SHOW_ERRORS" => "Y"
                    )
                );?>
        </div>
    </div>
</div>
<!-- End Modal -->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = '7iNCXC8Z5w';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>