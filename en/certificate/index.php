<?
define('HEADER_SUB_CLASS', 'header header-certificate to-fixed h0');
define('CONTENT_SUB_CLASS', 'certificate-full');
define('FOOTER_SUB_CLASS', 'footer-right footer-certificate footer-hide-info');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Certs");
$APPLICATION->AddHeadScript('/local/templates/main/custom_js/certificate.js');

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

    <section id="section-certificate" class="section section-certificate">
        <div class="slide slide-order has-drop">
            <div class="order-step-1 order-step active">
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "catalog_list_jumps_in_certificates", Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"AJAX_MODE" => "N",	// Включить режим AJAX
					"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
					"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
					"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
					"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
					"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
					"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
					"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
					"DISPLAY_DATE" => "Y",	// Выводить дату элемента
					"DISPLAY_NAME" => "Y",	// Выводить название элемента
					"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
					"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
					"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
					"FIELD_CODE" => array(	// Поля
						0 => "catalog_PRICE_1",
						1 => "",
					),
					"FILTER_NAME" => "",	// Фильтр
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
					"IBLOCK_ID" => "42",	// Код информационного блока
					"IBLOCK_TYPE" => "main",	// Тип информационного блока (используется только для проверки)
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
					"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
					"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
					"NEWS_COUNT" => "90",	// Количество новостей на странице
					"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
					"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
					"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
					"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
					"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
					"PAGER_TITLE" => "Новости",	// Название категорий
					"PARENT_SECTION" => "",	// ID раздела
					"PARENT_SECTION_CODE" => "",	// Код раздела
					"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
					"PROPERTY_CODE" => array(	// Свойства
						0 => "MANS",
						1 => "FLIGHTS",
						2 => "JUMPS",
						3 => "catalog_PRICE_1",
					),
					"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
					"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
					"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
					"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
					"SET_STATUS_404" => "N",	// Устанавливать статус 404
					"SET_TITLE" => "N",	// Устанавливать заголовок страницы
					"SHOW_404" => "N",	// Показ специальной страницы
					"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
					"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
					"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
					"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
					),
					false
				);?>

                <? $APPLICATION->IncludeComponent("bitrix:news.list", "faq_flights", Array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "main",
                        "IBLOCK_ID" => "45",
                        "NEWS_COUNT" => "1111",
                        "SORT_BY1" => "ID",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => Array(),
                        "PROPERTY_CODE" => Array(),
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
            </div>



            <div class="order-step-3 order-step">
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
                        <div class="order">
                            <div class="order-in">
                                <form action="" id="form_params_cert" method="post">
                                    <input type="hidden" id="f_TARIFF_create" name="TARIFF" value="">

                                    <p class="number-men" id="tariff_mans_in_window_create">1 mans</p>
                                    <p class="title" id="tariff_name_in_window_create"></p>
                                    <div class="order-form">
                                        <div class="form-item">
                                            <input type="text" name="name" placeholder="<?=Loc::GetMessage('FORM_FIELD_NAME');?>"/>
                                        </div>
                                        <div class="form-item">
                                            <input type="text" name="email" placeholder="E-mail"/>
                                        </div>
                                        <div class="form-item">
                                            <input type="text" name="phone" class="tel" placeholder="<?=Loc::GetMessage('FORM_FIELD_PHONE');?>"/>
                                        </div>
                                        <div class="form-item">
                                            <div class="checkbox">
                                                <label for="agree">
                                                    <input type="checkbox" id="agree" name="agree" checked/>
                                                    <span></span>
                                                    <span><?=Loc::GetMessage('AGREE_TEXT_1');?> <a href="<?=CFile::GetPath(COption::GetOptionString( "askaron.settings", "UF_CERT_RULES_FILE" ));?>" target="_blank"><?=Loc::GetMessage('AGREE_TEXT_2');?></a> <?=Loc::GetMessage('AGREE_TEXT_3');?></span>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="order-certificate-btn btn-red button"><?=Loc::GetMessage('PAY_BUTTON');?> <span id="result_price_create">0.–</span></button>
                                    </div>
                                </form>
                            </div>
                            <a target="_blank" href="#"><i class="icon-file"></i><?=Loc::GetMessage('DOWNLOAD_ANK_BUTTON');?></a>
                            <a target="_blank" href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?>payinfo/"><?=Loc::GetMessage('RULES_PAY');?></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        $LEFT = get_data_from_iblock(59, 442);
        $RIGHT = get_data_from_iblock(59, 443);
        ?>
        <style>
            .section-certificate .big-btn-prev:hover {
                background: #1a88d6 url(<?=CFile::GetPath($LEFT['PREVIEW_PICTURE']);?>) no-repeat center center !important;
            }
            .section-certificate .big-btn-next:hover {
                background: #1a88d6 url(<?=CFile::GetPath($RIGHT['PREVIEW_PICTURE']);?>) no-repeat center center !important;
            }
        </style>

        <div class="slide active">
            <div class="big-btn big-btn-prev">
                <div class="site-wrapper">
                    <div class="site-wrapper-in"><?=$LEFT['NAME'];?></div>
                </div>
            </div>
            <div class="big-btn big-btn-next">
                <div class="site-wrapper">
                    <div class="site-wrapper-in"><?=$RIGHT['NAME'];?></div>
                </div>
            </div>
        </div>



        <div class="slide slide-activate">
            <div class="order-step-1 order-step active">
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
                        <div class="activate-form">
                            <p><?=Loc::GetMessage('CERT_ACTIVATE_TITLE');?></p>
                            <form action="" id="cert_form" method="post">
                                <div class="form-item">
                                    <input type="text" name="code" placeholder="<?=Loc::GetMessage('CERT_NUM');?>"/>
                                </div>
                                <button class="activate-cert-btn button btn-red"><?=Loc::GetMessage('BTN_SEND');?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-step-2 order-step">
                <div class="order-time-top">
                    <span><?=Loc::GetMessage('MONTH');?>:</span>
                    <p><i class="icon-calendar"></i> <span></span></p>
                </div>
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
                        <div id="loading" style="display: none"><?=Loc::GetMessage('LOADING');?></div>
                        <div class="order-user order-time-in no-popup" id="calendar" style="display: none">
                            <a href="#" onclick="init_calendar(); return false"><?=Loc::GetMessage('REFRESH_BUTTON');?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-step-3 order-step">
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
                        <div class="order">
                            <div class="order-in">

                                <script>
                                    var current_person_type = '<?=PERSONE_TYPE_USER;?>';
                                </script>

                                <form action="" id="form_params" method="post">
                                    <input type="hidden" id="f_TYPE" name="TYPE" value="<?=TYPE_F_CUSTOM;?>">
                                    <input type="hidden" id="f_CATEGORY" name="CATEGORY" value="<?=CATEGORY_F_BY_TARIFF;?>">
                                    <input type="hidden" id="f_TARIFF" name="TARIFF" value="0">
                                    <input type="hidden" id="f_TRUBA" name="TRUBA" value="<?=TRUBA_12;?>">
                                    <input type="hidden" id="f_ORDER_DAY" name="ORDER_DAY" value="">
                                    <input type="hidden" id="f_ORDER_TIME" name="ORDER_TIME" value="">
                                    <input type="hidden" id="f_TIMELENGTH" name="TIMELENGTH" value="15">
                                    <input type="hidden" id="f_TIMELENGTH_BLOCK" name="TIMELENGTH_BLOCK" value="2.5">
                                    <input type="hidden" id="f_TRAINER_CATEGORY" name="TRAINER_CATEGORY" value="0">
                                    <input type="hidden" id="f_PERSONE_TYPE" name="PERSONE_TYPE" value="<?=PERSONE_TYPE_USER;?>">
                                    <input type="hidden" id="f_PRICE" name="PRICE" value="0">
                                    <input type="hidden" id="f_PRICE_RESULT" name="PRICE_RESULT" value="0">
                                    <input type="hidden" id="f_CERT_HASH" name="CERT_HASH" value="">
                                    <input type="hidden" id="f_SOURCE" name="SOURCE" value="Страница сертификата (EN)">

                                    <p class="number-men" id="tariff_mans_in_window"></p>
                                    <p class="title" id="tariff_name_in_window"></p>
                                    <div class="order-form">
                                        <div class="form-item">
                                            <input type="text" name="name" placeholder="<?=Loc::GetMessage('FORM_FIELD_NAME');?>"/></div>
                                        <div class="form-item">
                                            <input type="text" name="email" placeholder="E-mail"/></div>
                                        <div class="form-item">
                                            <input type="text" name="phone" class="tel" placeholder="<?=Loc::GetMessage('FORM_FIELD_PHONE');?>"/></div>
                                        <div class="form-item">
                                            <div class="checkbox">
                                                <label for="agree">
                                                    <input type="checkbox" name="agree" id="agree" checked/> <span></span> <span><?=Loc::GetMessage('AGREE_TEXT_1');?> <a
                                                            href="<?=CFile::GetPAth(COption::GetOptionString( "askaron.settings", "UF_RULES_FILE" ));?>"><?=Loc::GetMessage('AGREE_TEXT_2');?></a> <?=Loc::GetMessage('AGREE_TEXT_3');?></span> </label>
                                            </div>
                                        </div>
                                        <button class="open-thank-order btn-red button"><?=Loc::GetMessage('BTN_ACTIVATE');?>
                                            <span id="result_price" style="display: none">0.–</span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <a target="_blank" href="<?=CFile::GetPAth(COption::GetOptionString( "askaron.settings", "UF_ANKETA_FILE" ));?>"><i class="icon-file"></i><?=Loc::GetMessage('DOWNLOAD_ANK_BUTTON');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section"></section>

    <div class="popup">
        <div class="popup-date">
            <div class="popup-date-in">
                !!!TODO555!!! Подтверждаете заказ полёта<span class="date-in">12 апреля в 12:30?</span>
                <div class="popup-btn-group">
                    <button class="btn-white button done-popup">Да</button>
                    <button class="btn-white button close-popup">Нет</button>
                </div>
            </div>
            <p>вы можете отменить бронь по телефону +7 (495) 18-000-18</p>
        </div>

        <div class="popup-thank">
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                    <p>!!!TODO666!!! Заказ принят</p>
                    <span>Вся необходимая информация<br /> отправлена вам на почту</span>
                </div>
            </div>

        </div>
        <div class="overlay"></div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>