<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//ini_set('display_errors',1);
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');

$USER_ID = get_or_create_tmp_user($_POST['name'], $_POST['email'], $_POST['phone']);

$basket_id = false;

$message = '';

$PRODUCT_ID = !empty($_POST['TARIFF']) ? intval($_POST['TARIFF']) : 0;
$COUNT = 1;

$res = CIBlockElement::GetList(
    false,
    array('IBLOCK_ID' => 42, 'ID' => $PRODUCT_ID),
    0,
    0,
    array('ID', 'NAME', 'PREVIEW_TEXT', 'CATALOG_GROUP_1')
);
if ($res->SelectedRowsCount() != 1) {
    die("error product");
}
$product = $res->GetNext();

$RESULT_PRICE = $COUNT * $product['CATALOG_PRICE_1'];

$PERSON_TYPE_ID = 1;
$DELIVERY = 2;
$PAY_SYSTEM_ID = 3;

$arOrderPropsValues = array();
$arOrderPropsValues[1] = $_POST['email'];
$arOrderPropsValues[2] = $_POST['name'];
$arOrderPropsValues[3] = $_POST['phone'];
$arOrderPropsValues[4] = 'TARIFF';
$arOrderPropsValues[5] = $PRODUCT_ID;


$arOrderOptions = array();
$arErrors = $arWarnings = array();

$arShoppingCart = array();
$arShoppingCart[] = array(
    "PRODUCT_ID" => $PRODUCT_ID,
    "PRICE" => $product['CATALOG_PRICE_1'],
    "CURRENCY" => "RUB",
    "QUANTITY" => $COUNT,
    "LID" => 's1',
    "DELAY" => "N",
    "CAN_BUY" => "Y",
    "NAME" => strip_tags($product['~NAME']),
    "PROPS" => array(
        array(
            "NAME" => "Дата",
            "CODE" => "DATE",
            "VALUE" => $_POST['ORDER_DAY']
        ),
        array(
            "NAME" => "Время",
            "CODE" => "TIME",
            "VALUE" => $_POST['ORDER_TIME']
        ),
        array(
            "NAME" => "Блок",
            "CODE" => "TIMELENGTH",
            "VALUE" => $_POST['TIMELENGTH']
        )
    ),
);


$arOrder = CSaleOrder::DoCalculateOrder(
    's1',
    $USER->GetID(),
    $arShoppingCart,
    $PERSON_TYPE_ID,
    $arOrderPropsValues,
    $DELIVERY,
    $PAY_SYSTEM_ID,
    $arOrderOptions,
    $arErrors,
    $arWarnings
);

$arAdditionalFields = array();

$arCoupon = array();
$arStoreBarcodeOrderFormData = array();

$ORDER_ID = CSaleOrder::DoSaveOrder(
    $arOrder,
    $arAdditionalFields,
    0,
    $arErrors
);

$url = '';
if ($ORDER_ID) {
    //CSaleOrder::StatusOrder($ORDER_ID, "DN");

    $bUseAccountNumber = (COption::GetOptionString("sale", "account_number_template", "") !== "") ? true : false;

    $paymentId = $PAY_SYSTEM_ID;

    $arOrder = false;
    $checkedBySession = false;
    if (!$USER->IsAuthorized() && is_array($_SESSION['SALE_ORDER_ID']))
    {
        $realOrderId = 0;

        if ($bUseAccountNumber)
        {
            $dbOrder = CSaleOrder::GetList(
                array("DATE_UPDATE" => "DESC"),
                array(
                    "LID" => SITE_ID,
                    "ACCOUNT_NUMBER" => $ORDER_ID
                )
            );
            $arOrder = $dbOrder->GetNext();
            if ($arOrder)
                $realOrderId = intval($arOrder["ID"]);
        }
        else
        {
            $realOrderId = intval($ORDER_ID);
        }

        $checkedBySession = in_array($realOrderId, $_SESSION['SALE_ORDER_ID']);
    }

    if ($bUseAccountNumber && !$arOrder)
    {
        $arFilter = array(
            "LID" => SITE_ID,
            "USER_ID" => intval($USER->GetID()),
            "ACCOUNT_NUMBER" => $ORDER_ID
        );

        $dbOrder = CSaleOrder::GetList(
            array("DATE_UPDATE" => "DESC"),
            $arFilter
        );
        $arOrder = $dbOrder->GetNext();
    }

    if (!$arOrder)
    {
        $arFilter = array(
            "LID" => SITE_ID,
            "ID" => $ORDER_ID
        );
        if (!$checkedBySession)
            $arFilter["USER_ID"] = intval($USER->GetID());

        $dbOrder = CSaleOrder::GetList(
            array("DATE_UPDATE" => "DESC"),
            $arFilter
        );
        $arOrder = $dbOrder->GetNext();
    }

    if ($arOrder)
    {
        $paymentItem = null;

        /** @var \Bitrix\Sale\Order $order */
        $order = \Bitrix\Sale\Order::load($arOrder['ID']);

        if ($order)
        {
            /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
            $paymentCollection = $order->getPaymentCollection();

            if ($paymentCollection)
            {
                if ($paymentId)
                {
                    $params = array(
                        'select' => array('ID'),
                        'filter' => array(
                            'LOGIC' => 'OR',
                            'ID' => $paymentId,
                            'ACCOUNT_NUMBER' => $paymentId,
                        )
                    );

                    $data = \Bitrix\Sale\Internals\PaymentTable::getRow($params);

                    if ($data !== null && $data['ID'] > 0)
                    {
                        /** @var \Bitrix\Sale\Payment $paymentItem */
                        $paymentItem = $paymentCollection->getItemById($data['ID']);
                    }
                }

                if ($paymentItem === null)
                {
                    /** @var \Bitrix\Sale\Payment $item */
                    foreach ($paymentCollection as $item)
                    {
                        if (!$item->isInner() && !$item->isPaid())
                        {
                            $paymentItem = $item;
                            break;
                        }
                    }
                }

                if ($paymentItem !== null)
                {
                    $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($paymentItem->getPaymentSystemId());
                    if ($service)
                    {
                        ob_start();
                        $result = $service->initiatePay($paymentItem);//, $context->getRequest());
                        if (!$result->isSuccess())
                        {
                            echo implode('<br>', $result->getErrorMessages());
                        }
                        $out = ob_get_contents();
                        ob_end_clean();

                        ob_start();
                        include $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_payment/sbr/payment.php';
                        $link = ob_get_contents();
                        ob_end_clean();

                        preg_match('#href="(.+?)"#', $link, $m);
                        $url = $m[1];
                    }
                }
            }
        }
    }

    echo json_encode(array('success' => true, 'order_id' => $ORDER_ID, 'url' => $url));
    exit;
} else {
    $message = 'Заказ не создан' . print_r($arErrors);
}

echo json_encode(array('error' => true, 'message' => $message));
exit;