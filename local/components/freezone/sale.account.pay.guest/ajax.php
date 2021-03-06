<?php
define("STOP_STATISTICS", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("DisableEventsCheck", true);
define("BX_SECURITY_SHOW_MESSAGE", true);

$siteId = isset($_REQUEST['SITE_ID']) && is_string($_REQUEST['SITE_ID']) ? $_REQUEST['SITE_ID'] : '';
$siteId = substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (!empty($siteId) && is_string($siteId))
{
	define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
ini_set('display_error', 1);
error_reporting(E_ALL);

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

$signer = new \Bitrix\Main\Security\Sign\Signer;
try
{
	$params = $signer->unsign($request->get('signedParamsString'), 'sale.account.pay');
	$params = unserialize(base64_decode($params));
	$params['AJAX_DISPLAY'] = "Y";
}
catch (\Bitrix\Main\Security\Sign\BadSignatureException $e)
{
	die();
}

CBitrixComponent::includeComponentClass("freezone:sale.account.pay.guest");

$orderPayment = new SaleAccountPayGuest();
$orderPayment->initComponent('freezone:sale.account.pay.guest');
$orderPayment->includeComponent($params["TEMPLATE_PATH"], $params, null);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>