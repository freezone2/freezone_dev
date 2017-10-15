<?
//define('HEADER_SUB_CLASS', 'to-fixed h0');
define('CONTENT_SUB_CLASS', 'content-full');
//define('FOOTER_SUB_CLASS', 'to-fixed');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Freezone (En)");

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
	<!--
	<a id="fp_next"></a>
	<a id="fp_prev"></a>
	-->
    <section class="section index-masthead">
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "main-slides", Array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "main",
                "IBLOCK_ID" => "25",
                "NEWS_COUNT" => "1111",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => Array(),
                "PROPERTY_CODE" => Array(),
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
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>
		<!--
        <div class="masthead-btn-group">
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                    <a href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?>orders/#left" class="button btn-red"><?=Loc::GetMessage('PERSONE_TYPE_USER');?></a>
                    <a href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?>orders/#right" class="button btn-blue"><?=Loc::GetMessage('PERSONE_TYPE_PROF');?></a>
                </div>
            </div>
        </div>
		-->
    </section>
	
	

	<!--
    <? $APPLICATION->IncludeComponent("bitrix:news.list", "main-blocks", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "main_en",
        "IBLOCK_ID" => "24",
        "NEWS_COUNT" => "1111",
        "SORT_BY1" => "ID",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array("DETAIL_PICTURE"),
        "PROPERTY_CODE" => Array( "IMAGE1_CLASS", "IMAGE2_CLASS", "IMAGE_POS", "VIDEO", "VIDEO_TYPE"),
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
        "AJAX_OPTION_ADDITIONAL" => "")
    ); ?>
	-->
	
	
	<div id="advantage-main-block">
		<h2>Our<br />advantages</h2>
		<div id="adv-1">
		<span>The largest flight zone in eastern Europe</span>
		</div>
		<div id="adv-2">
		<span>Prof. training and practice in the disciplines of parachute and trumpet sport</span>
		</div>
		<div id="adv-3">
		<span>2 drop zone nearby</span>
		</div>
		<div id="adv-4">
		<span>5 zones for carrying out trainings, holidays, quests with the possibility of participation from 60 to 150 people</span>
		</div>
		<div id="adv-5">
		<span>Virtual quest and polygon</span>
		</div>
		<div id="adv-6">
		<span>Family Leisure in the Eco-Territory of the Moscow Region</span>
		</div>
		<div id="adv-7">
		<span>Hotel (opening soon)</span>
		</div>
		<div id="adv-8">
		<span>Excursion transport</span>
		</div>
		<div id="adv-9">
		<span>Visa Support</span>
		</div>
		<div id="adv-10">
		<span>Unique coaching staff</span>
		</div>
		<div id="adv-11">
		<span>2 aerotubes produced by the American company Skyventure</span>
		</div>
	</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>