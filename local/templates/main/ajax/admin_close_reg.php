<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

$APPLICATION->RestartBuffer();

if ($order_id) {
    
    $order = get_order($order_id);
    $timelength_block = $order['PROPERTY_TIMELENGTH_BLOCK_VALUE'];
    $date_start = $order['PROPERTY_DATE_START_VALUE'];
    $time_start = $order['PROPERTY_TIME_START_VALUE'];
    list($h,$m) = explode(':', $time_start);
    $orders_count = get_count_orders($h, $m, $date_start);
    $orders = get_orders($h, $m, $date_start);
    $c = 0;
    $count = $orders->SelectedRowsCount();
    while($order = $orders->GetNext()) {
        $c += (close_registration($order['ID']) ? 1 : 0);
    }

    echo json_encode(arraY('success'=>'true', 'closed'=>$c, 'count'=>$count));
    exit;
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;