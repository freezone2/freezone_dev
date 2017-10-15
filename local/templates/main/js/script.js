function initMastheadSlider() {
    $('.index-masthead').flexslider({
        animation: "fade",
        slideshowSpeed: 4000

    });
};

function showNext(index, d, s) {
    if (!!$('.section').eq(index - 1).find('.show-tab').length) {
        if (!$('.section').eq(index - 1).find('.show-tab').find('.drop-item').last().hasClass('active')) {
            if ($('.section').eq(index - 1).find('.show-tab').find('.drop-item').last().hasClass('active')) {
                $('.section').eq(index - 1).find('.show-tab').find('.drop-item').removeClass('active hide')
                    .first().addClass('active');
            }
            else {
                $('.section').eq(index - 1).find('.show-tab').find('.drop-item.active').removeClass('active').addClass('hide')
                    .next().addClass('active');
            }
        }
        else {
            if (s) {
                $.fn.fullpage.moveTo(index + 1);
            }
            else {
                $('.section').eq(index - 1).find('.show-tab').find('.drop-item').removeClass('active hide')
                    .first().addClass('active');
            }
        }
    }
    else {
        if (!$('.section').eq(index - 1).find('.drop-item').last().hasClass('active')) {
            if ($('.section').eq(index - 1).find('.drop-item').last().hasClass('active')) {
                $('.section').eq(index - 1).find('.drop-item').removeClass('active hide')
                    .first().addClass('active');
            }
            else {
                $('.section').eq(index - 1).find('.drop-item.active').removeClass('active').addClass('hide')
                    .next().addClass('active');
            }
        }
        else {
            if (s) {
                $.fn.fullpage.moveTo(index + 1);
            }
            else {
                $('.section').eq(index - 1).find('.drop-item').removeClass('active hide')
                    .first().addClass('active');
            }
        }
    }


    /*if (!$('.section').eq(index - 1).find('.show-tab').find('.drop-item').last().hasClass('active')) {
     if($('.section').eq(index - 1).find('.show-tab').find('.drop-item').last().hasClass('active')){
     $('.section').eq(index - 1).find('.show-tab').find('.drop-item').removeClass('active hide')
     .first().addClass('active');
     }
     else{
     $('.section').eq(index - 1).find('.show-tab').find('.drop-item.active').removeClass('active').addClass('hide')
     .next().addClass('active');
     }
     }
     else{
     if(s){
     $.fn.fullpage.moveTo(index+1);
     }
     else{
     $('.section').eq(index - 1).find('.show-tab').find('.drop-item').removeClass('active hide')
     .first().addClass('active');
     }
     }*/
}

function showPrev(index, s) {
    if (!!$('.section').eq(index - 1).find('.show-tab').length) {
        if (!!$('.section').eq(index - 1).find('.show-tab').find('.drop-item.hide').length) { // not has hide
            $('.section').eq(index - 1).find('.show-tab').find('.drop-item.hide')
                .last().removeClass('hide').addClass('active')
                .next().removeClass('active')
        }
        else {
            if (s) {
                $.fn.fullpage.moveTo(index - 1);
                return false
            }
        }
    }
    else {
        if (!!$('.section').eq(index - 1).find('.drop-item.hide').length) { // not has hide
            $('.section').eq(index - 1).find('.drop-item.hide').last().removeClass('hide').addClass('active')
                .next().removeClass('active')
        }
        else {
            if (s) {
                $.fn.fullpage.moveTo(index - 1);
            }
        }
    }

}
function addVideo(url) {
    $('.video-in').attr('src', '')
    if ($('.video-in').parent().prev().hasClass('active')) {
        $('.video-in').attr('src', url)
    }

    else {
        if ($('.video-in').parent().hasClass('active')) {
            $('.video-in').attr('src', url)
        }
        else {
            $('.video-in').attr('src', '')
        }
    }
}


var catalogIndex = false;
function initFullPage() {
    var isVisite = false;
    var toScroll = false;
    var isAmin = true;
    var videoUrl = $('.video-in').attr('src');

    $('.nav-fullpage li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active')
        isVisite = $('.section.active').hasClass('has-drop');
        $.fn.fullpage.moveTo($(this).index() + 2);
        isVisite = false;
        return false
    });
    if (!!$('.content-full').length) {
        $('.content-full').fullpage({
            verticalCentered: false,
            resize: true,
            scrollingSpeed: 300,
            css3: false,
            //scrollOverflow: false,
            scrollOverflow: false,
            //scrollOverflowOptions: {
            //  scrollbars: false,
            //  mouseWheel: true,
            //  hideScrollbars: false,
            //  fadeScrollbars: false,
            //  disableMouse: true
            //},
            afterSlideLoad: function (anchorLink, index, slideAnchor, slideIndex) {
                $('.slider-nav li').removeClass('active').eq(slideIndex).addClass('active')

            },
            onLeave: function (index, nextIndex, direction) {
                if (nextIndex == 1) {
                    $('.burger').removeClass('open');
                    $('.header-nav').removeClass('show')
                    $('.content').removeClass('blur-bg')
                }
                hideFeedback();
                $('body').removeClass('show-popup-top show-popup-top');
                $('.sing-in, .recover-pass, .thank').slideUp();
                $('.recover-pass, .sing-in').removeClass('to-fixed');
                setTimeout(function () {
                    $('.recover-pass, .sing-in').removeClass('to-fixed');
                }, 1000)
                $('.header-log-in span').text("Войти")
                if ($('.section').eq(index - 1).hasClass('equipment-history')) {

                    if (isAmin) {
                        isAmin = false
                        setTimeout(function () {
                            isAmin = true
                        }, 2000)
                        if (direction == 'down') {
                            if (!$('.section').eq(index - 1).find('.tab-menu li').last().hasClass('active')) {
                                $('.section').eq(index - 1).find('.tab-menu .active').next().trigger('click')
                                return false
                            }
                            isAmin = true
                            return isAmin
                        }
                        if (direction == 'up') {
                            if (!$('.section').eq(index - 1).find('.tab-menu li').first().hasClass('active')) {
                                $('.section').eq(index - 1).find('.tab-menu .active').prev().trigger('click')
                                return false
                            }
                        }
                    }
                    else {
                        return false
                    }
                }

                if ($('.section').eq(index - 1).hasClass('has-drop')) {
                    if (!isVisite) {

                        if (isAmin) {
                            isAmin = false
                            setTimeout(function () {
                                isAmin = true
                            }, 2000)
                            if (direction == 'down') {
                                if (!!$('.section:eq(' + (index - 1) + ')').find('.show-tab').length) {
                                    if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item').last().hasClass('active')) {
                                        globalStop = $('.section').eq(index).hasClass('empty');
                                        return !$('.section').eq(index).hasClass('empty');
                                    }
                                }
                                else {
                                    if ($('.section:eq(' + (index - 1) + ') .drop-item').last().hasClass('active')) {
                                        globalStop = $('.section').eq(index).hasClass('empty');
                                        return !$('.section').eq(index).hasClass('empty');
                                    }
                                }
                                addVideo(videoUrl)
                                showNext(index, direction, true);
                            } else if (direction == 'up') {
                                catalogIndex--;
                                if (!!$('.section:eq(' + (index - 1) + ')').find('.show-tab').length) {
                                    if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item').first().hasClass('active')) {
                                        catalogIndex = false;
                                        globalStop = false;
                                        return true;
                                    }
                                }
                                else {
                                    if ($('.section:eq(' + (index - 1) + ') .drop-item').first().hasClass('active')) {
                                        catalogIndex = false;
                                        globalStop = false;
                                        return true;
                                    }
                                }
                                addVideo(videoUrl)
                                showPrev(index, direction, true)
                            }
                        }
                        else {
                            return false
                        }
                    }
                } else {
                    $('.section:eq(' + (index - 1) + ') .drop-item').removeClass('active').removeClass('hide');
                    catalogIndex = false;
                }
                return isAmin
                if (index == 1) {
                    $('.header').addClass('header-hide')
                }
            },
            afterLoad: function (anchorLink, index) {
                addVideo(videoUrl)
                $('.header').removeClass('header-hide');
                if ($('body').find('.nav-fullpage').length) {
                    $('.nav-fullpage li').removeClass('active').eq(index - 2).addClass('active');
                    if (index != 1) {
                        $('.nav-fullpage').fadeIn();
                    }
                    else {
                        $('.nav-fullpage').hide();
                    }
                }
                if (index != 1) {
                    if (index >= 3) {
                        $('.footer').addClass('hide-line');
                    }
                    else {
                        $('.footer').removeClass('hide-line');
                    }
                    $('.header').addClass('header-dark header-min').removeClass('header-regular');
                    $('.footer').addClass('footer-dark');
					$('#fp_next').removeClass('wt');
					$('#fp_prev').removeClass('wt');
					$('#fp_prev').show();
					if (index === $('.fullpage-wrapper .section').length) {
						$('#fp_next').hide();
					} else {
						$('#fp_next').show();
					}
                }
                else {
                    $('.header').removeClass('header-dark header-min').addClass('header-regular');
                    $('.footer').removeClass('footer-dark');
					//mobile styles by icmark
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					 $('.header').addClass('header-min').removeClass('header-regular');
					}
					$('#fp_next').addClass('wt');
					$('#fp_prev').addClass('wt');
					$('#fp_prev').hide();
                }
            }
        })
    }

    if (!!$('.certificate-full').length) {
        $('.certificate-full').fullpage({
            verticalCentered: false,
            resize: true,
            scrollingSpeed: 700,
            css3: false,
            scrollOverflow: false,
            afterSlideLoad: function (anchorLink, index, slideAnchor, slideIndex) {
                $('.header').removeClass('header-dark');

                if (slideIndex == 0) {
                    $('.footer-left').addClass('to-fixed').find('.footer-info li').removeClass('active').eq(1).addClass('active');
                    $('.header').addClass('header-dark')
                }
                if (slideIndex == 2) {
                    $('.footer-right').addClass('to-fixed').find('.footer-info li').removeClass('active').eq(1).addClass('active');
                }
                if ($('.slide.active').hasClass('slide-sportsmen')) {
                    $('.header').removeClass('header-orders').addClass('header-certificate')
                }
            },
            onLeave: function (index, nextIndex, direction) {
                hideFeedback()
                $('body').removeClass('show-popup-top show-popup-top');
                $('.sing-in, .recover-pass, .thank').slideUp();
                $('.header-log-in span').text("Войти")
                setTimeout(function () {
                    $('.recover-pass, .sing-in').removeClass('to-fixed');
                }, 1000)
                if ($('.slide.active').hasClass('has-drop')) {
                    if (!isVisite) {
                        globalStop = true;
                        if (catalogIndex === false) {
                            //$('.section:eq('+(index-1)+') .drop-item').removeClass('active').removeClass('hide');
                            //if (nextIndex > index) {
                            //  catalogIndex = 0;
                            //  $('.section:eq('+(index-1)+') .drop-item').first().addClass('active');
                            //} else {
                            //  catalogIndex = $('.section.active  .drop-item').length-1;
                            //  $('.section:eq('+(index-1)+') .drop-item').addClass('hide')
                            //    .last().addClass('active').removeClass('hide');
                            //}
                            //console.log('slide catalog '+catalogIndex);
                        }
                        //if (catalogIndex !== false) {
                        if (direction == 'down') {
                            catalogIndex++;
                            if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item').last().hasClass('active')) {
                                $('.section:eq(' + (index - 1) + ') .show-tab .drop-item').removeClass('active hide').first().addClass('active').removeClass('hide')
                                catalogIndex = false;
                                globalStop = false;
                                return false;
                            }
                            setTimeout(function () {
                                isVisite = false;
                            }, 1000)
                            isVisite = true
                            addVideo(videoUrl);
                            showNext(index, direction, false)


                        } else if (direction == 'up') {
                            if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item').first().hasClass('active')) {
                                $('.section:eq(' + (index - 1) + ') .show-tab .drop-item').addClass('hide')
                                $('.section:eq(' + (index - 1) + ') .show-tab .drop-item').removeClass('active').last().addClass('active').removeClass('hide')
                                catalogIndex = false;
                                globalStop = false;
                                return false;
                            }
                            setTimeout(function () {
                                isVisite = false;
                            }, 1000)
                            isVisite = true
                            addVideo(videoUrl)
                            showPrev(index, direction, false)
                        }
                        //console.log('slide catalog '+catalogIndex);
                        return false;
                    }
                    //}
                }
                return false


            },
            afterLoad: function (anchorLink, index) {
                addVideo(videoUrl);
                $('.header').removeClass('header-hide');
                if ($('body').find('.nav-fullpage').length) {
                    $('.nav-fullpage li').removeClass('active').eq(index - 2).addClass('active');
                    if (index != 1) {
                        $('.nav-fullpage').fadeIn();
                    }
                    else {
                        $('.nav-fullpage').hide();
                    }
                }
                if (index != 1) {
                    if (index >= 3) {
                        $('.footer').addClass('hide-line');
                    }
                    else {
                        $('.footer').removeClass('hide-line');
                    }
                    $('.header').addClass('header-dark header-min').removeClass('header-regular');
                    $('.footer').addClass('footer-dark');
                }
                else {
                    $('.header').removeClass('header-dark header-min').addClass('header-regular');
                    $('.footer').removeClass('footer-dark');
                }
            },
            afterRender: function () {
                var hasUrl = window.location.hash;
                window.location.href.split('#')[0]
                if (hasUrl == "#left") {
                    $.fn.fullpage.moveSlideLeft();

                    $('#fstep1 p').html('Любители');
                    $('#fstep3 p').html('15 минут');

                    $('.calendar_footer').show();
                    $('.normal_footer').remove();
                    $('.footer-order').show().addClass('to-fixed');

                    $('.footer-order .footer-info li:eq(2)').addClass('disabled');

                    $('.footer-order .footer-info li:first').on('click', function () {
                        location.href = $(this).data('url');
                        return false;
                    })
                }
                if (hasUrl == "#right") {
                    $.fn.fullpage.moveSlideRight();
                }
			$.fn.fullpage.setAllowScrolling(false, 'left, right');
            }
        })
    }

    /*if (!!$('.cabinet-full').length) {
     $('.cabinet-full').fullpage({
     verticalCentered: false,
     resize: true,
     scrollingSpeed: 700,
     css3: false,
     scrollOverflow: false,
     onLeave: function (index, nextIndex, direction) {
     if ($('.section').eq(index - 1).hasClass('has-drop')) {
     if (!isVisite) {
     globalStop = true;
     if (direction == 'down') {
     catalogIndex++;
     if (!!$('.section:eq(' + (index - 1) + ')').find('.show-tab').length) {
     if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item')
     .last().hasClass('active')) {
     catalogIndex = false;
     globalStop = false;
     return false;
     }
     }
     else {
     if ($('.section:eq(' + (index - 1) + ') .drop-item').last().hasClass('active')) {
     catalogIndex = false;
     globalStop = false;
     return false;
     }
     }
     showNext(index, direction, true)

     } else if (direction == 'up') {
     catalogIndex--;
     if (!!$('.section:eq(' + (index - 1) + ')').find('.show-tab').length) {
     if ($('.section:eq(' + (index - 1) + ') .show-tab .drop-item').first().hasClass('active')) {
     catalogIndex = false;
     globalStop = false;
     return false;
     }
     }
     else {
     if ($('.section:eq(' + (index - 1) + ') .drop-item').first().hasClass('active')) {
     catalogIndex = false;
     globalStop = false;
     return false;
     }
     }
     showPrev(index, direction, true)
     }
     return false;
     }
     }
     return false;
     }
     })
     }*/

}

function togglerMenu() {
    $('.burger').on('click', function () {
        $(this).toggleClass('open');
        $('.header-nav').toggleClass('show')
        $('.content').toggleClass('blur-bg');
        $('body').removeClass('show-popup-top');
        $('.sing-in, .recover-pass, .thank').slideUp();
        $('.header-log-in span').text("Войти");
        $('.header-log-in').removeClass('active')
        if (!$(this).hasClass('open')) {
            setTimeout(function () {
                $('.recover-pass, .sing-in').removeClass('to-fixed');
            }, 1000)
        }
    })
    $('body').on('click', function (e) {
        if ($(e.target).hasClass('header-nav')) {
            $('.burger').removeClass('open');
            $('.header-nav').removeClass('show')
            $('.content').removeClass('blur-bg')
            $('body').removeClass('show-popup-top');
            $('.sing-in, .recover-pass, .thank').slideUp();
            $('.header-log-in span').text("Войти");
            $('.header-log-in').removeClass('active')
            setTimeout(function () {
                $('.recover-pass, .sing-in').removeClass('to-fixed');
            }, 1000)
        }
        if ($(e.target).parents().hasClass('header-nav')) {
            $('.burger').removeClass('open');
            $('.header-nav').removeClass('show')
            $('.content').removeClass('blur-bg')
            $('body').removeClass('show-popup-top');
            $('.sing-in, .recover-pass, .thank').slideUp();
            $('.header-log-in span').text("Войти");
            $('.header-log-in').removeClass('active')
            setTimeout(function () {
                $('.recover-pass, .sing-in').removeClass('to-fixed');
            }, 1000)

        }
    })
}

function slideNav() {
    $('.slider-nav li').on('click', function () {
        $.fn.fullpage.moveTo($(this).parents('.section').index() + 1, $(this).index());
    })
}


function initCommentsSlide() {
    if ($('.slide-comments').find('li').length > 1) {
        $('.slide-comments').flexslider({
            animation: "slide",
            slideshowSpeed: 3000,
            directionNav: false,
            controlNav: false
        });
    }
}

function navAboutSlider() {
    $('.big-btn-prev').on('click', function () {
        $.fn.fullpage.moveSlideLeft();
        location = '#left';

        $('#fstep1 p').html('Любители');
        $('#fstep3 p').html('15 минут');

        $('.calendar_footer').show();
        $('.normal_footer').remove();
        $('.footer-order').show().addClass('to-fixed');

        $('.footer-order .footer-info li:eq(2)').addClass('disabled');

        $('.footer-order .footer-info li:first').on('click', function () {
            location.href = $(this).data('url');
            return false;
        })

    });

    $('.big-btn-next').on('click', function () {
        $.fn.fullpage.moveSlideRight();
    })
}

function initDataSlider() {
    $('.slide.active').find('.order-time-in').flexslider({
        animation: "slide",
        itemWidth: 120,
        slideshow: false,
        animationLoop: false,
        itemMargin: 10,
        start: function () {
            $('.slide.active').find('.order-time-in .slides > li').each(function (i) {
                var pos = $(this).offset().left - $(this).parents('.order-time-in').offset().left
                if (pos == 0) {
                    $('.slide.active').find('.order-step.active').find('.order-time-top p span').text($(this).data('date'))
                }
            })
        },
        after: function () {
            $('.slide.active').find('.order-time-in .slides > li').each(function (i) {
                var pos = $(this).offset().left - $(this).parents('.order-time-in').offset().left
                if (pos == 0) {
                    $('.slide.active').find('.order-step.active').find('.order-time-top p span').text($(this).data('date'))
                    console.log($(this).data('date'))
                }
            })
        }
    });
}

function popupDate() {
    $('li.selection-couple, li.free').on('mouseover', function () {
        console.log('hover')
        if ($('.order-user').length) return;
        if ($(this).hasClass('stopsale')) return;

        var li = $(this);
        var callback = li.data('callback');
        var offsetTop = li.offset().top
        var offsetLeft = li.offset().left
        $('.popup-selection').css({
            top: offsetTop - 109,
            left: offsetLeft + 60
        })
        if (typeof window[callback] != 'undefined') {
            window[callback](li);
        }
        $('.has-scroll-wrap').on('scroll', function () {
        })

    });
    $('li.selection-couple, li.free').on('mouseleave', function () {
        $('.popup, .popup-selection').hide().removeClass('open');
        $('.popup').removeClass('no-style');
    });

    $('.order-time-list li').on('click', function () {
        if ($(this).parents().hasClass('section-orders2')) {
            if ($(this).hasClass('selection-couple')) {
                $('.popup-selection').show().addClass('open');
                return
            }
            $(this).parents('.order-step').removeClass('active')
                .next().addClass('active');
            initDataSlider();
            $('.footer-info .active').removeClass('active')
                .next().addClass('active')

            return false
        }
        if ($(this).parents().hasClass('no-popup')) {
            $('.slide.active .order-step.active').removeClass('active').next().addClass('active')
            $('.footer-info .active').removeClass('active')
                .next().addClass('active')
            $('.order .title').text(productName)
            $('.order .button span').text(productCash)
            return false
        }

        var thisMount = $(this).parents('.slide').find('.order-time-top p span').text();
        var thisDay = $(this).parent().prev().find('p').text();
        var thisTimeArray = $(this).text().substring(0, 5);
        $('.popup, .popup-date').show().addClass('open');
        $('.date-in').text(thisDay + " " + thisMount + " " + thisTimeArray);
    })
    $('.close-popup, .overlay').on('click', function () {
        $('.popup, .popup-selection, .popup-date, .popup-order, .popup-thank').removeClass('open');
        return false
    })

    $('.done-popup').on('click', function () {
        $('.popup, .popup-date').hide().removeClass('open').show();
        if ($('.slide.active').hasClass('slide-activate')) {
            $('.popup-date').hide().removeClass('open').show();
            $('.popup-date, .popup-order').removeClass('open').hide().show();
            $('.popup, .popup-thank').addClass('open');
            if ($('.slide.active').index() == 0) {
                $('.popup-thank p').text('Заказ принят')
                $('.popup-thank span').text('Вся необходимая информация<br /> отправлена вам на почту')
            }
            else {
                $('.popup-thank p').text('Спасибо!')
                $('.popup-thank span').text('Сертификат активирован')
            }
            $('.header').css('z-index', "50");
            setTimeout(function () {
                $('.popup, .popup-thank').removeClass('open');
            }, 3000)
        }
        else {
            $('.slide.active .order-step.active').removeClass('active').next().addClass('active')
            $('.footer-info .active').removeClass('active')
                .next().addClass('active')
            $('.order .title').text(productName)
            $('.order .button span').text(productCash)
        }
        return false
    })

    if (typeof disabled_popup_event == 'undefined') {
        $('.order .button, .open-thank-order').on('click', function () {
            $('.popup, .popup-thank').show().addClass('open');
            $('.header').css('z-index', "50")
            setTimeout(function () {
                $('.popup, .popup-thank').removeClass('open');
            }, 3000)
            return false
        })
    }

    $('body').on('click', function (e) {
        if ($(e.target).hasClass('selection-couple')) {

        } else if (!$(e.target).parents().hasClass('popup-selection-in')) {
            $('.popup, .popup-selection, .popup-date, .popup-order, .popup-thank').removeClass('open');
        }
    })

}

function initMask() {
    if ($('.tel').length == 1) {
        $('.tel').mask("9 (999) 999 99 99", {
            placeholder: "телефон",
            onKeyPress: function (cep, event, currentField, options) {
                if (cep.length == 17) {
                    $(event.currentTarget).parents('.form-item').removeClass('error')
                }
            }
        }).on('change', function () {
            if ($(this).val().length <= 16) {
                $(this).val('')
            }
        });
    } else {
        $('.tel').each(function () {
            $(this).mask("9 (999) 999 99 99", {
                placeholder: "телефон",
                onKeyPress: function (cep, event, currentField, options) {
                    if (cep.length == 17) {
                        $(event.currentTarget).parents('.form-item').removeClass('error')
                    }
                }
            }).on('change', function () {
                if ($(this).val().length <= 16) {
                    $(this).val('')
                }
            });
        })
    }
    if ($('.birthday').length) {
        $('.birthday').mask("DZ.DY.1999", {
            placeholder: "Дата рождения ",
            translation: {
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                },
                'D': {
                    pattern: /[0-2]/,
                    optional: true
                },
                'Y': {
                    pattern: /[0-9]/,
                    optional: true
                }
            },
            onKeyPress: function (cep, event, currentField, options) {
                if (cep.length == 9) {
                    $(event.currentTarget).parents('.form-item').removeClass('error')
                }
            }
        }).on('change', function () {
            if ($(this).val().length <= 8) {
                $(this).val('')
            }
        });
    }



}

function choiseProductName() {
    $('.section-certificate .index-service-item .button,  .section-certificate .index-service-item2').on('click', function () {
        productName = $(this).siblings('.title').text();
        productCash = $(this).prev().text();

        $(this).parents('.order-step').removeClass('active')
            .next().addClass('active');
        initDataSlider();
        $('.footer-info .active').removeClass('active')
            .next().addClass('active')

        //return false
    });

    $('.section-orders .index-service-item .button, .section-orders .index-service-item2').on('click', function () {
        productName = $(this).siblings('.title').text();
        productCash = $(this).prev().text();

        $(this).parents('.order-step').removeClass('active')
            .next().addClass('active');
        initDataSlider();
        $('.footer-info .active').removeClass('active')
            .next().addClass('active')

        return false
    })

    $('.section-orders2 .index-service-item .button, .section-orders2 .index-service-item2').on('click', function () {
        productName = $(this).siblings('.title').text();
        productCash = $(this).prev().text();
        $(this).parents('.order-step').removeClass('active')
            .next().addClass('active');
        $('.footer-info .active').removeClass('active')
            .next().addClass('active')
        return false
    })
}

function activateCertificate() {

    if (typeof disable_activate_cert_event == 'undefined') {
        $('.activate-form .button').on('click', function () {
            $(this).parents('.order-step').removeClass('active')
                .next().addClass('active');
            initDataSlider();
            $('.footer-info .active').removeClass('active')
                .next().addClass('active')
            return false
        })
    }
}

function openInfoFooter() {
    $('.open-more-info-footer').on('click', function () {
        $(this).parents('footer').toggleClass('footer-hide-info')
        if ($(this).parents('footer').hasClass('footer-hide-info')) {
            $(this).find('span').text('Подробнее')
        }
        else {
            $(this).find('span').text('Скрыть')
        }

        return false
    })
}

function footerNavCertificate() {
    $('.footer-certificate li').on('click', function () {
        var activeIndex = $(this).siblings('.active').index()
        if ($(this).index() == 0) {
            if (!$('.slide.active').hasClass('slide-order')) {
                $.fn.fullpage.moveSlideLeft();
            }
            else {
                $.fn.fullpage.moveSlideRight();
            }
            $('.footer').removeClass('to-fixed');
            $('.order-step').removeClass('active').first().addClass('active');
            $('.show-tab .drop-item').removeClass('active hide').first().addClass('active')
            $('.order-step:first-child').addClass('active')
            $(this).removeClass('active').siblings().removeClass('active')
        }
        else {
            if (activeIndex > $(this).index()) {
                $(this).addClass('active')
                    .siblings().removeClass('active');
                $('.slide.active').find('.order-step').removeClass('active')
                    .eq($(this).index() - 1).addClass('active')
            }
        }
    })
}

function initAccordion() {
    $('.accordion-title').on('click', function () {
        if ($(this).hasClass('active')) {
            $('.accordion-title').removeClass('active').next().slideUp();
            return false
        }
        $('.accordion-title').removeClass('active').next().slideUp();
        $(this).toggleClass('active').next().slideToggle();
    })
}

function onPlayerReady(event) {
    event.target.playVideo();
}

// Fires when the player's state changes.
function onPlayerStateChange(event) {
    // Go to the next video after the current one is finished playing
    if (event.data === 0) {
        $.fancybox.next();
    }
}

function initFancybox() {
    $('.fancybox')
        .fancybox({
            beforeShow: function () {
                // Find the iframe ID
                var id = $.fancybox.inner.find('iframe').attr('id');

                // Create video player object and add event listeners
                var player = new YT.Player(id, {
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }
        })
    $('.fancybox-img').fancybox({
        helpers: {
            title: {
                type: 'over'
            }
        },
        beforeShow: function () {
            this.title = '<p>' + (this.index + 1) + ' / ' + this.group.length + '</p>' + '<span class="fancy-counter">' + (this.title ? ' ' + this.title : ' ') + '</span>';
        }
    })
}


function initTab() {
    $('.tab-menu #truba_selector li').on('click', function () {
        if ($(this).find('a').length) {
            return
        }
        $(this).addClass('active').siblings().removeClass('active')
        if ($(this).parents().hasClass('header')) {
            $('body').find('.tab-item').removeClass('show-tab')
                .eq($(this).index()).addClass('show-tab')
        }
        else {
            $(this).parents('section').find('.tab-item').removeClass('show-tab')
                .eq($(this).index()).addClass('show-tab')
        }

        catalogIndex = false
    });
	/*
	$('.tab-menu #mans_selector li').on('click', function () {
		if ($(this).attr("data-men") == "2") {
			$(".index-service-item.men3").hide();
			$(".index-service-item.men2").show();
		} else {
			$(".index-service-item.men2").hide();
			$(".index-service-item.men3").show();
		}
	});
	*/
	//фильтр по минутам
	
	$('.tab-menu #mins_selector li').on('click', function () {
		if ($(this).attr("data-min") == "2") {
			$(".show-tab .index-service-item.min10").hide();
			$(".show-tab .index-service-item.min2").show();
		} else {
			$(".show-tab .index-service-item.min2").hide();
			$(".show-tab .index-service-item.min10").show();
		}
		$('.tab-menu #mins_selector li').removeClass('active');
		$(this).addClass('active');
	});
	
}


function showNewsIn() {
    if (!!$('.news-in').length) {
        if ($(window).scrollTop() >= $('.news-in').offset().top) {
            $('.news-in').addClass('active');
            $('.header').addClass('to-fixed header-dark header-min');
            $('.footer').addClass('footer-dark');
        }
        else {
            $('.header').removeClass('to-fixed header-dark header-min');
            $('.footer').removeClass('footer-dark');
			//mobile styles by icmark
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					 $('.header').addClass('header-min').removeClass('header-regular');
					}
        }
        if ($(window).scrollTop() >= $('.news-date').offset().top - 500) {
            $('.news-date').addClass('active')
        }
    }
}


function showNewsItem() {
    var hArr = []
    $('.news-item').each(function (e) {
        hArr.push($(this).offset().top)
    });
    $.each(hArr, function (i) {
        if ($(window).scrollTop() >= hArr[i] - 500) {
            $('.news-item').eq(i).addClass('active')
        }
    })
}

function hideSidebar() {
    if (!!$('.news-in').length) {
        if ($(window).scrollTop() >= $('.sidebar').offset().top + $('.sidebar').innerHeight()) {
            $('.news-wrapper').addClass('hide-sidebar')
        }
        else {
            $('.news-wrapper').removeClass('hide-sidebar')
        }
    }
}


function initEquipmentHistoryTab() {
    if (!!$('.tab-menu-img').length) {
        $('.tab-menu-img').css({
            'left': $('.equipment-history .active').offset().left,
            'top': $('.equipment-history .active').offset().top - $('.equipment-history').offset().top
        })
        $('.equipment-history .tab-menu li').on('click', function () {
            $('.tab-menu-img').css({
                'left': $('.equipment-history .active').offset().left,
                'top': $('.equipment-history .active').offset().top - $('.equipment-history').offset().top
            })
        })
    }
}


function toggleQuestion() {
    $('.cart-list .btn-gray').on('click', function () {
        $(this).parent().hide().addClass('hide').removeClass('show')
            .next().slideDown().addClass('show').removeClass('hide');
        $(this).parents('.has-drop').removeClass('has-drop').addClass('not-drop')
    })
    $('.question-list .btn-gray').on('click', function () {
        $(this).parents('.question-list').hide().addClass('hide').removeClass('show')
            .prev().slideDown().addClass('show').removeClass('hide')
        $(this).parents('.not-drop').addClass('has-drop').removeClass('not-drop')
        $('.cart-list .show-tab .drop-item').first().addClass('active')
    })
}


function openSingIn() {
    $('.header-log-in').on('click', function () {
        if ($(this).hasClass('active')) {
            $('.sing-in').toggleClass('to-fixed');
            $('.recover-pass, .sing-in').slideUp();
            $('body').removeClass('show-popup-top');
            $(this).toggleClass('active').find('span').text("Войти")
            return false
        }
        $(this).toggleClass('active').find('span').text($(this).hasClass('active') ? "Свернуть" : "Войти")
        $('body').toggleClass('show-popup-top');
        $('.sing-in').slideToggle();
        if ($(this).parents('.header').hasClass('header-min')) {
            if (!$(this).hasClass('active')) {
                setTimeout(function () {
                    $('.sing-in').toggleClass('to-fixed');
                }, 1000)
            }
            else {
                $('.recover-pass, .sing-in').addClass('to-fixed');
            }
        }

        return false
    })
}

function openRecover() {
    $('.open-recover').on('click', function () {
        $('.sing-in').hide();
        $('.recover-pass').show();
        if ($(this).parents('.header').hasClass('header-min')) {
            if (!$(this).hasClass('active')) {
                setTimeout(function () {
                    $('.recover-pass').toggleClass('to-fixed');

                }, 1000)
            }
            else {
                $('.recover-pass').toggleClass('to-fixed');
            }
        }
        return false
    })
}

function openThanskFeedback(title, text, reload, redirect_url) {

    if (typeof reload == 'undefined') {
        reload = true;
    }
    if (typeof redirect_url == 'undefined') {
        redirect_url = false;
    }

    $('.thank').addClass('open');
    $('.thank').find('p').text(title);
    $('.thank').find('span').text(text);

    if (reload) {
        setTimeout(function () {
            if (!redirect_url) {
                location.reload();
            } else {
                location.href = redirect_url;
            }
        }, 4000);
    }
}

function openFeedback() {
    $('.footer-callback').on('click', function () {
        $('.feedback').slideToggle();
        $('body').toggleClass('show-popup-bottom');
        $(this).toggleClass('active').find('span').text($(this).hasClass('active') ? "Свернуть" : "Обратная связь")
        return false
    });


    $('.content').on('click', function () {
        if ($('.footer-callback').hasClass('active')) {
            hideFeedback();
        }
    })
}
function hideFeedback() {
    $('.feedback').slideUp();
    $('body').removeClass('show-popup-bottom');
    $('.footer-callback').removeClass('active').find('span').text("Обратная связь")
}

function initSelect() {
    $(".choice-date select").select2();
    $(".choice-date select").on('change', function () {
        filterNews();
    });
    $('.order2-info select').each(function () {
        $(this).select2({
            containerCssClass: "style2",
            dropdownCssClass: "style2"
        });
    });

    if (typeof disable_select_time_object == 'undefined') {
        $(".select-time select").select2({
            dropdownCssClass: "select-time"
        }).on('change', function () {
            console.log("text:" + $(this).find(':selected').text())
            console.log("value:" + $(this).find(':selected').val())
        });
    }
}

function closeChangeDate() {
    var pos = 1;
    $('.icon-close-select').on('click', function () {
        $(this).parent().hide().prev().slideDown();
        $('.choice-date').prev().find('span').text($('.mounts-list .active').text())
    })
    $('.mounts-list li').on('click', function () {
        var $lastActiveEl = $('.mounts-list .active').index() + 1;
        var $isActive = $(this).index() + 1;
        var _this = $(this);
        var $isIndex = +($('[data-month="' + $isActive + '"]').index() / 7).toFixed(0)
        if ($isIndex > 0) {
            $('.flex-control-nav li').eq($isIndex + 1).find('a').trigger('click')

        }
        if ($isIndex == 0) {
            $('.flex-control-nav li').eq($isIndex).find('a').trigger('click')
        }

        $(this).addClass('active')
            .siblings().removeClass('active');
        $(this).parents('.choice-date').hide().prev().slideDown();
        $(this).parents('.choice-date').prev().find('span').text($(this).parents('.mounts-list').find('.active').text())

        filterNews($lastActiveEl);
    })
}

function openChangeDate() {
    $('.news-date p').on('click', function () {
        $(this).hide()
            .next().slideDown();
    })
}

function hideBtn() {
    if ($(window).height() < 793) {
        $('.cart-list .button').hide()
    }
    else {
        $('.cart-list .button').show()
    }
}

function initHoverCarousel() {
    var fnIntervaTime;
    $('.images-wrap').on('mouseover', function () {
        var _this = $(this);
        _this.find('.active').next().addClass('active')
            .siblings().removeClass('active')
        clearInterval(fnIntervaTime);
        fnIntervaTime = false;
        fnIntervaTime = setInterval(function () {
            var _active = _this.find('.active')
            if (_active.index() + 1 == _this.find('img').length) {
                _this.find('img').first().addClass('active')
                    .siblings().removeClass('active')
                return false
            }
            else {
                _active.next().addClass('active')
                    .siblings().removeClass('active')
            }
        }, 2000);
    })
    $('.images-wrap').on('mouseleave', function () {
        clearInterval(fnIntervaTime);
        fnIntervaTime = false;

    })
}

function initLoader() {
    $('.loader').fadeOut();
    $('body').addClass('show-to-block')

}
function addPercent() {
    var loaded_images = 0;
    var img_to_load = [];


    $('img').each(function (i) {
        img_to_load[i] = $(this).attr('src')
    })
    for (var i = 0; i < img_to_load.length; i++) {
        var img = document.createElement('img');
        img.src = img_to_load[i];
        img.style.display = 'hidden'; // don't display preloaded images
        img.onload = function () {
            loaded_images++;
            if (loaded_images == img_to_load.length) {
                $('.loader span').text('100 %');
                setTimeout(function () {
                    initLoader()
                }, 2000)
            }
            if (loaded_images == img_to_load.length - 1) {
                $('.loader span').text('100 %');
                setTimeout(function () {
                    initLoader()
                }, 2000)
            }
            else {
                $('.loader span').text(Math.round((100 * loaded_images / img_to_load.length)) + "%");
            }

        }
    }
}


function filterNews(last) {
    var countActive = 0;
    var isYear = $('.choice-date select option:selected').text();
    var isMoun = $('.mounts-list .active').index() + 1;


    $('.accordion-item').each(function (i) {
        if (i == 0) {
            countActive = 0
        }
        if ($(this).data('year') == isYear && $(this).data('month') == "" + isMoun) {
            $(this).removeClass('hide active');
            countActive++;
            if (countActive < 4) {
                $(this).addClass('active');
            }
        }
        else {
            $(this).removeClass('active').addClass('hide');
        }
    })


}


function filter() {
    var filter_params = {
        "month": 'Июнь',
        "year": 2016,
        "type_17_12": 17,
        "humans_type": '',
        "sport_type": 'active'
    };

    renderMount(filter_params);
}

function renderMount() {
    $('.cabinet-calendar-in').append('' +
        '<table>' +
        '<thead>' +
        '<tr>' +
        '<th>Понеделельник</th>' +
        '<th>Вторник</th>' +
        '<th>Среда</th>' +
        '<th>Четверг</th>' +
        '<th>Пятница</th>' +
        '<th>Суббота</th>' +
        '<th>Воскресение</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody></tbody>' +
        '</table>')


    var D1 = new Date(),
        D1last = new Date(D1.getFullYear(), D1.getMonth() + 1, 0).getDate(), // последний день месяца
        D1Nlast = new Date(D1.getFullYear(), D1.getMonth(), D1last).getDay(), // день недели последнего дня месяца
        D1Nfirst = new Date(D1.getFullYear(), D1.getMonth(), 1).getDay(), // день недели первого дня месяца
        D1Mlast = new Date(D1.getFullYear(), D1.getMonth(), 0).getDate(), //последний месяц
        calendar1 = '<tr>',

        month = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"]; // название месяца, вместо цифр 0-11


    $.get('../json/file1.json', function (data) {
        // пустые клетки до первого дня текущего месяца
        if (D1Nfirst != 0) {
            var lastNumberMount = parseInt(D1Mlast - D1Nfirst) + 1;
            for (var i = 1; i < D1Nfirst; i++) {
                var lastDay = lastNumberMount + i
                calendar1 += '<td class="not-active">' + lastDay;
            }
        } else { // если первый день месяца выпадает на воскресенье, то требуется 7 пустых клеток
            for (var i = 0; i < 6; i++) calendar1 += '<td class="not-active">';
        }
        // дни месяца

        for (var i = 1; i <= D1last; i++) {
            if (i != D1.getDate()) {
                calendar1 += '<td>' + i;

            } else {
                calendar1 += '<td id="today">' + i;  // сегодняшней дате можно задать стиль CSS
            }
            if (new Date(D1.getFullYear(), D1.getMonth(), i).getDay() == 0) {  // если день выпадает на воскресенье, то перевод строки
                calendar1 += '<tr>';
            }
        }
// пустые клетки после последнего дня месяца
        if (D1Nlast != 0) {
            for (var i = D1Nlast; i < 7; i++) calendar1 += '<td class="not-active">' + i + '';
        }
        $('.cabinet-calendar-in tbody').append(calendar1);

    })


}


function calendarTab() {
    $('.change-preview .btn').on('click', function () {
        $('.not-mount').show()
        if ($(this).data('for-type') == "mount") {
            $('.not-mount').hide()
        }
        $('.cabinet-calendar-item').hide();
        $('[data-type="' + $(this).data('for-type') + '"]').show();
        $(this).addClass('active').siblings().removeClass('active');
        $('.nav-calendar span').text($(this).data('for-type') != "mount" ? "" : "");


    })
}

if (typeof disable_openCalendarPopup == 'undefined') {
    function openCalendarPopup() {

        $('.cabinet-calendar-content .table-blue').on('click', function () {
            $('.calendar-popup2, .calendar-popup1, .calendar-popup3').hide();
            $('.calendar-popup1').fadeIn();
            $(this).addClass('active');
            $('.popup-calendar-overlay').show();
        });

        $('.cabinet-calendar-content .table-red').on('click', function () {
            $('.calendar-popup2, .calendar-popup1, .calendar-popup3').hide();

            $(this).addClass('active');
            $('.calendar-popup2').fadeIn();
            $('.popup-calendar-overlay').show();
        });

        $('.open-change-popup').on('click', function () {
            $('.calendar-popup2, .calendar-popup1, .calendar-popup3').hide();
            $('.calendar-popup3').fadeIn();
            $('.popup-calendar-overlay').show();
        });

        $('.popup-calendar-overlay').on('click', function () {
            $('.calendar-popup2, .calendar-popup1, .calendar-popup3').fadeOut();
            $('.popup-calendar-overlay').hide();
            $('.table-red, .table-blue').removeClass('active')
        })
    }
}

function selectTime() {
    $('.order-time-big li').on('click', function () {
        // var productName = $(this).siblings('.title').text();
        // var productCash = $(this).prev().text();

        if ($(this).hasClass('unlimited-time')) {
            $.fn.fullpage.moveSlideRight();
            return
        }

        $(this).parents('.order-step').removeClass('active')
            .next().addClass('active');

        initDataSlider();

        //$('.footer-info .active').removeClass('active')
        //  .next().addClass('active')

        return false
    })
}


function openSelectionCouple() {
    $('.selection-couple').on('click', function () {

    })
}


function initDatepiker() {
    // if (typeof disable_cabinet_datetime_picket_activate == 'undefined') {
    $('.datepicker-input input').datepicker({
        position: "bottom left",
        range: true,
        multipleDatesSeparator: " - ",
        onLastChange: function (inst) {
            var dateFrom = moment(inst.minRange).format('YYYY-MM-DD');
            var dateTo = moment(inst.maxRange).format('YYYY-MM-DD');
            $('#date_from').val(dateFrom);
            $('#date_to').val(dateTo);

            var callback = $('.datepicker-input input').datepicker().data('callback');

            if (typeof window[callback] != 'undefined') {
                window[callback]();
            }
            $('.datepicker-input input').datepicker().data('datepicker').hide()
        }
    });

    $('.open-datepiker').on('click', function () {
        $('.datepicker-input input').datepicker().data('datepicker').show();
    });
    // }
}


function toggleCabinetPopup() {

    if (typeof disable_cabinet_cancel_move_ok_buttons == 'undefined') {

        $('.btn-cancel').on('click', function () {
            $('.cabinet-popup, .cabinet-cancel').addClass('open');
            return false
        });

        $('.btn-remove').on('click', function () {
            $('.cabinet-popup, .cabinet-move').addClass('open');
            return false
        })

        $('.btn-done').on('click', function () {
            location.reload()
        })
    }

    $('.overlay, .btn-not').on('click', function () {
        $('.cabinet-popup, .popup-team, .cabinet-cancel, .cabinet-categories, .cabinet-move').removeClass('open');
    })
    $('.popup-team').on('click', function (e) {
        if (!$(e.target).hasClass('popup-team-in')) {
            $('.cabinet-popup, .popup-team, .cabinet-cancel, .cabinet-categories, .cabinet-move').removeClass('open');
        }
    })
    // $('.user-info .categories').on('click', function () {
    //   $('.cabinet-popup, .cabinet-categories').addClass('open');
    // })

}


function initCabinetBonusCarousel() {
    if ($(".cabinet-bonus").find('li').length > 1) {
        $(".cabinet-bonus").flexslider({
            animation: "slide",
            slideshowSpeed: 3000,
            directionNav: false,
            controlNav: false
        });
    }

}

function initDropToggler() {
    $('.status-list li').on('click', function () {
        // if (!$(this).hasClass('remove')) {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
                .find('.drop-list').slideUp()
            return
        }
        $('.drop-list').slideUp()
        $(this).toggleClass('active').siblings().removeClass('active')
        $(this).find('.drop-list').slideToggle()
        // }
    })
}

if (typeof disable_init_big_calendar == 'undefined') {
    function initCAlendar2() {
        if ($('body').find('#date-range').length) {
            $('#date-range').dateRangePicker(
                {
                    autoClose: true,
                    singleDate: true,
                    showShortcuts: false,
                    inline: true,
                    container: '#date-range-container',
                    alwaysOpen: true,
                    setValue: function (s) {
                        alert(s)
                    }
                });
        }
    }
}

function windPrint() {
    $('.btn-print').on('click', function () {
        window.print();
    })
}


function navOrder2() {
    $('.orders-nav .big-btn').on('click', function () {
        if ($(this).data('nav') == 'right') {
            $('.order-step-1').removeClass('active')
                .next().addClass('active');
            $('.footer-info li').removeClass('active').eq(1).addClass('disabled').next().addClass('active')

        }
        if ($(this).data('nav') == 'left') {
            $('.footer-info li').removeClass('active').eq(1).removeClass('disabled').show().addClass('active')
            $('.order-step').removeClass('active')
                .first().addClass('active');
        }
        $('.orders-nav').addClass('move-to-' + $(this).data('nav'));
        $('.header').addClass('header-dark');
        $('.footer-order').show().addClass('to-fixed');
        $('body').addClass('show-to-block');


        $('.calendar_footer').show();
        $('.normal_footer').remove();
        $('.footer-order').show().addClass('to-fixed');

        return false
    });

    $('.order-component .index-service-item').unbind('click').on('click', function () {
        nextStep($(this), false);
        return false
    });

    $('.order-component .order-time-big li').unbind('click').on('click', function () {
        nextStep($(this), true);
    });

    $('.order-component .order-time-list li').unbind('click').on('click', function () {
        nextStep($(this), true);
    });

    $('.footer-order li').on('click', function () {

        if ($(this).hasClass('disabled')) {
            return;
        }

        var isActiveEl = $('.footer-order .active').index();
        if ($(this).index() == 0) {
            $('.orders-nav').removeClass('move-to-left move-to-right');
            $('.order-step').removeClass('active');
            $('.footer-order').hide().removeClass('to-fixed');
            $('.header').removeClass('header-dark');
            $('body').removeClass('show-to-block');
        }
        if ($(this).index() < isActiveEl) {
            if ($(this).index() > 0) {
                $('.order-step').removeClass('active').eq($(this).index() - 1).addClass('active')
                $(this).addClass('active').siblings().removeClass('active')
            }
        }
    })

}

function nextStep(th, slider) {
    th.parents('.order-step').removeClass('active').next().addClass('active');

    $('.footer-info .active').removeClass('active').next().addClass('active');

    if (slider) {
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
                })
            },
            after: function () {
                $('.order-time-in .slides > li').each(function (i) {
                    var pos = $(this).offset().left - $(this).parents('.order-time-in').offset().left;

                    if (pos == 0) {
                        $('.order-step.active').find('.order-time-top p span').text($(this).data('date'));
                        console.log($(this).data('date'))
                    }
                })
            }
        });
    }
    return false
}


// function togglerTeamPopup() {
//     $('a.command-item').on('click', function () {
//       $('.cabinet-popup, .popup-team').addClass('open')
//     })
// }


function superScroll() {
    //$('.order-time-list').on('mouseleave', function () {
    //  $('.order-time-list').animate('top', 0);
    //  $('.order-time-list').animate({
    //      scrollTop: 0
    //    }, 400);
    //})
    //$('.order-time-list').on('scroll', function () {
    //  $('.order-time-list').css('top', -($('.order-time-list').scrollTop()));
    //})
}

function moveHistory() {
    $('.history-item').on('mouseleave', function () {
        $(this).removeClass('move-history')
    })
    $('.history-item').on('mouseover', function () {
        if ($(this).find('.history-item-drop').length) {
            $(this).addClass('move-history')
        }
    })
}

if (typeof disable_admin_calendar_buttons == 'undefined') {
    function cabinetCalendarFilter() {
        $('.calendar-change-btn .btn').on('click', function () {
            $(this).addClass('active').siblings().removeClass('active')
        })
    }
}

function closeBigPopup() {
    $('body').on('click', '.thank.open', function () {
        $('.thank').removeClass('open');
        $('.thank').find('p').text('');
        $('.thank').find('span').text('')
    })
}

function footerBottom() {
    $('.faq-list').parent().addClass('h_auto')
}
$(document).on('ready', function () {
    footerBottom();
    initMask();
    closeBigPopup();
    moveHistory();
    if (typeof disable_admin_calendar_buttons == 'undefined') {
        cabinetCalendarFilter();
    }
    var productName, productCash;
    //filter()
    superScroll();
    navOrder2();
    calendarTab();

    if (typeof disable_openCalendarPopup == 'undefined') {
        openCalendarPopup();
    }

    openSelectionCouple();
    initDatepiker();
    toggleCabinetPopup();
    initCabinetBonusCarousel()
    // togglerTeamPopup();

// нужно будет удалить
    initLoader();


    addPercent();
    selectTime();

    initMastheadSlider();
    //initFullPage();
    togglerMenu();
    slideNav();
    initCommentsSlide();
    navAboutSlider();
    popupDate();
    choiseProductName();
    activateCertificate();
    openInfoFooter();
    footerNavCertificate();
    initAccordion();
    initFancybox();
    initTab();
    showNewsIn();
    showNewsItem();
    hideSidebar();
    initEquipmentHistoryTab();
    toggleQuestion();
    openSingIn();
    openRecover();
    openFeedback();
    initSelect();
    closeChangeDate();
    openChangeDate();
    hideBtn();
    initHoverCarousel();
    initDropToggler();

    if (typeof disable_init_big_calendar == 'undefined') {
        initCAlendar2();
    }

    windPrint()
});


$(window).on('scroll', function () {
    showNewsIn();
    showNewsItem();
    hideSidebar();
    hideBtn();
    $('.order-component .order-time-list').css('max-height', ( $(window).height() / 1.5) - 100)

});

$(window).on('resize', function () {
    hideBtn();
    $('.order-component .order-time-list').css('max-height', ( $(window).height() / 1.5) - 100)
});

/* prev-next page arrows by Icmark */
$.fn.fullpage({
    fixedElements: '#fp_next, #fp_prev'
});
$('#fp_next').click(function(){
    $.fn.fullpage.moveSectionDown();
});

$('#fp_prev').click(function(){
    $.fn.fullpage.moveSectionUp();
});

/* / prev-next page arrows by Icmark */

/* fixed header */
	$(function(){
	 $(window).scroll(function() {
	  var top = $(document).scrollTop();
	  if (top > 800) $('header').addClass('h0 to-fixed header-dark header-min');
	  else $('header').removeClass('h0 to-fixed header-dark header-min');
	 });
	});
/* /fixed header */
