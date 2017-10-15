<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;
\Bitrix\Main\Loader::includeModule('iblock');

$oid = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

if ($oid) {
    $order = get_order($oid);
    if (!empty($order['ID'])) {
        if ($order['PROPERTY_USER_VALUE'] == $USER->GetID()) {

            $ruser = $USER->GetByID($order['PROPERTY_USER_VALUE']);
            $user = $ruser->Fetch();

            $arEventFields = array(
                "ORDER_ID" => $oid,
                "FIO" => $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'],
                "PHONE" => $user['MOBILE_PHONE'],
                "EMAIL" => $user['EMAIL'],
                "DATE" => date('d.m.Y H:i'),
                "ORDER_DATE" => $order['PROPERTY_DATE_START_VALUE'],
                "ORDER_TIME" => $order['PROPERTY_TIME_START_VALUE'],

            );
            if (CEvent::Send("ORDER_MOVE", SITE_ID, $arEventFields)) {
                echo json_encode(array('success'=>true));
                exit;
            } else {
                $message = 'Ошибка отправки уведомления';
            }
        } else {
            $message = 'Ошибка. Доступ к чужому заказу запрещен';
        }
    } else {
        $message = 'Ошибка передачи данных';
    }
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;