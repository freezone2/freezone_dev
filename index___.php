<?
//define('HEADER_SUB_CLASS', 'to-fixed h0');
define('CONTENT_SUB_CLASS', 'content-full');
//define('FOOTER_SUB_CLASS', 'to-fixed');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Полет в аэротрубе вместе с FreeZone");
$APPLICATION->SetPageProperty("description", "НАШ РЕЙТИНГ 5/5★ Закажите полет в аэротрубе в Москве от FreeZone. ❶ Большая аэродинамическая труба ❷ Сертификаты ❸ Низкие цены на полет в аэротрубе!");
$APPLICATION->SetPageProperty("title", "Полет в аэротрубе в Москве » Аэротруба FreeZone (аэродинамическая труба в Москве) ");
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
	<!--
	<a id="fp_next"></a>
	<a id="fp_prev"></a>
	-->
    <section class="section index-masthead<?if(NEW_DES == 1){?> index-masthead-new index-masthead-indexpage<?}?>">
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "main-slides", Array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "main",
                "IBLOCK_ID" => "19",
                "NEWS_COUNT" => "1111",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => Array(),
                "PROPERTY_CODE" => Array("BANNER_LINK"),
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

        <div class="masthead-btn-group">
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                    <a href="/air/#amateur" class="button btn-red">Любителям</a>
                    <a href="/sportrates/" class="button btn-blue">Профессионалам</a>
                </div>
            </div>
        </div>
    </section>

<?if(NEW_DES == 1){?>
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
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "UF_IN_MAIN_PAGE" => "Y",
    ),
                                     false
    );?>
    <section class="section text-section">
        <div class="section-wrap container">
            <h2>Парк развлечений FreeZone</h2>
            <p>Парк развлечений FreeZone  - это 2 гектара развлечений. Freezone – это две аэротрубы, полетная зона которых является одной из самых крупных в мире. Многие
                профессиональные спортсмены предпочитают тренироваться именно здесь. Приобретая подарочный сертификат на полет в аэротрубе в Москве для своих родных и
                близких, вы подарите им незабываемые ощущения и отличную тренировку</p>

            <p>В 2016 г. началось масштабное развитие Комплекса FREEZONE. Запуск гостиницы планируется в 2017 г.
                Кроме того, на территории комплекса располагается комфортабельная гостиница с 23 номерами различного класса, банкетный зал, кафе и ресторан, VR-мир, канатный город.
                В нашем комплексе Вы можете провести мероприятия следующих видов: конференц зал, дет праздники, корпоративы, детская игровая.</p>

            <p>В 2016 году проведена реконструкция комплекса, благодаря которой на территории FREEZONE в<br>
                настоящее время работает бар, в котором открывается вид на полеты и имеется детская комната. <br>
                Открытие нового кафе ресторана планируется к лету 2017 г.
            </p>
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
    </section>
    <section class="section index-adv-list">
        <div class="section-wrap container">
            <h2>Наши преимущества</h2>
            <div class="container">
                <div class="row adv-list">
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/1.png" alt=""></span>
                        <span>Самая большая полетная зона в мире</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/2.png" alt=""></span>
                        <span>Проф.обучение и практика в дисциплинах парашютного и трубного спорта</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/3.png" alt=""></span>
                        <span>Две дроп зоны рядом</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/4.png" alt=""></span>
                        <span>5 зон для проведения треннингов, праздников, квестов с возможностью участия от 60 до 150 человек </span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/5.png" alt=""></span>
                        <span>Виртуальный квест и полигон</span>
                    </div>
                </div>
                <div class="row adv-list adv-list-sec">
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/6.png" alt=""></span>
                        <span>Семейный досуг на эко территории подмосковья  </span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/7.png" alt=""></span>
                        <span>Отель (скоро открытие)</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/8.png" alt=""></span>
                        <span>Экскурсионный транспорт</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/9.png" alt=""></span>
                        <span>Визовое сопровождение</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/10.png" alt=""></span>
                        <span>Уникальный тренерский состав</span>
                    </div>
                    <div class="adv-item">
                        <span class="image"><img src="/local/templates/main/images/advantage/11.png" alt=""></span>
                        <span>2 аэротрубы производства американской компании Skyventure </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?}else{?>
	<section class="section index-service-list has-drop tab">
		<div class="index-service-in">
			<div class="section-wrap">
			<h2 id="amateur" class="center">Выберите подходящий пакет</h2>
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "catalog_list_jumps", Array(
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
						0 => "",
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
						3 => "",
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
			</div>
		</div>
	</section>


<section class="section index-service-list">	
	<div class="section-wrap">
	
	<div class="slide slide-activate home-cert" id="main-cert-act">
	
	<h2 class="center">Купить полет в аэротрубе</h2>
	<p>
	Не знаете, чем порадовать себя или близких? Полет в аэротрубе FreeZone – яркий подарок для людей любого возраста. Ощущение свободного падения, незабываемые эмоции и впечатления не смогут оставить равнодушным ни детей, ни взрослых. Самая большая полетная зона в мире даст возможность в полной мере насладиться отсутствием гравитации. Опытные инструктора делают полет в аэротрубе совершенно безопасным и доступным для детей от 4х лет. Яркие фотографии и видео Вашего полета оставят память об этом событии на всю жизнь.
	</p>
	<h4>
	FreeZone – место, где люди летают
	</h4>
	
            <div class="order-step-1 order-step active">
                <div class="site-wrapper">
                    <div class="site-wrapper-in">
						
						<a href="/certificate/?order=true" id="home-cert-order">Заказать сертификат</a>
						<!--
                        <div class="activate-form">
                            <form action="" id="cert_form" method="post">
                                <div class="form-item">
                                    <input type="text" name="code" placeholder="Введите номер сертификата"/>
									<button class="activate-cert-btn button btn-red">Активировать</button>
                                </div>
                               
                            </form>
                        </div>
						-->
                    </div>
                </div>
            </div>
            <div class="order-step-2 order-step">
                <div class="order-time-top">
                    <span>Месяц:</span>
                    <p><i class="icon-calendar"></i> <span></span></p>
                </div>
               <div class="has-scroll h100">
                    <div class="has-scroll-wrap">
                        <div class="site-wrapper">
                            <div class="site-wrapper-in">
                                <div id="loading" style="display: none">Загрузка...</div>
                                <div class="order-user order-time-in no-popup" id="calendar" style="display: none">
                                    <a href="#" onclick="init_calendar(); return false">Обновить</a>
                                </div>
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
							<? $APPLICATION->AddHeadScript('/local/templates/main/custom_js/certificate.js'); ?>
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
                                    <input type="hidden" id="f_SOURCE" name="SOURCE" value="Страница сертификата">


                                    <p class="number-men" id="tariff_mans_in_window">xxx</p>
                                    <p class="title" id="tariff_name_in_window">xxx</p>
                                    <div class="order-form">
                                        <div class="form-item">
                                            <input type="text" name="name" placeholder="Имя, отчество"/></div>
                                        <div class="form-item">
                                            <input type="text" name="email" placeholder="E-mail"/></div>
                                        <div class="form-item">
                                            <input type="text" name="phone" class="tel" placeholder="Телефон"/></div>
                                        <div class="form-item">
                                            <div class="checkbox">
                                                <label for="agree">
                                                    <input type="checkbox" name="agree" id="agree" checked/> <span></span> <span>Я согласен с <a
                                                            href="<?=CFile::GetPAth(COption::GetOptionString( "askaron.settings", "UF_RULES_FILE" ));?>">правилами</a> посещения</span> </label>
                                            </div>
                                        </div>
                                        <button class="open-thank-order btn-red button">Активировать
                                            <span id="result_price" style="display: none">0.–</span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <a target="_blank" href="<?=CFile::GetPAth(COption::GetOptionString( "askaron.settings", "UF_ANKETA_FILE" ));?>"><i class="icon-file"></i>Скачать анкету</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
		
	<div id="advantage-main-block">
		<h2>Наши преимущества</h2>
		<div id="adv-1">
		<span>Самая большая полетная зона в восточной Европе</span>
		</div>
		<div id="adv-2">
		<span>Проф.обучение и практика в дисциплинах парашютного и трубного спорта</span>
		</div>
		<div id="adv-3">
		<span>2 дроп зоны рядом</span>
		</div>
		<div id="adv-4">
		<span>5 зон для проведения треннингов, праздников, квестов с возможностью участия от 60 до 150 человек </span>
		</div>
		<div id="adv-5">
		<span>Виртуальный квест и полигон</span>
		</div>
		<div id="adv-6">
		<span>Семейный досуг на эко территории подмосковья  </span>
		</div>
		<div id="adv-7">
		<span>Отель (скоро открытие)</span>
		</div>
		<div id="adv-8">
		<span>Экскурсионный транспорт</span>
		</div>
		<div id="adv-9">
		<span>Визовое сопровождение</span>
		</div>
		<div id="adv-10">
		<span>Уникальный тренерский состав</span>
		</div>
		<div id="adv-11">
		<span>2 аэротрубы производства американской компании Skyventure </span>
		</div>
	</div>
	
	
	</div>
</section>


<? /* $APPLICATION->IncludeComponent("bitrix:news.list", "main-blocks", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "main",
        "IBLOCK_ID" => "20",
        "NEWS_COUNT" => "1111",
        "SORT_BY1" => "ID",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array("DETAIL_PICTURE"),
        "PROPERTY_CODE" => Array( "IMAGE1_CLASS", "IMAGE2_CLASS", "IMAGE_POS", "VIDEO", "VIDEO_TYPE"),
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
); */ ?>

 <?}?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>