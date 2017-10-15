<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// pRU($arResult);
if(empty($arResult)) return false;
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<?if(isset($arResult["UF_INNER_BANNER"]["SRC"])){?>
<section class="inner-section-banner" style="background-image: url(<?=$arResult["UF_INNER_BANNER"]["SRC"]?>)">
    <div class="container">
        <div class="table">
            <div class="table-row">
                <div class="table-cell">
                    <div class="text"><?=$arResult["~DESCRIPTION"]?></div>
                    <?if($arResult["UF_FORM"]){?>
                    <a href="#form_<?=$arResult["UF_FORM"]?>" class="btn btn-request" data-toggle="modal"><?=Loc::getMessage("TEXT_ADD")?></a><br>
                    <?}?>
                    <a href="#" class="page-arrow-scroll"></a>
                </div>
            </div>
            <div class="table-row bottom"></div>
        </div>
    </div>
</section>
<?}?>
<?if($arResult["UF_FORM"]){?>
<?$this->SetViewTarget('form_request');?>
<div class="form-requests modal modal-center modal-medium" id="form_<?=$arResult["UF_FORM"]?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "requests",
                Array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPONENT_TEMPLATE" => "requests",
                    "EDIT_URL" => "",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "Y",
                    "VARIABLE_ALIASES" => array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID",),
                    "WEB_FORM_ID" => $arResult["UF_FORM"],
                    "UF_REQUEST_TABLE" => $arResult["UF_REQUEST_TABLE"],
                    "TYPES_LIST" => !empty($arResult["TYPES"]) ? $arResult["TYPES"] : array()
                )
            );?>
        </div>
    </div>
</div>
<?$this->EndViewTarget();?>
<?}?>
