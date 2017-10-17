<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<div class="question-list hide">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="accordion">
                <?foreach($arResult['ITEMS'] as $arItem){?>
                <div class="accordion-item">
                    <p class="accordion-title"><?=$arItem['~NAME'];?></p>
                    <div class="accordion-drop">
                        <p><?=$arItem['~PREVIEW_TEXT'];?></p>
                    </div>
                </div>
                <?}?>
            </div>
            <button class="btn-gray button">
                <?=Loc::getMessage("HIDE");?> <i class="icon-arr-up"></i>
            </button>
        </div>
    </div>

</div>


