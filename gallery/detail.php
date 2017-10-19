<?
define('HEADER_SUB_CLASS', 'header-dark header-min');
define('CONTENT_SUB_CLASS', 'no-full section');
define('FOOTER_SUB_CLASS', 'hide-line footer-dark to-fixed');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");
?>

<?$APPLICATION->IncludeComponent("bitrix:news.detail","gallery_item",Array(
        "IBLOCK_ID"=>11,
        "IBLOCK_TYPE"=>"main",
        "ELEMENT_CODE"=>$_REQUEST['CODE'],
        "PROPERTY_CODE"=>Array('PHOTOS'),
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
