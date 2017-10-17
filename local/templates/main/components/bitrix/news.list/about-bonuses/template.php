<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<div class="more-info-about">
    <ul>
        <?foreach($arResult['ITEMS'] as $arItem){?>
        <li>
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                    <i><img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt=""/></i>
                </div>
                <div class="site-wrapper-in">
                    <p><?=$arItem['~NAME'];?></p>
                </div>
            </div>
        </li>
        <?}?>

    </ul>
</div>