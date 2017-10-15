<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');


$oid = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

if ($oid) {
    $order = get_order($oid);
    if (!empty($order['ID'])) {
        if ($order['PROPERTY_USER_VALUE'] == $USER->GetID()) {

            $ruser = $USER->GetByID($order['PROPERTY_USER_VALUE']);
            $user = $ruser->Fetch();

            $arEventFields = array(
                "ORDER_ID" => $oid,
                "FIO" => $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'],
                "PHONE" => $user['MOBILE_PHONE'],
                "EMAIL" => $user['EMAIL'],
                "DATE" => date('d.m.Y H:i'),
                "ORDER_DATE" => $order['PROPERTY_DATE_START_VALUE'],
                "ORDER_TIME" => $order['PROPERTY_TIME_START_VALUE'],

            );
			
			//автоматическая отмена заказа не более чем за 24 часа до полета
			$hours_to_order = round((strtotime($order['PROPERTY_DATE_START_VALUE']." ".$order['PROPERTY_TIME_START_VALUE']) - strtotime(date('Y-m-d H:i:s')))/(60*60));
			
			if ($hours_to_order > 24) {
				//отменяем заказ
				if (CIBlockElement::Delete($oid)) {
					//возвращаем деньги на счет
					if (CSaleUserAccount::UpdateAccount(
					$order['PROPERTY_USER_VALUE'],
					$order["PROPERTY_PRICE_VALUE"],
					"RUB",
					"MANUAL",
					0
					)) 
					{
						echo json_encode(array('success'=>true));
						exit;
					} else {
						$message = 'Ошибка возврата средств. Пожалуйста обратитесь к менеджеру.';	
					}
				} else {
					$message = 'Ошибка отмены заказа';
				}
			} else {
				//если до заказа менее 24 часов отпарвка уведомления менеджеру
				if (CEvent::Send("ORDER_CANCEL", SITE_ID, $arEventFields)) {
					echo json_encode(array('success'=>true));
					exit;
				} else {
					$message = 'Ошибка отправки уведомления';
				}
			}

        } else {
            $message = 'Ошибка. Доступ к чужому заказу запрещен';
        }
    } else {
        $message = 'Ошибка передачи данных';
    }
} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;