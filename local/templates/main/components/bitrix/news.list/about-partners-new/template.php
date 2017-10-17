<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

?>
<section class="section about-page about-partner">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="section-wrap">
                <h3><?=Loc::GetMessage('PARTNERS')?></h3>
                <ul class="partners-list">
                    <? foreach ($arResult['ITEMS'] as $num => $arItem):
                        $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>137, 'height'=>90), BX_RESIZE_IMAGE_EXACT);
                        ?>
                        <li><a href="<?= $arItem['~PREVIEW_TEXT']; ?>" target="_blank">
                                <img src="<?= $file['src']; ?>" alt=""/>
                            </a></li>
                    <? endforeach; ?>
                </ul>

                <div class="about-social">
                    <a target="_blank" class="icon-vk" href="<?echo COption::GetOptionString( "askaron.settings", "UF_VK_LINK" );?>">
                        <img src="/local/templates/main/images/vk-a.png" alt="" />
                        <img src="/local/templates/main/images/vk-a-a.png" alt="" />
                    </a>
                    <a target="_blank" class="icon-fb" href="<?echo COption::GetOptionString( "askaron.settings", "UF_FB_LINK" );?>">
                        <img src="/local/templates/main/images/fb-a.png" alt="" />
                        <img src="/local/templates/main/images/fb-a-a.png" alt="" />

                    </a>
                    <a target="_blank" class="icon-yt" href="<?echo COption::GetOptionString( "askaron.settings", "UF_YT_LINK" );?>">
                        <img src="/local/templates/main/images/yt-a.png" alt="" />
                        <img src="/local/templates/main/images/yt-a-a.png" alt="" />
                    </a>
                    <a target="_blank" class="icon-inst" href="<?echo COption::GetOptionString( "askaron.settings", "UF_INST_LINK" );?>">
                        <img src="/local/templates/main/images/inst-a.png" alt="" />
                        <img src="/local/templates/main/images/inst-a-a.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>