<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//ini_set('display_errors',1);
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');

if (!empty($_POST['CATEGORY'])) {
    $CAT_ID = intval($_POST['CATEGORY']);
    $TRUBA = intval($_POST['TRUBA']);

    ob_start();
    $res_time_row = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        array(
            'IBLOCK_ID'=>49,
            'PROPERTY_TRUBA'=>get_truba_id($TRUBA),
            'PROPERTY_CATEGORY'=>$CAT_ID,
        ),
        0,
        0,
        array('ID', 'NAME', 'PROPERTY_TIMELENGTH', 'PROPERTY_TIMELENGTH_BLOCK', 'ACTIVE')
    );
    while ($time_row = $res_time_row->GetNext()) {
        $tb = $time_row['PROPERTY_TIMELENGTH_BLOCK_VALUE'];
        $time = $time_row['PROPERTY_TIMELENGTH_VALUE'];

        if ($time_row['ACTIVE'] == 'Y') {
            ?>
            <li style="min-height: 151px;" 
                data-id="<?=$time_row['ID'];?>" 
                data-r="<?= $time; ?>" 
                data-rl="<?= $tb; ?>"><p><?= $time_row['NAME']; ?>
                    минут</p><span>По <?= $tb; ?>
                    минуты</span></li>
            <?
        }else {
            ?><li style="visibility: hidden; min-height: 151px;"></li><?
        }
    }
    
    $content = ob_get_contents();
    ob_end_clean();

    echo json_encode(array('success' => true, 'content' => $content));
    exit;
}

echo json_encode(array('error' => true, 'message' => $message));
exit;