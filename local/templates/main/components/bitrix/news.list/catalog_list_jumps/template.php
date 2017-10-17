<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

$this->setFrameMode ( true );
\Bitrix\Main\Loader::includeModule( 'sale' );
?>


		<div class="cart-list show">
			<button class="btn-gray q-orange button">
                <?=Loc::getMessage("NEED_ANSWERS");?> <i class="icon-arr-down"></i>
			</button>
			<div class="tab-menu index-service-list-tab-menu">
				<p><?=Loc::GetMessage('TRUBA');?>:</p>
                <ul id="truba_selector">
                    <?php
                    $tubes = array();
                    $res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>13, 'ACTIVE'=>'Y'));
                    while ( $sec = $res->GetNext () ) {
                        $num ++;
                        ?><li <?=($num == 1 ? 'class="active fl-hint"' : 'class="fl-hint"');?> 
						title="<?=($sec['CODE'] == 12 ? 'Базовый: оптимальный вариант для ощущения первого полета.' : 'Базовый+: Для тех, кто уже пробовал Базовый уровень и жаждет более острых ощущений');?>"
						data-truba="<?=$sec['CODE'];?>"><?=$sec ['CODE'];?> <?=Loc::getMessage("METERS");?></li><?
                        $tubes [$sec['SORT']] = $sec ['ID'];
                    }
                    ?>
                </ul>
				<!--
				<p>Сколько Вас:</p>
                <ul id="mans_selector">
                    <li class="active fl-hint" title="Выберите количество человек" data-men="2">1-2</li>
					<li class="fl-hint" title="Выберите количество человек" data-men="3">3-20</li>                
				</ul>
				-->
				<p>Cколько минут:</p>
                <ul id="mins_selector">
                    <li class="active fl-hint" title="Выберите количество минут" data-min="2">2-6</li>
					<li class="fl-hint" title="Выберите количество минут" data-min="10">10-60</li>                
				</ul>
			</div>
			<div class="tab-content">
				<?php
                ksort($tubes);
                $tab = 0;
                foreach ( $tubes as $sort => $truba_id ) {

					$item = 0;
                    $tab++;

                    $current_items = array();
                    foreach ( $arResult ['ITEMS'] as $arItem ) {
                        if ($arItem ['PROPERTIES']['TRUBA']['VALUE'] != $truba_id) {
                            continue;
                        }
                        $current_items[] = $arItem;
                    }
					?>
					<div class="tab-item <?=($tab == 1 ? 'show-tab' : '');?>" data-tab="<?=$tab;?>">
						<div class="drop-item index-service-item-group <?=($item == 0 ? 'active' : '');?>">

							<?php
							foreach ( $current_items as $mmm => $arItem) {
								$price = CPrice::GetBasePrice ( $arItem ['ID'] );

								$item ++;

								$mans = $arItem ['PROPERTIES'] ['MANS'] ['VALUE'];
								$flights = $arItem ['PROPERTIES'] ['FLIGHTS'] ['VALUE'];
								$jumps = $arItem ['PROPERTIES'] ['JUMPS'] ['VALUE'];
								?>
								<div class="index-service-item <?=($flights >= 10 ? 'min10' : 'min2');?>">
									<div class="index-service-item-top">
										<p class="fl_l">
                                            до <?=$mans;?>
                                            <?if (LANGUAGE_ID == 'ru') {?>
                                                человек<?=set_end ( $mans, array ('а','','') )?>
                                            <?} else {?>
                                                man<?=($mans>1 ? 's' : '');?>
                                            <?}?>
                                        </p>
										<p class="fl_r">
										<!--
										<a name="#" class="fl-hint" 
										<? if (LANGUAGE_ID == 'ru') { ?>
										title="<?=$flights?> полёт<?=set_end ( $flights, array ('','а','а') )?> =  <?=$flights?> мин."
										<?} else {?>
										title="<?=$flights?> flight<?=($flights>1 ? 's' : '');?> = <?=$flights?> min."
										<?}?>
										>
										-->
                                            <?=$flights?>
                                            <?if (LANGUAGE_ID == 'ru') {?>
                                                <!--полёт<?=set_end ( $flights, array ('','а','а') )?>-->мин.
                                            <?} else {?>
                                                <!--flight<?=($flights>1 ? 's' : '');?>-->min.
                                            <?}?>
                                            <?if ($jumps) {?> / <?=$jumps;?>
                                                <?if (LANGUAGE_ID == 'ru') {?>
                                                    прыж<?=set_end ( $jumps, array ('ок','ка','ков') )?>
                                                <?}else{?>
                                                    jump<?=($jumps>1?'s': '');?>
                                                <?}?>
                                            <?}?>
										<!--
										</a>
										-->
										</p>
									</div>
									<div class="index-service-item-regular">
										<div class="index-service-item-in">
											<p class="title">
                                                <?if (LANGUAGE_ID == 'ru'){?>
												    <?=$arItem ['~NAME'];?>
                                                <?}else{?>
                                                    <?=$arItem ['PROPERTIES']['NAME_EN']['~VALUE'];?>
                                                <?}?>
											</p>
											<p>
                                                <?if (LANGUAGE_ID == 'ru'){?>
                                                    <?=$arItem ['~PREVIEW_TEXT'];?>
                                                <?}else{?>
                                                    <?=$arItem ['PROPERTIES']['PREVIEW_TEXT_EN']['~VALUE'];?>
                                                <?}?>
                                            </p>
										</div>
										<div class="index-service-item-bottom"><?=round ( $price ['PRICE'] );?>.-</div>

										<img style="margin-top: 72px;"
											src="<?=$arItem ['PREVIEW_PICTURE'] ['SRC'];?>"
											alt="" />
									</div>
									<div class="index-service-item-drop">
										<p class="title">
											<?=$arItem ['~NAME']?>
										</p>
										<div class="index-service-item-bottom"><?=round ( $price ['PRICE'] );?>.-</div>
										<a href="/orders/?t=<?=$arItem['ID'];?>#left"
                                           data-id="<?=$arItem ['ID'];?>" class="button btn-white"><?=Loc::getMessage("ORDER_FLIGHT");?></a>

										<a href="/certificate/?order=true"><?=Loc::getMessage("CERTIFICATE");?></a>

									</div>
								</div>
								<?
						        /*if ($item == 4) {
							        $item = 0;
							        $tab++;
							        ?><?if($mmm<sizeof($current_items)-1){?></div><div class="drop-item index-service-item-group"><?}
                                }*/
                            }
                            ?>
                        </div>
                    </div>
                    <?
				}
				?>

			</div>
		</div>

        <?php
        if (LANGUAGE_ID == 'ru') {
            $IBLOCK_TYPE = 'main';
            $IBLOCK_ID = 45;
        } else {
            $IBLOCK_TYPE = 'main_en';
            $IBLOCK_ID = 56;
        }
        ?>


        <? $APPLICATION->IncludeComponent("bitrix:news.list", "faq_flights", Array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => $IBLOCK_TYPE,
                "IBLOCK_ID" => $IBLOCK_ID,
                "NEWS_COUNT" => "1111",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => Array(),
                "PROPERTY_CODE" => Array(),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>

		
	
