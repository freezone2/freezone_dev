<?
define('HEADER_SUB_CLASS', 'header-fix header-dark');
define('CONTENT_SUB_CLASS', 'not-full pay-info');
define('FOOTER_SUB_CLASS', 'footer-dark footer-fix hide-line');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Payment information");

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>

<section class="pay-info-list">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-title">
                        <?=Loc::GetMessage('PAYMENT_INFO_TITLE');?>
                    </div>
                    <div class="accordion-drop">
                        <aside class="preview-card">
                            <img style="margin: 113px 33px -10px -11px" src="/local/templates/main/images/mastercard.png" alt="" />
                            <img style="margin-top: 116px ;" src="/local/templates/main/images/visa-card.png" alt="" />
                            <img style="margin: 766px 31px 0 -9px"  src="/local/templates/main/images/visa-card2.png" alt="" />
                            <img style="margin: 765px -10px 0"  src="/local/templates/main/images/mastercard2.png" alt="" />
                        </aside>
                        <div class="center">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => "index_info.php",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "standard.php"
                                )
                            );?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-title">
                        <?=Loc::GetMessage('PAYMENT_INFO_REQ');?>
                    </div>
                    <div class="accordion-drop">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "index_sect.data.php",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "standard.php"
                            )
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
