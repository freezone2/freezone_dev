<?php
/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 12:57
 */
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$action = (string)$_REQUEST['action'];

$MESSAGE_ERROR = '';

global $USER;

if (!empty($_POST['action']) && $_POST['action'] == 'avatar') {
    if (!empty($_FILES['fileToUpload']) && is_file($_FILES['fileToUpload']['tmp_name'])) {
        $user = new CUser;
        $fid = CFile::SaveFile($_FILES['fileToUpload'], "avatar");
        $data = CFile::GetFileArray($fid);
        $fields = Array(
            "PERSONAL_PHOTO" => CFile::MakeFileArray($data['SRC']),
        );
        if ($user->Update($USER->GetID(), $fields)) {
            echo json_encode(array('success' => true));
            exit;
        } else {
            $MESSAGE_ERROR = $user->LAST_ERROR;
        }
    }
    echo json_encode(array('error'=>true, 'MESSAGE'=>$MESSAGE_ERROR));
    exit;
}


if (!empty($_POST['SAVE'])) {
    $user = new CUser;

    $error = false;

    if (empty($_POST['NAME'])) {
        $error = true;
    }
    
    $name_tmp = explode(' ', $_POST['NAME']);
    if (sizeof($name_tmp) < 2) {
        $error = true;
    }

    $first_name = $name_tmp[0];
    $last_name = $name_tmp[1];
    $second_name = '';
    if (isset($name_tmp[2])) {
        $second_name = $name_tmp[2];
    }

    if (empty($_POST['EMAIL'])) {
        $error = true;
    }
    $email = $_POST['EMAIL'];

    if (empty($_POST['PERSONAL_MOBILE'])) {
        $error = true;
    }
    $phone = $_POST['PERSONAL_MOBILE'];

    if (empty($_POST['PERSONAL_BIRTHDAY'])) {
        $error = true;
    }
    $bday = $_POST['PERSONAL_BIRTHDAY'];

    if (!$error) {
        $fields = Array(
            "NAME" => $first_name,
            "LAST_NAME" => $last_name,
            "SECOND_NAME" => $second_name,
            "EMAIL" => $email,
            "PERSONAL_MOBILE" => $phone,
            "PERSONAL_BIRTHDAY" => $bday,
        );
        if ($user->Update($USER->GetID(), $fields)) {
            echo json_encode(array('success' => true));
            exit;
        } else {
            $MESSAGE_ERROR = $user->LAST_ERROR;
        }
    } else {
        $MESSAGE_ERROR = 'validation error';
    }
} else {
    $MESSAGE_ERROR = 'POST form error';
}

echo json_encode(array('error' => true, 'message' => $MESSAGE_ERROR));
exit;