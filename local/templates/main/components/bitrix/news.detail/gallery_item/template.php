<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<section class="photo-page">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="gallery-item-in">
                <?
                foreach($arResult['DISPLAY_PROPERTIES']['PHOTOS']['FILE_VALUE'] as $file) {
				$ff = CFile::ResizeImageGet($file['ID'], array('width'=>1000, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
				$ff_small = CFile::ResizeImageGet($file['ID'], array('width'=>216, 'height'=>144), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                ?>
                    <a title="<?=$file['DESCRIPTION'];?>" class="fancybox-img" rel="group" href="<?=$ff['src'];?>" data-fancybox="gallery"><img src="<?=$ff_small['src'];?>" alt="" /></a>

                <?}?>
            </div>
        </div>
    </div>
</section>