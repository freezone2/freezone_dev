<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach ($arResult["ITEMS"] as $arItem){?>
<a class="gallery-item" href="<?=$arItem['DETAIL_PAGE_URL'];?>" >
    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" />
    <div class="overlay"></div>
    <p class="title"><?=$arItem['NAME'];?></p>
    <span class="sub-info"><i class="icon-sub-info"></i><?=sizeof($arItem['PROPERTIES']['PHOTOS']['VALUE']);?> </span>
</a>
<?}?>
