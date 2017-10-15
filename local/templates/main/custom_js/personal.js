/**
 * Created by kilanoff on 25.11.16.
 */

$(document).on('click', '#get_report', function(){
    $.post('/local/templates/main/ajax/report.php', {
        'from_date': $('#date_from').val(),
        'to_date': $('#date_to').val()
    }, function(data){
        var res = $.parseJSON(data);
        if (res.success) {
            openThanskFeedback('Выписка', 'На Вашу почту отправлена выписка');
        } else {
            openThanskFeedback('Выписка', 'Ошибка отправки отчета');
        }
    });
    return false;
});

function initCabinetButtons() {


    $('.btn-cancel').on('click', function () {
        var oid = parseInt($(this).data('oid'));
        $('#oid').val(oid);
        $('.cabinet-popup, .cabinet-cancel').addClass('open');
        initCabinetButtons();
        return false
    });

    $('.btn-remove').on('click', function () {
        var oid = parseInt($(this).data('oid'));
        $('#oid').val(oid);
        $('.cabinet-popup, .cabinet-move').addClass('open');
        initCabinetButtons();
        return false
    });

    $('.cabinet-popup .cabinet-cancel .btn-done').unbind('click').on('click', function () {
        var oid = parseInt($('#oid').val());
        $.post('/local/templates/main/ajax/order_cancel.php', {oid: oid}, function(data){
            var res = $.parseJSON(data);
            if (res.success) {
                $('.cabinet-popup, .popup-team, .cabinet-cancel, .cabinet-categories, .cabinet-move').removeClass('open');
                openThanskFeedback('Запрос отмены заказа',
                    'Спасибо. Если до полета менее 24 часов - заказ отменится автоматически и баллы будут возвращены на ваш персональный счет. В противном случае, с вами свяжутся в ближайшее время наши менеджеры для подтверждения отмены.');
            } else {
                alert(res.message);
            }
        });
    });

    $('.cabinet-popup .cabinet-move .btn-done').unbind('click').on('click', function () {
        var oid = parseInt($('#oid').val());
        $.post('/local/templates/main/ajax/order_move.php', {oid: oid}, function(data){
            var res = $.parseJSON(data);
            if (res.success) {
                $('.cabinet-popup, .popup-team, .cabinet-cancel, .cabinet-categories, .cabinet-move').removeClass('open');
                openThanskFeedback('Запрос переноса заказа',
                    'Спасибо. Ваша заявка будет рассмотрена. С вами свяжутся в ближайшее время.');
                $('#oid').val(0);
            } else {
                alert(res.message);
                $('#oid').val(0);
            }
        });
    });
}

function reloadCabinetReportTable() {
    var flag = $('#date_filter').val();
    if (flag == 0) {
        $('#date_filter').val(1);
        $.post('/local/templates/main/ajax/cabinet.php', {
            from: $('#date_from').val(),
            to: $('#date_to').val()
        }, function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                $('#history_cabinet_orders').html(res.content);

                initCabinetButtons();

                $('#sum_price').html(res.sum_price);
                $('#sum_time').html(res.sum_time);

                $('.info_dp_out').html(res.info);

                $('#date_filter').val(0);
            } else {
                alert(res.message);
            }
        })
    }
}