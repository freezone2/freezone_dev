<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!empty($arParams["UF_PARENT_ID"]) && !empty($arParams["UF_PARENT_SECT"])) {
    $arFilter = array (
        "IBLOCK_ID" => $arParams["UF_PARENT_ID"],
        "ID" => $arParams["UF_PARENT_SECT"],
        "ACTIVE" => "Y",
    );

    $arSelect = array("IBLOCK", "ID", "SECTION_ID", "DESCRIPTION", "UF_INNER_BANNER", "UF_INNER_TEXT", "UF_REQUEST_TABLE", "UF_FORM");
    $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
    if($obSection = $rsSection->GetNext())
    {
        $arResult["EXT_SECTION"] = $obSection;
    }
}

$arParams["POPUP_IMAGE_WIDTH"] = "1500";
$arParams["POPUP_IMAGE_HEIGHT" ]= "1500";
$arParams["BIG_IMAGE_WIDTH"] = "642";
$arParams["BIG_IMAGE_HEIGHT"] = "430";
$arParams["SMALL_IMAGE_WIDTH"] = "98";
$arParams["SMALL_IMAGE_HEIGHT"] = "65";

if(!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as $num => &$arItem) {
		
		if(isset($arItem["PROPERTIES"]["TEMPL"]["VALUE"])) {
			
		}
		
        $arItem["IMAGES_ID"] = array();
        if(!empty($arItem["DETAIL_PICTURE"])) {
            if(is_array($arItem["DETAIL_PICTURE"])) {
                $arItem["IMAGES_ID"][] = $arItem["DETAIL_PICTURE"]["ID"];
            }
            else {
                $arItem["IMAGES_ID"][] = $arItem["DETAIL_PICTURE"];
            }
        }
        if(!empty($arItem["PROPERTIES"]["IMAGES"]["VALUE"])) {
            foreach ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] as $arImage)
            {
                $arItem["IMAGES_ID"][] = $arImage;
            }
        }

        $arItem['SMALL_IMAGE_COUNT'] = 0;
        $arItem['POPUP_IMAGE_COUNT'] = 0;
        $arItem["IMAGES"] = array();
        if(!empty($arItem["IMAGES_ID"])){
            foreach ($arItem["IMAGES_ID"] as $arImage)
            {
                $arItem["IMAGES"][] = array(
                    "ID" => $arImage,
                    "POPUP_IMAGE" => getResizeImageSrc($arImage, $arParams["POPUP_IMAGE_WIDTH"], $arParams["POPUP_IMAGE_HEIGHT"]),
                    "BIG_IMAGE" => getResizeImageSrc($arImage, $arParams["BIG_IMAGE_WIDTH"], $arParams["BIG_IMAGE_HEIGHT"]),
                    "SMALL_IMAGE" => getResizeImageSrc($arImage, $arParams["SMALL_IMAGE_WIDTH"], $arParams["SMALL_IMAGE_HEIGHT"]),
                );
                $arItem['SMALL_IMAGE_COUNT']++;
                $arItem['POPUP_IMAGE_COUNT']++;
            }
        }
    }
    unset($arItem);
}
// pRU($arResult['ITEMS']);
// pRU($arParams["UF_KITCHEN"]);
if($arParams["UF_KITCHEN"]){

    $arSections = array();
    $arSectionsInfo = array();

    foreach ($arResult['ITEMS'] as $num => $arItem) {
        $arSections[] = $arItem['PROPERTIES']["DISHES"]["VALUE"];
    }

    if(!empty($arSections)) {
        $arSections = array_unique($arSections);
        $arFilter = array (
            "SECTION_ID" => $arSections,
            "ACTIVE" => "Y",
        );
        $arSelect = array("IBLOCK_ID", "ID", "IBLOCK_SECTION_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_*");
        $rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while($obElement = $rsElement->GetNextElement())
        {
            $arFields = $obElement->GetFields();
            $arProps = $obElement->GetProperties();
            $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
            if($arFile)
                $arFields["PREVIEW_PICTURE"] = $arFile;
            $arSectionsInfo[$arFields["IBLOCK_SECTION_ID"]][$arFields["ID"]] = array(
                "ID" => $arFields["ID"],
                "NAME" => $arFields["NAME"],
                "PREVIEW_PICTURE" => $arFields["PREVIEW_PICTURE"],
                "PROPERTIES" => $arProps,
            );
        }
    }
    $arResult["DISHES"] = $arSectionsInfo;
    // pRU($arSectionsInfo);
}