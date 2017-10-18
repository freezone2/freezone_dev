<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);

if (!empty($_REQUEST['logout'])){
    global $USER;
    $USER->Logout();
    header('Location: /');
    exit;
}

$curPage = $APPLICATION->GetCurPage(false);
$isMain = false;
if($curPage == "/") {
    $isMain = true;
}

$is_personal_page = preg_match('#/personal/#', $APPLICATION->GetCurDir());
$is_orders_page = preg_match('#/orders/#', $APPLICATION->GetCurDir());
$is_cabinet_page = preg_match('#/cabinet/#', $APPLICATION->GetCurDir());
$is_air_page = preg_match('#/air/#', $APPLICATION->GetCurDir());
$is_rate_page = preg_match('#/rates/#', $APPLICATION->GetCurDir());
$is_gallery_page = preg_match('#/gallery/#', $APPLICATION->GetCurDir());
$is_equipment_page = preg_match('#/equipment/#', $APPLICATION->GetCurDir());
$is_certificate_page = preg_match('#/certificate/#', $APPLICATION->GetCurDir());
$is_news_page = preg_match('#/news/#', $APPLICATION->GetCurDir());
$inner_air_page = $is_rate_page || $is_gallery_page || $is_equipment_page || $is_certificate_page || $is_news_page;
$is_team_page = preg_match('#/team/#', $APPLICATION->GetCurDir());

if (!$USER->isAuthorized() && $is_personal_page) {
    header('Location: /?need_login=Y');
    exit;
}

// if ($_SERVER["REMOTE_ADDR"] != "95.139.203.80") {
// die("На сайте ведутся технические работы. Приносим извинения за неудобства - в ближайшее время он снова станет доступным!");
// }

$LastModified = gmdate('D, d M Y H:i:s', filemtime(__FILE__)).' GMT';
header('Last-Modified: '. $LastModified);
?>
<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js <?=(defined('HTML_SUB_CLASS')? HTML_SUB_CLASS : '');?>" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <script src="/local/templates/main/custom_js/overload.js" type="text/javascript"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=$APPLICATION->Showtitle();?></title>
    <?if(NEW_DES == 1){?>
        <?if ($is_personal_page || $is_orders_page || $is_cabinet_page || $is_air_page || $inner_air_page){?>
            <meta name="viewport" content="width=1024" />
        <?}else{?>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <?}?>
    <?}
    else{?>
        <meta name="viewport" content="width=1024" />
    <?}?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="mailru-domain" content="JakSs4nS3BV4A6PF" />
    <meta name="yandex-verification" content="e0eb92b46dfa466f" />
    <meta name="yandex-verification" content="84229b129c1bc1b7" />
    <meta name="google-site-verification" content="gpTc8qGgcibXcbZSTKTeUT6YINX_1lYi4BjZvjLvxGQ" />
    <link rel="icon" type="image/png" href="/favicon.png" />
    <script src="/local/templates/main/js/libs/jquery-1.9.1.min.js"></script>
    <?if(NEW_DES == 1){?>
        <link rel="stylesheet" href="/local/templates/main/css/bootstrap.css">
    <?}?>
    <link rel="stylesheet" href="/local/templates/main/css/style.css">
    <link rel="stylesheet" href="/local/templates/main/custom_css/style.css">
    <?if(NEW_DES == 1){?>
        <link rel="stylesheet" href="/local/templates/main/css/jquery.fancybox.min.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/custom.css">
    <?}?>

    <script type="text/javascript">
        var UF_GOOGLE_MAP_DATA = '<?echo COption::GetOptionString("askaron.settings", "UF_GOOGLE_MAP_DATA");?>';
        var PERSONE_TYPE_PROF = <?=PERSONE_TYPE_PROF;?>;
        var PERSONE_TYPE_USER = <?=PERSONE_TYPE_USER;?>;
    </script>
	
	<!-- browser update -->
	<script> 
	var $buoop = {vs:{i:8,f:35,o:25,s:7,c:30},mobile:false,api:4}; 
	function $buo_f(){ 
	 var e = document.createElement("script"); 
	 e.src = "//browser-update.org/update.min.js"; 
	 document.body.appendChild(e);
	};
	try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
	catch(e){window.attachEvent("onload", $buo_f)}
	</script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-90570840-1', 'auto');
	  ga('send', 'pageview');
	</script>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter42199304 = new Ya.Metrika({
						id:42199304,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/42199304" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
    <!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');

	fbq('init', '1621215908190099');
	fbq('track', "PageView");</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=1621215908190099&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

	<?$APPLICATION->ShowHead();?>

	<?
	//mobile styles by icmark
	/*$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
	?>
	<link rel="stylesheet" href="/local/templates/main/css/mobile_styles.css">
	<meta name="viewport" content="width=1024, user-scalable=no" />
	<?
	}*/
	?>
    <?if(NEW_DES == 2){?>
	    <meta name="viewport" content="width=1280" />
    <?}?>
<meta name="cmsmagazine" content="8d83b506f5e84a5f11295e2f5a77dc0e" /> 
</head>

<body<?if(NEW_DES == 1){?> class="custom-new-style"<?}?>
itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?$APPLICATION->ShowPanel();?>
<?if (!empty($_REQUEST['panel'])) $APPLICATION->ShowPanel();?>
<?if(NEW_DES == 2){?>
<div class="loader">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <img src="/local/templates/main/images/934086.gif" alt="" />
            <span>0</span>
        </div>
    </div>
</div>
<?}?>
<?if (!$USER->IsAuthorized()){?>
    <div class="sing-in">
        <?$APPLICATION->includeComponent('freezone:auth', '.default', array());?>
    </div>

    <div class="recover-pass">
        <?$APPLICATION->includeComponent('freezone:forgot', '.default', array());?>
    </div>
<?}?>

<div class="thank">
    <div class="site-wrapper">
        <div class="site-wrapper-in">
            <p><?=Loc::getMessage("POPUP_TITLE_THANKS");?></p>
            <span><?=Loc::getMessage("POPUP_MESSAGE_THANKS");?></span>
        </div>
    </div>
</div>
<?if(NEW_DES == 1){?>
    <div class="header-min">
        <nav class="header-nav navbar-collapse collapse" id="navbarCollapse">
            <div class="nav-wrap">
                <div class="close-menu-fixed">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="nav-wrap-block container">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "main_new_custom", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                           0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "topnew",	// Тип меню для первого уровня
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                                                     false
                    );?>
                    <div class="header-tel">
                        <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p></div>
                </div>
            </div>
        </nav>
    </div>
    <div class="fixed-top-line header-min">
        <div class="fixedCenter">
            <article class="wrapper navbar-expand-md clearfix">
                <div class="header-line navbar-light container clearfix">
                    <div class="logo">
                        <a class="logo-link" href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?><?=($is_personal_page ? 'personal/' : '');?>"><img src="/local/templates/main/images/logo.png" alt="" /></a>
                        <div class="header-tel">
                            <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p></div>
                    </div>

                    <div class="navbar-toggler burger" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <?if ($APPLICATION->GetCurDir() == '/contacts/') {?>
                        <!--
                      <div class="tab-menu index-service-list-tab-menu">
                        <p><?=Loc::getMessage("TAB_TRANSPORT");?>:</p>
                        <ul>
                          <li class="active"><?=Loc::getMessage("TAB_TRANSPORT_FREE");?></li>
                          <li ><?=Loc::getMessage("TAB_TRANSPORT_CITY");?></li>
                        </ul>
                      </div>
                    -->
                    <?}?>
                    <div class="clearfix hidden-md-up"></div>
                    <div class="row header-bottom clearfix">
                        <div class="col-md-auto header-tel">
                            <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p>
                        </div>
                        <? if(LANGUAGE_ID != 'en') { ?>
                            <a class="col-md-auto header-top-button header-callback" href="/air/#amateur">
                                <?=Loc::getMessage("BUTTON_ORDER_FLIGHT");?>
                            </a>
                        <? } ?>
                        <a class="col-md-auto header-top-button header-login<?=(!$USER->isAuthorized() ? " header-log-in" : "")?>" href="/personal/"><?=Loc::getMessage("PERSONAL_LINK");?></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
<?}?>
<?if (!preg_match('#/cabinet/#simu', $APPLICATION->GetCurDir())){?>

    <header class="header <?=(defined('HEADER_SUB_CLASS')? HEADER_SUB_CLASS : '');?>">

        <?if (defined('AS_CABINET') && ($is_personal_page || $is_team_page)) {?>

            <article class="wrapper<?if(NEW_DES == 1){?> clearfix<?}?>">
                <a class="logo" href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?><?=($is_personal_page ? 'personal/' : '');?>"><img src="/local/templates/main/images/logo.png" alt="" /></a>
            <?if(NEW_DES == 1){?>
                <a class="link-exit" href="/?logout=Y"><?=Loc::getMessage("PERSONAL_LINK");?> <i class="icon-exit2"></i></a>
            <?}else{?>
                <a class="link-exit" href="/?logout=Y"><?=Loc::getMessage("LOGOUT");?> <i class="icon-exit2"></i></a>
            <?}?>
				<a href="/personal/order/" class="button btn-white">
                    <i class="icon-men-d"></i><?=Loc::getMessage("BUTTON_ORDER_FLIGHT");?>
                </a>
                <a href="/personal/balance/" class="button btn-white">
                    <i class="icon-balance"></i><?=Loc::getMessage("BUTTON_PAYMENT");?>
                </a>
            </article>

        <?} else {?>
            <?if(NEW_DES == 1){?>
                <article class="wrapper navbar-expand-md clearfix">
                    <div class="header-line navbar-light container clearfix">
                        <div class="logo">
                            <a class="logo-link" href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?><?=($is_personal_page ? 'personal/' : '');?>"><img src="/local/templates/main/images/logo.png" alt="" /></a>
                            <div class="header-tel">
                                <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p></div>
                            <div class="descriptor">
                                Полет в аэротрубе в Москве – официальный сайт FreeZone
                            </div>
                        </div>

                        <div class="navbar-toggler burger" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <?if ($APPLICATION->GetCurDir() == '/contacts/') {?>
                            <!--
                          <div class="tab-menu index-service-list-tab-menu">
                            <p><?=Loc::getMessage("TAB_TRANSPORT");?>:</p>
                            <ul>
                              <li class="active"><?=Loc::getMessage("TAB_TRANSPORT_FREE");?></li>
                              <li ><?=Loc::getMessage("TAB_TRANSPORT_CITY");?></li>
                            </ul>
                          </div>
                        -->
                        <?}?>
                        <div class="clearfix hidden-md-up"></div>
                        <div class="row header-bottom">
                            <div class="col-md-auto header-tel">
                                <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p>
                            </div>
                            <? if(LANGUAGE_ID != 'en') { ?>
                                <a class="col-md-auto header-top-button header-callback" href="/air/#amateur">
                                    <?=Loc::getMessage("BUTTON_ORDER_FLIGHT");?>
                                </a>
                            <? } ?>
                            <a class="col-md-auto header-top-button header-login<?=(!$USER->isAuthorized() ? " header-log-in" : "")?>" href="/personal/"><?=Loc::getMessage("PERSONAL_LINK");?></a>
                        </div>
                    </div>
                    <div class="container">
                        <nav class="header-nav" id="navbarCollapse">
                            <div class="nav-wrap">
                                <div class="nav-wrap-in">
                                    <?$APPLICATION->IncludeComponent("bitrix:menu", "main_new", Array(
                                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                                           0 => "",
                                        ),
                                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                        "ROOT_MENU_TYPE" => "topnew",	// Тип меню для первого уровня
                                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    ),
                                                                     false
                                    );?>
                                    <div class="header-tel">
                                        <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a></p></div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </article>
            <?}else{?>
                <article class="wrapper">
                    <a class="logo" href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?><?=($is_personal_page ? 'personal/' : '');?>"><img src="/local/templates/main/images/logo.png" alt="" /></a>
                    <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <?if ($APPLICATION->GetCurDir() == '/contacts/') {?>
                        <!--
                  <div class="tab-menu index-service-list-tab-menu">
                    <p><?=Loc::getMessage("TAB_TRANSPORT");?>:</p>
                    <ul>
                      <li class="active"><?=Loc::getMessage("TAB_TRANSPORT_FREE");?></li>
                      <li ><?=Loc::getMessage("TAB_TRANSPORT_CITY");?></li>
                    </ul>
                  </div>
				-->
                    <?}?>
                    <nav class="header-nav">
                        <div class="nav-wrap">
                            <div class="nav-wrap-in">
                                <?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
                                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                                                       0 => "",
                                    ),
                                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                ),
                                                                 false
                                );?>
                                <?if(!$USER->isAuthorized()){?>
                                    <a class="header-log-in" href="#"><i class="icon-log"></i><span><?=Loc::getMessage("LOGIN");?></span></a>
                                <?} else {?>
                                    &nbsp;<a href="/?logout=Y"><i class="icon-log"></i><span><?=Loc::getMessage("LOGOUT");?></span></a>
                                <?}?>
                            </div>
                        </div>

                    </nav>
                    <div class="header-bottom">
                        <? if(LANGUAGE_ID != 'en') { ?>
                            <a href="/<?=(LANGUAGE_ID == 'en' ? 'en/' : '');?>#amateur" class="header-callback">
                                <i class="icon-men"></i>
                                <?=Loc::getMessage("BUTTON_ORDER_FLIGHT");?>
                            </a>
                        <? } ?>
                        <div class="header-tel">
                            <p><a href="tel: <?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?>" rel="nofollow"><?echo COption::GetOptionString( "askaron.settings", "UF_PHONE" );?></a>
                                <i class="icon-tel"></i></p>
                        </div>
                    </div>
                </article>
            <?}?>
        <?}?>
    </header>

    <!--<div>
    <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "s2",
		"START_FROM" => "0"
	)
    );?>
    </div>-->

    <?php
    if (defined('NAVIGATION')) {
        echo NAVIGATION;
    }
    ?>

    <div class="content <?=(defined('CONTENT_SUB_CLASS') ? CONTENT_SUB_CLASS : '');?>">
    <?if(NEW_DES == 1 && LANGUAGE_ID == "ru"){?>
        <?$APPLICATION->IncludeComponent(
            "freezone:inners.pages",
            "",
            Array(
                "IBLOCK_ID" => MAIN_SECTIONS,
            )
        );?>
        <?$APPLICATION->ShowViewContent('elems_list_wrap_head');?>
    <?}?>

    <div class="breadcrumb">
    <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "s2",
		"START_FROM" => "0"
	)
    );?>
    </div>
<?}?>