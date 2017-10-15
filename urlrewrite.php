<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/en/gallery/(.+?)/(.*)?#",
		"RULE" => "CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/en/gallery/detail.php",
	),
	array(
		"CONDITION" => "#^/gallery/(.+?)/(.*)?#",
		"RULE" => "CODE=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/gallery/detail.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/test/oplata.php",
	),
);

?>