<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//ini_set('display_errors',1);
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');

if ($_POST['PRICE_RESULT'] == 'NaN') {
    $_POST['PRICE_RESULT'] = $_POST['PRICE'];
}

if (!is_numeric($_POST['PRICE_RESULT'])) {
    die(json_encode(array('error' => true, 'message' => 'Ошибка цены заказа')));
}

$message = '';

$params = array(
    'TYPE' => $_POST['TYPE'],
    'CATEGORY' => $_POST['CATEGORY'],
    'TARIFF' => $_POST['TARIFF'],
    'TRUBA' => $_POST['TRUBA'],
    'ORDER_DAY' => $_POST['ORDER_DAY'],
    'ORDER_TIME' => $_POST['ORDER_TIME'],
    'TIMELENGTH' => $_POST['TIMELENGTH'],
    'TIMELENGTH_BLOCK' => $_POST['TIMELENGTH_BLOCK'],
    'TRAINER_CATEGORY' => $_POST['TRAINER_CATEGORY'],
    'PERSONE_TYPE' => $_POST['PERSONE_TYPE'],
    'PRICE' => $_POST['PRICE'],
    'PRICE_RESULT' => $_POST['PRICE_RESULT'],
    'SOURCE' => $_POST['SOURCE']
);

$params['EMAIL'] = $_POST['email'] ? $_POST['email'] : '';
$params['PHONE'] = $_POST['phone'] ? preg_replace('#\s#','',$_POST['phone']) : '';

if ($USER->isAuthorized()) {

    if (!$params['EMAIL']) {
        $params['EMAIL'] = $USER->GetEmail();
    }

    if (!$params['PHONE']) {
        $params['PHONE'] = getUserParam($USER->GetID(), 'PERSONAL_MOBILE');
    }
    
    if ($params['PERSONE_TYPE'] == PERSONE_TYPE_PROF) {
        // check balance
        if (!check_can_order($params['PRICE_RESULT'])) {
            echo json_encode(array('error' => true, 'message' => 'Нет доступных средств на балансе. Пожалуйста пополните баланс.'));
            exit;
        }
    }
}


if (!empty($_POST['CERT_HASH'])) {
    $res = CIBlockElement::GetList(
        false,
        array(
            'IBLOCK_ID' => 50,
            'ACTIVE' => 'Y',
            '!PROPERTY_USED' => CERTIFICATE_USED_YES,
            'PROPERTY_HASH' => $_POST['CERT_HASH']
        ), 0, 0, array('ID'));

    if ($res->SelectedRowsCount() == 1) {
        $CERT = $res->GetNext();
        $params['CERT'] = $CERT['ID'];
    }
}

$ORDER_ID = create_order($params, false);
if (is_numeric($ORDER_ID) && $ORDER_ID > 0) {

    // send event mail
    $arEventFields = get_event_params_by_order_id($ORDER_ID);
    if (!empty($_POST['email'])) {
        $arEventFields['EMAIL'] = $_POST['email'];
    }
   
    
    $response = array('success' => true, 'title'=>'Заказ оформлен', 'message'=>'Спасибо.', 'order_id' => $ORDER_ID);
    if (!empty($_POST['CERT_HASH'])) {
        $response['cert_activated'] = true;
        // send event mail
		//CEvent::Send("FLIGHT_ORDER_NEW", SITE_ID, $arEventFields);
		CEvent::Send("CERT_ACTIVATE", SITE_ID, $arEventFields);
        activate_certificate($_POST['CERT_HASH']);
		 
    } else {
		 // send event mail
		 CEvent::Send("FLIGHT_ORDER_NEW", SITE_ID, $arEventFields);
        if ($params['PERSONE_TYPE'] == PERSONE_TYPE_USER) {
            $response['content'] = generate_link_sber($ORDER_ID);
        }
    }
    echo json_encode($response);
    exit;
} else {
    list($error_flag, $message) = $ORDER_ID;
}

echo json_encode(array('error' => true, 'message' => $message));
exit;