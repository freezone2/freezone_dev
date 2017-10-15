<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

$message = 'Ошибка активации';

$params = array(
    'CODE' => trim($_POST['code']),
);

if ($CERT = get_certificate($params)) {

    // send event mail
	/*
    $arEventFields = array(
        'PRICE' => $CERT['PRICE'],
        'TARIFF_NAME' => $CERT['TARIFF_NAME'],
        'COUNT_PERSONS' => $CERT['TARIFF_MANS'],
        'EMAIL' => $CERT['EMAIL'],
        'PHONE' => $CERT['PHONE'],
        'FIO' => $CERT['FIO'],
    );

    CEvent::Send("CERT_ACTIVATE", SITE_ID, $arEventFields);
	*/
    echo json_encode(array(
        'success' => true,
        'tariff' => $CERT['TARIFF'],
        'truba' => $CERT['TRUBA'],
        'price' => $CERT['PRICE'],
        'hash' => $CERT['HASH'],
        'tariff_name' => $CERT['TARIFF_NAME'],
        'tariff_mans' => $CERT['TARIFF_MANS'],
    ));
    exit;
    
} else {
    $message = 'Сертификат не обнаружен';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;