<section class="section equipment-icon-group">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="equipment-icon-group-in">
                <?foreach($arResult['ITEMS'] as $arItem){?>
                <div class="equipment-icon-group-item">
                    <span><img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" /></span>
                    <p><?=$arItem['~NAME'];?>
                    <?if ($arItem['PREVIEW_TEXT']){?><span><?=$arItem['PREVIEW_TEXT'];?></span><?}?></p>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</section>