<?
define('HEADER_SUB_CLASS', 'header-orders to-fixed h0');
define('CONTENT_SUB_CLASS', 'certificate-full');
define('FOOTER_SUB_CLASS', 'footer-left footer-certificate footer-hide-info');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказ");

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);


?>


    <section class="section"></section>

    <section id="section-orders" class="section section-orders active">
        <div id="left" class="slide slide-order has-drop">
            <div class="order-step-1 order-step active">
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "catalog_list_jumps_in_orders_slide1", Array(
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
							0 => "CATALOG_PRICE_1",
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
							3 => "CATALOG_PRICE_1",
                            4=>"TRUBA",
						),
						"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
						"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
						"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
						"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
						"SET_STATUS_404" => "N",	// Устанавливать статус 404
						"SET_TITLE" => "N",	// Устанавливать заголовок страницы
						"SHOW_404" => "N",	// Показ специальной страницы
						"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
						"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
						"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
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
            <div class="order-step-2 order-step">
                <div class="order-time-top">
                    <div class="news-date">
                        <?global $months_rus1;?>
                        <span><?=Loc::GetMessage('MONTH');?>:</span>
                        <p><i class="icon-calendar"></i> <span><?=$months_rus1[(int)date('m')];?></span></p>
                        <div class="choice-date">
                            <i class="icon-close-select"></i>
                            <div class="center">
                                <select>
                                    <?for($i=date('Y')-2;$i<=date('Y');$i++) {?>
                                        <option <?=(date('Y') == $i ? 'selected' : '');?>
                                            value="<?=$i;?>"><?=$i;?></option>
                                    <?}?>
                                </select>
                                <div class="mounts-list">
                                    <ul>
                                        <?
                                        foreach($months_rus1 as $key => $m){?>
                                            <li <?=($key == intval(date('m')) ? 'class="active"' : '');?>><?=$m;?></li>
                                        <?}?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="has-scroll h100">
                    <div class="has-scroll-wrap">
                        <div class="site-wrapper">
                            <div class="site-wrapper-in">
                                <div id="loading" style="display: none"><?=Loc::GetMessage('LOADING');?></div>
                                <div class="order-user order-time-in no-popup" id="calendar" style="display: none">
                                    <a href="#" onclick="init_calendar(); return false"><?=Loc::GetMessage('REFRESH_BUTTON');?></a>
                                </div>

                                <script>
                                    $('.cart-list .index-service-item').each(function(){
                                        var block = $(this);
                                        var button = block.find('.get_tariff');
                                        var tariff = block.data('tariff');

                                        button.off('click').unbind('click').on('click', function(){
                                            $('#f_TARIFF').val(tariff);
                                            var tariff_name = block.find('p.title').html().replace('<br>', '').replace('<br/>','');
                                            $('#tariff_name_in_window').html(tariff_name);

                                            var result_price = block.data('price');

                                            $('#result_price').html(result_price+'.-');
                                            $('#f_PRICE').val(result_price);
                                            $('#f_PRICE_RESULT').val(result_price);

                                            $('#fstep2 p').html(tariff_name);

                                            init_calendar();
                                        })
                                    });

                                    $('#truba_selector li').on('click', function(){
                                        var li = $(this);
                                        var truba = li.data('truba');
                                        $('#f_TRUBA').val(truba);
                                    });
                                </script>

                                <?if(isset($_GET['t'])){?>
                                    <script>
                                        setTimeout(function () {
                                            var t = '<?=intval($_GET['t']);?>';
                                            $('.index-service-item[data-tariff="'+t+'"]').each(function(){
                                                var block = $(this);
                                                var button = block.find('.get_tariff');
                                                var tariff = block.data('tariff');

                                                button.click();

                                                $('#f_TARIFF').val(tariff);
                                                var tariff_name = block.find('p.title').html().replace('<br>', '').replace('<br/>','');
                                                $('#tariff_name_in_window').html(tariff_name);

                                                var result_price = block.data('price');

                                                $('#result_price').html(result_price+'.-');
                                                $('#f_PRICE').val(result_price);
                                                $('#f_PRICE_RESULT').val(result_price);

                                                init_calendar();
                                            });

                                        }, 500);
                                    </script>
                                <?}?>
                            </div>
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
                                    var current_person_type = <?=PERSONE_TYPE_USER;?>;
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
                                    <input type="hidden" id="f_SOURCE" name="SOURCE" value="Страница заказов (EN)">

                                    <p class="number-men">1 человек</p>
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
                                        <button class="open-thank-order btn-red button"><?=Loc::GetMessage('PAY_BUTTON');?> <span id="result_price">1800.–</span></button>
                                    </div>

                                </form>
                            </div>
                            <a target="_blank" href="/payinfo/"><?=Loc::GetMessage('RULES_PAY');?></a>
                            <a target="_blank" href="<?=CFile::GetPAth(COption::GetOptionString( "askaron.settings", "UF_ANKETA_FILE" ));?>"><i class="icon-file"></i><?=Loc::GetMessage('DOWNLOAD_ANK_BUTTON');?></a></div>
                    </div>
                </div>
            </div>
        </div>



        <div id="secondSlide" class="slide active">
            <div class="big-btn big-btn-prev">
                <div class="site-wrapper">
                    <div class="site-wrapper-in"> <?=Loc::GetMessage("ORDER_VAR1_TITLE"); ?>
                        <p><?=Loc::GetMessage("ORDER_VAR1_TEXT"); ?></p>
                    </div>
                </div>
            </div>
            <div class="big-btn big-btn-next">
                <div class="site-wrapper">
                    <div class="site-wrapper-in"> <?=Loc::GetMessage("ORDER_VAR2_TITLE"); ?>
                        <p><?=Loc::GetMessage("ORDER_VAR2_TEXT"); ?></p>
                    </div>
                </div>
            </div>
            <a class="big-btn" href="/certificate/">
                <div class="site-wrapper">
                    <div class="site-wrapper-in"> <?=Loc::GetMessage("ORDER_VAR3_TITLE"); ?>
                        <p><?=Loc::GetMessage("ORDER_VAR3_TEXT"); ?></p>
                    </div>
                </div>
            </a>
        </div>






        <div id="right" class="slide slide-sportsmen">
            <div class="order-step-1 order-step active">
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
                        <div class="order">
                            <div class="order-in">
                                <p class="title"><?=Loc::GetMessage('ORDER_TO_FLIGHT');?></p>
                                <div class="order-form">

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:form",
                                        "order_professionals",
                                        Array(
                                            "AJAX_MODE" => "Y",
                                            "AJAX_OPTION_ADDITIONAL" => "",
                                            "AJAX_OPTION_HISTORY" => "N",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "Y",
                                            "CACHE_TIME" => "3600",
                                            "CACHE_TYPE" => "N",
                                            "CHAIN_ITEM_LINK" => "",
                                            "CHAIN_ITEM_TEXT" => "",
                                            "EDIT_ADDITIONAL" => "N",
                                            "EDIT_STATUS" => "Y",
                                            "IGNORE_CUSTOM_TEMPLATE" => "N",
                                            "NOT_SHOW_FILTER" => array(0=>"",1=>"",),
                                            "NOT_SHOW_TABLE" => array(0=>"",1=>"",),
                                            "RESULT_ID" => $_REQUEST[RESULT_ID],
                                            "SEF_MODE" => "N",
                                            "SHOW_ADDITIONAL" => "N",
                                            "SHOW_ANSWER_VALUE" => "N",
                                            "SHOW_EDIT_PAGE" => "N",
                                            "SHOW_LIST_PAGE" => "Y",
                                            "SHOW_STATUS" => "Y",
                                            "SHOW_VIEW_PAGE" => "N",
                                            "START_PAGE" => "new",
                                            "SUCCESS_URL" => "",
                                            "USE_EXTENDED_ERRORS" => "N",
                                            "VARIABLE_ALIASES" => array("action"=>"action",),
                                            "WEB_FORM_ID" => "3"
                                        )
                                    );?>                                    

                                </div>
                            </div>
                            <a target="_blank" href="/payinfo/"><?=Loc::GetMessage('RULES_PAY');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section"></section>


    <div class="popup">
        <div class="popup-date">
            <div class="popup-date-in">TODO123!!! Подтверждаете заказ полёта<span class="date-in">12 апреля в 12:30?</span>
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
                    <p>TODO456!!! Заказ принят</p> <span>Вся необходимая информация<br/> отправлена вам на почту</span></div>
            </div>
        </div>
        <div class="overlay"></div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>