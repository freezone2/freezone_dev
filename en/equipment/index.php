<?
//define('HEADER_SUB_CLASS', 'h0 to-fixed');
define('CONTENT_SUB_CLASS', 'content-full');
//define('FOOTER_SUB_CLASS', 'to-fixed');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Equipment");
?>
	<!--
	<a id="fp_next"></a>
	<a id="fp_prev"></a>
	-->
    <section class="section about-page about-masthead<?=(NEW_DES == 1 ? ' text-eq-wrap' : "")?>">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
                <p><?echo COption::GetOptionString( "askaron.settings", "UF_EQ_TITLE_EN" );?></p>
            </div>
        </div>
        <div class="slide-img">
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                    <img src="<?echo CFile::GetPath(COption::GetOptionString( "askaron.settings", "UF_EQ_IMAGE" ));?>" alt="" />
                </div>
            </div>
        </div>
    </section>

	
	<section class="section equipment-info<?=(NEW_DES == 1 ? ' container' : "")?>">
    <div class="equipment-info-in">
	  <div class="section-wrap">
	  
	  <p class="equipment-info-in-an">Two aerotubes produced by the American company Skyventure - the world leader in this field. <br /> The size of the flight zone is the largest in Russia / Europe.</p>
	
	  </div>
	</div>
	</section>
    
    <? $APPLICATION->IncludeComponent("bitrix:news.list", "equipment", Array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "",
            "IBLOCK_ID" => "40",
            "NEWS_COUNT" => "1111",
            "SORT_BY1" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => Array(),
            "PROPERTY_CODE" => Array("AERO", "SPEED", "MANS", "H", "D"),
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


  

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>