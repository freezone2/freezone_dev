<script src="//www.youtube.com/player_api"></script>

<?foreach($arResult['ITEMS'] as $arItem){?>

<a title="<?=$arItem['PREVIEW_TEXT'];?>" class="gallery-item gallery-item-video fancybox fancybox.iframe"
   rel="gallery2"  href="<?=$arItem['CODE'];?>?enablejsapi=1&wmode=opaque" >
    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" />
    <div class="overlay"></div>
    <p class="title"><?=$arItem['NAME'];?></p>
</a>

<?}?>

