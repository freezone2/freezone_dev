<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;
$date = !empty($_POST['date']) ? ($_POST['date']) : 0;
$truba = !empty($_POST['truba']) ? intval($_POST['truba']) : TRUBA_12;
$type = !empty($_POST['type']) ? intval($_POST['type']) : null;
$person_type = !empty($_POST['person_type']) ? intval($_POST['person_type']) : PERSONE_TYPE_USER;

$APPLICATION->RestartBuffer();

if ($order_id) {
    ob_start();
    ?>
    <option value="">Доступное время</option>
    <?php
    $times = renderCalendarColByDate(strtotime($date), 15, $truba, $type, $person_type, RC_CONTENT_OPENED_TIMES);
    foreach($times as $time) {
        ?>
        <option value="<?=substr($time, 0, 5);?>"><?=$time;?></option>
        <?
    }
    $content = ob_get_contents();
    ob_end_clean();
    
    echo json_encode(arraY('success'=>'true', 'oid'=>$order_id, 'content'=>$content));
    exit;
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;