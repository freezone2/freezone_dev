<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

if (!empty($_POST['from']) && !empty($_POST['to'])) {
    $from = strtotime($_POST['from']);
    $to = strtotime($_POST['to']);

    list($content, $sum, $sum_time) = load_order_history($from, $to);

    if (date('m', $from) == date('m', $to)) {
        $sfrom = FormatDate('j', $from);
    } else {
        $sfrom = FormatDate('j F', $from);
    }
    $sto = FormatDate('j F', $to);

    echo json_encode(array(
        'success' => true,
        'content' => $content,
        'sum_price'=>$sum.'.—',
        'sum_time'=>$sum_time,
        'info' => '<i class="icon-calendar2"></i>' . $sfrom . '-' . $sto . ''
    ));
    exit;
}


echo json_encode(array('error' => true, 'message' => 'Ошибка получения данных'));
exit;