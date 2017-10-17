<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

if (LANGUAGE_ID == 'ru') {
    $text = COption::GetOptionString("askaron.settings", "UF_TEXT_ABOUT_BLOCKS");
} else {
    $text = COption::GetOptionString("askaron.settings", "UF_TEXT_ABOUT_BLC_EN");
}
?>

<section class="section about-page about-text">
	
    <?if ($text){?>
    <div class="section-wrap more-info-about-text">
        <div class="">
            <h3><?=Loc::getMessage("SCHOOL");?></h3>
            <?=$text;?>
        </div>
    </div>
    <?}?>
	
	
	<div id="tabs" class="section-wrap">
		<div class="slider-nav school-nav">
		<p><?=Loc::getMessage("SPEC_PROGRAMS");?>:</p>
		<ul>
			<?foreach($arResult['ITEMS'] as $num => $arItem):?>
			<li><a href="#tabs-<?= $num ?>"><?=$arItem['NAME'];?></a></li>
			<?endforeach;?>
		</ul>
		</div>
		<?foreach($arResult['ITEMS'] as $num => $arItem):?>
		<div class="site-wrapper slider-school" id="tabs-<?= $num ?>">
			<div class="site-wrapper-in">
				<div class="section-wrap">
					<div class="slide">
						<div class="about-comp-text fl_l">
							<h3><?=$arItem['NAME'];?></h3>
							<?=$arItem['~PREVIEW_TEXT'];?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?endforeach;?>
	
	</div>
</section>


 