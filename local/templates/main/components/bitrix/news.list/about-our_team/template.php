<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<section class="section about-command has-drop">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="section-wrap">
                <div class="command-list drop-item active">

                    <? $z = 0;
                    foreach ($arResult['ITEMS'] as $num => $arItem):
                    $z++;
                    $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 160, 'height' => 180), BX_RESIZE_IMAGE_EXACT);
                    ?>
                    <div class="command-item" data-id="<?= $arItem['ID']; ?>">
                        <img src="<?= $file['src']; ?>" alt=""/>
                        <p><?= $arItem['NAME']; ?></p>
                        <span><?= $arItem['~PREVIEW_TEXT']; ?></span>
                    </div>
                    <? if ($z == 5) {
                    $z = 0;
                    if ($num < sizeof($arResult['ITEMS']) - 1){
                    ?></div>
                <div class="command-list drop-item"><?
                    }
                    } ?>
                    <? endforeach; ?>
                </div>

                <script>
                    $('.command-list .command-item').on('click', function () {
                        var id = $(this).data('id');
                        $.post(
                            '/local/templates/main/components/bitrix/news.list/our_team/ajax.php',
                            {
                                'ID': id
                            },
                            function (data) {
                                var res = $.parseJSON(data);
                                if (res.success) {
                                    $('#team_content').html(res.content);
                                    $('.cabinet-popup, .popup-team').addClass('open')
                                } else {
                                    openThanskFeedback('Ошибка', res.message);
                                }
                            })
                    });
                </script>

            </div>
        </div>
    </div>
</section>


