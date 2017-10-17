<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$search = array('Не заполнены следующие обязательные поля: ');
$replace = array('The following required fields are missing: ');

$search[] = "Ваше имя";
$search[] = "Телефон";
$search[] = "Категория номера";
$search[] = "Дата заезда";
$search[] = "Дата отъезда";
$search[] = "Количество гостей";
$search[] = "Желаемая дата";
$search[] = "Желаемое время";

$replace[] = 'Your name';
$replace[] = 'Phone';
$replace[] = 'Room category';
$replace[] = 'Date from';
$replace[] = 'Date to';
$replace[] = "Guests count";
$replace[] = 'Date';
$replace[] = 'Time';

$arResult["FORM_ERRORS_TEXT"] = str_replace($search, $replace, $arResult["FORM_ERRORS_TEXT"]);
echo json_encode($arResult);