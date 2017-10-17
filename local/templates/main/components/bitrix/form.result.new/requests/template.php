<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<div>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title"><?=(LANGUAGE_ID == 'en' ? 'Reservation' : 'Забронировать')?></h3>
</div>
<div class="modal-body lines-form">
    <div class="feedback-note"></div>
    <div class="note-text" data-text="<?=\Bitrix\Main\Localization\Loc::getMessage('FORM_DATA_SAVED_RES')?>"></div>
<?
	$input_mask = "";
	$input_id = "";
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	    //pRU($FIELD_SID);
	    //pRU($arQuestion);
        switch ($arQuestion["CAPTION"]) {
            case "Ваше имя":
                $arQuestion["CAPTION_EN"] = 'Your name';
                $input_id = 'id="name"';
                $input_mask = "";
                break;
            case "E-mail":
                $arQuestion["CAPTION_EN"] = $arQuestion["CAPTION"];
                $input_id = 'id="mail"';
                $input_mask = "";
                break;
            case "Телефон":
                $arQuestion["CAPTION_EN"] = 'Phone';
                $input_id = 'id="pnone"';
                $input_mask = 'data-mask="+7 (000) 000-00-00"';
                break;
            case "Категория номера":
                $arQuestion["CAPTION_EN"] = 'Room category';
                $input_id = '';
                break;
            case "Дата заезда":
                $arQuestion["CAPTION_EN"] = 'Date from';
                $input_id = '';
                $input_mask = 'data-mask="00.00.0000"';
                break;
            case "Дата отъезда":
                $arQuestion["CAPTION_EN"] = 'Date to';
                $input_id = '';
                $input_mask = 'data-mask="00.00.0000"';
                break;
            case "Количество гостей":
                $arQuestion["CAPTION_EN"] = "Guests count";
                $input_id = '';
                $input_mask = "";
                break;
            case "Желаемая дата":
                $arQuestion["CAPTION_EN"] = 'Date';
                $input_id = '';
                $input_mask = "";
                break;
            case "Желаемое время":
                $arQuestion["CAPTION_EN"] = 'Time';
                $input_id = '';
                $input_mask = "";
                break;
        }

		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{?>
            <div class="item-line-form">
                <span class="error"></span>
                <span class="title"><?=(LANGUAGE_ID == 'en' ? $arQuestion["CAPTION_EN"] : $arQuestion["CAPTION"])?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?></span>
                <span class="input">
                <?if($arQuestion["CAPTION"] == "Категория номера"){?>
                    <select class="select" name="form_<?=$arQuestion['STRUCTURE'][0]["FIELD_TYPE"]?>_<?=$arQuestion['STRUCTURE'][0]["ID"]?>">
					    <option value="не важно">не важно</option>
                        <?foreach ($arParams["TYPES_LIST"] as $dt=>$arType){?>
                            <option value="<?=$arType?>"><?=$arType?></option>
                        <?}?>
					</select>
                <?}else{?>
                    <input <?=$input_mask?> type="text" class="inputtext input-text<?if($arQuestion['STRUCTURE'][0]["FIELD_TYPE"] == "date" || $arQuestion["CAPTION"] == "Желаемое время"){?> date-text<?}?>" name="form_<?=$arQuestion['STRUCTURE'][0]["FIELD_TYPE"]?>_<?=$arQuestion['STRUCTURE'][0]["ID"]?>" <?=$input_id?> value="" size="0"><?if($arQuestion['STRUCTURE'][0]["FIELD_TYPE"] == "date" || $arQuestion["CAPTION"] == "Желаемое время"){?>
                    <?$APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            '',
                            array(
                                'SHOW_INPUT' => 'N',
                                'FORM_NAME' => $arResult["arForm"]["SID"],
                                'INPUT_NAME' => $arQuestion['STRUCTURE'][0]["FIELD_TYPE"] == "date" ? "form_date_".$arQuestion['STRUCTURE'][0]["ID"] : "form_text_".$arQuestion['STRUCTURE'][0]["ID"],
                                'SHOW_TIME' => 'N',
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                    <?}?>
                <?}?>
                </span>
            </div>

	<?
		}
	}
	?>
</div>
<script type="text/javascript">
	var rep = /[\.;":'0-9]/; 
	$("#name").on('keypress keyup', function(){
		value = $(this).val().replace(rep, ''); 
		$(this).val(value); 
	});
</script>
<div class="modal-footer">
<input type="submit" name="web_form_submit" class="btn btn-request btn-submit" value="<?=(LANGUAGE_ID == 'en' ? 'Send' : 'Отправить')?>" />
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>