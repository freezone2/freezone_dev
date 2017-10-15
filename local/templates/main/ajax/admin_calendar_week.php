<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');


if (!empty($_POST['date']) && preg_match('#^\d+.\d+.\d+$#sim', $_POST['date'])) {

    $length = intval($_POST['length']);

    $current = strtotime($_POST['date']);
    $type_and_category = $_POST['type_and_category'];
    $type = $category = null;
    if ($type_and_category) {
        list($type, $category) = explode(';', $type_and_category);
    }

    $params = array(
        'truba' => $_POST['truba'],
        'person' => $_POST['person'],
        'type' => $type,
        'category' => $category,
        'length' => $length,
    );

    $content = build_week($current, $params);

    if ($length == 7) {
        $from_time = get_date_start_week(date('Y-m-d', $current), $length);
    } else {
        $from_time = $current;
    }

    $to_time = strtotime(date('Y-m-d', $from_time) . ' +'.($length-1).' days');

    if (date('m', $from_time) == date('m', $to_time)) {
        $from = FormatDate('j', $from_time);
    } else {
        $from = FormatDate('j F', $from_time);
    }
    $to = FormatDate('j F', $to_time);

    $period_name = $from . '-' . $to;

    echo json_encode(array('success' => true,
        'period_name' => $period_name,
        'content' => $content,
        'debug'=>date('Y-m-d', $from_time).' '.date('Y-m-d', $to_time)));
    exit;
}

echo json_encode(array('error' => true, 'message' => 'Ошибка получения цены'));
exit;