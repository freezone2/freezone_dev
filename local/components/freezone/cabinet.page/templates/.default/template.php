<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

$APPLICATION->AddHeadScript('/local/templates/main/custom_js/cabinet.js');

\Bitrix\Main\Loader::includeModule('iblock');
?>

<div class="content-cabinet">
    <div class="cabinet-calendar">
        <aside class="calendar-left-filter">
            <a class="logo-cabinet" href="/"><img src="/local/templates/main/images/logo.png" alt=""/></a>

            <div class="calendar-change-btn not-mount" id="filter_truba">
                <button class="btn active" data-val="17">17</button>
                <button class="btn" data-val="12">12</button>
            </div>

            <div class="calendar-change-btn not-mount" id="filter_person">
                <button class="btn " data-val="<?= PERSONE_TYPE_USER; ?>">Любители</button>
                <button class="btn active" data-val="<?= PERSONE_TYPE_PROF; ?>">Спортсмены</button>
            </div>

            <button class="btn btn-more not-mount btn_all_persons"
                    onclick="$(this).addClass('active'); $('#filter_person button').removeClass('active'); $('.change-preview .btn.active').click();">Все</button>

            <div class="radio-group not-mount" id="filter_category">
                <div class="radio">
                    <label for="radio0">
                        <input type="radio" id="radio0" name="type" checked value=""/>
                        <span></span>
                        <span>Все виды</span>
                    </label>
                </div>

                <?$res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>58, 'ACTIVE'=>'Y'));
                while($row = $res->GetNext()) {?>
                <div class="radio filtering" data-ptype="<?= PERSONE_TYPE_PROF; ?>">
                    <label for="radio1">
                        <input type="radio" id="radio1" name="type"
                               value="<?= TYPE_F_DUPLE; ?>;<?= $row['ID']; ?>"/>
                        <span></span>
                        <span><?=$row['NAME'];?></span>
                    </label>
                </div><?}?>

                <div class="radio">
                    <label for="radio3">
                        <input type="radio" id="radio3" name="type"
                               value="<?= TYPE_F_ONE; ?>;"/>
                        <span></span>
                        <span>Без пары</span>
                    </label>
                </div>
                <div class="radio filtering" data-ptype="<?= PERSONE_TYPE_USER; ?>" style="display: none">
                    <label for="radio4">
                        <input type="radio" id="radio4" name="type"
                               value="<?= TYPE_F_ONE; ?>;<?= CATEGORY_F_BY_CERTIFICATE; ?>"/>
                        <span></span>
                        <span>Сертификат</span>
                    </label>
                </div>
            </div>
            <a class="btn-exit" href="#"><i class="icon-exit"></i> Выйти</a>
            <a class="made" href="#"></a>
        </aside>
        <div class="cabinet-calendar-in">
            <div class="cabinet-calendar-top-filter">
                <div class="change-preview">
                    <!--<button data-for-type="day" class="btn">День</button>-->
                    <button data-for-type="week" class="btn">Неделя</button>
                    <!--<button data-for-type="month" class="btn active">Месяц</button>-->
                </div>
                <button class="btn-send"><i class="icon-send"></i> Отправить</button>
                <button class="btn-print"><i class="icon-print"></i> Печать</button>
                <div class="nav-calendar">
                    <div class="nav-calendar-in">
                        <button class="btn btn-prev"></button>
                        <button class="btn btn-next"></button>
                    </div>
                    <span id="period_name"></span>
                </div>
            </div>
            <div class="cabinet-calendar-content">

                <?php
                $dateComponents = getdate();
                $month = $dateComponents['mon'];
                $year = $dateComponents['year'];

                $week_time = get_date_start_week(date('Y-m-d'));
                ?>

                <div data-type="month" class="cabinet-calendar-item" style="display: block;">
                    <div class="cabinet-calendar-mount" id="content-month">
                        <?
                        echo build_calendar($month, $year);
                        ?>
                    </div>
                </div>

                <div data-type="week" class="cabinet-calendar-item" id="content-week">
                    Загрузка...
                </div>

                <div data-type="day" class="cabinet-calendar-item" id="content-day">
                    Загрузка...
                </div>

                <input type="hidden" name="filter_month_date"
                       value="<?= $year; ?>-<?= ($month < 10 ? '0' . $month : $month); ?>-01">
                <input type="hidden" name="filter_week_date" id="filter_week_date"
                       value="<?= date('Y-m-d', $week_time); ?>">
            </div>
        </div>
    </div>

    <div class="calendar-popup1"></div>
    <div class="calendar-popup2"></div>
    <div class="calendar-popup3"></div>
    <div class="popup-calendar-overlay"></div>
</div>


<script>
    function print_filter(type, length) {
        var val = $('input[name="filter_week_date"]').val();
        var date = val.split('-');
        var m = date[1];
        var y = date[0];
        var d = date[2];
        var new_date = moment(y + m + d, "YYYYMMDD").format('YYYY-MM-DD');

        if (typeof length == 'undefined') {
            length = 7;
        }
        
        var person = 0;
        if ($('#filter_person button.active').length == 1) {
            person = $('#filter_person button.active').data('val');
        }

        $.post('/local/templates/main/ajax/admin_calendar_send.php', {
            date: new_date,
            type: type,
            truba: $('#filter_truba button.active').data('val'),
            person: person,
            type_and_category: $('#filter_category input:checked').val(),
            length: length
        }, function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                openThanskFeedback('Отправка', 'Выполнено');
            } else {
                alert(res.message);
            }
        });
    }

    $('.btn-send').on('click', function(){
        var type = $('.change-preview button.active').data('for-type');

        if (type == 'month') {
            print_filter('month');
        } else if (type == 'week') {
            print_filter('week', 7);
        } else if (type == 'day') {
            print_filter('day', 2);
        }
    });
</script>