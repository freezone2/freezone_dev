/**
 * Created by kilanoff on 06.10.16.
 */

$(document).ready(function () {
    $('#signinform').each(function () {
        var form = $(this);
        form.find('button').on('click', function () {
            form.find('.form-item').removeClass('error');
            var email = form.find('input[name="email"]');
            var password = form.find('input[name="password"]');
            if (!email.val() || email.val().indexOf('@') == -1 || email.val().indexOf('.') == -1 || !password.val()) {
                form.find('.form-item').addClass('error');
                return false;
            }

            $.ajax({
                url: '/local/components/freezone/auth/ajax.php',
                async: "false",
                type: "POST",
                // data: "email=" + email.val() + '&password=' + encodeURIComponent(password.val()) + '&action=check',
                data: form.serialize() + '&action=check',
                dataType: "json",
                success: function (res) {
                    if (res.error) {
                        form.find('.form-item').addClass('error');
                    } else {
                        form.submit();
                    }
                }
            });
        })
    });
	$(".show-password").click(function() {
		$("#sportsman-login").prop('type', 'text');
		$(this).hide();
	});
	
});
