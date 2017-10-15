<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');


$ch = intval($_POST['ch']);
$cm = intval($_POST['cm']);
$eh = intval($_POST['eh']);
$em = intval($_POST['em']);

$filter = array(
    'IBLOCK_ID' => 47,
    'PROPERTY_DATE_START' => ConvertDateTime(date('d.m.Y', strtotime($_POST['date'])), "YYYY-MM-DD"),
    'PROPERTY_TIME_START' => $_POST['ch'] . ':' . $_POST['cm'],
    '!PROPERTY_PRICE_RESULT' => 'NaN',
    'PROPERTY_TRUBA' => $_POST['truba'],
    'PROPERTY_PERSON_TYPE' => $_POST['ptype'],
);

if (isset($_POST['oid'])) {
    $filter = array(
        'IBLOCK_ID' => 47,
        'ID'=>$_POST['oid'],
    );
}

$res = CIBlockElement::GetList(
    false,
    $filter, 0, 0, arraY('ID', 'PROPERTY_TRAINER_CATEGORY', 'PROPERTY_PRICE_RESULT', 'PROPERTY_TIMELENGTH', 'PROPERTY_TRUBA')
);

$type = TYPE_F_DUPLE;

$cnt = $res->SelectedRowsCount();

if ($cnt > 0) {

    $order = $res->GetNext();

    $max_truba_humans = get_max_truba_humans_by_id($order['PROPERTY_TRUBA_VALUE']);

    $is_need_more_people = ($cnt < $max_truba_humans);
    if ($is_need_more_people) {
        $status_text = 'Подбор пары';
    } else {
        $status_text = 'Занято';
    }

    $work_time = ($ch < 10 ? '0' . $ch : $ch) . ':' . ($cm < 10 ? '0' . $cm : $cm) . ' - ' . ($eh < 10 ? '0' . $eh : $eh) . ':' . ($em < 10 ? '0' . $em : $em);

    $cat_id = $order['ID'];
    $trainer_cat_text = '';
    if ($cat_id) {
        $res2 = CIBlockElement::GetList(false, array('IBLOCK_ID' => 48, 'ID' => $cat_id));
        if ($res2->SelectedRowsCount()) {
            $cat = $res2->GetNext();
            $trainer_cat_text = $cat['NAME'];
        }
    }

    $timelenght_text = $order['PROPERTY_TIMELENGTH_VALUE'] . ' минут' . set_end($order['PROPERTY_TIMELENGTH_VALUE'], array('а', 'ы', ''));
    $price = $order['PROPERTY_PRICE_RESULT_VALUE'];


    echo json_encode(array(
        'success' => true,
        'order_id' => $order['ID'],
        'mans_text' => $cnt . ' человек' . set_end($cnt, array('', 'а', '')),
        'status_text' => $status_text,
        'work_time' => $work_time,
        'trainer_cat_text' => $trainer_cat_text,
        'timelenght_text' => $timelenght_text,
        'price' => $price
    ));
    exit;
}

echo json_encode(array('error' => true, 'message' => 'Ошибка получения цены'));
exit;