<?
//define('HEADER_SUB_CLASS', 'header-contact header-dark h0 header-min');
define('CONTENT_SUB_CLASS', 'no-full section');
//define('FOOTER_SUB_CLASS', 'footer-dark to-fixed');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Contacts");
$APPLICATION->SetPageProperty("title", "Contacts");
$APPLICATION->AddHeadScript('https://maps.googleapis.com/maps/api/js?key=' . COption::GetOptionString("askaron.settings", "UF_GOOGLE_API_KEY"));
$APPLICATION->AddHeadScript('/local/templates/main/custom_js/contacts.js');
?>

    <section class="contacts-page">
        <div class="site-wrapper">
            <div class="site-wrapper-in">
                <div class="contacts-in">
					<h1><?=$APPLICATION->ShowTitle(false)?></h1>
                    <div class="contact-left">
                        <p class="title"><? echo COption::GetOptionString("askaron.settings", "UF_CONT_ADDR_EN"); ?></p>
                        <p class="subtitle"><? echo COption::GetOptionString("askaron.settings", "UF_CONT_WORKTIME_EN"); ?></p>
                        <ul>
                            <li>
                                <i class="icon-tel-d"></i><? echo COption::GetOptionString("askaron.settings", "UF_PHONE"); ?>
                            </li>
                            <li><i class="icon-mess"></i><a
                                    href="mailto:<? echo COption::GetOptionString("askaron.settings", "UF_EMAIL"); ?>"><? echo COption::GetOptionString("askaron.settings", "UF_EMAIL"); ?></a>
                            </li>
							<li>Contacts for cooperation with the company: <a href="mailto:pr@freezone.net">pr@freezone.net</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-item">
                                <div class="contact-left-bottom">
                                    <? echo COption::GetOptionString("askaron.settings", "UF_CONT_SHEDULE_EN"); ?>
                                </div>
                            </div>
                            <!--
							<div class="tab-item">
                                <div class="contact-left-bottom">
                                    <ul>
                                        <li><? echo COption::GetOptionString("askaron.settings", "UF_POINT_FROM_EN"); ?></li>
                                        <li><? echo COption::GetOptionString("askaron.settings", "UF_POINT_TO_EN"); ?></li>
                                    </ul>
                                    <p><? echo COption::GetOptionString("askaron.settings", "UF_CONT_TEXT_EN"); ?></p>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
                    <div class="map-in" id="map">
                    </div>
                </div>
            </div>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>