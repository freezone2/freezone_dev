<?php
/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 10.10.16
 * Time: 23:55
 */
?>
<span class="categories"><?=$arResult['CATEGORY_NAME'];?></span>

<script>
    $('.categories').unbind('click').on('click', function(){
        $.post('/local/components/freezone/cabinet.category/ajax.php', {'action': 'category'}, function(data){
            var res = $.parseJSON(data);
            if (res.success) {
                $('#caregory_content').html(res.content);
                $('.cabinet-popup, .cabinet-categories').addClass('open');
            } else {
                alert(res.message);
            }
        })
    });
</script>