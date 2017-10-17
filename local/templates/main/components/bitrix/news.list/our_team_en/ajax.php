<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$MESSAGE_ERROR = '';

if (!empty($_POST['ID'])) {
    $id = intval($_POST['ID']);
    \Bitrix\Main\Loader::includeModule('iblock');
    $res = CIBlockElement::getList(false, array('IBLOCK_ID'=>33, 'ID'=>$id));
    if ($res->SelectedRowsCount()==1) {
        ob_start();
        $row = $res->GetNext();
        ?>
		<? $file = CFile::ResizeImageGet($row['PREVIEW_PICTURE'], array('width' => 160, 'height' => 180), BX_RESIZE_IMAGE_EXACT); ?>
        <img src="<?= $file['src']; ?>" alt="" />
        <div class="center">
            <p class="name"><?=$row['NAME'];?></p>
            <p class="categories"><?=$row['PREVIEW_TEXT'];?></p>
            <?=$row['DETAIL_TEXT'];?>
        </div>
        

        <?
        $content = ob_get_contents();
        ob_end_clean();

        echo json_encode(array('success'=>true, 'content'=>$content));
        exit;
    }
}

echo json_encode(array('error'=>true, 'message'=>$MESSAGE_ERROR));
exit;