<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');



echo json_encode(array('error' => true, 'message' => 'Ошибка получения данных'));
exit;