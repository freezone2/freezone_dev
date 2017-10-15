<?
$arUrlRewrite = array(

    array(
        "CONDITION" => "#^/en/gallery/(.+?)/(.*)?#",
        "RULE" => "CODE=$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/en/gallery/detail.php",
    ),

    array(
        "CONDITION" => "#^/gallery/(.+?)/(.*)?#",
        "RULE" => "CODE=$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/gallery/detail.php",
    ),

	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),

);

?>