$(function () {


    $('#comp_fspr').mask("99 99 9999 9999", {
        placeholder: "__ __ ____ ____"
    });

    $('#comp_phone').mask("+7 (999) 999-99-99", {
        placeholder: "+7 (___) ___ -__-__"
    });

    var select_item = $('.field_select');

    select_item.each(function () {
        var cont = $(this).closest('.field_wrap');
        $(this).select2({
            minimumResultsForSearch: 5,
            dropdownParent: cont,
            placeholder: "--Select something (default placeholder)--"

        });
    }).on('focus', function (e) {
        $(this).select2('open');
    }).on('select2:open', function() {
        $('.select2-search--dropdown .select2-search__field').attr('placeholder', 'Поиск по названию');
    }).on('select2:close', function() {
        $('.select2-search--dropdown .select2-search__field').attr('placeholder', null);
    });

    $('#regFormPage').on('submit', function(e){

        var t = $(this),
            button = t.find("[name='add_regitem']"),
            error = false;
        t.find("#comp_fspr_id").val("");
        t.find(".line-success").addClass("line-hidden");
        t.find(".error-type-page").addClass("error-hidden");

        var names_str = {};

        if(t.find('input[name="type_object[]"]:checked').length==0) {
            error = true;
            t.find(".wrap-disp-form").addClass("error");
        }
        else {
            t.find(".wrap-disp-form").removeClass("error");

            // t.find('input[name="type_value_add[]"]').each(function(){
            //     names_str[]
            // });
        }

        t.find('input[type=text], \
			input[type=tel], \
			input[type=email], \
			select').each(function() {
            var inp = $(this),
                v = $.trim(inp.val());
            // console.log(v, t.attr('name'));

            if(inp.attr('name')=='comp_fspr'){ // state
                if(!v) {
                    // error = true;
                }
                else {
                    console.log(v);
                    $.ajax({
                        type: "post",
                        url: '/custom_page/check.php',
                        data: {
                            'test_fspr': v
                        },
                        dataType: "json",
                        beforeSend: function () {

                        },
                        success: function (response) {
                            console.log(response["id"]);
                            if (response && response["id"]) {
                                t.find("#comp_fspr_id").val(response["id"]);
                                inp.parent().find(".error-type-page").addClass("error-hidden");
                            }
                            else {
                                inp.parent().find(".error-type-page").removeClass("error-hidden");
                            }
                        }
                    });
                }

            }else if(!v){

                $(this).parent().addClass('error');
                error = true;

            }else{

                $(this).parent().removeClass('error');

            }
        });

        if(!error){

            var datastring = t.find(':input, select').serializeArray();

            console.log(datastring);
            $.ajax({
                type: "post",
                url: '/custom_page/save_req.php',
                data: datastring,
                dataType: "json",
                beforeSend: function () {

                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        button.show();
                        if(response["id"]) {
                            t.find(".line-success").removeClass("line-hidden");
                            t[0].reset();
                            t.find(".get-add-line").remove();
                            t.find(".error-type-page").addClass("error-hidden");
                        }
                    }
                }
            });
        }

        e.preventDefault();
    });

    function getNewAddField(button) {
        var parentWrap = button.closest(".add__field__checkbox"),
            parent = parentWrap.find(".checkbox"),
            parentWrapGl = parentWrap.closest(".wrap-disp-form"),
            get_line_add = parentWrap.find(".get-add-line"),
            val = button.val(),
            cur_id = button.attr("id"),
            cur_code = button.attr("data-code"),
            cur_name = "type_value_add",
            placeholder_name = "Team name",
            is_error = parentWrapGl.hasClass("error");

        if(button.is(":checked")) {
            var new_line = parent.clone();
            new_line.empty();
            new_line.addClass("input get-add-line");
            new_line.removeClass("checkbox");
            $('<input/>').attr({
                type: 'text',
                class: 'field__type',
                id: cur_id + '_add',
                name: cur_name + '['+cur_code+']',
                placeholder: placeholder_name + ' ' + val
            }).prependTo(new_line);

            new_line.appendTo(parentWrap);
            if(is_error) {
                new_line.addClass("error");
            }
        }
        else if(get_line_add.length > 0) {
            get_line_add.remove();

        }
    }

    $("body").on('click', '.add__field__checkbox input[type="checkbox"]', function(e){

        getNewAddField($(this));

        // e.preventDefault();
    });
});