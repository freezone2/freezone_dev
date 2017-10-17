<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

global $months_rus1;
?>
<section class="news-in" id="news-link">
    <article class="news-wrapper">
        <div class="news-date">
            <p><i class="icon-calendar"></i> <span><?=Loc::getMessage("FILTER");?></span></p>
            <div class="choice-date">
                <i class="icon-close-select"></i>
                <div class="center">
                    <select>
                        <?for($i=date('Y');$i>=2016;$i--){?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                        <?}?>
                    </select>
                    <div class="mounts-list">
                        <ul>
                            <?php
                            foreach($months_rus1 as $num => $month){
                            ?>
                            <li <?=($num+1 == intval(date('m')) ? 'class="active"' : '');?>><?=$month;?></li>
                            <?}?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="cleafix">
            <aside class="sidebar">

                <? $APPLICATION->IncludeComponent("bitrix:news.list", "news_banners", Array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_ID" => (LANGUAGE_ID == 'ru' ? "18" : '28'),
                        "NEWS_COUNT" => "9999",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "",
                        "SORT_ORDER2" => "",
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
                <?if (COption::GetOptionString( "askaron.settings", "UF_NEWS_SIDEBAR" ) == 1) {?>
                <div class="sidebar-in">
                    <p class="title"><?=Loc::getMessage("CHAMPIONSHIP");?></p>
                    <ul>
                        <li><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_NEWS_SHEDULE_LINK" );?>"><i class="icon-file2"></i><?=Loc::getMessage("SCHEDULE");?></a></li>
                        <li><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_NEWS_PERSONS_LINK" );?>"><i class="icon-file2"></i><?=Loc::getMessage("PERSONS_LIST");?></a></li>
                        <li><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_NEWS_RULES" );?>"><i class="icon-file2"></i><?=Loc::getMessage("REG_RULES");?></a></li>
                    </ul>
                    <a href="<?=CFile::GetPath(COption::GetOptionString( "askaron.settings", "UF_NEWS_PDF" ));?>" target="_blank"><?=Loc::getMessage("DOWNLOAD_PDF");?></a>
                </div>
                <?}?>
            </aside>
            <div class="accordion news-list">
                <?foreach($arResult['ITEMS'] as $arItem){?>
                <div class="accordion-item news-item" 
                     data-year="<?=date('Y', strtotime($arItem['DISPLAY_ACTIVE_FROM']));?>"
                        data-month="<?=intval(date('m', strtotime($arItem['DISPLAY_ACTIVE_FROM'])));?>">
                    <div class="accordion-title">
                        <p class="title"><?=$arItem['~NAME'];?></p>
                        <p><?=$arItem['~PREVIEW_TEXT'];?></p>
                    </div>
                    <?if ($arItem['~DETAIL_TEXT']){?>
                    <div class="accordion-drop">
                        <div class="news-item-bottom">
                        <?=$arItem['~DETAIL_TEXT'];?>
                        </div>
                    </div>
                    <?}?>
                    <span class="date-news"> <?=$arItem['DISPLAY_ACTIVE_FROM'];?></span>
                </div>
                <?}?>
            </div>
        </div>
    </article>
</section>