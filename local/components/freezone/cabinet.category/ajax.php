<?php
/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 12:57
 */
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$action = (string)$_REQUEST['action'];

$MESSAGE_ERROR = '';

if ($action == 'category') {
    \Bitrix\Main\Loader::includeModule('iblock');
    global $USER;
    ob_start();
    $cat_id = getUserCatId();
    $row = getUserCategory($cat_id);
    if ($row) {

        ?>
        <span class="title"><?=$row['NAME'];?></span>

        <?=$row['~DETAIL_TEXT'];?>

        <div class="cabinet-categories-list">
            <?php
            $num=0;
            $active = 0;
            $res = CIBlockElement::getList(array('CODE'=>'ASC'), array('IBLOCK_ID'=>44, 'ACTIVE'=>'Y'));
            while($cat = $res->GetNext()){
                $num++;
                if ($cat['ID'] == $cat_id) {
                    $active = $num;
                }
                ?><p <?=($cat['ID'] == $cat_id ? 'class="active"' : '');?>><?=$cat['PREVIEW_TEXT'];?></p><?
            }
            ?>
        </div>
        <img class="flying-man active<?=$active;?>" src="/local/templates/main/images/flying-man.png" alt="" />
        <img src="/local/templates/main/images/cabinet-categories-img.png" alt="" />
        <?
        $content = ob_get_contents();
        ob_end_clean();

        echo json_encode(array('success'=>true, 'content'=>$content));
        exit;
    }
}

echo json_encode(array('error' => true, 'message' => $MESSAGE_ERROR));
exit;