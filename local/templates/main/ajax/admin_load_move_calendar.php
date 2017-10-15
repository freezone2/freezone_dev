<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

$APPLICATION->RestartBuffer();

if ($order_id) {
    ob_start();
    ?>
    <div class="calendar-multi">
        <input id="date-range" size="40" value="">
        <div id="date-range-container"></div>
    </div>
    <div class="select-time">
        <select id="big_calendar_times">
            <option value="">Нужно выбрать дату</option>
        </select>
    </div>
    <button class="btn move-btn" data-oid="<?=$order_id;?>">Перенести</button>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    
    echo json_encode(arraY('success'=>'true', 'oid'=>$order_id, 'content'=>$content));
    exit;
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;