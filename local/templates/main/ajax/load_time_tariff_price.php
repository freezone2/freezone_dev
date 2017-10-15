<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');


if ($_POST['personal_type'] == PERSONE_TYPE_PROF) {

    if ($_POST['type'] == TYPE_F_ONE) {
        $IBLOCK_ID = 55;
    } else {
        $IBLOCK_ID = 49;
    }

    $TARIFF = intval($_POST['time_tariff']);

    $timeblock_tariff = get_timeblock_tariff($TARIFF, $IBLOCK_ID);

    if ($_POST['is_night'] == 1) {
        $price = $timeblock_tariff['PROPERTY_PRICE_NIGHT_VALUE'];
    } else {
        $price = $timeblock_tariff['PROPERTY_PRICE_VALUE'];
    }
} else if ($_POST['personal_type'] == PERSONE_TYPE_USER) {
    $IBLOCK_ID = 42;
    $TARIFF = intval($_POST['time_tariff']);

    $timeblock_tariff = get_timeblock_tariff($TARIFF, $IBLOCK_ID);

    if ($_POST['is_night'] == 1) {
        $price = $timeblock_tariff['PROPERTY_PRICE_NIGHT_VALUE'];
    } else {
        $price = $timeblock_tariff['CATALOG_PRICE_1'];
    }
} else {
    echo json_encode(array('error'=>true, 'message'=>'Ошибка указания типа человека :))'));
    exit;
}

echo json_encode(array('success' => true, 'price' => $price));
exit;