<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

$APPLICATION->RestartBuffer();

if ($order_id) {
    $order = get_order($order_id);
    if (CIBlockElement::delete($order['ID'])) {
        echo json_encode(arraY('success' => 'true'));
        exit;
    } else {
        $message = 'Ошибка удаления';
    }
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;