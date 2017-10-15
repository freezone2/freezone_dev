<div class="cabinet-item">
    <span class="change-info"><i class="icon-pen"></i>Редактировать</span>
    <div class="cabinet-item-in">
        <div class="user-info">
                <?php
                $photo = CFile::ResizeImageGet($USER->GetParam('PERSONAL_PHOTO'), array('width'=>100, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                ?>
                <img src="<?=($photo['src'] ? $photo['src'] : '/local/templates/main/images/no-img.jpg');?>"
                     style="max-width: 100px; max-height: 120px;" id="avatar2"
                     alt="" />

            <div class="center">
                <p>Здравствуйте,</p>
                <p class="name"><?= $USER->GetFullName(); ?></p>

                <?$APPLICATION->includeComponent('freezone:cabinet.category', '.default', array());?>
                
            </div>
        </div>
        <div class="user-info-bottom">
            <ul>
			<!--
                <li class="user-points-balance">
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
					<span>Баланс (Баллы)</span>
                </li>
			-->
                <li>
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
                    <span>Кол-во минут</span>
                </li>
            </ul>
        </div>

        <?php
        $res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>51, 'ACTIVE'=>'Y'));
        if ($res->SelectedRowsCount()) {
            ?>
            <div class="cabinet-bonus">
                <ul class="slides"><?
                while ($row = $res->GetNext()) {
                    $url = '/local/templates/main/images/cabinet-bonus.jpg';
                    if ($row['PREVIEW_PICTURE']) {
                        $url = CFile::GetPath($row['PREVIEW_PICTURE']);
                    }
                    ?>
                    <li>
                        <img src="<?=$url;?>" alt="" />
                        <div class="cabinet-bonus-in">
                            <div class="cabinet-bonus-text">
                                <p><?=$row['NAME'];?></p>
                                <span><?=$row['CODE'];?></span>
                            </div>
                        </div>
                    </li>
                    <?
                }
                ?>
                </ul>
            </div><?
        }
        ?>




        <div class="change-user-form">
            <form method="post" enctype="multipart/form-data">
                <?php
                $photo = CFile::ResizeImageGet($USER->GetParam('PERSONAL_PHOTO'), array('width'=>100, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                ?>
                <img src="<?=($photo['src'] ? $photo['src'] : '/local/templates/main/images/no-img.jpg');?>"
                     id="avatar"
                     style="max-width: 100px; max-height: 120px;"
                     alt=""
                     onclick="document.getElementById('picField').click()"/>
                <input type="file" name="avatar" value="" id="picField" style="display: none">
            </form>

            <script>
                document.getElementById('picField').onchange = function (evt) {
                    var tgt = evt.target || window.event.srcElement,
                        files = tgt.files;

                    // FileReader support
                    if (FileReader && files && files.length) {
                        var fr = new FileReader();
                        fr.onload = function () {
                            document.getElementById('avatar').src = fr.result;
                            document.getElementById('avatar2').src = fr.result;

                            var fd = new FormData();
                            fd.append("fileToUpload", files[0]);
                            fd.append("action", "avatar");

                            $.ajax({
                                url: '/local/components/freezone/profile.block.edit/ajax.php',
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    // .. do something
                                },
                                error: function(jqXHR, textStatus, errorMessage) {
                                    console.log(errorMessage); // Optional
                                }
                            });
                        };
                        fr.readAsDataURL(files[0]);
                    }

                    // Not supported
                    else {
                        // fallback -- perhaps submit the input to an iframe and temporarily store
                        // them on the server until the user's session ends.
                        alert('Not supported')
                    }
                }
            </script>

            <form action="" id="personalform">
                <input type="hidden" name="SAVE" value="Y">
                <div class="center">
                    <div class="form-item">
                        <input type="text" required name="NAME" value="<?= $USER->GetFullName(); ?>" placeholder="Ваше Имя"/>
                    </div>
                </div>
                <div class="form-item">
                    <input class="tel" required name="PERSONAL_MOBILE" type="text"
                           value="<?= getUserParam($USER->GetID(), 'PERSONAL_MOBILE'); ?>" placeholder="Телефон"/>
                </div>
                <div class="form-item">
                    <input type="email" required name="EMAIL" value="<?= getUserParam($USER->GetID(), 'EMAIL'); ?>"
                           placeholder="E-mail"/>
                </div>
                <div class="form-item">
                    <input placeholder="Дата рождения" class="birthday" type="text" required name="PERSONAL_BIRTHDAY"
                           value="<?= getUserParam($USER->GetID(), 'PERSONAL_BIRTHDAY'); ?>"/>
                </div>
                <button class="button btn-gray save">Сохранить</button>
                <button type="button" class="button cancel">Отменить</button>
            </form>

            <script>
                function changeUserInfo() {
                    $('.change-info').on('click', function () {
                        $('.change-user-form').toggleClass('open');
                        initMask();
                    });

                    $('.change-user-form .button.cancel').on('click', function () {
                        $('.change-user-form').removeClass('open');
                        initMask();
                        return false;
                    });

                    $('.change-user-form .button.save').on('click', function () {


                        var form = $('#personalform');
                        form.find('input[type="email"], input[type="text"]').removeClass('error');

                        var errors = 0;
                        form.find('input[type="email"], input[type="text"]').each(function () {
                            if (!$(this).val()) {
                                $(this).parent().addClass('error');
                                errors++;
                            }
                            if ($(this).attr('name') == 'EMAIL') {
                                if ($(this).val().indexOf('@') == -1 || $(this).val().indexOf('.') == -1) {
                                    $(this).parent().addClass('error');
                                    errors++;
                                }
                            }
                        });

                        if (errors) {
                            return false;
                        }

                        $.post('/local/components/freezone/profile.block.edit/ajax.php', form.serialize(), function (data) {
                            var res = $.parseJSON(data);
                            if (res.success) {
                                if (!$(this).hasClass('.btn-gray')) $('.change-user-form').removeClass('open');
                                initMask();
                            } else {
                                form.find('input[type="text"]').addClass('error');
                            }
                        });

                        return false
                    })
                }
                changeUserInfo();
                initMask();
            </script>
        </div>
    </div>
</div>

