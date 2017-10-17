<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="command-list">
    <? $num = 0;
    foreach ($arResult["ITEMS"] as $arItem){
        $num++;
        ?>


        <a href="#" class="command-item" data-id="<?=$arItem['ID'];?>">
            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt=""/>
            <p><?= $arItem['NAME']; ?></p>
            <span><?= $arItem['PREVIEW_TEXT']; ?></span>
        </a>


        <?
        if ($num == 4){
            $num = 0;
            ?></div><div class="command-list"><?
        }
    }
    ?>
</div>


<script>
    $('.command-list .command-item').on('click', function () {
        var id = $(this).data('id');
        $.post('/local/templates/main/components/bitrix/news.list/our_team/ajax.php', {'ID': id},function(data){
            var res = $.parseJSON(data);
            if (res.success) {
                $('#team_content').html(res.content);
                $('.cabinet-popup, .popup-team').addClass('open')
            } else {
                alert(res.message);
            }
        })
    });
</script>
