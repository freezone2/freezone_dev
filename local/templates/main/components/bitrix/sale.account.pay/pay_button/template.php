<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;
CJSCore::Init(array('popup'));
if (!empty($arResult["errorMessage"]))
{
	if (!is_array($arResult["errorMessage"]))
	{
		ShowError($arResult["errorMessage"]);
	}
	else
	{
		foreach ($arResult["errorMessage"] as $errorMessage)
		{
			ShowError($errorMessage);
		}
	}
}
else
{
	if ($arParams['REFRESHED_COMPONENT_MODE'] === 'Y')
	{
		$wrapperId = str_shuffle(substr($arResult['$signedParams'],0,10));
        CJSCore::Init(array('popup'));
        ?>

		<div class="bx-sap" id="bx-sap<?=$wrapperId?>" style="position: relative; z-index: 1000;">
			<div class="container-fluid">
				<?
				if ($arParams['SELL_VALUES_FROM_VAR'] != 'Y')
				{
					if ($arParams['SELL_SHOW_FIXED_VALUES'] === 'Y')
					{
						?>
							<div class="sale-acountpay-block">
								<h3 class="sale-acountpay-title"><?= Loc::getMessage("SAP_FIXED_PAYMENT") ?></h3>
								<div class="sale-acountpay-fixedpay-container">
									<div class="sale-acountpay-fixedpay-list">
										<?
										foreach ($arParams["SELL_TOTAL"] as $valueChanging)
										{
											?>
											<div class="sale-acountpay-fixedpay-item">
												 <?=CUtil::JSEscape(htmlspecialcharsbx($valueChanging))?>
											</div>
											<?
										}
										?>
									</div>
								</div>
							</div>
						<?
					}
					?>
                    <div class=" sale-acountpay-block ">
                        <?
                        $inputElement = "
                                <input type='hidden' id='payment_amount'	
                                class='sale-acountpay-input' value='".$arParams['PAYMENT_AMOUNT']."' "
                                ."name=".CUtil::JSEscape(htmlspecialcharsbx($arParams["VAR"]))." "
                                .($arParams['SELL_USER_INPUT'] === 'N' ? "disabled" :"").
                                ">
                            ";
                        echo $inputElement;
                        ?>
                    </div>
				<?
				}
				else
				{
					if ($arParams['SELL_SHOW_RESULT_SUM'] === 'Y')
					{
						?>
							<div class="sale-acountpay-block form-horizontal">
								<h3 class="sale-acountpay-title"><?=Loc::getMessage("SAP_SUM")?></h3>
								<h2><?=SaleFormatCurrency($arResult["SELL_VAR_PRICE_VALUE"], $arParams['SELL_CURRENCY'])?></h2>
							</div>
						<?
					}
					?>
                    <input type="hidden" name="<?=CUtil::JSEscape(htmlspecialcharsbx($arParams["VAR"]))?>"
                        class="form-control input-lg sale-acountpay-input"
                        value="<?=CUtil::JSEscape(htmlspecialcharsbx($arResult["SELL_VAR_PRICE_VALUE"]))?>">
					<?
				}
				?>
					<div class=" sale-acountpay-block" style="display: none">
                        <div class="sale-acountpay-pp">
                            <?
                            foreach ($arResult['PAYSYSTEMS_LIST'] as $key => $paySystem)
                            {
                                ?>
                                <div class="sale-acountpay-pp-company  <?= ($key == 0) ? 'bx-selected' :""?>">
                                        <input type="checkbox"
                                                class="sale-acountpay-pp-company-checkbox"
                                                name="PAY_SYSTEM_ID"
                                                value="<?=$paySystem['ID']?>"
                                                <?= ($key == 0) ? "checked='checked'" :""?>
                                        > <?=CUtil::JSEscape(htmlspecialcharsbx($paySystem['NAME']))?>

                                    </div>
                                </div>
                                <?
                            }
                            ?>
                        </div>
					</div>
            
                <a href=""
                   class="button btn-red"
                   style="text-align: center; padding-left:10px; padding-right: 10px;">Пополнить на <span id="payment_amount_html"><?=$arParams['PAYMENT_AMOUNT'];?></span> руб.</a>
			</div>
		</div>
		<?
		$javascriptParams = array(
			"alertMessages" => array("wrongInput" => Loc::getMessage('SAP_ERROR_INPUT')),
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"signedParams" => $arResult['$signedParams'],
			"wrapperId" => $wrapperId
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			var sc = new BX.saleAccountPay(<?=$javascriptParams?>);
		</script>
	<?
	}

}

