<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "UF_INNER_TITLE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("CPT_BCSL_INNER_TITLE"),
        "TYPE" => "STRING",
    ),
    "UF_INNER_PAGE" => array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("CPT_BCSL_INNER_PARAM"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => 'N',
    ),
);

?>