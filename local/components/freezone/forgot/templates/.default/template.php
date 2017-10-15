<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<form action="" id="forgotform" method="post">
    <input type="hidden" name="ref" value="<?=$APPLICATION->GetCurDir();?>">

    <div class="form-item <?=($arResult['ERROR'] ? 'error' : '');?>">
        <input type="email" id="forgot_email" name="forgot_email" value="<?=$_POST['forgot_email'];?>"
               placeholder="E-mail"/>
        <span class="error" style="font-size: 12px; color: Red; padding-top: 10px; display: none"><?=Loc::GetMessage('EMAIL_NOT_FOUND');?></span>
    </div>

    <button type="button" class="button btn-white"><?=Loc::GetMessage('NEW_PASSWORD');?></button>
</form>
