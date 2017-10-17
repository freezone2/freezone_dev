<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<?/*if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;*/?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

    <style>
        .form-item.error {
            margin-bottom: 26px !important;
        }
    </style>

    <div class="form-item <?=(preg_match('#имя#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : '');?>">
        <input type="text" placeholder="<?=Loc::GetMessage('FIELD_NAME');?>" name="form_text_9" value="<?=$_POST['form_text_9'];?>"></div>
    <div class="form-item <?=(preg_match('#mail#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : '');?>">
        <input type="text" placeholder="E-mail" name="form_email_10" value="<?=$_POST['form_email_10'];?>"></div>
    <div class="form-item <?=(preg_match('#телефон#simu', $arResult["FORM_ERRORS_TEXT"]) ? 'error' : '');?>">
        <input type="text" class="tel" placeholder="<?=Loc::GetMessage('FIELD_PHONE');?>" name="form_text_11" value="<?=$_POST['form_text_11'];?>"></div>
    <div class="choice-time">
        <p><?=Loc::GetMessage('FIELD_TIMES');?></p>
        <div class="choice-time-list">
            <label for="time-check1" class="time-check">
                <input type="radio" id="time-check1" checked name="form_text_12" value="15"/> <span>15</span>
            </label>

            <label for="time-check2" class="time-check">
                <input type="radio" id="time-check2"  name="form_text_12" value="30"/> <span>30</span>
            </label>

            <label for="time-check3" class="time-check">
                <input type="radio" id="time-check3" name="form_text_12" value="60"/> <span>60</span>
            </label>
        </div>
    </div>
    <div class="more-services">
        <label for="more-services-item1" class="more-services-item">
            <input type="checkbox" checked id="more-services-item1" name="form_checkbox_SIMPLE_QUESTION_490[]" value="13"/> <span><i
                    class="icon-men2"></i><?=Loc::GetMessage('FIELD_ADDON_TRAINER');?></span> </label>
        <label for="more-services-item2" class="more-services-item">
            <input type="checkbox" id="more-services-item2"  name="form_checkbox_SIMPLE_QUESTION_490[]" value="14"/> <span><i
                    class="icon-house"></i><?=Loc::GetMessage('FIELD_ADDON_HOTEL');?></span> </label>
        <label for="more-services-item3" class="more-services-item">
            <input type="checkbox" id="more-services-item3"  name="form_checkbox_SIMPLE_QUESTION_490[]" value="15"/> <span><i
                    class="icon-car"></i><?=Loc::GetMessage('FIELD_ADDON_TRANSFER');?></span> </label>
    </div>
    <button id="order_prof_start" class="btn-red button"><?=Loc::GetMessage('SEND');?></button>
    <script>

        $(function(){
            $('#order_prof_start').unbind('click').off('click').on('click', function(){
                $('#orderprofstart').click();
                return false;
            });

        initMask();
        })

    </script>

	<?
	/*foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	?>
		<tr>
			<td>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</td>
			<td><?=$arQuestion["HTML_CODE"]?></td>
		</tr>
	<?
	} //endwhile
	*/
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
    <div style="display: none">
        <input id="orderprofstart" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
        <?if ($arResult["F_RIGHT"] >= 15):?>
        &nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
        <?endif;?>
        &nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
    </div>

    <?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>