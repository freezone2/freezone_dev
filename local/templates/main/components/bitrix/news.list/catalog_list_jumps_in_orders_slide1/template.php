<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

$this->setFrameMode ( true );
\Bitrix\Main\Loader::includeModule( 'sale' );
?>

<div class="cart-list show">
    <div class="tab-menu index-service-list-tab-menu">
        <p><?=Loc::getMessage("TRUBA");?>:</p>
        <ul id="truba_selector">
            <?php
            $tubes = array();
            $res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>13, 'ACTIVE'=>'Y'));
            while ( $sec = $res->GetNext () ) {
                $num ++;
                ?><li <?=($num == 1 ? 'class="active"' : '');?> data-truba="<?=$sec['CODE'];?>"><?=$sec ['CODE'];?> <?=Loc::getMessage("METERS");?></li><?
                $tubes [$sec['SORT']] = $sec ['ID'];
            }
            ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php
        ksort($tubes);
        $tab = 0;
        foreach ( $tubes as $sort => $truba_id ) {

            $item = 0;
            $tab++;

            $current_items = array();
            foreach ( $arResult ['ITEMS'] as $arItem ) {
                if ($arItem ['PROPERTIES']['TRUBA']['VALUE'] != $truba_id) {
                    continue;
                }
                $current_items[] = $arItem;
            }
            ?>
            <div class="tab-item <?=($tab == 1 ? 'show-tab' : '');?>" data-tab="<?=$tab;?>">
                <div class="drop-item index-service-item-group <?=($item == 0 ? 'active' : '');?>">

                    <?php
                    foreach ( $current_items as $mmm => $arItem) {
                        $price = CPrice::GetBasePrice ( $arItem ['ID'] );

                        $item ++;

                        $mans = $arItem ['PROPERTIES'] ['MANS'] ['VALUE'];
                        $flights = $arItem ['PROPERTIES'] ['FLIGHTS'] ['VALUE'];
                        $jumps = $arItem ['PROPERTIES'] ['JUMPS'] ['VALUE'];


                        ?>
                        <div class="index-service-item"
                             data-tariff="<?=$arItem['ID'];?>"
                             data-mans="<?=$mans;?> человек<?=set_end($mans, array('','а',''));?>"
                             data-price="<?=round ( $price ['PRICE'] );?>"
                            data-truba_id="<?=$truba_id;?>">
                            <div class="index-service-item-top">
                                <p class="fl_l">
									<?if (LANGUAGE_ID == 'ru') {?>
									до
									<? } ?>
									<?=$mans;?>
                                    <?if (LANGUAGE_ID == 'ru') {?>
                                        человек<?=set_end ( $mans, array ('а','','') )?>
                                    <?} else {?>
                                        man<?=($mans>1 ? 's' : '');?>
                                    <?}?>
                                </p>
                                <p class="fl_r">
									<!--
									<a name="#" class="fl-hint" 
									<? if (LANGUAGE_ID == 'ru') { ?>
									title="<?=$flights?> полёт<?=set_end ( $flights, array ('','а','а') )?> =  <?=$flights?> мин."
									<?} else {?>
									title="<?=$flights?> flight<?=($flights>1 ? 's' : '');?> = <?=$flights?> min."
									<?}?>
									>
									-->
                                    <?=$flights?>
                                    <?if (LANGUAGE_ID == 'ru') {?>
                                        <!--полёт<?=set_end ( $flights, array ('','а','а') )?>-->мин.
                                    <?} else {?>
                                        <!--flight<?=($flights>1 ? 's' : '');?>-->min.
                                    <?}?>
                                    <?if ($jumps) {?> / <?=$jumps;?>
                                        <?if (LANGUAGE_ID == 'ru') {?>
                                            прыж<?=set_end ( $jumps, array ('ок','ка','ков') )?>
                                        <?}else{?>
                                            jump<?=($jumps>1?'s': '');?>
                                        <?}?>
                                    <?}?>
									</a>
                                </p>
                            </div>
                            <div class="index-service-item-regular">
                                <div class="index-service-item-in">
                                    <p class="title">
                                        <?if (LANGUAGE_ID == 'ru'){?>
                                            <?=$arItem ['~NAME'];?>
                                        <?}else{?>
                                            <?=$arItem ['PROPERTIES']['NAME_EN']['~VALUE'];?>
                                        <?}?>
                                    </p>
                                    <p>
                                        <?if (LANGUAGE_ID == 'ru'){?>
                                            <?=$arItem ['~PREVIEW_TEXT'];?>
                                        <?}else{?>
                                            <?=$arItem ['PROPERTIES']['PREVIEW_TEXT_EN']['~VALUE'];?>
                                        <?}?>
                                    </p>
                                </div>
                                <div class="index-service-item-bottom"><?=round ( $price ['PRICE'] );?>.-</div>

                                <img style="margin-top: 72px;"
                                    src="<?=$arItem ['PREVIEW_PICTURE'] ['SRC'];?>"
                                    alt="" />
                            </div>
                            <div class="index-service-item-drop">
                                <p class="title">
                                    <?if (LANGUAGE_ID == 'ru'){?>
                                        <?=$arItem ['~NAME'];?>
                                    <?}else{?>
                                        <?=$arItem ['PROPERTIES']['NAME_EN']['~VALUE'];?>
                                    <?}?>
                                </p>
                                <div class="index-service-item-bottom"><?=round ( $price ['PRICE'] );?>.-</div>
                                <button data-id="<?=$arItem ['ID'];?>" data-time="<?=$flights?>" class="get_tariff button btn-white"><?=Loc::getMessage("ORDER_FLIGHT");?></button>

                                <a href="/certificate/?tid=<?=$arItem ['ID'];?>#left"><?=Loc::getMessage("CERTIFICATE");?></a>

                            </div>
                        </div>
                        <?
                        if ($item == 3) {
                            $item = 0;
                            $tab++;
                            ?><?if($mmm<sizeof($current_items)-1){?></div><div class="drop-item index-service-item-group"><?}
                        }
                    }
                    ?>
                </div>
            </div>
            <?
        }
        ?>

    </div>
    <button class="btn-gray button">
        <?=Loc::getMessage("NEED_ANSWERS");?> <i class="icon-arr-down"></i>
    </button>
</div>
