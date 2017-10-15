<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//pRU($arResult);
?>
<?$APPLICATION->IncludeComponent(
    "freezone:inner_banner",
    "",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "SECTION_ID" => $arResult["ID"]
    )
);?>
<?if(!$arResult["UF_WRAP_STYLE"]){?>
<?$this->SetViewTarget('elems_list_wrap_head');?>
<section class="scroll-to-wrap container section-wrap section-wrap-inpage">
<?$this->EndViewTarget();?>
<?$this->SetViewTarget('elems_list_wrap_foot');?>
</section>
<?$this->EndViewTarget();?>
<?}?>
<?
if($arResult["UF_LIST"]){?>
<?$this->SetViewTarget('elems_list');?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "section_elements",
    Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "main",
        "IBLOCK_ID" => $arResult["UF_LIST"],
        "NEWS_COUNT" => "1111",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array(
            0 => "DETAIL_PICTURE"
        ),
        "PROPERTY_CODE" => Array(
            0 => "IMAGES",
            1 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "UF_TITLE" => $arResult["UF_LIST_TITLE"],
        "UF_PARENT_ID" => $arParams["IBLOCK_ID"],
        "UF_PARENT_SECT" => $arResult["ID"],
        "UF_PRICE_REG" => $arResult["UF_PRICE_REG"],
        "UF_KITCHEN" => $arResult["UF_KITCHEN"],
        "UF_FORM" => $arResult["UF_FORM"],
    )
); ?>
<?$this->EndViewTarget();?>
<?}?>