<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<? /*if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;*/ ?>

<?= $arResult["FORM_NOTE"] ?>

<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <?= str_replace('<form', '<form novalidate class="feedbackform"', $arResult["FORM_HEADER"]) ?>

    <style>
        div[id*='wait_comp'] {
            position: absolute;
            top: 0;
            right: 0;
        }

        div[id*='wait_comp']:last-child {
            display: none;
        }
    </style>

    <div class="column">
        <div class="form-item <?= (preg_match('#Имя#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : ''); ?>">
            <input type="text" placeholder="<?=Loc::GetMessage('FIELD_NAME');?>" name="form_text_1" value="<?= $_REQUEST['form_text_1']; ?>"/>
            <? if (preg_match('#mail#simu', $arResult["FORM_ERRORS_TEXT"])) {
                ?>
                <span><?=Loc::GetMessage('ERROR_ENTER_NAME');?></span>
            <? } ?>
        </div>

        <div class="form-item <?= (preg_match('#mail#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : ''); ?>">
            <span>E-mail</span>
            <input type="email" placeholder="E-mail" name="form_email_2" value="<?= $_REQUEST['form_email_2']; ?>"/>
            <? if (preg_match('#mail#simu', $arResult["FORM_ERRORS_TEXT"])) {
                ?>
                <span><?=Loc::GetMessage('ERROR_ENTER_EMAIL');?></span>
            <? } ?>
        </div>

        <div class="form-item <?= (preg_match('#телефон#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : ''); ?>">
            <input type="text" class="tel" placeholder="<?=Loc::GetMessage('FIELD_PHONE');?>" name="form_text_3"
                   value="<?= $_REQUEST['form_text_3']; ?>"/>
            <? if (preg_match('#mail#simu', $arResult["FORM_ERRORS_TEXT"])) {
                ?>
                <span><?=Loc::GetMessage('ERROR_ENTER_PHONE');?></span>
            <? } ?>
        </div>
    </div>
    <div
        class="form-item form-textarea <?= (preg_match('#Сообщение#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : ''); ?>">
        <label for="textarea"><?=Loc::GetMessage('FIELD_MESSAGE');?></label>
        <textarea name="form_text_4" id="textarea" placeholder=""><?= $_REQUEST['form_text_4']; ?></textarea>
    </div>
    <button class="feedbackbutton button btn-white" onclick="$('#feedbackbbb').click();"><?=Loc::GetMessage('SEND');?></button>

    <script>
        function recheck_button() {
            var name = $('.feedbackform input[name="form_text_1"]').val();
            var email = $('.feedbackform input[name="form_email_2"]').val();
            var phone = $('.feedbackform input[name="form_text_3"]').val();
            var text = $('.feedbackform textarea').val();

            if (name && email && email.indexOf('@') > -1 && email.indexOf('.') > -1 && phone && text) {
                $('.feedbackbutton').removeClass('btn-white').addClass('btn-red');
            } else {
                $('.feedbackbutton').removeClass('btn-red').addClass('btn-white');
            }
        }

        $(document).on('keyup', '.feedbackform input, .feedbackform textarea', function () {
            recheck_button();
            if($(this).attr('type') == 'email'){
                if($(this).val().indexOf('@') > -1 && $(this).val().indexOf('.') > -1){
                    $(this).parent().removeClass('error')
                }
            }
            else{
                if($(this).val() != ''){
                    $(this).parent().removeClass('error')
                }
            }
        });

        $(document).on('ready', function () {
            $('.feedbackform input').on('keyup', function () {

            })
        });

        window.onload = function () {
            if (typeof initMask != 'undefined') {
                initMask();
            }
        }
    </script>

    <div style="display: none">
        <input id="feedbackbbb" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit"
               name="web_form_submit"
               value="<?= htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"/>
        <? if ($arResult["F_RIGHT"] >= 15):?>
            &nbsp;<input type="hidden" name="web_form_apply" value="Y"/><input type="submit" name="web_form_apply"
                                                                               value="<?= GetMessage("FORM_APPLY") ?>"/>
        <? endif; ?>
        &nbsp;<input type="reset" value="<?= GetMessage("FORM_RESET"); ?>"/>
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)
?>


