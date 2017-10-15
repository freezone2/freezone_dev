<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Web\Json;
use Bitrix\Main\Mail\Event;

if(!check_bitrix_sessid()) die();

$iblockId = "61";
CModule::IncludeModule("iblock");
$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblockId, "ACTIVE" => "Y"), false, false, array());
$num_req = intval($res->SelectedRowsCount());

$el = new CIBlockElement;
$info = "";
$arProps = array();
$arProps["114"] = htmlspecialcharsbx($_REQUEST["comp_last_name"]);
$info .= "Фамилия: ".$arProps["114"]."<br>";
$arProps["115"] = htmlspecialcharsbx($_REQUEST["comp_name"]);
$info .= "Имя: ".$arProps["115"]."<br>";
$arProps["116"] = htmlspecialcharsbx($_REQUEST["comp_date_birth"]);
$info .= "Дата рождения: ".$arProps["116"]."<br>";
$arProps["117"] = htmlspecialcharsbx($_REQUEST["comp_country"]);
$info .= "Страна: ".$arProps["117"]."<br>";
$arProps["118"] = htmlspecialcharsbx($_REQUEST["comp_city"]);
$info .= "Город: ".$arProps["118"]."<br>";
$types = array();
if(!empty($_REQUEST["type_object"])) {
    if(!is_array($_REQUEST["type_object"])) {
        $types[] = htmlspecialcharsbx($_REQUEST["type_object"]);
    }
    else{
        foreach ($_REQUEST["type_object"] as $itemType) {
            $types[] = htmlspecialcharsbx($itemType);
        }
    }
}
$arProps["119"] = $types;
$info .= "Дисциплины: ".implode(", ", $types)."<br>";

$types_name = array();
if(!empty($_REQUEST["type_value_add"])) {
    $ii=0;
    $info .= "Названия команд: <br>";
    foreach ($_REQUEST["type_value_add"] as $key=>$itemType) {
        $description = base64_decode(htmlspecialcharsbx($key));
        $types_name["n".$ii] = Array(
            "VALUE" => htmlspecialcharsbx($itemType),
            "DESCRIPTION" => $description
        );
        $info .= "&nbsp;&nbsp;".$description.": ".htmlspecialcharsbx($itemType)."<br>";
        $ii++;
    }
    unset($ii);
}
$arProps["120"] = $types_name;

$arProps["121"] = htmlspecialcharsbx($_REQUEST["comp_phone"]);
$info .= "Телефон: ".$arProps["121"]."<br>";
$arProps["122"] = htmlspecialcharsbx($_REQUEST["comp_email"]);
$info .= "E-mail: ".$arProps["122"]."<br>";

$id_comp_fspr = "";
if($_REQUEST["comp_fspr"])
{
    $ar_res = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => 62,
            "ACTIVE" => "Y",
            "NAME" => htmlspecialcharsbx($_REQUEST["comp_fspr"])
        ),
        false,
        false,
        array("ID")
    );
    if ($arRes = $ar_res->GetNext())
    {
        $id_comp_fspr = $arRes["ID"];
    }
}
$arProps["123"] = $id_comp_fspr;
$info .= "Номер членской карты ФПСР: ".$arProps["123"]."<br>";
$arProps["124"] = htmlspecialcharsbx($_REQUEST["comp_size_shirt"]);
$info .= "Размер футболки: ".$arProps["124"]."<br>";

$arLoadProductArray = Array(
    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
    "IBLOCK_ID"      => $iblockId,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => "Заявка №".($num_req+1),
    "ACTIVE"         => "Y",
);

$new_add = false;

//writeToFile($arLoadProductArray, "log_form_1.txt");
if($elementId = $el->Add($arLoadProductArray)){
    $new_add = $elementId;
}

if($new_add) {
    $arrFieldsReq["INFO"] = $info;
    $arrFieldsReq["EMAIL_TO"] = $arProps["122"];
    Event::send(array(
                    "EVENT_NAME" => "NEW_REGISTER_PAGE",
                    "LID" => "s1",
                    "C_FIELDS" => $arrFieldsReq,
                ));
    unset($arProps);
    unset($arLoadProductArray);
    unset($arrFieldsReq);
}

$output = array("id" => $new_add);

echo Json::encode($output);