<?
//define('HEADER_SUB_CLASS', 'h0 header-bg-gray');
//define('CONTENT_SUB_CLASS', 'no-full section');
//define('FOOTER_SUB_CLASS', 'hide-line to-fixed');
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка 404");
?>

<? $APPLICATION->IncludeComponent("bitrix:main.include", "page404", Array(
    "AREA_FILE_SHOW" => "file",    // Показывать включаемую область
    "PATH" => "/local/templates/main/include/404.php",    // Путь к файлу области
    "AREA_FILE_RECURSIVE" => "Y",
    "EDIT_TEMPLATE" => "",    // Шаблон области по умолчанию
),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
