<?php
/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 12:57
 */
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
global $USER;

$action = (string)$_REQUEST['action'];
if ($action == 'forgot') {
    if (isset($_POST['email'])) {
        if (preg_match('#[@.]#simu', $_POST['email'])) {

            $res = CUser::GetByLogin($_POST['email']);
            if ($res->SelectedRowsCount() == 1) {
                $new_password = rand(111111, 999999);
                $user_data = $res->GetNext();

                $message = 'Ваш пароль успешно изменен и отправлен Вам на электронную почту';

                // change the password
                $obUser = new CUser;
                $res = $obUser->Update($ID, array("PASSWORD"=>$new_password));
                if(!$res && $obUser->LAST_ERROR <> '')
                    return array("MESSAGE"=>$obUser->LAST_ERROR."<br>", "TYPE"=>"ERROR");
                CUser::SendUserInfo($ID, 1, $message, true, 'USER_PASS_CHANGED');

                echo json_encode(array('success'=>true, 'message'=>$message));
                exit;
            }
        }
    }
}

echo json_encode(array('error'=>true));
exit;