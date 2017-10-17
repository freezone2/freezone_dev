<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult1 = array();
foreach($arResult as $k=>$arItem) {
    if($arItem["PARAMS"]["AIR"] == "Y") {
        if(!$arItem["IS_PARENT"]) {
            $arResult1["AIR"]["CHILDREN"][] = $arItem;
            unset($arResult[$k]);
        }
    }
}

if(!empty($arResult)){?>
    <ul class="header-nav-in">
        <?foreach ($arResult as $arItem)
        {
            $class = $arItem["PARAMS"]["AIR"] == "Y" && $arItem['IS_PARENT'] ? "parent-item item" : "item";
            ?><li class="<?=$class?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <?if($arItem["PARAMS"]["AIR"] == "Y" && $arItem['IS_PARENT']){?>
            <?if(isset($arResult1["AIR"]["CHILDREN"])){
                ?><ul><?
                foreach ($arResult1["AIR"]["CHILDREN"] as $arItemChild)
                {
                    ?><li><a href="<?=$arItemChild["LINK"]?>"><?=$arItemChild["TEXT"]?></a></li><?
                }
                ?></ul>
            <?}?>
            <?}?></li><?
        }?>
    </ul>
<?}?>