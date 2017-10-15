<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $months_rus1;

\Bitrix\Main\Loader::includeModule('iblock');

if (!empty($_POST['date']) && preg_match('#^\d+.\d+.\d+$#sim', $_POST['date'])) {
    $time = strtotime($_POST['date']);
    $dateComponents = getdate($time);
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
    $content = build_calendar($month, $year);

    $month_name = $months_rus1[date('m', $time)];

    echo json_encode(array('success'=>true, 'month_name'=>$month_name, 'content'=>$content));
    exit;
}

echo json_encode(array('error' => true, 'message' => 'Ошибка получения цены'));
exit;