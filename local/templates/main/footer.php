<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
$curPage = $APPLICATION->GetCurPage(false);
$isMain = false;
if($curPage == "/") {
    $isMain = true;
}

$is_personal = preg_match('#/personal/#simu', $APPLICATION->GetCurDir());

if (!preg_match('#/cabinet/#simu', $APPLICATION->GetCurDir())){?>
    <?if(NEW_DES == 1){?>
        <?$APPLICATION->ShowViewContent('elems_list_wrap_foot');?>
        <?$APPLICATION->ShowViewContent('elems_list');?>
    <?}?>
    </div>

    <?
    $show_calendar_footer = false;
    if (preg_match('#^/personal/order/#', $APPLICATION->GetCurDir())) {
        $show_calendar_footer = true;
    }?>
    
	
	<? if ((!preg_match('/contacts/', $APPLICATION->GetCurDir())) and  (!preg_match('/personal/', $APPLICATION->GetCurDir()))) { ?>
        <?if(NEW_DES == 1){?>
            <?if($isMain){?>
                <section class="section index-address">
                    <div class="section-wrap">
                        <h2><?=(LANGUAGE_ID == 'en' ? 'Contacts' : 'Контакты');?></h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-xs-4 item-contact">
                                    <div class="item-img"><img src="<?=SITE_TEMPLATE_PATH?>/images/main_page/contact_icon_1.png" alt=""></div>
                                    <div class="item-note item-addr"><?=(LANGUAGE_ID == 'en' ? COption::GetOptionString( "askaron.settings", "UF_CONT_ADDR_EN" ) : COption::GetOptionString( "askaron.settings", "UF_CONT_ADDR" ));?></div>
                                </div>
                                <div class="col-md-4 col-xs-4 item-contact">
                                    <div class="item-img"><img src="<?=SITE_TEMPLATE_PATH?>/images/main_page/contact_icon_2.png" alt=""></div>
                                    <div class="item-note item-tel"><?= COption::GetOptionString( "askaron.settings", "UF_PHONE" ); ?></div>
                                </div>
                                <div class="col-md-4 col-xs-4 item-contact">
                                    <div class="item-img"><img src="<?=SITE_TEMPLATE_PATH?>/images/main_page/contact_icon_3.png" alt=""></div>
                                    <div class="item-note item-link"><a href="mailto:info@freezone.ru">info@freezone.ru</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section index-map">
                    <div id="map" data-latitude="55.237340" data-longitude="37.525507"></div>
                </section>
            <?}?>
            
            <?if($isMain){?>
                <section class="section">
                    <div class="section-wrap"><br><br><br>
                        <h2><?=(LANGUAGE_ID == 'en' ? 'Reviews' : 'Отзывы');?></h2>
                        <div class="container">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviews", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "78",
		"IBLOCK_TYPE" => "reviess",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "AUTHOIR",
			1 => "TEXT",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "reviews"
	),
	false
);?><br>
                            </div>
                        </div>
                    </div>
                </section>
            <?}?>

            <?if($isMain){?>
                <section class="section list-soc">
                    <div class="section-wrap">
                        <h2><?=Loc::GetMessage('FOOTER_SOC')?></h2>
                        <div class="container">
                            <div class="row about-social">
                                <div class="col-md-3 col-6 item-soc">
                                    <a target="_blank" class="icon-vk" href="<?echo COption::GetOptionString( "askaron.settings", "UF_VK_LINK" );?>">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/vk-a.png" alt="">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/vk-a-a.png" alt="">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 item-soc">
                                    <a target="_blank" class="icon-fb" href="<?echo COption::GetOptionString( "askaron.settings", "UF_FB_LINK" );?>">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/fb-a.png" alt="">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/fb-a-a.png" alt="">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 item-soc">
                                    <a target="_blank" class="icon-yt" href="<?echo COption::GetOptionString( "askaron.settings", "UF_YT_LINK" );?>">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/yt-a.png" alt="">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/yt-a-a.png" alt="">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 item-soc">
                                    <a target="_blank" class="icon-inst" href="<?echo COption::GetOptionString( "askaron.settings", "UF_INST_LINK" );?>">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/inst-a.png" alt="">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/inst-a-a.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?}?>
        <?}else{?>
	
	 <section class="section index-address">
	  <div class="section-wrap">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
			<h2><?=(LANGUAGE_ID == 'en' ? 'Contacts' : 'Контакты');?></h2>
                <a target="_blank" href="<?=COption::GetOptionString( "askaron.settings", "UF_LINK_TO_MAP" );?>">
                    <img src="/local/templates/main/images/index-map.png" alt=""/>
                    <p><?=(LANGUAGE_ID == 'en' ? COption::GetOptionString( "askaron.settings", "UF_CONT_ADDR_EN" ) : COption::GetOptionString( "askaron.settings", "UF_CONT_ADDR" ));?></p>
                    <span><?= COption::GetOptionString( "askaron.settings", "UF_PHONE" ); ?></span>
                </a>
				<div class="ta_widget">
					<div id="TA_certificateOfExcellence660" class="TA_certificateOfExcellence">
					<ul id="7M0YzHruQP" class="TA_links fPA5p4vW">
					<li id="yi3aS4w105JZ" class="EW1Dfkaxwt">
					<a target="_blank" href="https://www.tripadvisor.ru/Attraction_Review-g12833615-d7034200-Reviews-FREEZONE_Aerodynamic_Complex-Sharapovo_Chekhovsky_District_Moscow_Oblast_Centra.html"><img src="https://www.tripadvisor.ru/img/cdsi/img2/awards/CoE2017_WidgetAsset-14348-2.png" alt="TripAdvisor" class="widCOEImg" id="CDSWIDCOELOGO"/></a>
					</li>
					</ul>
					</div>
				</div>
            </div>
        </div>
	  </div>
    </section>
	
	<? $APPLICATION->IncludeComponent("bitrix:news.list", "about-partners", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "",
        "IBLOCK_ID" => "9",
        "NEWS_COUNT" => "1111",
        "SORT_BY1" => "ID",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array(),
        "PROPERTY_CODE" => Array("PHOTOS"),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    )
	); ?>


        <?}?>
    <footer class="calendar_footer footer footer-order footer-hide-info" <?=($show_calendar_footer ? '' : 'style="display: none"');?>>
        <article class="wrapper">
            <a class="open-more-info-footer" href="#"><i class="icon-arr-drop"></i><span><?=Loc::getMessage("FOOTER_MORE");?></span></a>
            <ul class="footer-info">
                <li data-url="/orders/" id="fstep1">
                    <p>&nbsp;</p>
                    <span>1. <?=Loc::getMessage("FOOTER_TAB_CATEGORY");?></span>
                </li>
                <li class="active" id="fstep2">
                    <p>&nbsp;</p>
                    <span>2. <?=Loc::getMessage("FOOTER_TAB_LERN_TYPE");?></span>
                </li>
                <li id="fstep3">
                    <p>&nbsp;</p>
                    <span>3. <?=Loc::getMessage("FOOTER_TAB_TIMELENGHT");?></span>
                </li>
                <li id="fstep4">
                    <p>&nbsp;</p>
                    <span>4. <?=Loc::getMessage("FOOTER_TAB_DATESTART");?></span>
                </li>
                <li  id="fstep5">
                    <p>&nbsp;</p>
                    <span>5. <?=Loc::getMessage("FOOTER_TAB_ORDER");?></span>
                </li>
            </ul>
            <a href="#" class="made"></a>
        </article>
    </footer>

    <? } ?>
    <?if(NEW_DES == 2){?>
	<footer class="normal_footer footer <?=(defined('ERROR_404') ? 'hide-line' : '');?> <?=(defined('FOOTER_SUB_CLASS') ? FOOTER_SUB_CLASS : '');?>">
        <article class="wrapper">
            <a href="#" class="footer-callback"><i class="icon-arr-up"></i> <span><?=Loc::getMessage("FOOTER_FEEDBACK");?></span></a>
            <?if ($is_personal) {?>
              <a href="/team/"><?=Loc::getMessage("FOOTER_OUR_COMMAND");?></a>
            <?} else {?>
                <?if (LANGUAGE_ID == 'ru') {?>
                    <a href="/en/" class="#">english version</a>
                <?}else{?>
                    <a href="/" class="#">русская версия</a>
                <?}?>
            <?}?>
            <a class="made" target="_blank" href="<?echo COption::GetOptionString( "askaron.settings", "UF_DEVELOPER_LINK" );?>"></a>
			<a class="regulations" href="#" target="_blank"><?=(LANGUAGE_ID == 'en' ? 'Terms of Use' : 'Правила пользования сайтом');?></a>
			<a class="copyright" href="/">FREEZONE <?= date("Y"); ?></a> 
			</div>
        </article>
        <div class="vertical-line"></div>
    </footer>
    <?}?>
    <?if (preg_match('#/certificate/#', $APPLICATION->GetCurDir())) {?>
    <footer class="footer footer-left footer-certificate footer-hide-info">
        <article class="wrapper">
            <a class="open-more-info-footer" href="#"><i class="icon-arr-drop"></i><span><?=Loc::getMessage("FOOTER_MORE");?></span></a>
            <ul class="footer-info">
                <li class="fstep1">
                    <p><?=Loc::getMessage("FOOTER_TAB_ORDER");?></p>
                    <span>1. <?=Loc::getMessage("FOOTER_TAB_CATEGORY");?></span>
                </li>
                <li class="fstep2 active">
                    <p>&nbsp;</p>
                    <span>2. <?=Loc::getMessage("FOOTER_TAB_PACKAGE");?></span>
                </li>
                <li class="fstep3">
                    <p><?=Loc::getMessage("FOOTER_TAB_ORDER_HINT");?></p>
                    <span>3. <?=Loc::getMessage("FOOTER_TAB_ORDER");?></span>
                </li>
            </ul>
            <a href="#" class="made"></a>
        </article>
    </footer>

    <footer class="footer footer-right footer-certificate footer-hide-info">
        <article class="wrapper">
            <a class="open-more-info-footer" href="#"><i class="icon-arr-drop"></i><span><?=Loc::getMessage("FOOTER_MORE");?></span></a>
            <ul class="footer-info">
                <li>
                    <p>&nbsp;</p> <!-- Начальный -->
                    <span>1. <?=Loc::getMessage("FOOTER_TAB_CATEGORY");?></span>
                </li>
                <li class="active">
                    <p>&nbsp;</p> <!-- Активация -->
                    <span>2. <?=Loc::getMessage("FOOTER_TAB_ACTIVATE");?></span>
                </li>
                <li>
                    <p></p>
                    <span>3. <?=Loc::getMessage("FOOTER_TAB_DATESTART");?></span>
                </li>
            </ul>
            <a href="#" class="made"></a>
        </article>
    </footer>
    <?}?>

    <?if(NEW_DES == 1 && !$is_personal && !$isMain && LANGUAGE_ID=="ru"){?>
        <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", Array(
            "VIEW_MODE" => "TEXT",	// Вид списка подразделов
            "SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
            "IBLOCK_TYPE" => "",	// Тип инфоблока
            "IBLOCK_ID" => MAIN_SECTIONS,	// Инфоблок
            "SECTION_ID" => "",	// ID раздела
            "SECTION_CODE" => "",	// Код раздела
            "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
            "COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
            "TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
            "SECTION_FIELDS" => "",	// Поля разделов
            "SECTION_USER_FIELDS" => array("UF_INNER_TEXT"),	// Свойства разделов
            "ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа,
            "UF_INNER_PAGE" => "Y",
            "UF_INNER_TITLE" => "Инфраструктура парка",
        ),
                                         false
        );?>
    <?}?>
    <?if(NEW_DES == 1){?>
        <footer class="footer-menu<?=(defined('ERROR_404') ? ' hide-line' : '');?>">
            <div class="section-wrap container">
                <div class="row">
                    <!--noindex-->
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "bottom1",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                           0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "bottom1",	// Тип меню для первого уровня
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                                                     false
                    );?>
                    <!--/noindex-->
                    <div class="col-md-3 col-5 item-foot-menu">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom2", Array(
                            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "bottom2",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                               0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "bottom2",	// Тип меню для первого уровня
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                                                         false
                        );?>
                        <p class="footer-tel"><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p>
                        <p class="footer-addr"><?=Loc::getMessage("FOOTER_TEXT");?></p>
                        <p><a href="<?=(LANGUAGE_ID == 'en' ? "/en/contacts/" : "/contacts/")?>"><?=Loc::getMessage("FOOTER_MAP");?></a></p>
                    </div>
                </div>
            </div>
        </footer>

        <footer class="footer-line-bottom<?=(defined('ERROR_404') ? ' hide-line' : '');?>">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?= date("Y"); ?><?=Loc::getMessage("FOOTER_COPYRIGHT");?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?=(LANGUAGE_ID == 'en' ? "/en/privacy-policy/" : "/politika-konfidentsialnosti/")?>"><u><?=Loc::getMessage("RRIVACY_POLICY");?></u></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?=(LANGUAGE_ID == 'en' ? "/en/sitemap/" : "/sitemap/")?>"><?=Loc::getMessage("FOOTER_SITEMAP");?></a></p>
                    </div>
                    <div class="col-6 ">
                        <span class="float-md-right"><?=Loc::getMessage("FOOTER_CREATE");?></span>
                    </div>
                </div>
            </div>
        </footer>
    <?}?>
    <div class="feedback">
        <?$APPLICATION->IncludeComponent("bitrix:form", "feedback", Array(
            "AJAX_MODE" => "Y",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "CACHE_TYPE" => "N",	// Тип кеширования
            "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
            "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
            "EDIT_ADDITIONAL" => "N",	// Выводить на редактирование дополнительные поля
            "EDIT_STATUS" => "Y",	// Выводить форму смены статуса
            "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
            "NOT_SHOW_FILTER" => array(	// Коды полей, которые нельзя показывать в фильтре
                0 => "",
                1 => "",
            ),
            "NOT_SHOW_TABLE" => array(	// Коды полей, которые нельзя показывать в таблице
                0 => "",
                1 => "",
            ),
            "RESULT_ID" => $_REQUEST[RESULT_ID],	// ID результата
            "SEF_MODE" => "N",	// Включить поддержку ЧПУ
            "SHOW_ADDITIONAL" => "Y",	// Показать дополнительные поля веб-формы
            "SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
            "SHOW_EDIT_PAGE" => "Y",	// Показывать страницу редактирования результата
            "SHOW_LIST_PAGE" => "Y",	// Показывать страницу со списком результатов
            "SHOW_STATUS" => "Y",	// Показать текущий статус результата
            "SHOW_VIEW_PAGE" => "Y",	// Показывать страницу просмотра результата
            "START_PAGE" => "new",	// Начальная страница
            "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
            "USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
            "VARIABLE_ALIASES" => array(
                "action" => "action",
            ),
            "WEB_FORM_ID" => "1",	// ID веб-формы
        ),
            false
        );?>
    </div>



    <div class="cabinet-popup">
        <div class="cabinet-cancel">
            <p><?=Loc::getMessage("CABINET_POPUP_CANCEL_FLIGHT");?></p>
            <button class="button btn-white btn-done"><?=Loc::getMessage("CABINET_POPUP_ACTON_YES");?></button>
            <button class="button btn-white btn-not"><?=Loc::getMessage("CABINET_POPUP_ACTON_NO");?> </button>
        </div>
        <div class="cabinet-move">
            <p><?=Loc::getMessage("CABINET_POPUP_MOVE_FLIGHT");?></p>
            <button class="button btn-white btn-done"><?=Loc::getMessage("CABINET_POPUP_ACTON_YES");?></button>
            <button class="button btn-white btn-not"><?=Loc::getMessage("CABINET_POPUP_ACTON_NO");?> </button>
        </div>

        <div class="cabinet-categories" id="caregory_content">

        </div>
        <div class="popup-team">
            <div class="popup-team-in" id="team_content">

            </div>
        </div>
        <div class="overlay"></div>
    </div>
    
    <div class="scroll_top">
        <img src="/local/templates/main/images/top.png">
    </div>
    <style type="text/css">
        .scroll_top {
            position:fixed;
            bottom:30px;
            right:30px;
            z-index:10000;
            opacity:0.8;
            cursor:pointer;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('scroll',function(event){
                scroll = Math.round($(this).scrollTop());
                if (scroll > 100){
                    $('.scroll_top').show();
                }
                else{
                    $('.scroll_top').hide();
                }
            });
            $('.scroll_top').on('click',function(){
                if (scroll > 10){
                    $('html, body').animate({scrollTop: 0}, 800);
                }
            });
        });
    </script>

<?}?>
<?if(NEW_DES == 1){?><?}?>

<?if(NEW_DES == 1){?><?$APPLICATION->ShowViewContent('form_request');?><?}?>

<script src="/local/templates/main/js/libs/jquery-1.9.1.min.js"></script>
<script src="/local/templates/main/js/libs/scrolloverflow.min.js"></script>
<script src="/local/templates/main/js/libs/jquery.fullPage.min.js"></script>

<link rel="stylesheet" href="/local/templates/main/js/fancybox/jquery.fancybox.min.css">
<script src="/local/templates/main/js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="/local/templates/main/js/fancybox/jquery.fancybox-thumbs.js" type="text/javascript"></script>
<script type="text/javascript">$(".slider").fancybox({helpers:{overlay:{locked:false},thumbs: true}});</script>

<script src="/local/templates/main/js/libs/jquery.flexslider-min.js"></script>
<script src="/local/templates/main/js/libs/maskedInput.js"></script>
<script src="/local/templates/main/js/libs/select2.min.js"></script>
<script src="/local/templates/main/js/libs/datepiker.js"></script>
<script type="text/javascript" src="/local/templates/main/js/libs/moment.min.js"></script>
<script type="text/javascript" src="/local/templates/main/js/libs/jquery.daterangepicker.min.js"></script>
<?if(NEW_DES == 1){?>
    <script src="/local/templates/main/js/new_script.min.js"></script>
<?}else{?>
<script src="/local/templates/main/js/script.min.js"></script>
<?}?>
<script src="/local/templates/main/custom_js/calendar.min.js" type="text/javascript"></script>
<!--<script src="/local/templates/main/js/libs/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>-->
<script src="/local/templates/main/js/libs/jquery-ui-1.12.1.min.js" type="text/javascript"></script>
<script src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=660&amp;locationId=7034200&amp;lang=ru&amp;year=2017&amp;display_version=2"></script>
<?if(NEW_DES == 1){?>
    <?if($isMain){?>
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <?}?>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/libs/popper.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/libs/bootstrap.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/library.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/custom.min.js"></script>
<?}?>

<script>
$(".fl-hint").tooltip();
$( function() {
	$("#tabs").tabs();
} );
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter41005179 = new Ya.Metrika({
                    id:41005179,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/41005179" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87696945-1', 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-102736-9RCgu';</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1431626816896121'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1431626816896121&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

<?if(!empty($_REQUEST['payment']) && $_REQUEST['payment'] == 'complete'){?>
    <script type="text/javascript">
        openThanskFeedback('Оплата произведена', 'Денежные средства зачислены на ваш счет', true, '/personal/');
    </script>
<?}?>

<?if(!empty($_REQUEST['payment']) && $_REQUEST['payment'] == 'success'){?>
    <script type="text/javascript">
        openThanskFeedback('Заказ полета', 'Спасибо. Ваш заказ оформлен. Ожидайте, с Вами свяжется один из наших менеджеров. *Чтобы закрыть это окно нажмите в любом месте.', false, false);
    </script>
<?}?>

<?if(!empty($_REQUEST['cert']) && $_REQUEST['cert'] == 'success'){?>
    <script type="text/javascript">
        openThanskFeedback('Покупка сертификата', 'Спасибо. Данные по сертификату отправлены вам на E-mail', true, '/certificate/');
    </script>
<?}?>
<style type="text/css">
    .page_headers {
    	position:absolute;
    	left:-100000px;
    	top:-10000px;
    }
</style>
<div class="page_headers">
    <h1 itemprop="name"><?=$APPLICATION->Showtitle();?></h1>
    <div itemprop="description"><?=$APPLICATION->GetDescription("description");?></div>
</div>
</body>
</html>