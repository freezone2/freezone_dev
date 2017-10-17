<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="section about-cafe about-page about-text">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="section-wrap">
                <div class="about-comp-preview fl_l">
                    <img class="cafe-1" src="<?=$arResult['PREVIEW_PICTURE']['SRC'];?>" alt="">
                    <img class="cafe-2" src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" alt="">
                </div>
                <div class="about-comp-text fl_r">
                    <h3><?=$arResult['NAME'];?></h3>
                    <?=$arResult['~PREVIEW_TEXT'];?>
                </div>
            </div>
        </div>
    </div>
</section>