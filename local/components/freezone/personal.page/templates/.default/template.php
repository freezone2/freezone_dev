<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

$APPLICATION->AddHeadScript('/local/templates/main/custom_js/personal.js');

\Bitrix\Main\Loader::includeModule('iblock');

$from = strtotime(date('Y-m-d'));
$to = strtotime(date('Y-m-d'))+3600*24*10;

if (date('m', $from) == date('m', $to)) {
    $sfrom = FormatDate('j', $from);
} else {
    $sfrom = FormatDate('j F', $from);
}
$sto = FormatDate('j F', $to);
?>

<section class="cabinet-in">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="cabinet-wrapper">

                <?$APPLICATION->includeComponent('freezone:profile.block.edit', '.default', array());?>

                <div class="cabinet-item">
                    <div class="datepicker-input">
                        <input type="text" id="datepickerinp" data-callback="reloadCabinetReportTable" />
                    </div>

                    <input type="hidden" id="date_from" value="<?=date('Y-m-d', $from);?>"/>
                    <input type="hidden" id="date_to" value="<?=date('Y-m-d', $to);?>"/>
                    <input type="hidden" id="date_filter" value="0"/>
                    <input type="hidden" id="oid" value="0"/>
					
					
                    <label for="date" class="open-datepiker info_dp_out"><i class="icon-calendar2"></i><?=$sfrom;?>-<?=$sto;?></label>
                    <!--<span class="extract" id="get_report"><i class="icon-extract"></i>Получить выписку</span>-->

                    <div class="cabinet-item-in">
                        <div class="history-top">
                            <span class="data">Дата</span>
                            <span class="package-services">&nbsp;<!--пакет--></span>
                            <span class="time">Мин.</span>
                            <span class="cash">Цена</span>
                        </div>
                        <div class="history-wrap" id="history_cabinet_orders">

                            <?php
                            list($content, $sum, $sum_time) = load_order_history($from, $to);
                            echo $content;
                            ?>

                            <script>
                                initCabinetButtons();
                            </script>

                        </div>
                        <div class="history-bottom">
                            <span>Итого</span>
                            <span id="sum_price"><?=$sum;?>.—</span>
                            <span id="sum_time"><?=$sum_time;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

