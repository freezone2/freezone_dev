<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">',true);
$APPLICATION->SetAdditionalCSS("/custom_page/new_page.css");
$APPLICATION->AddHeadScript("/custom_page/new_page.js");
?>

<section class="section competition-info page-competition">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="title-page">RISC 2017</div>
            <p>6-9 DEC. MOSCOW.</p>
            <p>1 official Russian indoor skydiving championship
            </p>
            <a class="btn-comp-page" href="#registration">Registration for the championship</a>
        </div>
    </div>
    <div class="slide-img">
        <div class="site-wrapper">
            <div class="site-wrapper-in" style="background-image: url('/custom_page/img/new_page_banner.png');"></div>
        </div>
    </div>
</section>
<section class="container section competition-info competition-info-1">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Disciplines</div>
            <div class="row">
                <div class="item-competition">
                    <div class="item-img"><img src="/custom_page/img/new_page_1.png" alt=""></div>
                    <div class="item-text-wrap">Relative work</div>
                </div>
                <div class="item-competition">
                    <div class="item-img"><img src="/custom_page/img/new_page_2.png" alt=""></div>
                    <div class="item-text-wrap">Dynamic</div>
                </div>
                <div class="item-competition">
                    <div class="item-img"><img src="/custom_page/img/new_page_3.png" alt=""></div>
                    <div class="item-text-wrap">Freestyle</div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container section competition-info competition-info-2">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Who can participate</div>
            <div class="row">
                <div class="item-competition">
                    <div class="small-name">Championship among Youth and Juniors</div>
                    <div class="small-text">
                        - citizens of the Russian Federation<br>
                        - boys and girls aged 8 to 18 years old
                    </div>
                </div>
                <div class="item-competition">
                    <div class="small-name">Russian championship </div>
                    <div class="small-text">
                        - citizens of the Russian Federation<br>
                        - athletes over 18 years old
                    </div>
                </div>
                <div class="item-competition">
                    <div class="small-name">Freezone Open Cup</div>
                    <div class="small-text">
                        - citizens of the Russian Federation and foreigners<br>
                        - athletes over 18 years old
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container section competition-info competition-info-3">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Documents</div>
            <div class="row-docs">
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
                <a class="item-page-doc page-doc" href="#"><span>Ссылка 1 в несколько строк</span></a>
            </div>
        </div>
    </div>
</section>
<!--
<section class="container section competition-info competition-info-4">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Prize fund</div>
            <p>We have presents for all the participants of the competition. Sports club "Freezone" awards the finalists with free flights in the 12ft and 16ft tunnels. These are awards in hours according to the disciplines in the table below.
            </p>
            <table>
                <tr>
                    <th>Discipline</th>
                    <th>Class</th>
                    <th>1st place</th>
                    <th>2nd place</th>
                    <th>3rd place</th>
                </tr>
                <tr>
                    <td>2 way FS</td>
                    <td>OPEN</td>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2 way FS</td>
                    <td>JUNIOR</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>2 way FS</td>
                    <td>WOMEN</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>4 way FS</td>
                    <td>OPEN</td>
                    <td>4</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>4 way FS</td>
                    <td>WOMEN</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>4 way FS</td>
                    <td>JUNIOR</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>4 way FS</td>
                    <td>A-CLASS</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>2 way VFS</td>
                    <td>OPEN</td>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2 way VFS</td>
                    <td>INTER</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>2 way VFS</td>
                    <td>JUNIOR</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>4 way VFS</td>
                    <td>OPEN</td>
                    <td>4</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2 way DYNAMIC</td>
                    <td>OPEN</td>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2 way DYNAMIC</td>
                    <td>JUNIOR</td>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>4 way DYNAMIC</td>
                    <td>OPEN</td>
                    <td>4</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2 way DYNAMIC</td>
                    <td>OPEN</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
                <tr>
                    <td>4 way DYNAMIC</td>
                    <td>JUNIOR</td>
                    <td>2</td>
                    <td>1</td>
                    <td>0.5</td>
                </tr>
            </table>
        </div>
    </div>
</section>
-->

<section class="container section competition-info competition-info-5">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Participation fee</div>
            <div class="row">
                <div class="item-competition">
                    <div class="small-price"><span>8 000</span> rubles (per person)</div>
                    <div class="small-text-price">
                        Men and women in disciplines Relative work, Dynamic, Freestyle. For participation in other disciplines, additional payment is 3000 rubles
                    </div>
                </div>
                <div class="item-competition">
                    <div class="small-price"><span>5 000</span> rubles (per person)</div>
                    <div class="small-text-price">
                        Members of Sport Parachuting Association, men and women in disciplines Relative work, Dynamic, Freestyle. For participation in other disciplines, additional payment is 3000 rubles.
                    </div>
                </div>
                <div class="item-competition">
                    <div class="small-price"><span>3 000</span> rubles (per person)</div>
                    <div class="small-text-price">
boys and girls aged to 18 years old in disciplines relative work, Dynamic, Freestyle. For participation in other disciplines, additional payment is 2000 rubles.
                    </div>
                </div>
            </div>
            <p class="note">These rates are valid until November 25, from November, 25 to December, 6 the registration fee will be increased by 20%.</p>
        </div>
    </div>
</section>

<section class="container section competition-info competition-info-6" id="registration">
    <div class="competition-info-in">
        <div class="section-wrap">
            <div class="item-title">Registration</div>
            <div class="form-wrap">
                <form id="regFormPage" action="" method="post">
                    <?=bitrix_sessid_post()?>
                    <div class="line-form line-form-1">
                        <label for="comp_last_name"><input placeholder="Surname" type="text" id="comp_last_name" name="comp_last_name"></label>
                        <label for="comp_name"><input placeholder="First Name" type="text" id="comp_name" name="comp_name"></label>
                    </div>
                    <div class="line-form line-form-2">
                        <label for="comp_date_birth"><input placeholder="Date of birth" type="text" id="comp_date_birth" name="comp_date_birth"></label>
                        <label for="comp_country"><input placeholder="Country" type="text" id="comp_country" name="comp_country"></label>
                        <label for="comp_city"><input placeholder="City" type="text" id="comp_city" name="comp_city"></label>
                    </div>
                    <div class="form-title">Participation in disciplines</div>
                    <div class="wrap-disp-form">
                        <div class="form-title-line">Relative work</div>
                        <div class="line-form line-form-3 line-form-checks">
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_1"><input id="type_object_1" data-code="<?=base64_encode('FS2W OPEN')?>" value="FS2W OPEN" name="type_object[]" type="checkbox"><span></span><span>FS2W OPEN</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_2"><input id="type_object_2" data-code="<?=base64_encode('FS2W WOMEN')?>" value="FS2W WOMEN" name="type_object[]" type="checkbox"><span></span><span>FS2W WOMEN</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_3"><input id="type_object_3" data-code="<?=base64_encode('FS2W JUNIOR')?>" value="FS2W JUNIOR" name="type_object[]" type="checkbox"><span></span><span>FS2W JUNIOR</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_4"><input id="type_object_4" data-code="<?=base64_encode('FS4W OPENR')?>" value="FS4W OPENR" name="type_object[]" type="checkbox"><span></span><span>FS4W OPEN</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_5"><input id="type_object_5" data-code="<?=base64_encode('FS4W WOMEN')?>" value="FS4W WOMEN" name="type_object[]" type="checkbox"><span></span><span>FS4W WOMEN</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_6"><input id="type_object_6" data-code="<?=base64_encode('FS4W A-class')?>" value="FS4W A-class" name="type_object[]" type="checkbox"><span></span><span>FS4W A-class</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                <label for="type_object_7"><input id="type_object_7" data-code="<?=base64_encode('FS4W JUNIOR')?>" value="FS4W JUNIOR" name="type_object[]" type="checkbox"><span></span><span>FS4W JUNIOR</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_8"><input id="type_object_8" data-code="<?=base64_encode('VFS4W')?>" value="VFS4W" name="type_object[]" type="checkbox"><span></span><span>VFS4W</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                <label for="type_object_9"><input id="type_object_9" data-code="<?=base64_encode('VFS2W OPEN')?>" value="VFS2W OPEN" name="type_object[]" type="checkbox"><span></span><span>VFS2W OPEN</span></label>
                            </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_10"><input id="type_object_10" data-code="<?=base64_encode('VFS2W INTER')?>" value="VFS2W INTER" name="type_object[]" type="checkbox"><span></span><span>VFS2W INTER</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_11"><input id="type_object_11" data-code="<?=base64_encode('VFS2W JUNIOR')?>" value="VFS2W JUNIOR" name="type_object[]" type="checkbox"><span></span><span>VFS2W JUNIOR</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-title-line">Dynamic</div>
                        <div class="line-form line-form-4 line-form-checks">
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_12"><input id="type_object_12" data-code="<?=base64_encode('D2W')?>" value="D2W" name="type_object[]" type="checkbox"><span></span><span>D2W</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_13"><input id="type_object_13" data-code="<?=base64_encode('D2W JUNIOR')?>" value="D2W JUNIOR" name="type_object[]" type="checkbox"><span></span><span>D2W JUNIOR</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_14"><input id="type_object_14" data-code="<?=base64_encode('D4W')?>" value="D4W" name="type_object[]" type="checkbox"><span></span><span>D4W</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-title-line">Freestyle</div>
                        <div class="line-form line-form-5 line-form-checks">
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_15"><input id="type_object_15" data-code="<?=base64_encode('Solo Freestyle')?>" value="Solo Freestyle" name="type_object[]" type="checkbox"><span></span><span>Solo Freestyle</span></label>
                                </div>
                            </div>
                            <div class="field__checkbox add__field__checkbox">
                                <div class="checkbox">
                                    <label for="type_object_16"><input id="type_object_16" data-code="<?=base64_encode('Solo Freestyle Junior')?>" value="Solo Freestyle Junior" name="type_object[]" type="checkbox"><span></span><span>Solo Freestyle Junior</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line-form line-form-6">
                        <div class="input"><label for="comp_phone"><input placeholder="Phone" type="tel" id="comp_phone" name="comp_phone"></label></div>
                        <div class="input"><label for="comp_email"><input placeholder="E-mail" type="email" id="comp_email" name="comp_email"></label></div>
                    </div>
                    <div class="line-form line-form-7">
                        <div class="input"><label for="comp_fspr"><input placeholder="Input code FPSR" type="text" id="comp_fspr" name="comp_fspr"><i class="error-type-page error-hidden">Invalid number</i><a class="line-link" href="#">Input code FPSR</a></label></div>
                        <input type="hidden" name="comp_fspr_id" id="comp_fspr_id">
                        <div class="field_wrap field_wrap-size">
                            <select class="field_select" data-minimum-results-for-search="Infinity" data-placeholder="T-shirt size" placeholder="T-shirt size" name="comp_size_shirt" id="comp_size_shirt">
								<option></option>
                                <option value="s">s</option>
                                <option value="m">m</option>
                                <option value="l">l</option>
                                <option value="xl">xl</option>
                            </select>
                        </div>
                    </div>
                    <div class="line-form line-success line-hidden">Your order has been submitted!</div>
                    <div class="line-form line-button">
                        <button class="btn-comp-page" name="add_regitem" type="submit">sent request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>