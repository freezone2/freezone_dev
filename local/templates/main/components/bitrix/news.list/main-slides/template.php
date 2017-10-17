<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<ul class="slides">
    <? foreach ($arResult['ITEMS'] as $num => $arItem) { ?>
    <li>
		
        <div class="site-wrapper">
            <div class="site-wrapper-in" <? if ($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]) { ?>onclick="document.location.href='<?= $arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]; ?>'" style="cursor: pointer"<? } ?>>
                <?= $arItem['~NAME']; ?>
            </div>
        </div>
        <div class="slide-img">
            <div class="site-wrapper">
                <div class="site-wrapper-in">
                   <img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt=""/>
					<!--
					<pre>
					<? 
					if ($arItem["PROPERTIES"]["VALUE"]) {
						print_r($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]); 
					}
					?>
					</pre>
					-->
                </div>
            </div>
        </div>
		
    </li>
    <?}?>
</ul>


