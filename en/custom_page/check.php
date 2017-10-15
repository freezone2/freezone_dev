<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Web\Json;

if(!$_REQUEST["test_fspr"]) die();

$res = "";
CModule::IncludeModule("iblock");
$ar_res = CIBlockElement::GetList(
    array(),
    array(
        "IBLOCK_ID" => 62,
        "ACTIVE" => "Y",
        "NAME" => htmlspecialcharsbx($_REQUEST["test_fspr"])
    ),
    false,
    false,
    array("ID")
);
if($arRes = $ar_res->GetNext()) {
    $res = $arRes["ID"];
}

$output = array("id" => $res);

echo Json::encode($output);