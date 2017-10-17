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

if(!empty($arResult1)){?>
    <div class="header-nav-row">
        <?foreach ($arResult as $arItem)
        {
            $class = $arItem["PARAMS"]["AIR"] == "Y" && $arItem['IS_PARENT'] ? "parent-item item" : "item";
            ?><div class="row">
            <div class="col-xs-12 <?=$class?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div></div>
            <?if($arItem["PARAMS"]["AIR"] == "Y" && $arItem['IS_PARENT']){?>
            <?if(isset($arResult1["AIR"]["CHILDREN"])){
                ?><div class="row"><?
                foreach ($arResult1["AIR"]["CHILDREN"] as $arItemChild)
                {
                    ?><div class="col-xs-12 col-sm-4 child-item"><a href="<?=$arItemChild["LINK"]?>"><?=$arItemChild["TEXT"]?></a></div><?
                }
                ?></div>
            <?}?>
        <?}?><?
        }?>
    </div>
<?}?>