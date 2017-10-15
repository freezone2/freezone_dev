<?php
/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 12:57
 */
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$action = (string)$_REQUEST['action'];

if ($action == 'check') {
    $arAuthResult = $USER->Login($_POST['email'], $_POST['password'], "Y");
    if ($arAuthResult['TYPE'] == 'ERROR') {
        echo json_encode(array('error'=>true, 'message'=>$arAuthResult['MESSAGE']));
        exit;
    }

    if ($arAuthResult === true) {
        echo json_encode(array('success'=>true));
        exit;
    }
}

echo json_encode(array('error'=>true));
exit;