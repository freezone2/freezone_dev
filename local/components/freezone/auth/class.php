<?php

/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 11:24
 */
class FreezoneAuthComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult['ERROR'] = false;
        if (isset($_POST['email']) && $_POST['password']) {

            if (preg_match('#[@.]#simu', $_POST['email'])) {

                global $USER;
                if (!is_object($USER)) $USER = new CUser;
                $arAuthResult = $USER->Login($_POST['email'], $_POST['password'], "Y");


                if ($arAuthResult === true) {
                    if (!empty($_POST['action']) && $_POST['action'] == 'check') {
                        echo json_encode(array('success' => true));
                        exit;
                    } else {
                        header('Location: /personal/');
                        exit;
                    }
                } else {
                    if (!empty($_POST['action']) && $_POST['action'] == 'check') {
                        echo json_encode(array('error' => true));
                        exit;
                    } else {
                        $this->arResult['ERROR'] = true;
                    }
                }
            } else {
                $this->arResult['ERROR'] = true;
            }
        }

        $this->includeComponentTemplate();
    }
}