<section class="section equipment-history">
    <div class="tab-menu">
        <ul>
            <?foreach($arResult['ITEMS'] as $num => $arItem){?>
            <li class="tan-menu<?=($num+1);?> <?=($num==0 ?'active' : '');?>"><span></span> <br /> <?=$arItem['CODE'];?></li>
            <?}?>
        </ul>
        <img class="tab-menu-img active" src="/local/templates/main/images/tab-active.png" alt="" />
    </div>
    <div class="site-wrapper">
        <div class="site-wrapper-in">
			<div class="section-wrap">
			<h2><?=(LANGUAGE_ID == 'en' ? 'Freezone History' : 'История FreeZone');?></h2>
			</div>
            <div class="equipment-history-in tab-content">
                <?foreach($arResult['ITEMS'] as $num => $arItem):?>
                <div class="tab-item <?=($num==0 ? 'show-tab' : '');?>">
                    <p class="title"><?=$arItem['NAME'];?></p>
                    <p><?=$arItem['PREVIEW_TEXT'];?></p>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</section>
