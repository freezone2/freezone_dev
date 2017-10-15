<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(!isset($_POST['WEB_FORM_ID'])) die;

$web_form_id = (int)$_POST['WEB_FORM_ID'];

$APPLICATION->IncludeComponent("bitrix:form.result.new", "ajax", Array(
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "CACHE_TYPE" => "N",	// Тип кеширования
    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
    "COMPONENT_TEMPLATE" => "ajax",
    "EDIT_URL" => "",	// Страница редактирования результата
    "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
    "LIST_URL" => "",	// Страница со списком результатов
    "SEF_MODE" => "N",	// Включить поддержку ЧПУ
    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
    "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
    "VARIABLE_ALIASES" => array(
        "RESULT_ID" => "RESULT_ID",
        "WEB_FORM_ID" => "WEB_FORM_ID",
    ),
    "WEB_FORM_ID" => $web_form_id,	// ID веб-формы
),
                               false
);

exit;