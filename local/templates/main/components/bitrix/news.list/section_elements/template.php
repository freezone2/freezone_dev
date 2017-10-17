<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if(empty($arResult['ITEMS'])) return false;?>
<?
if(!$arParams["UF_PRICE_REG"]) {
    $arParams["UF_PRICE_REG"] = GetMessage("TEXT_PRICE_FROM")." #PRICE#";
}
?>
<section class="container container-list-elements">
<?=($arParams["UF_TITLE"] ? "<h2>".$arParams["UF_TITLE"]."</h2>" : "")?>
<?$arResImg = array();
?><div class="item-elem-list"><?
foreach ($arResult['ITEMS'] as $num => $arItem) {?>
    <div class="item-elem-content">
        <?if($arParams["UF_KITCHEN"]){?><h2><?=$arItem['NAME']?></h2><div class="clearfix"></div><?}?>
        <div class="item-elem row">
            <div class="col-md-6 col-sm-6">
                <?if(isset($arItem["IMAGES"]) && !empty($arItem["IMAGES"])){?>
                    <div class="product-card-gallery">
                        <div class="product-card-gallery-photo">
                            <?$fi=1;foreach($arItem["IMAGES"] as $itemImg){?>
                                <div class="product-card-gallery-photo-slide" data-num='<?=$fi?>'>
                                    <a <?if($arItem['POPUP_IMAGE_COUNT']>0){?> data-popup="1" data-fancybox="gallery_<?=$arItem["ID"]?>" data-thumb="<?=$itemImg["SMALL_IMAGE"]?>" href="<?=$itemImg["POPUP_IMAGE"]?>"<?}?>>
                                        <span class="product-card-gallery-photo-table"><span class="product-card-gallery-photo-cell"><img src="<?=$itemImg["BIG_IMAGE"]?>" alt=""></span></span>
                                    </a>
                                </div>
                            <?$fi++;}?>
                        </div>
                        <?if($arItem['SMALL_IMAGE_COUNT']>0){?>
                            <div class="product-card-gallery-nav">
                                <?foreach($arItem["IMAGES"] as $itemImg){?>
                                    <div class="product-card-gallery-nav-slide">
                                        <div class="product-card-gallery-nav-img">
                                            <span class="product-card-gallery-nav-img-table">
                                                <span class="product-card-gallery-nav-img-cell">
                                                    <img src="<?=$itemImg["SMALL_IMAGE"]?>" width="98" height="65" alt="">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                <?}?>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>
            <div class="col-md-6 col-sm-6 left-part-img">
                <?if(!$arParams["UF_KITCHEN"]){?><div class="item-name"><?=$arItem['NAME']?></div><?}?>
                <?if(strlen($arItem["DETAIL_TEXT"])>0){?><div class="item-text"><?=$arItem["DETAIL_TEXT"]?></div><?}?>
                <?if($arItem["PROPERTIES"]["NUM"]["VALUE"]){?><div class="item-prop ext-num"><span><?=$arItem["PROPERTIES"]["NUM"]["VALUE"]?></span></div><?}?>
                <?if(!empty($arItem["PROPERTIES"]["PARAMS"]["VALUE"]) && is_array($arItem["PROPERTIES"]["PARAMS"]["VALUE"])){?>
                    <div class="item-prop ext-params"><span><?=implode(", ", $arItem["PROPERTIES"]["PARAMS"]["VALUE"])?></span></div>
                <?}?>
                <?if($arItem["PROPERTIES"]["BATH"]["VALUE"] == "Да"){?><div class="item-prop ext-bath"><span><?=GetMessage("TEXT_BATH")?></span></div><?}?>
                <?/*if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?><div class="item-prop ext-price"><span><?=str_replace("#PRICE#", "<b>".format_price($arItem["PROPERTIES"]["PRICE"]["VALUE"])."</b>", $arParams["UF_PRICE_REG"])?></span></div><?}*/?>
                <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?><div class="item-prop ext-price"><span><?=str_replace("#PRICE#", "<b>".$arItem["PROPERTIES"]["PRICE"]["VALUE"]."</b>", $arParams["UF_PRICE_REG"])?></span></div><?}?>
                <?if(count($arItem['PROPERTIES']["LIST_PARAMS"]["VALUE"])>0){?>
                    <ul class="list-prop-param">
                        <? foreach ($arItem['PROPERTIES']["LIST_PARAMS"]["VALUE"] as $arItParam)
                        {
                            ?><li class="clearfix"><i></i><span><?=$arItParam?></span></li><?
                        }?>
                    </ul>
                <?}?>
                <?if($arParams["UF_FORM"]){?>
                <div><a href="#form_<?=$arResult["EXT_SECTION"]["UF_FORM"]?>" class="item-btn btn btn-request" data-toggle="modal"><?=\Bitrix\Main\Localization\Loc::getMessage("TEXT_ADD")?></a></div><?}?>
            </div>
        </div>

    <?
    if($arItem['PROPERTIES']["DISHES"]["VALUE"] && isset($arResult["DISHES"][$arItem['PROPERTIES']["DISHES"]["VALUE"]])){
        ?><div class="item-dishes-list">
        <h2><?=\Bitrix\Main\Localization\Loc::getMessage("TEXT_FOOD")?></h2>
            <div class="item-dishes-wrap container">
                <div class="item-dishes-row row">
            <?
            $itemSect = $arResult["DISHES"][$arItem['PROPERTIES']["DISHES"]["VALUE"]];
            foreach ($itemSect as $item)
            {
                ?>
                <div class="item-dish">
                    <div class="item-img"><img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" alt=""></div>
                    <div class="item-info">
                        <span class="item-check"><?=$item["NAME"]?></span>
                        <span class="item-in-props"><?=$item["PROPERTIES"]["WEIGHT"]["VALUE"]?><?=$item["PROPERTIES"]["WEIGHT"]["DESCRIPTION"]?> <i></i> <?=format_price($item["PROPERTIES"]["PRICE"]["VALUE"])?> <?=\Bitrix\Main\Localization\Loc::getMessage("TEXT_RUB")?></span>
                    </div>
                </div>
                <?
            }
            ?>
                </div>
            </div>
        </div>
      <?
    }?>
    </div>
<? } ?>
</div>
</section>
<?/*$this->SetViewTarget("modal-gallery-element");?>
    <?if(!empty($arResImg)){
        foreach ($arResImg as $item)
        {
            echo $item;
        }
    }?>
<?$this->EndViewTarget();*/?>