<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $USER;

\Bitrix\Main\Loader::includeModule('iblock');

$order_id = !empty($_POST['oid']) ? intval($_POST['oid']) : 0;

$APPLICATION->RestartBuffer();

if ($order_id) {

    $order = get_order($order_id);

    $timelength_block = $order['PROPERTY_TIMELENGTH_BLOCK_VALUE'];
    $date_start = $order['PROPERTY_DATE_START_VALUE'];
    $time_start = $order['PROPERTY_TIME_START_VALUE'];
    list($h, $m) = explode(':', $time_start);
    $orders_count = get_count_orders($h, $m, $date_start);
    ob_start();

    $type = $order['PROPERTY_TYPE_F_ENUM_ID'];

    $closed = 0;
    if ($order['PROPERTY_CLOSED_ENUM_ID'] == ORDER_CLOSED_YES) {
        $closed = 1;
    }

    $is_user = ($order['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_USER);
    $type_is_one = ($type == TYPE_F_ONE or $type == TYPE_F_CUSTOM);
    if ($type_is_one) {
        ?>
        <div class="calendar-popup-top">
            <i></i>
            <?= ($order['PROPERTY_CATEGORY_F_VALUE'] ? $order['PROPERTY_CATEGORY_F_VALUE'] : $order['PROPERTY_TYPE_F_VALUE']); ?>
        </div>
       	<?php if (!$is_user) { ?>
        <p class="popup-time-info"><i class="icon-g-c"></i><?= $timelength_block; ?>
            минут<?= set_end($timelength_block, array('а', 'ы', '')); ?></p>
        <p class="popup-men-info"><i class="icon-g-m"></i> <?= $orders_count; ?>
            человек<?= set_end($orders_count, array('', 'а', '')); ?></p>
        <p class="popup-cash-info"><i class="icon-rubl"></i><?=$order['PROPERTY_PRICE_RESULT_VALUE'];?>.–</p>
		<?php } ?>

        <?php
        if ($order['PROPERTY_USER_VALUE']) {
            $ruser = $USER->GetByID($order['PROPERTY_USER_VALUE']);
            $user = $ruser->Fetch();
            ?>
            <ul class="popup-user-info">
                <li><?= $user['NAME']; ?> <?= $user['LAST_NAME']; ?> <?= $user['SECOND_NAME']; ?></li>
                <li><?= $user['PERSONAL_MOBILE']; ?></li>
                <li><?= $user['EMAIL']; ?></li>
            </ul>
            <?
        } else if ($order['PROPERTY_CERT_VALUE']) {
            $cert = get_certificate_by_id($order['PROPERTY_CERT_VALUE']);
            $tariff = get_tariff($cert['PROPERTY_TARIFF_VALUE']);
            ?>
            <ul class="popup-user-info">
                <li style="font-weight: bold; font-size: 14px;">Сертификат</li>
                <li><?= $cert['PROPERTY_FIO_VALUE']; ?></li>
                <li><?= $cert['PROPERTY_PHONE_VALUE']; ?></li>
                <li><?= $cert['PROPERTY_EMAIL_VALUE']; ?></li>
                <?if ($tariff['ID']){?>
                <li style="font-weight: bold; font-size: 14px;"><br>Тариф</li>
                <li><?=strip_tags($tariff['~NAME']);?></li>
                <?} else {?>
                    <li style="color: red">Тариф не указан</li>
                <?}?>
            </ul>
            <?
        }
        ?>



        <div class="popup-bottom">
            <button class="btn delete-order" data-oid="<?=$order_id;?>">Удалить</button>
            <button class="btn open-change-popup" data-oid="<?=$order_id;?>">Перенести</button>
        </div>
        <?
    } else {
        ?>

        <div class="calendar-popup-top">
            <i></i>
            <?= ($order['PROPERTY_CATEGORY_F_VALUE'] ? $order['PROPERTY_CATEGORY_F_VALUE'] : $order['PROPERTY_TYPE_F_VALUE']); ?>
        </div>
        <p class="popup-time-info"><i class="icon-g-c"></i>по <?= $timelength_block; ?>
            минут<?= set_end($timelength_block, array('а', 'ы', '')); ?> </p>
        <p class="popup-men-info"><i class="icon-g-m"></i> <?= $orders_count; ?>
            человек<?= set_end($orders_count, array('', 'а', '')); ?></p>
        <ul class="status-list">
            <?php
            $orders = get_orders($h, $m, $date_start);
            while ($user_order = $orders->GetNext()) {
                $ruser = $USER->GetByID($user_order['PROPERTY_USER_VALUE']);
                $user = $ruser->Fetch();

                $is_not_payed = false;
                if ($user_order['PROPERTY_DATE_PAYMENT_VALUE'] == "" ||
                    $user_order['PROPERTY_STATUS_PAYMENT_VALUE'] != STATUS_PAYED_COMPLETE
                ) {
                    $is_not_payed = true;
                }
                ?>
                <li <?= ($is_not_payed ? 'class="remove"' : ''); ?>>
                    <i class="icon-check2"></i><span><?= $user['NAME']; ?> <?= $user['LAST_NAME']; ?> <?= $user['SECOND_NAME']; ?></span>
                    <div class="drop-list">
                        <ul class="popup-user-info">
                            <li><?= $user['PERSONAL_MOBILE']; ?></li>
                            <li><?= $user['EMAIL']; ?></li>
                        </ul>
                        <button class="btn open-change-popup" data-oid="<?=$order_id;?>">Перенести на другое время</button>
                    </div>
                </li>
            <? } ?>
        </ul>
        <div class="popup-bottom">
            <button class="btn btn-close-reg" data-oid="<?= $order_id; ?>">Закрыть регистрацию</button>
        </div>

        <?
    }
    $content = ob_get_contents();
    ob_end_clean();

    echo json_encode(arraY('success' => 'true', 'content' => $content, 'type_is_one'=>$type_is_one, 'closed'=>$closed));
    exit;

} else {
    $message = 'Ошибка передачи данных';
}

echo json_encode(array('error' => true, 'message' => $message));
exit;