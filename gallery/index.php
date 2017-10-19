<?
//define('HEADER_SUB_CLASS', 'header-dark header-min');
define('CONTENT_SUB_CLASS', 'no-full section');
//define('FOOTER_SUB_CLASS', 'hide-line footer-dark to-fixed');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");
$APPLICATION->SetPageProperty("title", "Галерея");

$APPLICATION->SetPageProperty("title", "Галерея фото и видео из аэротрубы");
$APPLICATION->SetPageProperty("description", "Фото и видео полетов в аэротрубе наших гостей и инструкторов. Видео выступлений по дисциплинам аэротрубного спорта.");
$APPLICATION->SetPageProperty("keywords", "аэротруба фото, аэротруба видео, полеты в аэротрубе, смотреть");
?>

    <section class="gallery-page<?=(NEW_DES == 1 ? ' container' : "")?>">
	  <div class="section-wrap">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
			
			<h1 class="center">Галерея</h1>
			
			<h2>Аэротруба 12/'12</h2>
			<?$APPLICATION->IncludeComponent("bitrix:news.detail","gallery_item",Array(
					"IBLOCK_ID"=>11,
					"IBLOCK_TYPE"=>"main",
					"ELEMENT_CODE"=>"aerotruba-12-12-1",
					"PROPERTY_CODE"=>Array('PHOTOS'),
				)
			);?>
			
			<h2>Аэротруба 17/'17</h2>
			<?$APPLICATION->IncludeComponent("bitrix:news.detail","gallery_item",Array(
					"IBLOCK_ID"=>11,
					"IBLOCK_TYPE"=>"main",
					"ELEMENT_CODE"=>"polyety-v-trube-17-17",
					"PROPERTY_CODE"=>Array('PHOTOS'),
				)
			);?>
			
			<h2>Общие</h2>
			<?$APPLICATION->IncludeComponent("bitrix:news.detail","gallery_item",Array(
					"IBLOCK_ID"=>11,
					"IBLOCK_TYPE"=>"main",
					"ELEMENT_CODE"=>"obshchie",
					"PROPERTY_CODE"=>Array('PHOTOS'),
				)
			);?>
			
			<h2>Видео</h2>
			<div class="video-block">
			<? $APPLICATION->IncludeComponent("bitrix:news.list", "video_main", Array(
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "",
                                "IBLOCK_ID" => "12",
                                "NEWS_COUNT" => "1111",
                                "SORT_BY1" => "ID",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ID",
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
			</div>
			
            </div>
        </div>
	  </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>