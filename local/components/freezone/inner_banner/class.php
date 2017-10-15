<?php
use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Localization,
    Bitrix\Main\Loader,
    Bitrix\Iblock;

class FreezoneBannerComponent extends CBitrixComponent
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
        if(empty($this->arParams["SECTION_ID"]) || empty($this->arParams["IBLOCK_ID"]))
        {
            return;
        }

        if($this->startResultCache())
        {
            $this->arResult = array();

            $arSort = array();
            $arFilter = array (
                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                "ID" => $this->arParams["SECTION_ID"],
                "ACTIVE" => "Y",
            );

            $arSelect = array("IBLOCK", "ID", "SECTION_ID", "DESCRIPTION", "UF_INNER_BANNER", "UF_INNER_TEXT", "UF_REQUEST_TABLE", "UF_FORM", "UF_HOTEL", "UF_LIST");
            $arResult = array();
            $rsSection = CIBlockSection::GetList($arSort, $arFilter, false, $arSelect);
            if($obSection = $rsSection->GetNext())
            {
                if($obSection["UF_INNER_BANNER"]) {
                    $obSection["UF_INNER_BANNER"] = CFile::GetFileArray($obSection["UF_INNER_BANNER"]);
                }
                $arResult = $obSection;
            }

            $arResult["TYPES"] = array();
            if($arResult["UF_HOTEL"]) {
                $rs_res = CIBlockElement::GetList(
                    array(),
                    array(
                        "IBLOCK_ID" => $arResult["UF_LIST"],
                        "ACTIVE" => "Y"
                    ),
                    false,
                    false,
                    array(
                        "ID",
                        "NAME"
                    )
                );
                while ($ar_res = $rs_res->GetNext()) {
                    $arResult["TYPES"][$ar_res["ID"]] = $ar_res["NAME"];
                }
            }

            //pRU($arResult);

            $this->arResult = $arResult;
            $this->includeComponentTemplate();

        }
    }
}