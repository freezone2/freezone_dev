<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult['ITEMS'] as $num => $arItem) { ?>
    <?php
    $images_to_left = ($arItem['PROPERTIES']['IMAGE_POS']['VALUE'] == 'LEFT');
    ?>
    <section class="section index-about-comp">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
                <div class="section-wrap">
                    <? ob_start(); ?>
                    <div class="index-about-comp-text <?= ($images_to_left ? 'fl_r' : 'fl_l'); ?>">
                        <h3><?= $arItem['~NAME']; ?></h3>
                        <?= $arItem['PREVIEW_TEXT']; ?>
                    </div>
                    <? $text = ob_get_contents();
                    ob_end_clean(); ?>

                    <? ob_start(); ?>
                    <div class="index-about-comp-preview <?= ($images_to_left ? 'fl_l' : 'fl_r'); ?>">
                        
                        <?if ($arItem['PROPERTIES']['VIDEO']['VALUE']){?>
                          <video width="400" height="400" autoplay>
                            <source src="<?=CFile::GetPath($arItem['PROPERTIES']['VIDEO']['VALUE']);?>" 
                            type='<?=$arItem['PROPERTIES']['VIDEO_TYPE']['~VALUE'];?>'>
                          </video>                        
                        <?} else {?>
                        <img class="<?= $arItem['PROPERTIES']['IMAGE1_CLASS']['VALUE']; ?>"
                             src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="">
                        <img class="<?= $arItem['PROPERTIES']['IMAGE2_CLASS']['VALUE']; ?>"
                             src="<?= $arItem['DETAIL_PICTURE']['SRC']; ?>" alt="">
                        <?}?>
                    </div>
                    <? $images = ob_get_contents();
                    ob_end_clean(); ?>

                    <? echo $text . $images; ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>

