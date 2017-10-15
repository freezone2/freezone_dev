<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

global $USER;

if (empty($_POST['from_date'])) {
    $_POST['from_date'] = date('Y-m-d');
}
if (empty($_POST['to_date'])) {
    $_POST['to_date'] = date('Y-m-d', time()+3600*24*30);
}

$from_time = strtotime($_POST['from_date']);
$to_time = strtotime($_POST['to_date']);

if (date('m', $from_time) == date('m', $to_time)) {
    $from = FormatDate('j', $from_time);
} else {
    $from = FormatDate('j F', $from_time);
}
$to = FormatDate('j F', $to_time);

$report_title = 'Количество полётов с '.$from.' по '.$to.'';

ob_start();
?>

<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; padding:0" width="500px">
    <tr>
        <td>
            <center style="max-width: 500px; width: 100%;">
                <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0;" width="100%">
                    <tr>
                        <td colspan="4">
                            <br />
                            <br />
                            <a style="text-align: center; display: block;" href="#"><img src="<?=URL_HOST;?>/local/templates/main/images/logo-black.jpg" alt="" border="0" width="180" height="56" style="display:block; margin: 0 auto;"></a>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <span style="-webkit-text-size-adjust:none; text-align: center; display: block; color: #02030c; font-family: Arial, Helvetica, sans-serif; font-size: 30px; "><?=$report_title;?></span>
                            <br />
                            <br />
                            <br />
                        </td>
                    </tr>
                    <tr>
                        <td><br /><span style="display: block;width: 100%;border-bottom: 1px solid #a8adb1;padding-bottom: 30px;margin-bottom: 10px;-webkit-text-size-adjust:none; font-size: 15px;text-transform:uppercase;color: #a8adb1; font-family: Arial, Helvetica, sans-serif; ">Дата</span></td>
                        <td><br /><span style="display: block;width: 100%;border-bottom: 1px solid #a8adb1;padding-bottom: 30px;margin-bottom: 10px;-webkit-text-size-adjust:none; font-size: 15px;text-transform:uppercase;color: #a8adb1; font-family: Arial, Helvetica, sans-serif; ">пакет</span></td>
                        <td><br /><span style="display: block;width: 100%;border-bottom: 1px solid #a8adb1;padding-bottom: 30px;margin-bottom: 10px;-webkit-text-size-adjust:none; font-size: 15px;text-transform:uppercase;color: #a8adb1; font-family: Arial, Helvetica, sans-serif; ">Мин.</span></td>
                        <td><br /><span style="display: block;width: 100%;border-bottom: 1px solid #a8adb1;padding-bottom: 30px;margin-bottom: 10px;-webkit-text-size-adjust:none; font-size: 15px;text-transform:uppercase;color: #a8adb1; font-family: Arial, Helvetica, sans-serif; ">Цена</span></td>
                    </tr>

                    <?
                    $res = CIBlockElement::GetList(
                        array('PROPERTY_DATE_START'=>'DESC', 'PROPERTY_COMPLETED_VALUE'=>'DESC'),
                        array(
                            'IBLOCK_ID'=>47,
                            'PROPERTY_USER'=>$USER->GetID(),
                            ">=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $from_time), "YYYY-MM-DD"),
                            "<=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $to_time), "YYYY-MM-DD"),

                            ),
                        0,
                        0,
                        array(
                            'PROPERTY_COMPLETED', 'PROPERTY_PRICE_RESULT', 'PROPERTY_TIMELENGTH',
                            'PROPERTY_TARIFF', 'PROPERTY_DATE_START'
                        )
                    );
                    $sum = 0;
                    $sum_time = 0;
                    while($row = $res->GetNext()) {
                        $tariff_id = intval($row['PROPERTY_TARIFF_VALUE']);

                        $tariff = get_tariff($tariff_id);

                        $sum += $row['PROPERTY_PRICE_RESULT_VALUE'];
                        $sum_time += $row['PROPERTY_TIMELENGTH_VALUE'];
                        ?>
                        <tr>
                            <td><br /><span style="padding: 5px 10px 5px 0;-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;text-transform:uppercase;"><?=FormatDate('j F Y', strtotime($row['PROPERTY_DATE_START_VALUE']));?></span></td>
                            <td><br /><span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 24px; line-height: 40px;"><?=strip_tags($tariff['~NAME']);?></span></td>
                            <td><br /><span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><?=$row['PROPERTY_TIMELENGTH_VALUE'];?></span></td>
                            <td><br /><span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><?=intval($row['PROPERTY_PRICE_RESULT_VALUE']);?>.—</span></td>
                        </tr>
                        <?
                    }
                    ?>

                    <tr>

                        <td colspan="2">
                            <br />
                            <span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;text-transform:uppercase; font-weight: 700;"><b>Итого</b></span></td>
                        <td>
                            <br />
                            <span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;text-transform:uppercase; font-weight: 700;"><b><?=$sum_time;?></b></span></td>
                        <td>
                            <br />
                            <span style="-webkit-text-size-adjust:none; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 15px;text-transform:uppercase; font-weight: 700;"><b><?=$sum;?>.—</b></span></td>
                    </tr>
                </table>
                <br />
                <br />
                <br />
                <br />
                <br />
            </center>
        </td>
    </tr>
</table>
<?
$content = ob_get_contents();
ob_end_clean();

$email = $USER->GetEmail();


if (mail($email, $report_title, $content, "Content-type: text/html;charset=utf-8\r\nFrom: ".FROM_EMAIL)) {
    echo json_encode(array('success' => true));
    exit;
}
echo json_encode(array('error' => true, 'message' => 'Ошибка получения цены'));
exit;