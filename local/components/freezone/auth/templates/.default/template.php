<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<form action="/personal/" id="signinform" method="post">
    <input type="hidden" name="ref" value="/personal/">

    <div class="form-item <?=($arResult['ERROR'] ? 'error' : '');?>">
        <input type="email" placeholder="E-mail" name="email" onkeyup="$('#forgot_email').val($(this).val());"/>
        <?if ($arResult['ERROR']){?><span class="error"><?=Loc::GetMessage('ERROR_EMAIL');?></span><?}?>
    </div>
    <div class="form-item <?=($arResult['ERROR'] ? 'error' : '');?>">
        <input id="sportsman-login" type="password" placeholder="<?=Loc::GetMessage('PASSWORD');?>" name="password"/>
        <a class="open-recover" href="#"><?=Loc::GetMessage('FORGOT_PASSWORD');?></a>
		<a class="show-password" href="#"><?=Loc::GetMessage('SHOW_PASSWORD');?></a>&nbsp;&nbsp;
    </div>
    <button type="button" class="button btn-white "><?=Loc::GetMessage('LOGIN');?></button>
</form>

