<?php
$photo = CFile::ResizeImageGet($USER->GetParam('PERSONAL_PHOTO'), array('width'=>100, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
?>
<aside class="user-cabinet-info">
    <img src="<?=($photo['src'] ? $photo['src'] : '/local/templates/main/images/no-img.jpg');?>" alt="" />
    <p class="name"><?= $USER->GetFullName(); ?></p>
    <?$APPLICATION->includeComponent('freezone:cabinet.category', 'small', array());?>
    <!--<p><?= number_format($arResult['BALANCE'], 0, '', ' '); ?> .–</p>-->
	<?
	//Баланс в минутах и часах
	if ((int)($arResult['BALANCE'] / 6000 * 15) > 60) {
		$hours = floor((int)($arResult['BALANCE'] / 6000 * 15) / 60);
		$min = (int)($arResult['BALANCE'] / 6000 * 15) - ($hours * 60);
		$tube_12_day_tube_16_night = $hours." ч. ".$min." мин.";
	} else {	
		$tube_12_day_tube_16_night = (int)($arResult['BALANCE'] / 6000 * 15)." мин."; 
	}
	if ((int)($arResult['BALANCE'] / 5000 * 15) > 60) {
		$hours = floor((int)($arResult['BALANCE'] / 5000 * 15) / 60);
		$min = (int)($arResult['BALANCE'] / 5000 * 15) - ($hours * 60);
		$tube_12_night = $hours." ч. ".$min." мин.";
	} else {	
		$tube_12_night = (int)($arResult['BALANCE'] / 5000 * 15)." мин."; 
	}
	if ((int)($arResult['BALANCE'] / 7000 * 15) > 60) {
		$hours = floor((int)($arResult['BALANCE'] / 7000 * 15) / 60);
		$min = (int)($arResult['BALANCE'] / 7000 * 15) - ($hours * 60);
		$tube_17_day = $hours." ч. ".$min." мин.";
	} else {	
		$tube_17_day = (int)($arResult['BALANCE'] / 7000 * 15)." мин.";
	}	
	?>
	<div class="balance-in-min">
		<span>Труба 12м (день):</span> <?= $tube_12_day_tube_16_night ?><br />
		<span>Труба 12м (ночь):</span> <?= $tube_12_night ?><br />
		<span>Труба 17м (день):</span> <?= $tube_17_day ?><br />
		<span>Труба 17м (ночь):</span> <?= $tube_12_day_tube_16_night ?><br />
	</div>
    <span>Время</span>
	<!--
    <?if ($arResult['HOURS']<60) {?>
        <p><?= $arResult['HOURS']; ?></p>
        <span>минут<?= set_end($arResult['HOURS'], arraY('а', 'ы', '')); ?></span>
    <?} else {
        $t = ceil($arResult['HOURS']/60);
        ?>
        <p><?= $t; ?></p>
        <span>час<?= set_end($t, arraY('', 'а', 'ов')); ?></span>
    <?}?>
	
	<p><?= number_format($arResult['BALANCE'], 0, '', ' '); ?> .– <br /><br /></p>
	<span>Баллы</span>
	-->
</aside>
