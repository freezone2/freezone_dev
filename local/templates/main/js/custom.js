$(function(){

    $('.page-arrow-scroll').on('click', function(event) {
        event.preventDefault();
        $("body, html").animate({"scrollTop":$(".scroll-to-wrap").offset().top-133},"normal");
    });

    var fixedTopMenu = function(){
        if ($(window).scrollTop() > 250) {
            $('.fixed-top-line').addClass('visible');
        } else {
            $('.fixed-top-line').removeClass('visible');
        }
    };
    // $(window).scroll( $.throttle(fixedTopMenu, 200) );
    $(window).on('scroll', fixedTopMenu);

    $("body").on("click", ".close-menu-fixed", function(e) {
        $("body").find("header .navbar-toggler.burger").trigger("click");
        e.preventDefault();
    });

    $('.modal').on('show', function () {
        $('body').addClass('modal-overflow-hidden');
    });

    $('.modal').on('hide', function () {
        $(this).addClass('modal-begin-hide');
    });

    $('.modal').on('hidden', function () {
        $('body').removeClass('modal-overflow-hidden');
        var thisModalW = $(this);
        function removeBegin(){
            thisModalW.removeClass('modal-begin-hide');
        }
        setTimeout(removeBegin, 300);
    });

    $("[data-popup]").fancybox({
        loop     : true,
        thumbs   : true
    });

    //product gallery
    $('.product-card-gallery-photo').slick({
        dots: false,
        arrows: false,
        draggable: true,
        infinite: false,
        centerMode: false,
        centerPadding: '0px',
        autoplay: false,
        autoplaySpeed: 5000,
        speed: 500,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slide: '.product-card-gallery-photo-slide',
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        asNavFor: '.product-card-gallery-nav'
    });

    //product gallery nav
    $('.product-card-gallery-nav').slick({
        dots: false,
        arrows: true,
        draggable: true,
        infinite: false,
        centerMode: false,
        centerPadding: '0px',
        autoplay: false,
        autoplaySpeed: 5000,
        speed: 500,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        slide: '.product-card-gallery-nav-slide',
        slidesToShow: 6,
        slidesToScroll: 1,
        focusOnSelect: true,
        asNavFor: '.product-card-gallery-photo',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            }
        ]
    });

    //------------------------------------------------------------------------//

    $('.form-requests').on('hidden.bs.modal', function (e) {
        $(this).find(".feedback-note").html("");
    });

    $("body").on("submit", ".form-requests form", function(e){

        var form = $(this);
        var lang = form.attr("data-lang");
        var button = form.find(".btn-submit");
        var datastring = form.serialize()+"&web_form_submit=Y";
        // console.log(datastring);

        e.preventDefault();

        $.ajax({
            type: "post",
            url: '/local/templates/main/ajax/send_tool.php',
            data: datastring,
            beforeSend: function () {
                button.hide();
            },
            success: function (response) {
                // console.log(response);
                if (response) {
                    button.show();
                    var data = jQuery.parseJSON(response);
                    // console.log(data);
                    if (data && data.FORM_ERRORS_TEXT) {
                        form.find(".feedback-note").addClass("error");
                        if( form.hasClass("noted")) {
                            form.find(".feedback-note").removeClass("noted");
                        }
                        form.find(".feedback-note").html(data.FORM_ERRORS_TEXT);
                    }
                }
                else {
                    if( form.find(".feedback-note").hasClass("error")) {
                        form.find(".feedback-note").removeClass("error");
                    }
                    var message = form.find(".note-text").attr('data-text');
                    form.find(".feedback-note").html(message);
                    form[0].reset();
                    button.show();
                }

            }
        });
        return false;
    });

    if($('#map') && $('#map').length > 0) {
        var latitude = $('#map').data('latitude');
        var longitude = $('#map').data('longitude');
        if(latitude && longitude) {
            ymaps.ready(function () {
                var myMap = new ymaps.Map('map', {
                        center: [latitude, longitude],
                        zoom: 16
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),

                    myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                        //hintContent: 'Собственный значок метки',
                        //balloonContent: 'Это красивая метка'
                    }, {
                        // Опции.
                        // Необходимо указать данный тип макета.
                        iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        iconImageHref: '/local/templates/main/images/map_icon.png',
                        // Размеры метки.
                        iconImageSize: [45, 74],
                        // Смещение левого верхнего угла иконки относительно
                        // её "ножки" (точки привязки).
                        iconImageOffset: [-15, -74]
                    });

                myMap.geoObjects.add(myPlacemark);
                myMap.behaviors.disable('scrollZoom');
            });
        }
    }

});