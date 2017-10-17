<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? foreach ($arResult['ITEMS'] as $arItem) {

    $image_left = false;
    if ($arItem['PROPERTIES']['POS']['VALUE'] == 'LEFT') {
        $image_left = true;
    }
    ?>
   
                    <?php
                    ob_start();
                    ?>
                    <div>
                        <?= $arItem['~PREVIEW_TEXT']; ?>
                    </div>
                    <?
                    $text = ob_get_contents();
                    ob_end_clean();
                    ?>


                    <?
                    ob_start();
                    ?>
					<!--
                    <div class="about-comp-preview <?= ($image_left ? 'fl_l' : 'fl_r'); ?>">
                        <div class="images-wrap">
                            <? foreach ($arItem['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'] as $numa => $file) { ?>
                                <img <?= ($numa == 0 ? 'class="active"' : ''); ?> src="<?= $file['SRC']; ?>" alt=""/>
                            <? } ?>
                        </div>
                    </div>
					-->
                    <?php
                    $images = ob_get_contents();
                    ob_end_clean();
                    ?>

                    <?if ($image_left) {
                        echo $images.$text;
                    } else {
                        echo $text.$images;
                    }?>
               
<? } ?>
