<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');


$ch = intval($_POST['ch']);
$cm = intval($_POST['cm']);
$eh = intval($_POST['eh']);
$em = intval($_POST['em']);
$date = ($_POST['date']);
$timelength = ($_POST['timelength']);
$timelength_block = ($_POST['timelength_block']);
$ptype = $_POST['ptype'];
$truba = $_POST['truba'];
$time_tariff = $_POST['time_tariff'];

if ($ptype == PERSONE_TYPE_PROF) {
    $truba_id = get_truba_id($truba);

    if ($_POST['type'] == TYPE_F_ONE) {
        $IBLOCK_ID = 55;
    } else {
        $IBLOCK_ID = 49;
    }



    $fparams = array(
        'IBLOCK_ID'=>$IBLOCK_ID,
        'PROPERTY_TRUBA'=>$truba_id,
        'PROPERTY_TIMELENGTH'=>$timelength,
        'PROPERTY_TIMELENGTH_BLOCK'=>$timelength_block,
        'ACTIVE'=>'Y'
    );

    $res = CIBlockElement::GetList(
        false, 
        $fparams,
        0,
        0,
        array('PROPERTY_PRICE', 'ID', 'PROPERTY_PRICE_NIGHT')
    );

    if ($res->SelectedRowsCount() == 1) {
        $row = $res->GetNext();

        $status_text = 'Свободно';
        $work_time = ($ch < 10 ? '0' . $ch : $ch) . ':' . ($cm < 10 ? '0' . $cm : $cm) . ' - ' . ($eh < 10 ? '0' . $eh : $eh) . ':' . ($em < 10 ? '0' . $em : $em);
        $price = $row['PROPERTY_PRICE_VALUE'];
        $price_night = $row['PROPERTY_PRICE_NIGHT_VALUE'];
        $cnt = 1;
        $timelenght_text = $timelength . ' минут' . set_end($timelength, array('а', 'ы', ''));

        $mans_text = '';
        if ($_POST['type'] != TYPE_F_ONE) {
            $mans_text = $cnt . ' человек' . set_end($cnt, array('', 'а', ''));
            $timelenght_text = '';
        } else {

        }
        
        if ($_POST['is_night'] == 1) {
            $price = $price_night;
        }

        echo json_encode(array(
            'success' => true,
            'id'=>$row['ID'],
            'mans_text' => $mans_text,
            'status_text' => $status_text,
            'work_time' => $work_time,
            'trainer_cat_text' => '',
            'timelenght_text' => $timelenght_text,
            'price' => $price
        ));
        exit;
    }  else {
        $message = 'Не найден тариф для спортсмена';
    }

} else if ($ptype == PERSONE_TYPE_USER) {

} else {
    $message = 'Ошибка типа клиента';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;