/**
 * Created by kilanoff on 24.11.16.
 */

function filter_month(way) {
    var val = $('input[name="filter_month_date"]').val();
    var date = val.split('-');
    var m = date[1];
    var y = date[0];
    var new_date = '';

    if (typeof way == 'undefined') {
        new_date = moment().format('YYYY-MM-DD');
    } else if (way == 'left') {
        new_date = (moment(y + m + "01", "YYYYMMDD").subtract(1, 'months').format('YYYY-MM-DD'));
    } else {
        new_date = (moment(y + m + "01", "YYYYMMDD").add(1, 'months').format('YYYY-MM-DD'));
    }

    $('input[name="filter_month_date"]').val(new_date);

    $.post('/local/templates/main/ajax/admin_calendar_month.php', {
        date: new_date
    }, function (data) {
        var res = $.parseJSON(data);
        if (res.success) {
            $('#content-month').html(res.content);
            $('#period_name').html(res.month_name);

            init_popups_calendar();
        } else {
            alert(res.message);
        }
    })
}

function filter_week(way, length) {
    var val = $('input[name="filter_week_date"]').val();
    var date = val.split('-');
    var m = date[1];
    var y = date[0];
    var d = date[2];
    var new_date = '';

    var add = 1;
    var add_word = 'w';

    var content_id = 'content-week';
    if (typeof length != 'undefined') {
        content_id = 'content-day';
        length = 2;
        add = 2;
        add_word = 'd'
    } else {
        length = 7;
        add = 1;
        add_word = 'w';
    }

    if (typeof way == 'undefined') {
        new_date = moment(y + m + d, "YYYYMMDD").format('YYYY-MM-DD');
    } else if (way == 'left') {
        new_date = (moment(y + m + d, "YYYYMMDD").subtract(add, add_word).format('YYYY-MM-DD'));
    } else {
        new_date = (moment(y + m + d, "YYYYMMDD").add(add, add_word).format('YYYY-MM-DD'));
    }

    if (length == 7) {
        $("#content-week #time_list_week").hide();
    } else {
        $("#content-day #time_list_week").hide();
    }

    $('input[name="filter_week_date"]').val(new_date);

    var person = 0;
    if ($('#filter_person button.active').length == 1) {
        person = $('#filter_person button.active').data('val');
    }

    $.post('/local/templates/main/ajax/admin_calendar_week.php', {
        date: new_date,
        truba: $('#filter_truba button.active').data('val'),
        person: person,
        type_and_category: $('#filter_category input:checked').val(),
        length: length
    }, function (data) {
        var res = $.parseJSON(data);
        if (res.success) {
            $('#' + content_id).html(res.content);
            $('#period_name').html(res.period_name);

            var top = 0;
            if (length == 7) {
                top = $("#content-week .cabinet-calendar-week tbody tr:first td").height();
                $("#content-week #time_list_week").css("top", top + 22).fadeIn("fast");
            } else {
                top = $("#content-day .cabinet-calendar-week tbody tr:first td").height();
                $("#content-day #time_list_week").css("top", top + 22).fadeIn("fast");
            }

            init_popups_calendar();
        } else {
            alert(res.message);
        }
    })
}

function filter_day(way) {
    filter_week(way, 2);
}

function init_big_calendar_select_times(content) {

    if (typeof content != 'undefined') {
        console.log(content);
        $(".select-time select").html(content);
    }

    $(".select-time select").select2({
        dropdownCssClass: "select-time"
    }).on('change', function () {
        console.log("text:" + $(this).find(':selected').text());
        console.log("value:" + $(this).find(':selected').val());
    });
}

function initPopupButtons() {
    $('.btn-close-reg').unbind('click').on('click', function () {
        var btn = $(this);
        var oid = parseInt(btn.data('oid'));

        $.post('/local/templates/main/ajax/admin_close_reg.php', {oid: oid}, function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                alert('Регистрация закрыта');
            } else {
                alert(res.message);
            }
        })
    });
    
    // удаление
    $('.delete-order').unbind('click').on('click', function () {
        if (confirm('Действительно удалить эту запись?')) {
            var oid = parseInt($(this).data('oid'));
            $.post('/local/templates/main/ajax/admin_load_remove_flight.php', {oid: oid}, function (data) {
                var res = $.parseJSON(data);
                if (res.success) {
                    $('.popup-calendar-overlay').click();
                    $('.change-preview .btn.active').click();
                } else {
                    alert(res.message);
                }
            })
        }
    });

    // перенос 
    $('.open-change-popup').unbind('click').on('click', function () {
        $('.calendar-popup2, .calendar-popup1, .calendar-popup3').hide().empty();
        var oid = parseInt($(this).data('oid'));
        $.post('/local/templates/main/ajax/admin_load_move_calendar.php', {oid: oid}, function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                var oid = res.oid;
                $('.popup-calendar-overlay').show();
                $('.calendar-popup3').html(res.content).fadeIn();

                $('#date-range').dateRangePicker({
                    autoClose: true,
                    singleDate: true,
                    showShortcuts: false,
                    inline: true,
                    container: '#date-range-container',
                    alwaysOpen: true,
                    setValue: function (s) {

                        $('#date-range').val(s);

                        var truba = parseInt($('#filter_truba .btn.active').data('val'));
                        var person_type = 0;
                        if ($('#filter_person .btn.active').length == 1) {
                            person_type = parseInt($('#filter_person .btn.active').data('val'));
                        }
                        var type_tmp = $('#filter_category input:checked').val();
                        var type = '';
                        if (type_tmp) {
                            type_tmp = type_tmp.split(';');
                            type = type_tmp[0];
                        }

                        $.post('/local/templates/main/ajax/admin_load_times.php', {
                            date: s,
                            oid: oid,
                            truba: truba,
                            type: type,
                            person_type: person_type
                        }, function (data) {
                            var res = $.parseJSON(data);
                            if (res.success) {
                                var $example = $(".select-time select").select2();
                                $example.select2("destroy");

                                init_big_calendar_select_times(res.content);
                            } else {
                                alert(res.message);
                            }
                        })
                    }
                });

                init_big_calendar_select_times();

                $('.calendar-popup3 .move-btn').unbind('click').on('click', function () {
                    var oid = $.parseJSON($(this).data('oid'));
                    var date = $('#date-range').val();
                    var time =  $(".select-time select").val();

                    var error = false;
                    if (!date || !time) {
                        error = true;
                    }

                    if (!error) {
                        $.post('/local/templates/main/ajax/admin_move_process.php', {
                            oid: oid,
                            date: date,
                            time: time
                        }, function (data) {
                            var res = $.parseJSON(data);
                            if (res.success) {
                                $('.popup-calendar-overlay').click();
                                $('.change-preview .btn.active').click();
                            } else {
                                alert(res.message);
                            }
                        });
                    } else {
                        alert('Нужно выбрать дату и время для переноса заказа');
                    }
                })
            } else {
                alert(res.message);
            }
        })
    });
}

function init_popups_calendar() {
    //$('.cabinet-calendar-content li.order_bl').unbind('click').on('click', function () {
	$('.cabinet-calendar-content .order_bl').unbind('click').on('click', function () {
        $('.calendar-popup2, .calendar-popup1, .calendar-popup3').hide().empty();
        var order_bl = $(this);
        var oid = parseInt(order_bl.data('order_id'));
        $.post('/local/templates/main/ajax/admin_load_order_bl_info.php', {
            oid: oid
        }, function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                if (res.type_is_one) {
                    $('.calendar-popup2').html(res.content);
                    $('.calendar-popup2').fadeIn();
                } else {
                    $('.calendar-popup1').html(res.content);
                    $('.calendar-popup1').fadeIn();
                    var class_name = order_bl.data('class');
                    $('.' + class_name).addClass('active');
                }

                $('.popup-calendar-overlay').show();

                initDropToggler();

                initPopupButtons();
            } else {
                alert(res.message);
            }
        })
    });


    $('.popup-calendar-overlay').unbind('click').on('click', function () {
        $('.calendar-popup2, .calendar-popup1, .calendar-popup3').fadeOut();
        $('.popup-calendar-overlay').hide();
        $('li.order_bl').removeClass('active')
    })
}


$(function () {
    $('#filter_person .btn').on('click', function () {

        var val = $(this).data('val');
        $('.radio.filtering').hide();
        if (val == 24) {
            $('.radio.filtering[data-ptype="24"]').show();
        } else {
            $('.radio.filtering[data-ptype="25"]').show();
        }

        $('.btn_all_persons').removeClass('active');


        $(this).addClass('active').siblings().removeClass('active');
        $('#content-month, #content-day, #content-week').html('Загрузка...');
        var type = $('.change-preview button.active').data('for-type');
        if (type == 'month') {
            filter_month();
        } else if (type == 'week') {
            filter_week();
        } else if (type == 'day') {
            filter_day();
        }
    });

    $('#filter_truba .btn').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('#content-month, #content-day, #content-week').html('Загрузка...');
        var type = $('.change-preview button.active').data('for-type');
        if (type == 'month') {
            filter_month();
        } else if (type == 'week') {
            filter_week();
        } else if (type == 'day') {
            filter_day();
        }
    });

    $('#filter_category .radio span').on('click', function () {

        $('#filter_category input').attr('checked', false).prop('checked', false);
        $(this).parent().find('input').attr('checked', true).prop('checked', true);
        $('#content-month, #content-day, #content-week').html('Загрузка...');
        var type = $('.change-preview button.active').data('for-type');
        if (type == 'month') {
            filter_month();
        } else if (type == 'week') {
            filter_week();
        } else if (type == 'day') {
            filter_day();
        }
    });

    $('.change-preview button').on('click', function () {
        var but = $(this);
        var type = but.data('for-type');

        $('.change-preview button').removeClass('active');

        but.addClass('active');

        $('#period_name').html('');

        // $('.cabinet-calendar-item').html('Загрузка...');
        $('#content-month, #content-day, #content-week').html('Загрузка...');

        if (type == 'month') {
            filter_month();
        } else if (type == 'week') {
            filter_week();
        } else if (type == 'day') {
            filter_day()
        }
    });

    $('.nav-calendar').each(function () {
        var nav = $(this);

        nav.find('.btn-prev').on('click', function () {
            var type = $('.change-preview button.active').data('for-type');
            $('#content-month, #content-day, #content-week').html('Загрузка...');
            if (type == 'month') {
                filter_month('left');
            } else if (type == 'week') {
                filter_week('left');
            } else if (type == 'day') {
                filter_day('left');
            }
        });

        nav.find('.btn-next').on('click', function () {
            var type = $('.change-preview button.active').data('for-type');
            $('#content-month, #content-day, #content-week').html('Загрузка...');
            if (type == 'month') {
                filter_month('right');
            } else if (type == 'week') {
                filter_week('right');
            } else if (type == 'day') {
                filter_day('right');
            }
        })
    });

    filter_month();
})