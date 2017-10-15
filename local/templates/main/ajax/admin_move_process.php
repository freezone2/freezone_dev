<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;
$date = !empty($_POST['date']) ? ($_POST['date']) : 0;
$time = !empty($_POST['time']) ? ($_POST['time']) : 0;

$APPLICATION->RestartBuffer();

if ($order_id && $date && $time) {

    $moved = 0;
    $count = 0;
    $order = get_order($order_id);
    $ids = array();
    if (!empty($order['ID'])) {
        $count = 1;
        $ids[] = $order['ID'];
    }

//    $timelength_block = $order['PROPERTY_TIMELENGTH_BLOCK_VALUE'];
//    $date_start = $order['PROPERTY_DATE_START_VALUE'];
//    $time_start = $order['PROPERTY_TIME_START_VALUE'];
//    list($h, $m) = explode(':', $time_start);
//    $orders = get_orders($h, $m, $date_start);
//    $moved = 0;
//    $count = $orders->SelectedRowsCount();
//    $ids = array();
//    while ($order = $orders->GetNext()) {
        if (update_order_datetime($order['ID'], $date, $time)) {
            $moved++;
            $oids[] = $order['ID'];
        }
//    }
    
    echo json_encode(arraY('success'=>'true', 'moved'=>$moved, 'count'=>$count, 'date'=>$date, 'time'=>$time, 'oids'=>$ids));
    exit;
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;