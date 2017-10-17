<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<ul class="header-nav-in">
    <?
    foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
        ?>
        <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?endforeach?>

    <?if($USER->isAuthorized()){?>
    <li><a href="/personal/"><?=Loc::getMessage('PERSONAL_PAGE');?></a></li>
        <?if ($USER->isAdmin()){?>
        <li><a href="/cabinet/"><?=Loc::getMessage('ADMIN_PAGE');?></a></li>
        <?}?>
    <?}?>
</ul>

