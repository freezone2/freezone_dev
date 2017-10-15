<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

$content = renderCalendar($_POST['TIMELENGTH'], $_POST['TRUBA'], $_POST['TYPE'], $_POST['PERSONE_TYPE'], $_POST['TARIFF']);

if ($_POST['PERSONE_TYPE'] == PERSONE_TYPE_PROF) {

    $truba_id = get_truba_id($_POST['TRUBA']);

    if ($_POST['TYPE'] == TYPE_F_ONE) {
        $IBLOCK_ID = 55;
    } else {
        $IBLOCK_ID = 49;
    }

    $filter = array(
        'IBLOCK_ID' => $IBLOCK_ID,
        'PROPERTY_TIMELENGTH' => $_POST['TIMELENGTH'],
        'PROPERTY_TIMELENGTH_BLOCK' => $_POST['TIMELENGTH_BLOCK'],
        'PROPERTY_TRUBA' => $truba_id,
        'ACTIVE'=>'Y',
    );

    $res = CIBlockElement::GetList(false,
        $filter,
        0,
        0,
        array('ID', 'NAME', 'PROPERTY_PRICE')
    );
//    while($z = $res->GetNext()) {
//        print_R($z);
//    }
    if ($res->SelectedRowsCount() == 1) {

        $price_row = $res->GetNext();
        $price = $price_row['PROPERTY_PRICE_VALUE'];

        echo json_encode(array('success' => true, 'content' => $content, 'price' => $price));
        exit;
    } else {
        $price = 0;
    }

} else {
    echo json_encode(array('success' => true, 'content' => $content));
    exit;
}

echo json_encode(array('error' => true, 'message' => 'Ошибка получения цены'));
exit;