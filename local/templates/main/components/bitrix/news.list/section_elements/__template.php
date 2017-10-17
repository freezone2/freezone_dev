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
                            <?foreach($arItem["IMAGES"] as $itemImg){?>
                                <div class="product-card-gallery-photo-slide">
                                    <a <?if($arItem['POPUP_IMAGE_COUNT']>0){?>href="#modal-gallery-<?=$arItem["ID"]?>" data-toggle="modal"<?}?>>
                                        <span class="product-card-gallery-photo-table"><span class="product-card-gallery-photo-cell"><img src="<?=$itemImg["BIG_IMAGE"]?>" alt=""></span></span>
                                    </a>
                                </div>
                            <?}?>
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
                <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?><div class="item-prop ext-price"><span><?=str_replace("#PRICE#", "<b>".format_price($arItem["PROPERTIES"]["PRICE"]["VALUE"])."</b>", $arParams["UF_PRICE_REG"])?></span></div><?}?>
                <?if(count($arItem['PROPERTIES']["LIST_PARAMS"]["VALUE"])>0){?>
                    <ul class="list-prop-param">
                        <? foreach ($arItem['PROPERTIES']["LIST_PARAMS"]["VALUE"] as $arItParam)
                        {
                            ?><li class="clearfix"><i></i><span><?=$arItParam?></span></li><?
                        }?>
                    </ul>
                <?}?>
                <?if($arParams["UF_FORM"]){?>
                <div><a href="#form_<?=$arResult["EXT_SECTION"]["UF_FORM"]?>" class="item-btn btn btn-request" data-toggle="modal">Забронировать</a></div><?}?>
            </div>
        </div>

    <?
    if($arItem['PROPERTIES']["DISHES"]["VALUE"] && isset($arResult["DISHES"][$arItem['PROPERTIES']["DISHES"]["VALUE"]])){
        ?><div class="item-dishes-list">
        <h2>Блюда нашей кухни</h2>
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
                        <span class="item-in-props"><?=$item["PROPERTIES"]["WEIGHT"]["VALUE"]?><?=$item["PROPERTIES"]["WEIGHT"]["DESCRIPTION"]?> <i></i> <?=format_price($item["PROPERTIES"]["PRICE"]["VALUE"])?> руб.</span>
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
    <?if( isset($arItem["IMAGES"]) && !empty($arItem["IMAGES"]) && $arItem['POPUP_IMAGE_COUNT']>0 ){?>
        <? ob_start(); ?>
        <div class="modal modal-center medium modal-gallery" id="modal-gallery-<?=$arItem["ID"]?>" tabindex="-1" role="dialog">
            <div class="modal-wrapper-table">
                <div class="modal-wrapper-cell">
                    <div class="modal-wrapper-overflow">
                        <div class="modal-wrapper-block">
                            <a href="#" class="modal-close" data-dismiss="modal" aria-hidden="true"></a>
                            <div class="modal-title"><?=$arItem["NAME"]?></div>
                            <div class="modal-gallery-section">
                                <div class="modal-gallery-photo">
                                    <?foreach($arItem["IMAGES"] as $itemImg){?>
                                        <div class="modal-gallery-photo-slide">
                                            <span class="modal-gallery-photo-table"><span class="modal-gallery-photo-cell"><img src="<?=$itemImg["POPUP_IMAGE"]?>" alt=""></span></span>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="modal-gallery-nav-wrapper">
                                    <div class="modal-gallery-nav">
                                        <?foreach($arItem["IMAGES"] as $itemImg){?>
                                            <div class="modal-gallery-nav-slide">
                                                <div class="product-card-gallery-nav-img">
                                                    <span class="product-card-gallery-nav-img-table"><span class="product-card-gallery-nav-img-cell"><img src="<?=$itemImg["SMALL_IMAGE"]?>" width="98" height="65" alt=""></span></span>
                                                </div>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-w-m" data-dismiss="modal" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
        <? $arResImg[$arItem["ID"]] = ob_get_contents();
        ob_end_clean(); ?>
    <?}?>
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