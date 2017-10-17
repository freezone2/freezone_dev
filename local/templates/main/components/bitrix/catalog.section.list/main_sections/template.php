<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//pRU($arResult['SECTIONS']);
if(empty($arResult['SECTIONS'])) return false;
?>
<section class="section sect-main-item<?=($arParams["UF_IN_MAIN_PAGE"]=="Y" ? " sect-index-item" : "")?><?=($arParams["UF_INNER_PAGE"]=="Y" ? " sect-inner-item" : "")?>">
    <div class="section-wrap container">
        <?=($arParams["UF_INNER_TITLE"] ? "<h2>".$arParams["UF_INNER_TITLE"]."</h2>" : "")?>
        <div class="row">
            <?
            $obParser = new CTextParser;
            foreach ($arResult['SECTIONS'] as $arSection)
            {
                ?><div class="col-md-3 col-xs-3 sect-item">
                <a class="sect-item-link" style="background-image: url('<?=$arSection["PICTURE"]["SRC"]?>')" href="<?=$arSection["SECTION_PAGE_URL"]?>">
                    <span class="item-wrap">
                        <span class="item-title"><?=$arSection["NAME"]?></span>
                        <span class="item-text"><?=$obParser->html_cut($arSection["UF_INNER_TEXT"], 150);?></span>
                    </span>
                </a>
            </div><?
            }
            ?>
        </div>
    </div>
</section>
