<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Localization\Loc;

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
	if (empty($arResult['PAYMENT_LINK']) && !$arResult['IS_CASH'])
	{
		echo '<div style="display: none" id="callbackredirect">'.$arResult['TEMPLATE'].'</div>';
        ?>
        <div style="text-align: center; font-size: 14px;">Подождите. Сейчас вы будете перенаправлены на терминал банка для оплаты счета.</div>
        <script>
        //    location.href = $('#callbackredirect a').attr('href');
		$('.sale-paysystem-button button').click();
        </script>
        <?
	}
	else
	{
		?>
		<div class='col-xs-12'>
			<p><?=Loc::getMessage("SAP_ORDER_SUC", array("#ORDER_ID#"=>$arResult['ORDER_ID'],"#ORDER_DATE#"=>$arResult['ORDER_DATE']))?></p>
			<p><?=Loc::getMessage("SAP_PAYMENT_SUC", array("#PAYMENT_ID#"=>$arResult['PAYMENT_ID']))?></p>
			<?
			if (!$arResult['IS_CASH'])
			{
				?>
				<p><?=Loc::getMessage("SAP_PAY_LINK", array("#LINK#"=>$arResult['PAYMENT_LINK']))?></p>
				<?
			}
			?>
		</div>
		<?
		if (!$arResult['IS_CASH'])
		{
			?>
			<script type="text/javascript">
				window.open("<?=$arResult['PAYMENT_LINK']?>");
			</script>
			<?
		}
	}
}
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>