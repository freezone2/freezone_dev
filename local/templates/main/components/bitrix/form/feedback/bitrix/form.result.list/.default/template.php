<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<style>
    div[id*='wait_comp'] {
        position: absolute;
        top: 0;
        right: 0;
    }

    div[id*='wait_comp']:last-child {
        display: none;
    }
</style>
<script>openThanskFeedback('<?=Loc::GetMessage('THANKS_TITLE');?>', '<?=Loc::GetMessage('THANKS_TEXT');?>');</script>
