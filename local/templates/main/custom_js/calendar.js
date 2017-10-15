/**
 * Created by kilanoff on 01.11.16.
 */

function change_trainer_category(select) {
    var value_obj = $(select).find('option:selected');
    var price = parseInt($('#f_PRICE').val());
    var nacenka = parseInt(value_obj.data('price'));
    $('.open-thank-order span').html(parseInt(price + nacenka) + '.-');
    $('#f_TRAINER_CATEGORY').val(value_obj.val());
	
    $('#f_PRICE_RESULT').val(parseInt(price + nacenka))
}

function init_calendar() {
    $('#loading').show();
    $('#calendar').empty();
	
	
	if ($('#f_PERSONE_TYPE').val() != 25) {
		$('html').addClass("html-calendar");
	}

    $('#trainer_cat').val(0).trigger("change");

    $.post('/local/templates/main/ajax/calendar.php', $('#form_params').serialize(), function (data) {
        var res = $.parseJSON(data);
        if (res.success) {

            $('#calendar').html(res.content);

            if (typeof res.price != 'undefined' && res.price > 0) {
                $('#f_PRICE').val(parseInt(res.price));
                $('.open-thank-order span').html(parseInt(res.price) + '.-');
            }

            $('.order-time-in').removeData("flexslider");

            $('.footer-order .footer-info li').removeClass('active');
            $('.footer-order .footer-info li:eq(3)').addClass('active');

            
			$('.order-time-in').flexslider({
                animation: "slide",
                itemWidth: 120,
                slideshow: false,
                animationLoop: false,
                itemMargin: 10,
                start: function () {
                    $('.order-time-in .slides > li').each(function (i) {
                        var pos = $(this).offset().left - $(this).parents('.order-time-in').offset().left;
                        if (pos == 0) {
                            $('.order-step.active').find('.order-time-top p span').text($(this).data('date'))
                        }
                    });
                },
                after: function () {

                    $('.order-time-in .slides > li').each(function (i) {
                        moment.locale('ru')
                        var pos = $(this).offset().left - $(this).parents('.order-time-in').offset().left;
                        if (pos == 0) {
                            $('.order-step.active').find('.order-time-top .news-date .icon-calendar')
                                .next().text($(this).data('date'))
                            $('.mounts-list li').removeClass('active').eq($(this).data('month') - 1).addClass('active')
                        }
                    });
                }
            });

            popupDate();
            navOrder2();


            // Prof Variant
            $('.order-component .order-time-list li').off('click');
            $('.order-component .order-time-list li.free').on('click', function () {
				
				//множественное бронирование
				if ($(this).hasClass("booked")) {
				  $(this).removeClass("booked");
				  if (!$(".booked").length) {
					 $("#multiple-booking").css("display", "none");	 
				  }
				  
				} else {
				  $(this).addClass("booked");
				  $("#multiple-booking").css("display", "inline-block");			  
				}
				

				/*
				//бронирование по 15 мин
				$('html').removeClass("html-calendar");
                var li = $(this);

                $.post('/local/templates/main/ajax/load_time_tariff_price.php', {
                    time_tariff: li.data('time_tariff'),
                    is_night: li.data('is_night') == 1 ? 1 : 0,
                    type: $('#f_TYPE').val(),
                    personal_type: $('#f_PERSONE_TYPE').val()
                }, function(data){
                    var res = $.parseJSON(data);
                    if (res.success) {
                        $('#f_PRICE').val(res.price);
                        $('#f_PRICE_RESULT').val(res.price);
                        $('.open-thank-order span').html(parseInt(res.price) + '.-');

                        $('#order_date_name').html(li.data('datename'));
                        $('#order_time_name').html(li.data('timename'));

                        $('#f_ORDER_DAY').val(li.data('fulldate'));
                        $('#f_ORDER_TIME').val(li.data('timename'));

                        var tmp = li.data('timename');
                        tmp = tmp.replace(':', '<i>');
                        tmp = tmp.replace(':', '<i>');
                        tmp = tmp.replace(' – ', '</i>-');
                        tmp += '</i>';

                        var datetmp = li.data('fulldate').split('-');
                        datetmp = datetmp[2] + '.' + datetmp[1];

                        $('#fstep4 p').html(datetmp + ' ' + tmp);

                        nextStep(li, true);                        
                    } else {
                        alert(res.message);
                    }
                });
				*/
                

            });
			$("#multiple-booking").on('click', function () {
				alert("Сервис временно не доступен");
			});

            // User Variant
            $('.order-user .order-time-list li').off('click');
            $('.order-user .order-time-list li.free').on('click', function () {
                var li = $(this);
				$('html').removeClass("html-calendar");
                $.post('/local/templates/main/ajax/load_time_tariff_price.php', {
                    time_tariff: li.data('time_tariff'),
                    is_night: li.data('is_night') == 1 ? 1 : 0,
                    type: $('#f_TYPE').val(),
                    personal_type: $('#f_PERSONE_TYPE').val()
                }, function(data) {
                    var res = $.parseJSON(data);
                    if (res.success) {

                        $('#f_PRICE').val(res.price);
                        $('#f_PRICE_RESULT').val(res.price);
                        $('.open-thank-order span').html(parseInt(res.price) + '.-');

                        $('#f_ORDER_DAY').val(li.data('fulldate'));
                        $('#f_ORDER_TIME').val(li.data('timename'));

                        var tmp = li.data('timename');
                        tmp = tmp.replace(':', '<i>');
                        tmp = tmp.replace(':', '<i>');
                        tmp = tmp.replace(' – ', '</i>-');
                        tmp += '</i>';

                        var datetmp = li.data('fulldate').split('-');
                        datetmp = datetmp[2] + '.' + datetmp[1];

                        $('#fstep4 p').html(datetmp + ' ' + tmp);

                        nextStep(li, true);
                    }
                });
            });


            // both variant
            $('.open-thank-order').off('click').on('click', function (e) {
                e.preventDefault();
				$('html').removeClass("html-calendar");
                var form = $('#form_params');
                var error = false;
                if (typeof current_person_type != 'undefined') {
                    if (form.find('#f_PERSONE_TYPE').val() == current_person_type) {

                        form.find('input[name="name"]').parent().removeClass('error');
                        form.find('input[name="email"]').parent().removeClass('error');
                        form.find('input[name="phone"]').parent().removeClass('error');
                        $('#agree_label').css('border-bottom', 'none');

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

                        if (!form.find('#agree').is(':checked')) {
                            error = true;
                            $('#agree_label').css('border-bottom', '2px solid red');
                        }
                    }
                }

                if (!error) {
                    // certificate
                    if (form.find('input[name="CERT_HASH"]').length && form.find('input[name="CERT_HASH"]').val() != '') {
                        $.post('/local/templates/main/ajax/order.php', form.serialize(), function (data) {
                            var res = $.parseJSON(data);
                            if (res.success) {

                                $('.popup, .popup-thank').show().addClass('open');
                                $('.header').css('z-index', "50");

                                form.find('input[name="name"]').val('');
                                form.find('input[name="email"]').val('');
                                form.find('input[name="phone"]').val('');
                                form.find('input[name="TARIFF"]').val('');

                                openThanskFeedback(res.title, res.message, true);
                            } else {
                                openThanskFeedback('Ошибка оплаты', res.message, false);
                            }
                        });

                        // order
                    } else {
                        
                        var user_persone = form.find('input[name="PERSONE_TYPE"]').val();
                        if (user_persone == PERSONE_TYPE_PROF) {

                            $.post('/local/templates/main/ajax/order.php', form.serialize(), function (data) {
                                var res = $.parseJSON(data);
                                if (res.success) {
                                    $('.popup, .popup-thank').show().addClass('open');
                                    $('.header').css('z-index', "50");

                                    form.find('input[name="name"]').val('');
                                    form.find('input[name="email"]').val('');
                                    form.find('input[name="phone"]').val('');
                                    form.find('input[name="TARIFF"]').val('');

                                    setTimeout(function(){
                                        location.reload();
                                    }, 3000);
                                } else {
                                    openThanskFeedback('Ошибка оплаты', res.message, false);
                                }
                            });                            
                            
                        }  else if (user_persone == PERSONE_TYPE_USER) {
                            
                            $.post('/local/templates/main/ajax/guest_pre_order.php', form.serialize(), function (data) {
                                var res = $.parseJSON(data);
                                if (res.success) {
                                    if (res.url) {
                                        var redirect_url = res.url;
    
                                        $.post('/local/templates/main/ajax/order.php', form.serialize(), function (data) {
                                            var res = $.parseJSON(data);
                                            if (res.success) {
                                                location.href = redirect_url;
                                            } else {
                                                openThanskFeedback('Ошибка оплаты', res.message, false);
                                            }
                                        });
                                    }
                                } else {
                                    alert(res.message);
                                }
                            });
                        }
                    }

                }
                return false;
            });


            $('#loading').hide();
            $('#calendar').show();


        } else {
            alert(res.message);
        }
    })
}

// callback for LI.selection-couple
function previewDouplePopup(li) {
    if ($('.order-step-3').hasClass('active')) {
        return;
    }

    var params = {
        ch: li.data('ch'),
        cm: li.data('cm'),
        eh: li.data('eh'),
        em: li.data('em'),
        date: li.data('fulldate'),
        truba: $('#selector_truba li.active').data('truba'),
        ptype: $('#f_PERSONE_TYPE').val()
    };

    if (li.data('oid')) {
        params['oid'] = li.data('oid');
    }

    $.post('/local/templates/main/ajax/order_info.php', params, function (data) {
        var res = $.parseJSON(data);
        if (res.success) {
            $('#busy_time').html(res.status_text + '<br>' + res.work_time);

            $('#busy_trainer_block').show();
            $('#busy_trainer').html(res.trainer_cat_text);
            if (res.trainer_cat_text == '') {
                $('#busy_trainer_block').hide();
            }

            $('#busy_mans').html(res.mans_text);
            $('#busy_timelength').html(res.timelenght_text);
            $('#busy_price').html(res.price + '.-');

            if ($('.order-step-3').hasClass('active')) {
                return;
            }

            $('.popup, .popup-selection').show().addClass('open');
        } else {
            alert(res.message);
        }
    });
}

function previewFreePopup(li) {

    if ($('.order-step-3').hasClass('active')) {
        return;
    }
    $('.popup-selection, .popup').hide().removeClass('open');
    $('.popup').removeClass('no-style');


    $.post('/local/templates/main/ajax/free_order_info.php', {
        ch: li.data('ch'),
        cm: li.data('cm'),
        eh: li.data('eh'),
        em: li.data('em'),
        type: $('#f_TYPE').val(),
        date: li.data('fulldate'),
        timelength: $('#f_TIMELENGTH').val(),
        timelength_block: $('#f_TIMELENGTH_BLOCK').val(),
        truba: $('#f_TRUBA').val(),
        time_tariff: parseInt(li.data('time_tariff')),
        is_night: (li.data('is_night') == 1 ? 1 : 0),
        ptype: li.data('ptype')
    }, function (data) {
        var res = $.parseJSON(data);
        if (res.success) {
            $('#busy_time').html(res.status_text + '<br>' + res.work_time);

            $('#busy_trainer_block').show();
            $('#busy_trainer').html(res.trainer_cat_text);
            if (res.trainer_cat_text == '') {
                $('#busy_trainer_block').hide();
            }
            if (res.mans_text) {
                $('#busy_mans').html(res.mans_text);
                $('#mans_block_info').show();
            } else {
                $('#mans_block_info').hide();
            }
            if (!res.timelenght_text) {
                $('#timelength_li').hide();
            } else {
                $('#timelength_li').show();
            }
            $('#busy_timelength').html(res.timelenght_text);
            $('#busy_price').html(res.price + '.-');

            if (!li.data('time_tariff')) {
                li.data('time_tariff', res.id);
                console.log('set', li.data('time_tariff'))
            }

            if ($('.order-step-3').hasClass('active')) {
                return;
            }
            $('.popup').addClass('no-style');
            $('.popup-selection, .popup').show().addClass('open');
        } else {
            alert(res.message);
        }
    });
}