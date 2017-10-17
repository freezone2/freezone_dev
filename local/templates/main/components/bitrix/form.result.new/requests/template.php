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
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	    //pRU($FIELD_SID);
	    //pRU($arQuestion);
        switch ($arQuestion["CAPTION"]) {
            case "Ваше имя":
                $arQuestion["CAPTION_EN"] = 'Your name';
                break;
            case "E-mail":
                $arQuestion["CAPTION_EN"] = $arQuestion["CAPTION"];
                break;
            case "Телефон":
                $arQuestion["CAPTION_EN"] = 'Phone';
                break;
            case "Категория номера":
                $arQuestion["CAPTION_EN"] = 'Room category';
                break;
            case "Дата заезда":
                $arQuestion["CAPTION_EN"] = 'Date from';
                break;
            case "Дата отъезда":
                $arQuestion["CAPTION_EN"] = 'Date to';
                break;
            case "Количество гостей":
                $arQuestion["CAPTION_EN"] = "Guests count";
                break;
            case "Желаемая дата":
                $arQuestion["CAPTION_EN"] = 'Date';
                break;
            case "Желаемое время":
                $arQuestion["CAPTION_EN"] = 'Time';
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
                    <input type="text" class="inputtext input-text<?if($arQuestion['STRUCTURE'][0]["FIELD_TYPE"] == "date" || $arQuestion["CAPTION"] == "Желаемое время"){?> date-text<?}?>" name="form_<?=$arQuestion['STRUCTURE'][0]["FIELD_TYPE"]?>_<?=$arQuestion['STRUCTURE'][0]["ID"]?>" value="" size="0"><?if($arQuestion['STRUCTURE'][0]["FIELD_TYPE"] == "date" || $arQuestion["CAPTION"] == "Желаемое время"){?>
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
<div class="modal-footer">
<input type="submit" name="web_form_submit" class="btn btn-request btn-submit" value="<?=(LANGUAGE_ID == 'en' ? 'Send' : 'Отправить')?>" />
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>