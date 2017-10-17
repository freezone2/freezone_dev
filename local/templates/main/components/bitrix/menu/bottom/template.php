<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
//pRU($arResult);
$arResultExt = array();
foreach($arResult as $arItem){
    if($arItem["PARAMS"]["AIR"]=="Y") {
        if($arItem["PARAMS"]["IS_PARENT"]) {
            $arResultExt["AIR"]["PARENT"] = $arItem;
        }
        else {
            $arResultExt["AIR"]["CHILDREN"][] = $arItem;
        }
    }
    elseif ($arItem["PARAMS"]["EXT"]=="Y") {
        $arResultExt["EXT"][] = $arItem;
    }
    elseif ($arItem["PARAMS"]["AFTER"]=="Y") {
        $arResultExt["AFTER"][] = $arItem;
    }
}
//pRU($arResultExt);
?>
<?if(!empty($arResultExt)){?>
    <?if(isset($arResultExt["AIR"])){?>
        <div class="col-md-3 col-5 item-foot-menu">
            <ul>
                <li class="item-parent ext-menu-title"><a href="<?=$arResultExt["AIR"]["PARENT"]["LINK"]?>"><?=$arResultExt["AIR"]["PARENT"]["TEXT"]?></a>
                    <?if(isset($arResultExt["AIR"]["CHILDREN"])){?>
                        <ul>
                            <?foreach($arResultExt["AIR"]["CHILDREN"] as $arItem){?>
                                <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                            <?}?>
                        </ul>
                    <?}?>
                </li>
            </ul>
        </div>
    <?}?>
    <?if(isset($arResultExt["EXT"])){?>
        <div class="col-md-3 col-5 item-foot-menu">
            <ul>
                <?foreach($arResultExt["EXT"] as $arItem){?>
                    <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?}?>
            </ul>
        </div>
    <?}?>
    <?if(isset($arResultExt["AFTER"])){?>
        <div class="col-md-3 col-5 item-foot-menu">
            <ul>
                <?foreach($arResultExt["AFTER"] as $arItem){?>
                    <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?}?>
            </ul>
        </div>
    <?}?>
<?}?>