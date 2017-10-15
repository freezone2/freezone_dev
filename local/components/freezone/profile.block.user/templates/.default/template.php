<aside class="user-cabinet-info">
    <?php
    $photo = CFile::ResizeImageGet($USER->GetParam('PERSONAL_PHOTO'), array('width'=>100, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
    ?>

    <img src="<?=($photo['src'] ? $photo['src'] : '/local/templates/main/images/no-img.jpg');?>" alt="">
    <p class="name"><?=$USER->GetFullName();?></p>
    
    <?php
    $cat_id = getUserCatId();
    $category = getUserCategory($cat_id);
    ?>
    
    <span><?=$category['NAME'];?></span>

    <?if ($arResult['HOURS']<60) {?>
        <p><?= $arResult['HOURS']; ?></p>
        <span>минут<?= set_end($arResult['HOURS'], arraY('а', 'ы', '')); ?></span>
    <?} else {
        $t = ceil($arResult['HOURS']/60);
        ?>
        <p><?= $t; ?></p>
        <span>час<?= set_end($t, arraY('', 'а', 'ов')); ?></span>
    <?}?>



    <p><?= number_format($arResult['BALANCE'], 0, '', ' '); ?> .–</p>
    <span>Баланс</span>
</aside>
