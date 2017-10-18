<?
//define('HEADER_SUB_CLASS', 'header-contact header-dark h0 header-min');
define('CONTENT_SUB_CLASS', 'no-full section');
//define('FOOTER_SUB_CLASS', 'footer-dark to-fixed');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty("title", "Контакты");
//$APPLICATION->AddHeadScript('https://maps.googleapis.com/maps/api/js?key=' . COption::GetOptionString("askaron.settings", "UF_GOOGLE_API_KEY"));
$APPLICATION->AddHeadScript('/local/templates/main/custom_js/contacts.js');

$APPLICATION->SetPageProperty("title", "Контакты. Телефоны и адрес аэротрубы в Москве");
$APPLICATION->SetPageProperty("description", "Адрес и телефоны аэротрубы Фризон. Объясним как лучше доехать из Москвы и Чехова.");
$APPLICATION->SetPageProperty("keywords", "аэротруба в москве, адрес аэротрубы, аэротруба чехов");


?>

    <section class="contacts-page">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
                <div class="contacts-in" itemscope="" itemtype="http://schema.org/Organization">
                    <h1><?=$APPLICATION->ShowTitle(false)?></h1>
                    <span itemprop="name" style="display:none;">ООО "Фризон"</span>
                    <div class="contact-left" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
			<p class="title">
			    <span itemprop="addressLocality">Московская область</span>, <br>
			    <span itemprop="streetAddress">Симферопольское шоссе, 59 км</span>
			    <br> (от МКАД 39 км), 20 минут от МКАД</p>
                        <p class="subtitle">круглосуточно, манифест работает 10:00-22:00</p>
                        <ul>
                            <li>
                                <i class="icon-tel-d"></i><span itemprop="telephone">8 495 18 000 18</span>
                            </li>
                            <li>
                                <i class="icon-mess"></i><span itemprop="email">
                                <a href="mailto:info@freezone.net">info@freezone.net</a></span>
                            </li>
							<li>Контакты для сотрудничества с компанией: <a href="mailto:pr@freezone.net">pr@freezone.net</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-item show-tab">
                                <div class="contact-left-bottom">
                                    <? echo COption::GetOptionString("askaron.settings", "UF_CONT_SHEDULE"); ?>
                                </div>
                            </div>
                            <!--
							<div class="tab-item">
                                <div class="contact-left-bottom">
                                    <ul>
                                        <li><? echo COption::GetOptionString("askaron.settings", "UF_POINT_FROM"); ?></li>
                                        <li><? echo COption::GetOptionString("askaron.settings", "UF_POINT_TO"); ?></li>
                                    </ul>
                                    <p><? echo COption::GetOptionString("askaron.settings", "UF_CONT_TEXT"); ?></p>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
                    <div class="map-in" id="map">
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A90d0403bd7d253c89c4e2ede0ccb87a6d66f7155c76ad7c038e35e3bf9fd9c42&amp;width=405&amp;height=480&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>