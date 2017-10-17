<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<section class="section equipment-info<?=(NEW_DES == 1 ? ' container' : "")?>">
    <div class="equipment-info-in">
	  <div class="section-wrap">
	  
        <div class="site-wrapper">
            <div class="site-wrapper-in">
                <div class="tab-content">
                    <?foreach($arResult['ITEMS'] as $num => $arItem):?>
                    <div class="tab-item equipment-info-item show-tab">
                        <div class="equipment-preview">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" />
                            <div class="equipment-preview-info equipment-preview-info-1">
                                <p><?=$arItem['PROPERTIES']['H']['VALUE'];?></p>
                                <span><?=Loc::getMessage("WEIGHT");?></span>
                            </div>
                            <div class="equipment-preview-info equipment-preview-info-2">
                                <p><?=$arItem['PROPERTIES']['D']['VALUE'];?></p>
                                <span><?=Loc::getMessage("DIAMETR");?></span>
                            </div>
                        </div>
                        <p class="title"><?=$arItem['NAME'];?></p>
                        <p class="subtitle"><?=$arItem['PREVIEW_TEXT'];?></p>
                        <ul>
                            <li>
                                <p><?=$arItem['PROPERTIES']['AERO']['VALUE'];?></p>
                                <span><?=Loc::getMessage("TRUBA_TYPE");?></span>
                            </li>
                            <li>
                                <p><?=$arItem['PROPERTIES']['SPEED']['VALUE'];?></p>
                                <span><?=Loc::getMessage("TRUBA_SPEED");?></span>
                            </li>
                            <li>
                                <p><?=$arItem['PROPERTIES']['MANS']['VALUE'];?></p>
                                <span><?=Loc::getMessage("TRUBA_VARIANTS_FLIGHT");?></span>
                            </li>
                        </ul>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
	  </div>
    </div>
</section>