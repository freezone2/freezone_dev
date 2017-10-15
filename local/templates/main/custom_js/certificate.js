/**
 * Created by kilanoff on 24.11.16.
 */

$(function () {
    $('.cart-list .index-service-item').each(function () {
        var block = $(this);
        var button = block.find('.get_tariff');
        var tariff = block.data('tariff');

        button.off('click').unbind('click').on('click', function () {

            $('#f_TARIFF_create').val(tariff);
            var tariff_name = block.find('p.title').html().replace('<br>', '').replace('<br/>', '');
            $('#tariff_name_in_window_create').html(tariff_name);

            var tariff_mans = block.data('mans');
            $('#tariff_mans_in_window_create').html(tariff_mans);

            var result_price = block.data('price');

            $('#result_price_create').html(result_price + '.-');

            $('.footer-certificate .footer-info .fstep2 p').html(tariff_name);
        })
    });
});

// both variant
$(document).on('click', '.order-certificate-btn', function () {

    var form = $('#form_params_cert');
    var error = false;
    var str_error_message = '';

    form.find('input[name="name"]').parent().removeClass('error');
    form.find('input[name="email"]').parent().removeClass('error');
    form.find('input[name="phone"]').parent().removeClass('error');

    if (form.find('input[name="name"]').val() == '') {
        error = true;
        form.find('input[name="name"]').parent().addClass('error');
    }
    var email = form.find('input[name="email"]').val();
    if (email == '' || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
        error = true;
        form.find('input[name="email"]').parent().addClass('error');
    }

    if (form.find('input[name="phone"]').val() == '') {
        error = true;
        form.find('input[name="phone"]').parent().addClass('error');
    }

    if (!form.find('#agree2').is(':checked')) {
        error = true;
        str_error_message = 'Нужно подтвердить согласие';
    }

    if (!error) {
        $.post('/local/templates/main/ajax/certificate.php', form.serialize(), function (data) {
            var res = $.parseJSON(data);
            if (res.success) {
                if (res.url) {
                    location.href = res.url;
                }
            } else {
                alert(res.message);
            }
        });
    } else {
        if (str_error_message) {
            alert(str_error_message)
        }
    }
    return false;
});


$(document).on('click', '.activate-cert-btn', function () {

    var form = $('#cert_form');
    var error = false;

    $('#cert_form input[name="code"]').parent().removeClass('error');

    if (form.find('input[name="code"]').val() == '') {
        error = true;
        $('#cert_form input[name="code"]').parent().addClass('error');
    }

    if (!error) {

        $.post('/local/templates/main/ajax/activate.php', $('#cert_form').serialize(), function (data) {
            var res = $.parseJSON(data);
            if (res.success) {

                $('#f_TARIFF').val(res.tariff);
                $('#f_TRUBA').val(res.truba);
                $('#f_PRICE').val(res.price);
                $('#f_PRICE_RESULT').val(res.price);
                $('#f_CERT_HASH').val(res.hash);
                $('#tariff_name_in_window').html(res.tariff_name);
                $('#tariff_mans_in_window').html(res.tariff_mans);
                $('#result_price').html(res.price + '.-');

                $('.activate-cert-btn').parents('.order-step').removeClass('active')
                    .next().addClass('active');

                init_calendar();

                $('.footer-info .active').removeClass('active')
                    .next().addClass('active')
            } else {
                $('#cert_form input[name="code"]').parent().addClass('error');
            }
        });
    }

    return false;
})