<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult['ITEMS'] as $num => $arItem) { ?>
    <?php
    $images_to_left = ($arItem['PROPERTIES']['IMAGE_POS']['VALUE'] == 'LEFT');
    ?>
    <div class="about-info-item drop-item <?=($num==0 ? 'active':'');?> ">
        <? ob_start(); ?>
        <div class="about-comp-text <?= ($images_to_left ? 'fl_r' : 'fl_l'); ?>">
            <h3><?= $arItem['~NAME']; ?></h3>
            <?= $arItem['PREVIEW_TEXT']; ?>

            <? if ($arItem['PROPERTIES']['SLIDE_COMMENTS']['VALUE']) { ?>
                <div class="slide-comments">
                    <ul class="slides">
                        <? foreach ($arItem['PROPERTIES']['SLIDE_COMMENTS']['VALUE'] as $str) { ?>
                            <li>
                                <span><?= $str; ?></span>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>
        </div>
        <? $text = ob_get_contents();
        ob_end_clean(); ?>

        <? ob_start(); ?>
        <div class="about-comp-preview <?= ($images_to_left ? 'fl_l' : 'fl_r'); ?>">
            <img class="<?= $arItem['PROPERTIES']['IMAGE1_CLASS']['VALUE']; ?>"
                 src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="">
            <img class="<?= $arItem['PROPERTIES']['IMAGE2_CLASS']['VALUE']; ?>"
                 src="<?= $arItem['DETAIL_PICTURE']['SRC']; ?>" alt="">
        </div>
        <? $images = ob_get_contents();
        ob_end_clean(); ?>

        <? if ($images_to_left) {
            echo $images . $text;
        } else {
            echo $text . $images;
        } ?>
    </div>
<? } ?>

