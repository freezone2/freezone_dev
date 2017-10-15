<?php
use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Localization,
    Bitrix\Main\Loader,
    Bitrix\Iblock;


class FreezoneInPagesComponent extends CBitrixComponent
{
    public function __construct($component = null)
    {
        parent::__construct($component);
        Localization\Loc::loadMessages(__FILE__);
        Loader::includeModule("iblock");
    }

    public function onPrepareComponentParams($arParams)
    {
        // pRU($arParams);

        $arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
        $arParams["SECTION_ID"] = trim($arParams["SECTION_ID"]);

        return $arParams;
    }

    public function executeComponent()
    {
        global $APPLICATION, $CACHE_MANAGER;

        if(empty($this->arParams["IBLOCK_ID"]))
        {
            return;
        }

        $componentPage = "";
        $iblock_id = $this->arParams["IBLOCK_ID"];
        $requestURL = $APPLICATION->GetCurPage(false);
        $searchArr = array();
        $replaceArr = array();
        if(LANGUAGE_ID == 'en') {
            $searchArr[] = 'en/';
            $replaceArr[] = '';
        }
        $searchArr[] = '/';
        $replaceArr[] = '';

        $requestURL = str_replace($searchArr, $replaceArr, $requestURL);
        $arResult = array();

        $cacheId = $requestURL."|".SITE_ID."|".$iblock_id;
        if(strlen($requestURL) > 0) {
            $cache = new CPHPCache;
            if ($cache->StartDataCache(3600, $cacheId, "iblock_pages_find"))
            {
                if (defined("BX_COMP_MANAGED_CACHE"))
                {
                    $CACHE_MANAGER->StartTagCache("iblock_pages_find");
                    CIBlock::registerWithTagCache($iblock_id);
                }

//                pRU($requestURL);
                $arSort = array();
                $arFilter = array (
                    "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                    "CODE" => $requestURL,
                    "ACTIVE" => "Y",
                );

                $arSelect = array("IBLOCK_ID", "ID", "SECTION_ID", "DESCRIPTION", "UF_INNER_BANNER", "UF_INNER_TEXT", "UF_REQUEST_TABLE", "UF_FORM", "UF_LIST", "UF_PRICE_REG", "UF_LIST_TITLE", "UF_HOTEL", "UF_KITCHEN", "UF_WRAP_STYLE");
                $rsSection = CIBlockSection::GetList($arSort, $arFilter, false, $arSelect);
                if($obSection = $rsSection->GetNext())
                {
                    if($obSection["UF_INNER_BANNER"]) {
                        $obSection["UF_INNER_BANNER"] = CFile::GetFileArray($obSection["UF_INNER_BANNER"]);
                    }
                    $arResult = $obSection;
                    $componentPage = "list";
                }

                if (defined("BX_COMP_MANAGED_CACHE"))
                    $CACHE_MANAGER->AbortTagCache();
                $cache->AbortDataCache();
            }
        }

        $this->arResult = $arResult;
//         pRU($componentPage);
//         pRU($arResult);
        if($componentPage)
            $this->includeComponentTemplate($componentPage);
        else return;
    }
}