<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;


$aMenuLinksExt=$APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "IS_SEF" => "Y",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => MAIN_SECTIONS,
        "SECTION_URL" => "",
        "DEPTH_LEVEL" => "1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ),
    false
);
//pRU($aMenuLinks);
$aMenuLinks1 = array();
$aMenuLinks2 = array();
if(!empty($aMenuLinks)) {
    foreach ($aMenuLinks as $k=>$aMenuLink)
    {
        if($aMenuLink[3]["AIR"] == "Y") {
            $aMenuLinks[$k][3]["FROM_IBLOCK"] = 1;
            $aMenuLinks[$k][3]["IS_PARENT"] = "";
            $aMenuLinks[$k][3]["DEPTH_LEVEL"] = 2;
            $aMenuLinks1[] = $aMenuLinks[$k];
        }
        else {
            $aMenuLinks2[] = $aMenuLink;
        }
    }
}
if(!empty($aMenuLinksExt)) {
    $needLink = $aMenuLinksExt[0];
    unset($aMenuLinksExt[0]);
    $needLink[3]["FROM_IBLOCK"] = 1;
    $needLink[3]["IS_PARENT"] = 1;
    $needLink[3]["DEPTH_LEVEL"] = 1;
    $needLink[3]["AIR"] = "Y";
    foreach ($aMenuLinksExt as $k=>$aMenuLink)
    {
        $aMenuLinksExt[$k][3] = Array(
            "EXT" => "Y",
        );
    }

    $aMenuLinks = array_merge(array($needLink), $aMenuLinks1, $aMenuLinksExt, $aMenuLinks2);
}