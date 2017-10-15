<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');


if (!empty($_POST['date']) && preg_match('#^\d+.\d+.\d+$#sim', $_POST['date'])) {

    $render_type = $_POST['type'];
    
    $length = intval($_POST['length']);

    $current = strtotime($_POST['date']);
    $type_and_category = $_POST['type_and_category'];
    $type = $category = null;
    if ($type_and_category) {
        list($type, $category) = explode(';', $type_and_category);
    }


    $content = 'error';
    if ($render_type == 'month') {
        $time = strtotime($_POST['date']);
        $dateComponents = getdate($time);
        $content = build_calendar_quick($dateComponents['mon'], $dateComponents['year']);
    }
    else {
        $params = array(
            'truba' => $_POST['truba'],
            'person' => $_POST['person'],
            'type' => $type,
            'category' => $category,
            'length' => $length,
        );        
        $content = build_week_quick($current, $params);
    }

    $arEventFields = array(
        'EMAIL'=>CUser::GetEmail(),
        'CONTENT' => $content
    );
    CEvent::Send("SEND_CABINET_INFO", SITE_ID, $arEventFields);

    echo json_encode(array('success' => true));
    exit;
}

echo json_encode(array('error' => true, 'message' => 'Ошибка отправки отчета'));
exit;