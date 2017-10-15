/**
 * Created by kilanoff on 06.10.16.
 */

$(document).ready(function () {
    $('#forgotform').each(function () {
        var form = $(this);
        form.find('button').on('click', function () {
            form.find('.form-item').removeClass('error');
            var email = form.find('input[name="forgot_email"]');
            if (!email.val() || email.val().indexOf('@') == -1 || email.val().indexOf('.') == -1) {
                form.find('.form-item').addClass('error');
                return false;
            }

            $.ajax({
                url: '/local/components/freezone/forgot/ajax.php',
                async: "false",
                type: "POST",
                data: "email=" + email.val() + '&action=forgot',
                dataType: "json",
                success: function (res) {
                    if (res.error) {
                        form.find('.form-item').addClass('error');

                        $('#forgotform span.error').show();
                    } else {
                        openThanskFeedback('Восстановление пароля', res.message);
                    }
                }
            });
        })
    })
});
