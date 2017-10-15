<?php
if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/const.php')) {
    require_once($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/const.php');
}

if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/functions.php')) {
    require_once($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/functions.php');
}

if(file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/events.php')) {
    require_once($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/events.php');
}
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}

define('URL_HOST', 'http://freezone.bitrixpromo.ru');
define('FROM_EMAIL', 'info@freezone.ru');

define('RESERV_CENTER', 1);
define('RESERV_RIGHT', 2);
define('RESERV_LEFT', 3);

define('TYPE_F_ONE', 20);
define('TYPE_F_DUPLE', 21);
define('TYPE_F_CUSTOM', 26);

define('CATEGORY_F_BY_TARIFF', 27);
define('CATEGORY_F_BY_CERTIFICATE', 29);


define('PERSONE_TYPE_USER', 24);
define('PERSONE_TYPE_PROF', 25);

define('TRUBA_12', 12);
define('TRUBA_17', 17);


define('STATUS_PAYED_COMPLETE', 'COMPLETE');
define('STATUS_PAYED_FAIL', 'FAIL');

define('CERTIFICATE_USED_NO', 32);
define('CERTIFICATE_USED_YES', 31);

if (LANGUAGE_ID == 'ru') {
    $dow = array('Воскресение', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');

    $months_rus = array(
        "1" => "января",
        "2" => "февраля",
        "3" => "марта",
        "4" => "апреля",
        "5" => "мая",
        "6" => "июня",
        "7" => "июля",
        "8" => "августа",
        "9" => "сентября",
        "10" => "октября",
        "11" => "ноября",
        "12" => "декабря");

    $months_rus1 = array(
        "1" => "Январь",
        "2" => "Февраль",
        "3" => "Март",
        "4" => "Апрель",
        "5" => "Май",
        "6" => "Июнь",
        "7" => "Июль",
        "8" => "Август",
        "9" => "Сентябрь",
        "10" => "Октябрь",
        "11" => "Ноябрь",
        "12" => "Декабрь"
    );
} else {
    $dow = array('EN Воскресение', 'EN Понедельник', 'EN Вторник', 'EN Среда', 'EN Четверг', 'EN Пятница', 'EN Суббота');

    $months_rus = array(
        "1" => "января",
        "2" => "февраля",
        "3" => "марта",
        "4" => "апреля",
        "5" => "мая",
        "6" => "июня",
        "7" => "июля",
        "8" => "августа",
        "9" => "сентября",
        "10" => "октября",
        "11" => "ноября",
        "12" => "декабря");

    $months_rus1 = array(
        "1" => "Januar",
        "2" => "Февраль",
        "3" => "Март",
        "4" => "Апрель",
        "5" => "Май",
        "6" => "Июнь",
        "7" => "Июль",
        "8" => "Август",
        "9" => "Сентябрь",
        "10" => "Октябрь",
        "11" => "Ноябрь",
        "12" => "Декабрь"
    );
}


$ORDERS_SELECT = array(
    'ID',
    'NAME',
    'PROPERTY_TYPE_F',
    'PROPERTY_CATEGORY_F',
    'PROPERTY_TARIFF',
    'PROPERTY_TRUBA',
    'PROPERTY_DATE_START',
    'PROPERTY_TIME_START',
    'PROPERTY_TIMELENGTH',
    'PROPERTY_TIMELENGTH_BLOCK',
    'PROPERTY_PERSONE_TYPE',
    'PROPERTY_TRAINER_CATEGORY',
    'PROPERTY_CERT',
    'PROPERTY_USER',
    'PROPERTY_DATE_PAYMENT',
    'PROPERTY_STATUS_PAYMENT',
    'PROPERTY_AMOUNT_PAYMENT',
    'PROPERTY_PRICE',
    'PROPERTY_PRICE_RESULT',
    'PROPERTY_COMPLETED',
    'PROPERTY_TRAINER',
    'PROPERTY_CLOSED',
    'PROPERTY_CATEGORY_IB',
);


function generate_link_sber($ORDER_ID)
{
    $content = '';
    return $content;
}

function get_data_from_iblock($IBLOCK_ID, $ID)
{
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => $IBLOCK_ID, 'ID' => $ID));
        if ($res->SelectedRowsCount() == 1) {
            return $res->GetNext();
        }
    }

    return null;
}

function getUserHours()
{
    global $USER, $ORDERS_SELECT;

    \Bitrix\Main\Loader::includeModule('iblock');

    $res = CIBlockElement::GetList(
        array('PROPERTY_DATE_START' => 'DESC', 'PROPERTY_COMPLETED_VALUE' => 'DESC'),
        array('IBLOCK_ID' => 47, 'PROPERTY_USER' => $USER->GetID()),
        0,
        0,
        $ORDERS_SELECT
    );
    $sum_time = 0;
    while ($row = $res->GetNext()) {
        $sum_time += $row['PROPERTY_TIMELENGTH_VALUE'];
    }

    return $sum_time;
}

/**
 * @param $price
 * @return bool
 *
 * проверка доступного баланса на покупку
 */
function check_can_order($price)
{
    $balance = getUserBalance();
    if ($balance >= $price) {
        return true;
    }

    return false;
}

/**
 * @return int
 *
 * Получения баланса
 */
function getUserBalance()
{
    global $USER;
    if (\Bitrix\Main\Loader::includeModule('sale')) {
        if ($ar = CSaleUserAccount::GetByUserID($USER->GetID(), "RUB")) {
            return $ar['CURRENT_BUDGET'];
        }
    }

    return 0;
}

/**
 * @param $user_id
 * @param $param
 * @return string
 *
 * Получения параметра пользователя из профиля
 */
function getUserParam($user_id, $param)
{
    $order = array('sort' => 'asc');
    $tmp = 'sort';
    $rsUsers = CUser::GetList($order, $tmp, array('ID' => $user_id), array('SELECT' => array($param)));
    if ($rsUsers->SelectedRowsCount() == 1) {
        $user = $rsUsers->GetNext();
        return $user[$param];
    }

    return '';
}

function set_end($number, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

/**
 * @return null
 *
 * Категория пользователя
 */
function getUserCatId()
{
    global $USER;

    $cat_id = null;
    $a = $b = null;
    $res = CUser::getList($a, $b, array('ID' => $USER->GetID()), array('SELECT' => array('UF_USER_CATEGORY')));
    if ($res->SelectedRowsCount()) {
        $u = $res->GetNext();
        $cat_id = $u['UF_USER_CATEGORY'];
    }

    return $cat_id;
}

function getUserCategory($cat_id)
{
    $res = CIBlockElement::getList(
        false,
        array('IBLOCK_ID' => 44, 'ID' => $cat_id),
        0,
        0,
        array('ID', 'NAME', 'CODE', 'PREVIEW_TEXT', 'DETAIL_TEXT')
    );
    if ($res->SelectedRowsCount() == 1) {
        $row = $res->GetNext();

        return $row;
    }

    return false;
}

/**
 * @param $truba_code
 * @return bool
 *
 * Идентификатор трубы по ее коду (17, 12)
 */
function get_truba_id($truba_code)
{
    if (!in_array($truba_code, array(17, 12))) {
        return false;
    }
    $res = CIBlockElement::GetList(false, array('CODE' => $truba_code, 'IBLOCK_ID' => 13), 0, 0, array('ID'));
    if ($res->SelectedRowsCount() == 1) {
        $truba = $res->GetNext();
        return $truba['ID'];
    }

    return false;
}

/**
 * @param $times
 * @param $block_from
 * @param $block_end
 * @return array|bool
 *
 * Проверка и поиск вхождения резерва в блока времени
 */
function find_reserv($times, $block_from, $block_end)
{
    foreach ($times as $id => $order) {
        if ($order['FROM'] >= $block_from && $order['TO'] <= $block_end) {
//            echo "RESERV_CENTER";
            return array($order['FROM'], $order['TO'], RESERV_CENTER, $order);
        }
    }

    foreach ($times as $id => $order) {
        if ($order['FROM'] < $block_end && $order['FROM'] > $block_from) {
//            echo "RESERV_RIGHT";
            return array($order['FROM'], $order['TO'], RESERV_RIGHT, $order);
        }
    }

    foreach ($times as $id => $order) {
        if ($block_from >= $order['FROM'] && $block_end <= $order['TO']) {
//            echo "RESERV_CENTER2";
            return array($order['FROM'], $order['TO'], RESERV_CENTER, $order);
        }

        if ($block_from >= $order['FROM'] && $order['TO'] > $block_end) {
//            echo "RESERV_LEFT";
            return array($order['FROM'], $order['TO'], RESERV_LEFT, $order);
        }
    }

    return false;
}


/**
 * @param $h1
 * @param $m1
 * @param $h2
 * @param $m2
 * @return mixed
 *
 * Кол-во секунд между конечным и начальным временем
 */
function get_time_length($h1, $m1, $h2, $m2)
{
    return ($h2 * 60 + $m2) - ($h1 * 60 + $m1);
}


function get_max_truba_humans_by_id($truba_id)
{
    if ($truba_id) {
        $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 13, 'ID' => $truba_id), 0, 0, array('PROPERTY_MAX'));
        if ($res->SelectedRowsCount() == 1) {
            $row = $res->GetNext();
            return $row['PROPERTY_MAX_VALUE'];
        }
    }

    return false;
}

/**
 * @param $truba
 * @return bool
 *
 * Максимальное кол-во человек на трубу за раз
 */
function get_max_truba_humans($truba)
{
    $truba_id = get_truba_id($truba);
    return get_max_truba_humans_by_id($truba_id);
}

/**
 * @param $h1
 * @param $m1
 * @param $str_date
 * @return mixed
 *
 * Список заказов на дату и время
 */
function get_orders($h1, $m1, $str_date)
{
    global $ORDERS_SELECT;

    $params = array(
        'IBLOCK_ID' => 47,
        'PROPERTY_DATE_START' => ConvertDateTime(date('d.m.Y', strtotime($str_date)), "YYYY-MM-DD"),
    );

    if ($h1 && $m1) {
        $params['PROPERTY_TIME_START'] = $h1 . ':' . $m1;
    }

    return CIBlockElement::GetList(false, $params, false, false, $ORDERS_SELECT);
}

/**
 * @param $order_id
 * @param $str_date
 * @param $time
 *
 * Перенос заказа на дату и время
 * @return bool
 */
function update_order_datetime($order_id, $str_date, $time)
{
    $params = array(
        "DATE_START" => ConvertDateTime(date('d.m.Y', strtotime($str_date)), "DD.MM.YYYY"),
        "TIME_START" => $time
    );

    CIBlockElement::SetPropertyValuesEx($order_id, 47, $params);

    return true;
}

/**
 * @param $h1
 * @param $m1
 * @param $str_date
 * @return mixed
 *
 * Кол-во заказов на определенное время и дату
 */
function get_count_orders($h1, $m1, $str_date)
{
    $res = get_orders($h1, $m1, $str_date);
    return $res->SelectedRowsCount();
}


/**
 * @param $truba_id
 * @return array|bool
 *
 * Параметры трубы
 */
function get_truba_params($truba_id)
{
    $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 13, 'ID' => $truba_id), 0, 0, array(
        'PROPERTY_NIGHT_START', 'PROPERTY_START_TIME', 'PROPERTY_END_TIME', 'PROPERTY_MAX', 'NAME', 'CODE',
    ));
    if ($res->SelectedRowsCount() == 1) {
        $row = $res->GetNext();
        return array(
            $row['PROPERTY_START_TIME_VALUE'],
            $row['PROPERTY_END_TIME_VALUE'],
            $row['PROPERTY_NIGHT_START_VALUE'],
            $row['PROPERTY_MAX_VALUE'],
            $row['NAME'],
            $row['CODE'],
        );
    }

    return false;
}

function get_truba_time_settings($truba_id, $current_day)
{
  if(!$truba_id) return array();
  if(!$current_day) $current_day = time();
  CModule::IncludeModule("iblock");

  $day = ConvertTimeStamp($current_day, 'SHORT');
  $number_day = date('N', strtotime($day));
  $arRes = array();
  $arFilter = array(
    'IBLOCK_ID' => 60,
    'ACTIVE' => 'Y',
    'PROPERTY_TUBE' => $truba_id,
    '!PROPERTY_TIME_FROM' => false,
    '!PROPERTY_TIME_TO' => false,
  );

  $prop = CIBlockPropertyEnum::GetList(array(),array('IBLOCK_ID' => 60, 'CODE' => 'WEEK', 'XML_ID'=>$number_day));
  if($prop_row = $prop->GetNext(false, false)){
    $arFilter[] = array(
      'LOGIC' => 'OR',
      array('PROPERTY_WEEK_VALUE' => $prop_row['VALUE']),
      array(
        '>=PROPERTY_DATE' => $day,
        '<PROPERTY_DATE' => ConvertTimeStamp(strtotime($day.' +1 day'), 'SHORT')
      )
    );
  } else {
    $arFilter['>=PROPERTY_DATE'] = $day;
    $arFilter['<PROPERTY_DATE'] = ConvertTimeStamp(strtotime($day.' +1 day'), 'SHORT');
  }
//echo '<pre>'.print_r($arFilter,true).'</pre>';
  $res = CIBlockElement::GetList(
    array(),
    $arFilter,
    false,
    false,
    array(
      'ID', 'IBLOCK_ID', 'PROPERTY_TUBE',
      'PROPERTY_TIME_FROM', 'PROPERTY_TIME_TO', 'PROPERTY_TUBE',
      'PROPERTY_DATE', 'PROPERTY_WEEK', 'PROPERTY_STATUS',
    )
  );
  while($row = $res->GetNext(false, false)){

    $start_tmp = explode(':', $row['PROPERTY_TIME_FROM_VALUE']);
    $end_tmp = explode(':', $row['PROPERTY_TIME_TO_VALUE']);
    $start_hour = time_element_to_str($start_tmp[0]);
    $start_min = time_element_to_str($start_tmp[1]);
    $end_hour = time_element_to_str($end_tmp[0]);
    $end_min = time_element_to_str($end_tmp[1]);
    $flag = true;

    do{
      $ch = $start_hour < 10 ? '0' . intval($start_hour) : $start_hour;
      $cm = $start_min < 10 ? '0' . intval($start_min) : $start_min;

      // if(!empty($row['PROPERTY_DATE_VALUE']))
        // $arRes['ARMOR'][$ch][$cm] = 'Y';
      // else if(!empty($row['PROPERTY_STATUS_VALUE']) && !isset($arRes[$ch][$cm]))
        $arRes['FAN'][$ch][$cm] = 'Y';

      $start_min += 15;
      if ($start_min >= 60) {
        $start_hour += 1;
        $start_min = ($start_min > 60)?$start_min - 15:0;

        if ($start_hour >= 24) {
          $start_hour = 0;
        }
      }

      if($end_hour == $start_hour && $end_min == $start_min){
        $flag = false;
      }
    } while($flag);

//    if(!empty($row['PROPERTY_DATE_VALUE']))
//      $row['MARK'] = 'armor';
//    else if(!empty($row['PROPERTY_STATUS_VALUE']))
//      $row['MARK'] = 'fan';
//    $arRes[] = $row;
  }

  return $arRes;
}

function get_order($order_id)
{
    global $ORDERS_SELECT;

    $res = CIBlockElement::GetList(
        false,
        arraY('IBLOCK_ID' => 47, 'ID' => $order_id),
        0,
        0,
        $ORDERS_SELECT
    );
    if ($res->SelectedRowsCount() == 1) {
        return $res->GetNext();
    }

    return false;
}

const ORDER_CLOSED_YES = 30;

/**
 * @param $order_id
 * @return mixed
 *
 * Принудительно закрывание заявки
 */
function close_registration($order_id)
{
    CIBlockElement::SetPropertyValuesEx($order_id, 47, array("CLOSED" => ORDER_CLOSED_YES));
    return true;//CIBlockElement::SetPropertyValues($order_id, 47, ORDER_CLOSED_YES, "CLOSED");
}

/**
 * @param $order
 * @return bool
 *
 * проверка на наличиие свободных минут
 */
function is_free_time($order_id){

  $order = get_order($order_id);

  list($ch, $cm) = explode(':', $order['PROPERTY_TIME_START_VALUE']);

  $obRes = get_orders($ch, $cm, $order['PROPERTY_DATE_START_VALUE']);
  $max_time = $order['PROPERTY_TIMELENGTH_VALUE'];
  $time = 0;
  while($arRes = $obRes->GetNext()){
    $time += $arRes['PROPERTY_TARIFF_PROPERTY_FLIGHTS_VALUE'];
  }
//  AddMessage2Log($time.' - '.$max_time);

  return ($time!=0&&$time<$max_time)?$max_time-$time:false;
}

/**
 * @param $order_id
 * @return bool
 *
 * проверка за открытаза запись или нет
 */
function is_opened_registration($order_id)
{
    $order = get_order($order_id);

    // для одного человека заказ всегда "Занято"
    if ($order['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_ONE) {
        return false;
    }

    list($ch, $cm) = explode(':', $order['PROPERTY_TIME_START_VALUE']);
    $truba = get_truba_params($order['PROPERTY_TRUBA_VALUE']);
    $max_truba_humans = $truba[3];

    $count_humans = get_count_orders($ch, $cm, $order['PROPERTY_DATE_START_VALUE']);

    $is_opened = ($count_humans < $max_truba_humans);
    if ($order['PROPERTY_CLOSED_ENUM_ID'] == ORDER_CLOSED_YES) {
        $is_opened = false;
    }

    return $is_opened;
}

function is_closed_registration($order_id)
{
    $order = get_order($order_id);
    return $order['PROPERTY_CLOSED_ENUM_ID'] == ORDER_CLOSED_YES;
}

const RC_CONTENT_HTML = 'html';
const RC_CONTENT_OPENED_TIMES = 'opened_times';

function renderCalendarColByDate($current, $filter_grad_min, $filter_truba, $filter_type, $filter_person_type,
                                 $return_variant = RC_CONTENT_HTML, $time_tariff = null)
{
    global $months_rus, $dow, $months_rus1;

    $free_times = array();

    $hide_busy = (int)COption::GetOptionString("askaron.settings", "UF_SHOW_BUSY_DAYS");

    $disable_prof_black = false;
    if ($filter_person_type == PERSONE_TYPE_PROF) {
        $disable_prof_black = COption::GetOptionString("askaron.settings", "UF_DISABLE_PROF_BLCK");
    }

    $truba_id = get_truba_id($filter_truba);
    $truba_params = get_truba_params($truba_id);

    /** Настройки времени */
    $time_settings = get_truba_time_settings($truba_id, $current);

    if (!$truba_params) {
        echo 'error get truba params';
        exit;
    }
    list($start, $end, $night_start) = $truba_params;
	
	
	
    $night_time_tmp = explode(':', $night_start);
    $night_hash = intval($night_time_tmp[0] * 60) + intval($night_time_tmp[1]);
	
	
	

    /** Получаем список заказов с его свойствами для данной трубы */
    $times = get_orders_blocks($current, array('TRUBA_ID' => $truba_id, 'PERSON_ID' => $filter_person_type));
	
	//добавляем к профессионалам вывод брони любителями
	if ($filter_person_type == PERSONE_TYPE_PROF) {
		$times_user = get_orders_blocks($current, array('TRUBA_ID' => $truba_id, 'PERSON_ID' => PERSONE_TYPE_USER));
		$times = array_merge ($times, $times_user);
	}
	
    // AddMessage2Log($times);

    $content_time_blocks = '';

    $repeat = true;
    $need_end = false;
    $start_tmp = explode(':', $start);
    $end_tmp = explode(':', $end);

    $start_hour = time_element_to_str($start_tmp[0]);
    $start_min = time_element_to_str($start_tmp[1]);

    $ttl = 0;
    $is_night = false;
	//обединяем для проф. чейки по 2 в блок
	if ($filter_person_type == PERSONE_TYPE_PROF) {
		$block_count = 1;
	}
    do {
        $ttl++;
        $ch = $start_hour < 10 ? '0' . intval($start_hour) : $start_hour;
        $cm = $start_min < 10 ? '0' . intval($start_min) : $start_min;

        $start_min += $filter_grad_min;
        if ($start_min >= 60) {
            $start_hour += 1;
            if ($start_min > 60) {
                $start_min = $start_min - $filter_grad_min;
            } else {
                $start_min = 0;
            }

            if ($start_hour >= 24) {
                $start_hour = 0;
                $need_end = true;
            }
        }

        $ech = $start_hour < 10 ? '0' . intval($start_hour) : $start_hour;
        $ecm = $start_min < 10 ? '0' . intval($start_min) : $start_min;

        $from_hash = intval($ch) * 60 + intval($cm);
        $end_hash = $from_hash + $filter_grad_min;

        $reserv_data = find_reserv($times, $from_hash, $end_hash);
        $start_reserv = null;
        $end_reserv = null;
        $RESERV_VARIANT = null;
        $order = null;
        if ($reserv_data) {
            list($start_reserv, $end_reserv, $RESERV_VARIANT, $order) = $reserv_data;
        }

        // check for night
		if ($filter_person_type == PERSONE_TYPE_PROF) {
			//ночное время для спортсменов
			$prof_day_check = date('N', $current);
			if ($truba_id == 50) {
				//12м
				if (($prof_day_check == 6) || ($prof_day_check == 7)) {
					$prof_nights_hours  = array("01", "02", "03", "04", "05", "06", "07", "08", "09");
				} else {
					$prof_nights_hours  = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15");
				}
			}
			if ($truba_id == 49) {
				//17м
				$prof_nights_hours  = array("01", "02", "03", "04", "05", "06", "07", "08", "09");
			}
			if (in_array(intval($ch), $prof_nights_hours)) {
				$is_night = true;
			} else {
				$is_night = false;
			}
		} else {
			if (!$is_night) {
				if ($from_hash >= $night_hash) {
					$is_night = true;
				}
			}
		}

        $data_class = false;
        $data_ch = false;
        $data_cm = false;
        $data_start_hour = false;
        $data_start_min = false;
        $data_callback = false;
        $data_ptype = false;
        $data_oid = false;
        $data_fulldate = false;
        $data_datename = false;
        $data_timename = false;
        $data_content_name = false;
        $data_content_times = false;

        $show_time = false;
        $array_times = array();
		
		
		
		

        if ($reserv_data === false) {
            $is_free = true;

            // Если глобально отключены тарифы на ночные залеты
            // и данный блок это ночной блок
            // и текущий человек - спортсмен - говорим что занято
            if ($disable_prof_black && $is_night && $filter_person_type == PERSONE_TYPE_PROF) {
                $is_free = false;
            }

            $data_class = '';


            /**
             * Проверка на временные настройки для ЛЮБИТЕЛЕЙ:
             */
            if($filter_person_type != PERSONE_TYPE_PROF){ // пока только для любителей
              $is_armor = false;
              $is_fan = true;
              if(isset($time_settings['ARMOR'])){
                if(isset($time_settings['ARMOR'][$ch][$cm])){
                  $is_free = false;
                  $is_armor = true;
                }
              }
              if(isset($time_settings['FAN']) && !$is_armor){
                if(isset($time_settings['FAN'][$ch][$cm])){
                  $is_fan = true;
    //              AddMessage2Log($time_settings['FAN'][$ch][$cm]);
//                  $data_class .= ' yellow ';
                } else {
                  $is_free = false;
                  $is_fan = false;
                }
              }
				//отключаем ночь для любителей
				if ($is_night) {
					$is_free = false;
					$is_fan = false;
				}
			  
            } else { //для спорта

				$prof_time_check = $ch . ':' . $cm . ' – ' . $ech . ':' . $ecm;
				$prof_day_check = date('N', $current);
				//блокируем время, зарезервированное для любителей на сб и вс
				$prof_12_saturday_block = array(
					"11:30 - 11:45",
					"11:45 – 12:00",
					"12:00 – 12:15",
					"12:15 – 12:30",
					"13:30 – 13:45",
					"13:45 – 14:00",
					"15:30 – 15:45",
					"15:45 – 16:00",
					"16:00 – 16:15",
					"16:15 – 16:30",
					"17:30 – 17:45",
					"17:45 – 18:00",
					"18:00 – 18:15",
					"18:15 – 18:30",
					"19:00 – 19:15",
					"19:15 – 19:30",
				);
				$prof_12_sunday_block = array(
					"11:30 - 11:45",
					"11:45 – 12:00",
					"12:00 – 12:15",
					"12:15 – 12:30",
					"13:30 – 13:45",
					"13:45 – 14:00",
					"15:30 – 15:45",
					"15:45 – 16:00",
					"16:00 – 16:15",
					"16:15 – 16:30",
					"17:30 – 17:45",
					"17:45 – 18:00",
					"19:00 – 19:15",
					"19:15 – 19:30",
				);
				$prof_17_saturday_block = array(
					"11:00 – 11:15",
					"11:15 – 11:30",
					"12:30 – 12:45",
					"12:45 – 13:00",
					"14:30 – 14:45",
					"14:45 – 15:00",
					"16:30 – 16:45",
					"16:45 – 17:00",
					"20:00 – 20:15",
					"20:15 – 20:30",
				);
				$prof_17_sunday_block = array(
					"11:00 – 11:15",
					"11:15 – 11:30",
					"12:30 – 12:45",
					"12:45 – 13:00",
					"14:30 – 14:45",
					"14:45 – 15:00",
					"16:30 – 16:45",
					"16:45 – 17:00",
				);
				if ($truba_id == 50) {
					if ($prof_day_check == 6) {
						if (in_array($prof_time_check, $prof_12_saturday_block)) {
							$is_free = false;
							$is_fan = false;
						}
					}
					if ($prof_day_check == 7) {
						if (in_array($prof_time_check, $prof_12_sunday_block)) {
							$is_free = false;
							$is_fan = false;
						}
					}
				}
				if ($truba_id == 49) {
					if ($prof_day_check == 6) {
						if (in_array($prof_time_check, $prof_17_saturday_block)) {
							$is_free = false;
							$is_fan = false;
						}
					}
					if ($prof_day_check == 7) {
						if (in_array($prof_time_check, $prof_17_sunday_block)) {
							$is_free = false;
							$is_fan = false;
						}
					}
				}
				
			}


            if (!($hide_busy && !$is_free)) {
                if ($is_free) {
                  $data_class .= ' free ';
                } else {
                  $data_class .= ' selection-couple stopsale ';
                }
                if ($is_night) {
                    $data_class .= ' black ';
                }

                if ($is_free) {
                    $data_ch = $ch;
                    $data_cm = $cm;
                    $data_start_hour = $start_hour;
                    $data_start_min = $start_min;
                    $data_callback = 'previewFreePopup';
                    $data_ptype = $filter_person_type;
                }

                $data_fulldate = date('Y-m-d', $current);
                $data_datename = date('d', $current) . ' ' . $months_rus[date('m', $current)];
                $data_timename = $ch . ':' . $cm . ' – ' . $ech . ':' . $ecm;

                $busy = false;
                //if ($filter_person_type == PERSONE_TYPE_PROF)
                {
                    if ($is_free) {
                        $data_content_name = 'Свободно'." ";

                        $free_times[] = $data_timename;
                    } else {
                      $busy = true;
                      $data_content_name = 'Занято';
                      if(isset($is_fan) && !$is_fan){
                        $data_content_name = 'Недоступно';
                      }
                    }
                }
				
				
				

                $data_content_times = $data_timename;

                $show_time = true;

                //if ($busy && !$hide_busy)
                {
					
					//обединяем для проф. чейки по 2 в блок
					if ($filter_person_type == PERSONE_TYPE_PROF) {
						(($block_count % 2) == 0) ? $data_class.= " prof_even" : $data_class.= " prof_odd";
						$block_count++;	
					}
					
                    $array_times[] = array(
                        'data_class' => $data_class,
                        'data_ch' => $data_ch,
                        'data_cm' => $data_cm,
                        'data_start_hour' => $data_start_hour,
                        'data_start_min' => $data_start_min,
                        'data_callback' => $data_callback,
                        'data_oid' => $data_oid,
                        'data_ptype' => $data_ptype,
                        'data_fulldate' => $data_fulldate,
                        'data_datename' => $data_datename,
                        'data_timename' => $data_timename,
                        'data_content_name' => $data_content_name,
                        'data_content_times' => $data_content_times,
                    );
                }
            }
        } else if ($start_reserv && $end_reserv && ($RESERV_VARIANT == RESERV_RIGHT || $RESERV_VARIANT == RESERV_LEFT)) {
            $tmp_h = floor($start_reserv / 60);
            $tmp_m = $start_reserv - $tmp_h * 60;

            $etmp_h = floor($end_reserv / 60);
            $etmp_m = $end_reserv - $etmp_h * 60;

            $start_hour = $etmp_h;
            $start_min = $etmp_m;

            if (get_time_length($ch, $cm, $tmp_h, $tmp_m) >= $filter_grad_min) {

                $data_class = 'free ' . ($is_night ? ' black ' : '');
                $data_fulldate = date('Y-m-d', $current);
                $data_datename = date('d', $current) . ' ' . $months_rus[date('m', $current)];
                $data_timename = $ch . ':' . $cm . ' - ' . $tmp_h . ':' . $tmp_m;

                $data_content_name = 'Свободно';
                $data_content_times = $data_timename;

                $free_times[] = $data_timename;

				
				//обединяем для проф. чейки по 2 в блок
				if ($filter_person_type == PERSONE_TYPE_PROF) {
					(($block_count % 2) == 0) ? $data_class.= " prof_even" : $data_class.= " prof_odd";
					$block_count++;	
				}
				
                $array_times[] = array(
                    'data_class' => $data_class,
                    'data_ch' => $data_ch,
                    'data_cm' => $data_cm,
                    'data_start_hour' => $data_start_hour,
                    'data_start_min' => $data_start_min,
                    'data_callback' => $data_callback,
                    'data_oid' => $data_oid,
                    'data_ptype' => $data_ptype,
                    'data_fulldate' => $data_fulldate,
                    'data_datename' => $data_datename,
                    'data_timename' => $data_timename,
                    'data_content_name' => $data_content_name,
                    'data_content_times' => $data_content_times,
                );

                $show_time = true;
            }

            if (!$hide_busy) {
				
				//обединяем для проф. чейки по 2 в блок
				if ($filter_person_type == PERSONE_TYPE_PROF) {
					(($block_count % 2) == 0) ? $data_class.= " prof_even" : $data_class.= " prof_odd";
					$block_count++;	
				}
				
                $array_times[] = array(
                    'data_class' => 'stopsale ' . ($is_night ? 'black' : ''),
                    'data_content_name' => 'Занято',
                    'data_content_times' =>
                        ($filter_person_type == PERSONE_TYPE_PROF ? $tmp_h . ':' . $tmp_m . ' - ' . $etmp_h . ':' . $etmp_m : ''),
                );
            }

        } else if ($RESERV_VARIANT == RESERV_CENTER) {
            $tmp_h = floor($end_reserv / 60);
            $tmp_m = $end_reserv - $tmp_h * 60;

            $start_hour = time_element_to_str($tmp_h);
            $start_min = time_element_to_str($tmp_m);

            $is_free_time = is_free_time($order['ID']);
			
			//закрываем для бронирования спортсменам время, занятое любителями
			if (($filter_person_type == PERSONE_TYPE_PROF) and ($is_free_time > 0)) {
				$lasted_time = $is_free_time;
				$is_free_time = false;
			}

            if ($filter_type != TYPE_F_DUPLE) {
                $is_need_more_people = false;
            } else {
                $is_need_more_people = is_opened_registration($order['ID']);
            }

            if (!($hide_busy && !$is_need_more_people)) {

                $busy = false;
                $data_class = ($is_night ? 'black' : '');
                if ($is_need_more_people) {
                  $data_class .= ' free selection-couple ';
                } else {
                  if($is_free_time)
                    $data_class .= ' free ';
                  else
                    $data_class .= ' selection-couple stopsale ';

                  $busy = true;
                }

                $data_oid = $order['ID'];
                $data_ptype = $order['PERSONE_TYPE'];
                $data_callback = 'previewDouplePopup';

                if ($is_need_more_people || $is_free_time) {
                    $data_fulldate = date('Y-m-d', $current);
                    $data_datename = date('d', $current) . ' ' . $months_rus[date('m', $current)];
                }

                $data_timename = $ch . ':' . $cm . ' - ' . $start_hour . ':' . $start_min;

                if ($order['TYPE_F'] == TYPE_F_DUPLE) {
                    if ($is_need_more_people) {
                        $data_content_name = 'Подбор пары';

                        $free_times[] = $data_timename;

                    } else {
                        $data_content_name = 'Занято';
                    }
                } else {
                  if ($is_free_time) {
                    $data_callback = 'previewFreePopup';
                    $data_content_name = 'Свободно';
                    $data_oid = false;
                  } else {
						$data_content_name = 'Занято';
						//оставшиеся минуты от любителей
						if (isset($lasted_time)) {
							$data_content_name .= "<span class='group-type free-amtr'>свободно: $lasted_time мин.</span>";
						}
						//выводим сообщение о типе полета для профессионалов
						if ($filter_person_type == PERSONE_TYPE_PROF) {
							$order_info = get_order($order['ID']);
							
							switch ($order_info['PROPERTY_TRAINER_CATEGORY_VALUE']) {
							case 213:
								$data_content_name .= "<span class='group-type'>4RW/FS</span>";
								$data_class .= ' 4rwfs ';
								break;
							case 1869:
								$data_content_name .= "<span class='group-type'>Подбор пары</span>";
								$data_class .= ' need-couple ';
								break;
							default:
								if ($order_info["PROPERTY_PERSONE_TYPE_ENUM_ID"] ==  25) {
									$data_content_name .= "<span class='group-type'>Пара не нужна</span>";
								}
							}
							
						}
					}
                }

                if ($filter_person_type == PERSONE_TYPE_PROF || $is_need_more_people || $is_free_time) {
                    $data_content_times = $data_timename;
                }
				
				
				//обединяем для проф. чейки по 2 в блок
				if ($filter_person_type == PERSONE_TYPE_PROF) {
					(($block_count % 2) == 0) ? $data_class.= " prof_even" : $data_class.= " prof_odd";
					$block_count++;	
				}
				

                if ($busy && !$hide_busy) {

                    $array_times[] = array(
                        'data_class' => $data_class,
                        'data_ch' => $ch,
                        'data_cm' => $cm,
                        'data_start_hour' => $start_hour,
                        'data_start_min' => $start_min,
                        'data_callback' => $data_callback,
                        'data_oid' => $data_oid,
                        'data_ptype' => $data_ptype,
                        'data_fulldate' => $data_fulldate,
                        'data_datename' => $data_datename,
                        'data_timename' => $data_timename,
                        'data_content_name' => $data_content_name,
                        'data_content_times' => $data_content_times,
                        'data_reserve_times' => $is_free_time,
                    );
                }

                $show_time = true;
            }
        }

        if ($show_time) {
            if (sizeof($array_times)) {
                foreach ($array_times as $addon) {
					
                    extract($addon);

                    ob_start();

                    ?>
                    <li
                        class="<?= $data_class; ?>"
                        <? if ($data_oid){ ?>data-oid="<?= $data_oid; ?>"<?
                    } ?>
                        <? if ($is_night){ ?>data-is_night="1"<?
                    } ?>
                        <? if ($data_ch){ ?>data-ch="<?= $data_ch; ?>"<?
                    } ?>
                        <? if ($data_cm){ ?>data-cm="<?= $data_cm; ?>"<?
                    } ?>
                        <? if ($data_start_hour){ ?>data-eh="<?= $data_start_hour; ?>"<?
                    } ?>
                        <? if ($data_start_min){ ?>data-em="<?= $data_start_min; ?>"<?
                    } ?>
                        <? if ($data_callback){ ?>data-callback="<?= $data_callback; ?>"<?
                    } ?>
                        <? if ($data_ptype){ ?>data-ptype="<?= $data_ptype; ?>"<?
                    } ?>
                        <? if ($data_fulldate){ ?>data-fulldate="<?= $data_fulldate; ?>"<?
                    } ?>
                        <? if ($data_datename){ ?>data-datename="<?= $data_fulldate; ?>"<?
                    } ?>
                        <? if ($data_timename){ ?>data-timename="<?= $data_timename; ?>"<?
                    } ?>
                        <? if ($time_tariff){ ?>data-time_tariff="<?= $time_tariff; ?>"<?
                    } ?>
                        <? if ($addon['data_reserve_times']){ ?>data-time_free="<?= $addon['data_reserve_times']; ?>"<?
                    } ?>
                    >
                        <?= $data_content_name.'<br />'; ?>
                        <?=($addon['data_reserve_times'])?$addon['data_reserve_times'].' мин<br />':'<br />';?>
                        <?= $data_content_times; ?>
                    </li>
                    <?
					
                    $content_time_blocks .= ob_get_contents();
                    ob_end_clean();


                }
            }
        }

        if ($need_end) {
            if ($start_hour >= $end_tmp[0] && $start_min >= $end_tmp[1]) {
                $repeat = false;
            }
        }
		//количество выводимых ячеек времени в день
		//суббота
		/*
		if (date('l', $current) == "Saturday") {
			if ($ttl >= 48) {
            $repeat = false;
			}
		}
		*/
		//воскресенье 
		/*
		if (date('l', $current) == "Sunday") {
			if ($ttl >= 40) {
            $repeat = false;
			}
		}
		*/
		//остальные дни
		/*
        if ($ttl >= 96) {
            $repeat = false;
        }
		*/

    } while ($repeat);

    if ($return_variant == RC_CONTENT_OPENED_TIMES) {
        return $free_times;
    }

    ob_start();
    ?>

    <li data-year="<?= date('Y', $current); ?>"
        data-month="<?= date('m', $current); ?>"
        data-date="<?= $months_rus1[intval(date('m', $current))]; ?>"
        class="day">
        <div class="order-time-date">
            <p><?= date('d', $current); ?></p>
			
			
			
            <span><?= $dow[date('w', $current)]; ?></span>
        </div>
        <div class="order-time-wrap">
			<ul class="order-time-list">
			<?php
			//в первый понедельник месяца закрываем на ТО 
			//$first_day_of_week = date('l', $current);
			//$date = intval(date('j', $current));
			//if ($date <= 7 && $first_day_of_week == 'Monday') {
			//	echo "<li>Тех. обслуживание</li>";
			//} else {
				echo $content_time_blocks;
			//}
			?>
            </ul>
        </div>
    </li>

    <?php
    $column = ob_get_contents();
    ob_end_clean();

    return $column;

}

function get_timeblock_tariff($ID, $IBLOCK_ID){
    $res = CIBlockElement::GetList(false, array('IBLOCK_ID'=>$IBLOCK_ID, 'ID'=>$ID),0,0,
        array('PROPERTY_PRICE_NIGHT', 'PROPERTY_PRICE', 'CATALOG_GROUP_1'));
    if ($res->SelectedRowsCount()==1) {
        $t = $res->GetNext();

        return $t;
    }

    return false;
}

/**
 * @param $filter_grad_min
 * @param bool $filter_truba
 * @param int $filter_type
 * @param int $filter_person_type
 *
 * Рисуем календарь (универсальный) для всех целей
 * @param null $filter_tariff
 * @return string|void
 */
function renderCalendar($filter_grad_min,
                        $filter_truba = false,
                        $filter_type = TYPE_F_ONE,
                        $filter_person_type = PERSONE_TYPE_USER,
                        $filter_tariff = null
)
{
    if (!$filter_truba) {
        echo 'error truba set';
        return;
    }

    $list_columns = '';
    for ($i = 0; $i <= 30; $i++) {
        $current = strtotime('now +' . $i . ' day');
        $list_columns .= renderCalendarColByDate(
            $current,
            $filter_grad_min,
            $filter_truba,
            $filter_type,
            $filter_person_type,
            RC_CONTENT_HTML,
            $filter_tariff
        );
    }

    ob_start();
    ?>

    <style>
        .calendar_shedule li.day.hide {
            display: none !important;
        }

        li.black {
            background: #2c2c2d;
            color: #fff !important;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
    </style>
    <ul class="slides calendar_shedule">
        <?= $list_columns; ?>
    </ul>

    <?
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

/**
 * @param $params
 * @return array
 *
 * Создание заказа по параметрам
 */
function create_order($params, $use_event = true)
{
    global $USER;



    $el = new CIBlockElement;

    $truba_id = get_truba_id($params['TRUBA']);
    $tmp = explode(' ', $params['ORDER_TIME']);
    $from = trim($tmp[0]);

    $PROP = array();
    $PROP[51] = $params['TYPE'];

    if ($params['TYPE'] == TYPE_F_ONE) {
        $PROP[52] = $params['CATEGORY'];
    } else if ($params['TYPE'] == TYPE_F_DUPLE) {
        $PROP[102] = $params['CATEGORY'];
    }

    $PROP[56] = $truba_id;
    $PROP[54] = ($params['ORDER_DAY'])?date('d.m.Y', strtotime($params['ORDER_DAY'])):'';
    $PROP[55] = $from;
    $PROP[53] = $params['TIMELENGTH'];
    $PROP[61] = $params['PERSONE_TYPE'];
    $PROP[65] = $params['TRAINER_CATEGORY'];
    $PROP[66] = $params['PRICE'];
    $PROP[67] = $params['PRICE_RESULT'];
    $PROP[68] = $params['TIMELENGTH_BLOCK'];
    if ($params['SOURCE']) {
        $PROP[105] = $params['SOURCE'];
    }
    $PROP[82] = $USER->GetID();

    if ($params['EMAIL']) {
        $PROP[103] = $params['EMAIL'];
    }
    if ($params['PHONE']) {
        $PROP[104] = preg_replace('#\W+#','',$params['PHONE']);
    }

    if ($params['TARIFF'] != null) {
        $PROP[72] = $params['TARIFF'];
    }

    if (!empty($params['CERT'])) {
        $PROP[81] = $params['CERT'];
    }

    
    if($params['ORDER_DAY'] && $params['ORDER_TIME']){
      $date = FormatDate('j F Y', strtotime($params['ORDER_DAY']));
      $ORDER_NAME = "Заказ на " . $date . " на " . $params['ORDER_TIME'];
    } else {
      $date = FormatDate('j F Y', time());
      $ORDER_NAME = "Заказ от ".$date;
    }
    

    $arLoadProductArray = Array(
        "MODIFIED_BY" => $USER->GetID(),
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => 47,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $ORDER_NAME,
        "ACTIVE" => "Y",
    );

    if ($ORDER_ID = $el->Add($arLoadProductArray)) {

        if ($params['PERSONE_TYPE'] == PERSONE_TYPE_PROF) {
            CSaleUserAccount::UpdateAccount(
                $USER->GetID(),
                abs($params['PRICE_RESULT']) * -1,
                "RUB",
                "Оплата заказа № " . $ORDER_ID
            );
        }

        if ($use_event) {
            // send event mail
            $arEventFields = get_event_params_by_order_id($ORDER_ID);
            CEvent::Send("FLIGHT_ORDER_NEW", SITE_ID, $arEventFields);
        }
        
        return $ORDER_ID;
    }

    return array(false, $el->LAST_ERROR);
}

/**
 * @param $cert_id
 * @return mixed
 *
 * установка флага что сертификат - использован
 */
function set_certificate_as_used($cert_id)
{
    global $USER;

    $el = new CIBlockElement;

    $arLoadProductArray = Array(
        "MODIFIED_BY" => $USER->GetID(),
        "IBLOCK_SECTION" => false,
        "ACTIVE" => "N",
    );

    $el->Update($cert_id, $arLoadProductArray);
    CIBlockElement::SetPropertyValues($cert_id, 50, array("VALUE" => "Y"), "USED");

    return true;
}

function get_event_params_by_cert_id($cert_id)
{
    $cert = get_certificate_by_id($cert_id);

    $tariff = null;
    if ($cert['PROPERTY_TARIFF_VALUE']) {
        $tariff = get_tariff($cert['PROPERTY_TARIFF_VALUE']);
    }
	
	$truba = get_truba_params($tariff["PROPERTY_TRUBA_VALUE"]);
	
	//$truba_params_cert = get_truba_params();
	
    $event_params = arraY(
        'ORDER_DATE' => date('d.m.Y H:i'),
        'FIO' => $cert['PROPERTY_FIO_VALUE'],
        'EMAIL' => $cert['PROPERTY_EMAIL_VALUE'],
        'PHONE' => $cert['PROPERTY_PHONE_VALUE'],
        'TARIFF' => $tariff ? strip_tags($tariff['~NAME']) : '',
        'CODE' => $cert['CODE'],
		'TRUBA' => $truba[4],
    );

    return $event_params;
}

function get_or_create_tmp_user($name, $email, $phone)
{
    global $USER;

    if (!$USER->isAuthorized()) {
        $tmp = explode(' ', $name);
        $NAME = $tmp[0];
        $LNAME = '';
        if (isset($tmp[1])) {
            $LNAME = $tmp[1];
        }

        $PASS = time();

        $user = new CUser;
        $arFields = Array(
            "NAME" => $NAME,
            "LAST_NAME" => $LNAME,
            "EMAIL" => $email,
            "LOGIN" => $PASS . '@freezone.net',
            "LID" => "s1",
            "ACTIVE" => "Y",
            "GROUP_ID" => array(6),
            "PASSWORD" => $PASS,
            "CONFIRM_PASSWORD" => $PASS,
            "PERSNAL_MOBILE" => $phone,
        );

        $USER_ID = $user->Add($arFields);
        if (intval($USER_ID) > 0) {
            $USER->Authorize($USER_ID);
        } else {
            $message = 'Ошибка создания пользователя для заказа';
            echo json_encode(array('error' => true, 'message' => $message));
            exit;
        }
    } else {
        $USER_ID = $USER->GetID();
    }

    return $USER_ID;
}

/**
 * @param $params
 * @return array
 *
 * создание сертификата
 */
function create_certificate($params)
{
    global $USER;

    $code = 'freezone-' . date('dm') . '-' . date('His');

    $el = new CIBlockElement;

    $PROP = array();
    $PROP[74] = $params['FIO'];
    $PROP[75] = $params['EMAIL'];
    $PROP[76] = $params['PHONE'];
    $PROP[77] = $params['TARIFF'];
    $PROP[78] = 'N';
    $PROP[79] = '';
    $PROP[80] = sha1($code);


    $date = FormatDate('j F Y', time());
    $CERT_NAME = "Сертификат на имя " . $params['FIO'] . " от " . $date;

    $arLoadProductArray = Array(
        "MODIFIED_BY" => $USER->GetID(),
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => 50,
        'CODE' => $code,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $CERT_NAME,
        "ACTIVE" => "N",
    );

    if ($CERT_ID = $el->Add($arLoadProductArray)) {

        $arFields = array(
            "ID" => $CERT_ID,
            "QUANTITY" => 9999,
            "CAN_BUY_ZERO"=>"Y",
            "WEIGHT" => 0,
            "MEASURE" => 3,
        );
        if(CCatalogProduct::Add($arFields)) {

            $tariff = get_tariff($params['TARIFF']);
                
            if (set_price($CERT_ID, $tariff['CATALOG_PRICE_1'])) {

                return array(true, $CERT_ID);
            }
        }
    }

    return array(false, $el->LAST_ERROR);
}

function set_price($PRODUCT_ID, $PRICE)
{
    $PRICE_TYPE_ID = 1;

    $arFields = Array(
        "PRODUCT_ID" => $PRODUCT_ID,
        "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
        "PRICE" => floatval($PRICE),
        "CURRENCY" => "RUB",
        "QUANTITY_FROM" => false,
        "QUANTITY_TO" => false
    );

    $res = CPrice::GetList(
        array(),
        array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
        )
    );

    if ($arr = $res->Fetch()) {
        $PRICE_ID = CPrice::Update($arr["ID"], $arFields, True);
    } else {
        $PRICE_ID = CPrice::Add($arFields, True);
    }

    return $PRICE_ID;
}

function get_certificate_by_id($cert_id)
{

    if (\Bitrix\Main\Loader::includeModule('iblock')) {

        $res = CIBlockElement::GetList(
            false,
            array(
                'IBLOCK_ID' => 50,
                'ID' => $cert_id,
            ),
            0,
            0,
            arraY('ID', 'CODE', 'PROPERTY_TARIFF', 'PROPERTY_HASH', 'NAME', 'PROPERTY_FIO', 'PROPERTY_EMAIL', 'PROPERTY_PHONE')
        );
        $cnt = $res->SelectedRowsCount();
        if ($cnt) {
            return $res->GetNext();
        }
    }

    return false;
}

function enable_certificate($HASH)
{
    $filter = array(
        'IBLOCK_ID' => 50,
        'PROPERTY_HASH' => $HASH,
        'ACTIVE' => 'N',
        '!PROPERTY_USED_VALUE_ENUM_ID' => CERTIFICATE_USED_YES
    );

    $res = CIBlockElement::GetList(
        false,
        $filter
    );
    $cnt = $res->SelectedRowsCount();
    if ($cnt == 0 || $cnt > 1) {
        return false;
    }
    $CERT = $res->GetNext();

    $el = new CIBlockElement;
    if ($el->Update($CERT['ID'], array('ACTIVE'=>'Y'))) {

        return true;
    }

    return false;
}

function activate_certificate($HASH)
{
    $filter = array(
        'IBLOCK_ID' => 50,
        'PROPERTY_HASH' => $HASH,
        'ACTIVE' => 'Y',
        '!PROPERTY_USED_VALUE_ENUM_ID' => CERTIFICATE_USED_YES
    );

    $res = CIBlockElement::GetList(
        false,
        $filter,
        0,
        0,
        array('ID', 'PROPERTY_TARIFF', 'PROPERTY_HASH', 'PROPERTY_EMAIL', 'PROPERTY_PHONE', 'PROPERTY_FIO')
    );
    $cnt = $res->SelectedRowsCount();
    if ($cnt == 0 || $cnt > 1) {
        return false;
    }

    $CERT = $res->GetNext();

    CIBlockElement::SetPropertyValuesEx($CERT['ID'], 50, array("USED" => CERTIFICATE_USED_YES));
	
	//добавляем информацию об активации к заказу
	if (\Bitrix\Main\Loader::includeModule('sale')) {
	   $rsSales = CSaleOrder::GetList(array('ID' => 'DESC'), Array("PROPERTY_VALUE_VAL_BY_CODE_CERT_ID" => $CERT['ID']));
	   $ORDER = $rsSales->GetNext();
	   $rsSale_props = CSaleOrderPropsValue::GetOrderProps($ORDER["ID"]);
	   while ($arProps = $rsSale_props->Fetch()) {
		   if ($arProps["ORDER_PROPS_ID"] == 7) {
				CSaleOrderPropsValue::Update($arProps["ID"], array("ORDER_ID"=>$ORDER["ID"], "VALUE"=>"Сертификат активирован (".date("Y-m-d H:i:s").") на ".$_POST['ORDER_DAY']." ".$_POST['ORDER_TIME']));
		   }
	   }
    }
	
	
	
    $el = new CIBlockElement;
    $params = array('ACTIVE'=>'Y');
    if ($el->Update($CERT['ID'], $params)) {

        return true;
    }

    return false;
}

/**
 * @param $params
 * @return array|bool
 *
 * Получение данных сертификата
 */
function get_certificate($params)
{
    if (empty($params['CODE'])) {
        return false;
    }

    $filter = array(
        'IBLOCK_ID' => 50,
        'CODE' => $params['CODE'],
        'ACTIVE' => 'Y',
        '!PROPERTY_USED' => CERTIFICATE_USED_YES
    );

    $res = CIBlockElement::GetList(
        false,
        $filter,
        0,
        0,
        array('ID', 'PROPERTY_TARIFF', 'PROPERTY_HASH', 'PROPERTY_EMAIL', 'PROPERTY_PHONE', 'PROPERTY_FIO')
    );
    $cnt = $res->SelectedRowsCount();
    if ($cnt == 0 || $cnt > 1) {
        return false;
    }

    $row = $res->GetNext();

    $res_tariff = CIBlockElement::GetList(
        false,
        array(
            'IBLOCK_ID' => 42,
            'ID' => intval($row['PROPERTY_TARIFF_VALUE'])
        ),
        0,
        0,
        array('PROPERTY_TRUBA', 'CATALOG_GROUP_1', 'NAME', 'PROPERTY_MANS')
    );
    if ($res_tariff->SelectedRowsCount() == 1) {
        $tariff = $res_tariff->GetNext();
        $mans = intval($tariff['PROPERTY_MANS_VALUE']);

        $truba_id = $tariff['PROPERTY_TRUBA_VALUE'];
        if ($truba_id > 0) {

            $res_truba = CIBlockElement::GetList(
                false,
                array(
                    'IBLOCK_ID' => 13,
                    'ID' => $truba_id
                ),
                0,
                0,
                arraY('CODE')
            );
            if ($res_truba->SelectedRowsCount() == 1) {

                $truba = $res_truba->GetNext();

                $CERT = array(
                    'ID' => $row['ID'],
                    'TARIFF' => $row['PROPERTY_TARIFF_VALUE'],
                    'EMAIL' => $row['PROPERTY_EMAIL_VALUE'],
                    'PHONE' => $row['PROPERTY_PHONE_VALUE'],
                    'FIO' => $row['PROPERTY_FIO_VALUE'],
                    'TRUBA' => $truba['CODE'],
                    'PRICE' => $tariff['CATALOG_PRICE_1'],
                    'HASH' => $row['PROPERTY_HASH_VALUE'],
                    'TARIFF_NAME' => str_replace("\r", "", str_replace("\n", "", strip_tags($tariff['~NAME']))),
                    'TARIFF_MANS' => $mans . ' человек' . set_end($mans, array('', 'а', '')),
                );

                return $CERT;
            }
        }
    }

    return false;
}

function get_order_prop_value($ORDER_ID, $PROP_ID)
{
    $db_vals = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array(
            "ORDER_ID" => $ORDER_ID,
            "ORDER_PROPS_ID" => $PROP_ID
        )
    );
    $VALUE = '';
    if ($arVals = $db_vals->Fetch())
        $VALUE = $arVals["VALUE"];

    return $VALUE;
}

function get_tariff($tariff_id)
{
    if ($tariff_id) {
        $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 42, 'ID' => $tariff_id), 0, 0, array(
            'PROPERTY_MANS', 'PROPERTY_FLIGHTS', 'PROPERTY_JUMPS',
            'PROPERTY_BLOG_POST_ID', 'PROPERTY_BLOG_COMMENTS_CNT', 'PROPERTY_TRUBA',
            'CATALOG_GROUP_1', 'NAME', 'ID', 'CODE'
        ));
        if ($res->SelectedRowsCount()) {
            $row = $res->GetNext();

            return $row;
        }
    }

    return false;
}

function load_order_history($from_time, $to_time)
{
    global $USER, $ORDERS_SELECT;

    ob_start();

    $res = CIBlockElement::GetList(
        array('PROPERTY_DATE_START' => 'DESC', 'PROPERTY_COMPLETED_VALUE' => 'DESC'),
        array(
            'IBLOCK_ID' => 47,
            'PROPERTY_USER' => $USER->GetID(),
            ">=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $from_time), "YYYY-MM-DD"),
            "<=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $to_time), "YYYY-MM-DD"),
        ),
        0,
        0,
        $ORDERS_SELECT
    );
    $sum = 0;
    $sum_time = 0;
    while ($row = $res->GetNext()) {
        $tariff_id = intval($row['PROPERTY_TARIFF_VALUE']);

        $tariff = get_tariff($tariff_id);

        $sum += $row['PROPERTY_PRICE_RESULT_VALUE'];
        $sum_time += $row['PROPERTY_TIMELENGTH_VALUE'];
        ?>
        <div class="history-item <?= ($row['PROPERTY_COMPLETED_VALUE'] != 'Да' ? 'history-item_color' : ''); ?>">
            <div class="history-item-content">
                <!--<span class="data"><?= FormatDate('j F Y', strtotime($row['PROPERTY_DATE_START_VALUE'])); ?></span>-->
				<span class="data"><?= $row['NAME']; ?></span>
                <!--<span class="package-services"><?= strip_tags($tariff['~NAME']); ?></span>-->
                <span class="time"><?= $row['PROPERTY_TIMELENGTH_VALUE']; ?></span>
                <span class="cash"><?= intval($row['PROPERTY_PRICE_RESULT_VALUE']); ?>.—</span>
            </div>
            <? if ($row['PROPERTY_COMPLETED_VALUE'] != 'Да') { ?>
                <div class="history-item-drop">
                    <button class="btn btn-cancel" data-oid="<?= $row['ID']; ?>"><i class="icon-remove"></i>Отменить
                    </button>
                    <button class="btn btn-remove" data-oid="<?= $row['ID']; ?>"><i class="icon-prev"></i>Перенести
                    </button>
                </div>
                <?
            } ?>
        </div>
        <?
    }

    $content = ob_get_contents();
    ob_end_clean();

    return array($content, $sum, $sum_time);
}

function get_trainers_str($date, $delimiter = '<br>')
{
    $trainers = '';
    $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 53, 'ACTIVE' => 'Y', 'PROPERTY_DATE' => $date), 0, 0, array('PROPERTY_TRAINER'));
    if ($res->SelectedRowsCount()) {
        while ($row = $res->GetNext()) {
            $trainer = get_trainer($row['PROPERTY_TRAINER_VALUE']);
            $trainers .= $trainer['NAME'] . $delimiter;
        }
    }
    $trainers = trim($trainers, $delimiter);

    return $trainers;
}

function get_trainer($trainer_id)
{
    $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 52, 'ID' => $trainer_id, 'ACTIVE' => 'Y'));
    if ($res->SelectedRowsCount() == 1) {
        $row = $res->GetNext();

        return $row;
    }

    return false;
}

$weekdays_small_name = array('Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб',);



function build_calendar($month, $year, $dateArray = null)
{
    global $months_rus;

    $daysOfWeek = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');

    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    $numberDays = date('t', $firstDayOfMonth);

    $dateComponents = getdate($firstDayOfMonth);

    $dayOfWeek = $dateComponents['wday'] - 1;

    $calendar = "<table class='calendar'>";

    $calendar .= "<tr>";

    $calendar .= '<thead><tr>';
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th>$day</th>";
    }
    $calendar .= '</tr></thead>';

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        for ($i = 0; $i < $dayOfWeek; $i++) {
            $str = $year . '-' . $month . '-' . $currentDay;
            $time = strtotime($str . ' -' . ($dayOfWeek - $i) . ' days');
            $day = date('d', $time);

            $prev_month_name = $months_rus[date('m', $time)];

            $calendar .= "<td class='not-active'><span>" . $day . " " . ($i == 0 ? $prev_month_name : '') . "</span></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    $i = 0;
    while ($currentDay <= $numberDays) {

        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

        $date = "$year-$month-$currentDayRel";

        $time = strtotime($date);

        $trainers = get_trainers_str($date);

        $calendar .= "<td style='width: 14.28%' class='day' rel='$date'><div class='table-info'><span>$currentDay " . ($i == 0 ? $months_rus[date('m', $time)] : '') . "</span><p>" . $trainers . "</p></div></td>";

        $currentDay++;
        $dayOfWeek++;
        $i++;
    }

    if ($dayOfWeek != 7) {

        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $date = "$year-$month-$currentDayRel";

            $time = strtotime($date . ' +' . ($i + 1) . ' days');

            $calendar .= "<td class='not-active'><span>" . intval(date('d', $time)) . " " . ($i == 0 ? $months_rus[date('m', $time)] : '') . "</span></td>";
        }

    }

    $calendar .= "</tr>";

    $calendar .= "</table>";

    return $calendar;
}

function build_calendar_quick($month, $year, $dateArray = null)
{
    global $months_rus;

    $daysOfWeek = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', );

    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    $numberDays = date('t', $firstDayOfMonth);

    $currentDay = 1;

    $calendar = "<table border='1' width='100%'>";

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    $i = 0;
    while ($currentDay <= $numberDays) {

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

        $date = "$year-$month-$currentDayRel";

        $time = strtotime($date);

        $trainers = get_trainers_str($date);
        
        if ($trainers) {
            $calendar .= "
                <tr>
                    <td width='30%'>
                        <span>".$daysOfWeek[date('w', $time)]." / $currentDay " . $months_rus[date('m', $time)] . "</span>
                    </td>
                    <td>" . $trainers . "</td>
                </tr>
            ";
        }
        $currentDay++;
        $i++;
    }

    $calendar .= "</table>";

    return $calendar;
}



function get_date_start_week($date, $length = 7)
{
    $time = strtotime($date);
    $dow = date('w', $time);
    if ($dow == 0) {
        return strtotime(date("Y-m-d", $time) . ' -' . ($length - 1) . ' days');
    } else {
        return strtotime(date("Y-m-d", $time) . ' -' . ($dow - 1) . ' days');
    }
}


function get_orders_blocks($current, $params)
{
    global $ORDERS_SELECT;

    $filter = array(
        'IBLOCK_ID' => 47,
        ">=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $current), "YYYY-MM-DD"),
        "<=PROPERTY_DATE_START" => ConvertDateTime(date('d.m.Y', $current), "YYYY-MM-DD"),
        "PROPERTY_TRUBA" => $params['TRUBA_ID'],
        "PROPERTY_PERSONE_TYPE" => $params['PERSON_ID'],
    );

    if ($params['TYPE']) {
        $filter['PROPERTY_TYPE_F'] = $params['TYPE'];
    }
    if ($params['CATEGORY']) {
        $filter['PROPERTY_CATEGORY_F'] = $params['CATEGORY'];
    }
    $ORDERS_SELECT[] = 'PROPERTY_TARIFF.PROPERTY_FLIGHTS';

    $res = CIBlockElement::getList(
        array('PROPERTY_DATE_START' => 'ASC', 'PROPERTY_TIME_START' => 'ASC'),
        $filter,
        false,
        false,
        $ORDERS_SELECT
    );
    $times = array();
    if ($res->SelectedRowsCount()) {
        while ($row = $res->GetNext()) {
            $time_start_tmp = explode(':', $row['PROPERTY_TIME_START_VALUE']);
            if (isset($time_start_tmp[2])) {
                unset($time_start_tmp[2]);
            }
            $len = $row['PROPERTY_TIMELENGTH_VALUE'];

            $from = $time_start_tmp[0] * 60 + $time_start_tmp[1];
            $times[$row['ID']] = array(
                'FROM' => $from,
                'TO' => $from + $len,
                'ID' => $row['ID'],
                'DATE_START' => $row['PROPERTY_DATE_START_VALUE'],
                'TRUBA' => $row['PROPERTY_TRUBA_VALUE'],
                'TYPE_F' => $row['PROPERTY_TYPE_F_ENUM_ID'],
                'CATEGORY_F' => $row['PROPERTY_CATEGORY_F_ENUM_ID'],
                'PERSONE_TYPE' => $row['PROPERTY_PERSONE_TYPE_ENUM_ID'],
                'TARIFF_TIME' => $row['PROPERTY_TARIFF_PROPERTY_FLIGHTS_VALUE'],
            );

            if($row['PROPERTY_TARIFF_PROPERTY_FLIGHTS_VALUE']>$len){
              $count_cell = $row['PROPERTY_TARIFF_PROPERTY_FLIGHTS_VALUE']/$len;
              for($i=1; $i<$count_cell; $i++){
                $from += $len;
                $times[$row['ID'].'_'.$i] = array(
                  'FROM' => $from,
                  'TO' => $from + $len,
                  'ID' => $row['ID'],
                  'DATE_START' => $row['PROPERTY_DATE_START_VALUE'],
                  'TRUBA' => $row['PROPERTY_TRUBA_VALUE'],
                  'TYPE_F' => $row['PROPERTY_TYPE_F_ENUM_ID'],
                  'CATEGORY_F' => $row['PROPERTY_CATEGORY_F_ENUM_ID'],
                  'PERSONE_TYPE' => $row['PROPERTY_PERSONE_TYPE_ENUM_ID'],
                  'TARIFF_TIME' => $row['PROPERTY_TARIFF_PROPERTY_FLIGHTS_VALUE'],
              );
              }
            }
        }
    }

    return $times;
}

function find_reserv_multiple($times, $block_from, $block_end)
{
	$reserves = array();
    foreach ($times as $id => $order) {
        if ($order['FROM'] >= $block_from && $order['TO'] <= $block_end) {
//            echo "RESERV_CENTER";
            $reserve_hash = array($order['FROM'], $order['TO'], RESERV_CENTER, $order);
			array_push($reserves, $reserve_hash);
        }
    }

    foreach ($times as $id => $order) {
        if ($order['FROM'] < $block_end && $order['FROM'] > $block_from) {
//            echo "RESERV_RIGHT";
            $reserve_hash = array($order['FROM'], $order['TO'], RESERV_RIGHT, $order);
			array_push($reserves, $reserve_hash);
        }
    }

    foreach ($times as $id => $order) {
        if ($block_from >= $order['FROM'] && $block_end <= $order['TO']) {
//            echo "RESERV_CENTER2";
            $reserve_hash = array($order['FROM'], $order['TO'], RESERV_CENTER, $order);
			array_push($reserves, $reserve_hash);
        }

        if ($block_from >= $order['FROM'] && $order['TO'] > $block_end) {
//            echo "RESERV_LEFT";
            $reserve_hash = array($order['FROM'], $order['TO'], RESERV_LEFT, $order);
			array_push($reserves, $reserve_hash);
        }
    }
	if (!empty($reserves)) {
		return $reserves;
	} else {
		return false;
	}
}


function build_week($current_timestamp = null, $params = array())
{

    global $weekdays_small_name;

    if (!$current_timestamp) {
        $current_timestamp = time();
    }

    $truba = !empty($params['truba']) ? $params['truba'] : TRUBA_12;
    $truba_id = get_truba_id($truba);
    $person = !empty($params['person']) ? $params['person'] : array(PERSONE_TYPE_USER, PERSONE_TYPE_PROF);
    $type = !empty($params['type']) ? $params['type'] : null;
    $category = !empty($params['category']) ? $params['category'] : null;

    $length = !empty($params['length']) ? intval($params['length']) : 7;


    $truba = get_truba_params($truba_id);
    $max_truba_humans = $truba[3];

    $start_time = explode(':', $truba[0]);
    $end_time = explode(':', $truba[1]);


    $content = '
    <div class="time-list" id="time_list_week" style="display: none">
        <table>
            <thead>
    ';
    $sh_c = $sh = $start_time[0];
    $eh = $end_time[0];

    $rows = array();
    $new_day = false;
    for ($i = $sh; $i < $sh + 24; $i++) {
        $content .= '<tr><th>' . $sh_c . '</th></tr>';
        $eh_c = $sh_c + 1;
        $rows[] = array($sh_c . ':00', $eh_c . ':00');

        $sh_c += 1;
        if ($sh_c == 24) {
            $sh_c = 0;
            $new_day = true;
        }
        if ($sh_c > $eh && $new_day) {
            break;
        }
    }

    $content .= '
            </thead>
        </table>
    </div>
    <div class="cabinet-calendar-week">
        <table>
            <thead>
                <tr>   
    ';

    if ($length == 7) {
        $monday = get_date_start_week(date('Y-m-d', $current_timestamp), $length);
    } else {
        $monday = $current_timestamp;
    }
    $this_week_sd = date("Y-m-d", $monday);

    for ($i = 0; $i < $length; $i++) {
        $day = strtotime($this_week_sd . " +" . $i . " days");
        $day_num = date('d', $day);

        $content .= '<th><span>' . (int)$day_num . '</span> ' . $weekdays_small_name[(int)date('w', $day)] . '</th>';
    }

    $content .= ' 
                </tr>
            </thead>
            <tbody>
                <tr>
    ';

    for ($i = 0; $i < $length; $i++) {
        $day = strtotime($this_week_sd . " +" . $i . " days");
        $date = date('Y-m-d', $day);

        $trainers = get_trainers_str($date, ', ');
        $content .= '<td><p>' . $trainers . '</p></td>';
    }

    $content .= '</tr>';

    //for ($irow = 0; $irow < $rows; $irow++) {
    foreach ($rows as $irow => $data) {

        $sh = $data[0];
//        $eh = $data[1];

        list($shh, $shm) = explode(':', $sh);

        $content .= '
                <tr>
        ';

        for ($i = 0; $i < $length; $i++) {
            $current = strtotime($this_week_sd . " +" . $i . " days");
            $times = get_orders_blocks($current, array(
                'TRUBA_ID' => $truba_id,
                'PERSON_ID' => $person,
                'TYPE' => $type,
                'CATEGORY' => $category,
            ));

            $is_today = (date('Y-m-d') == date('Y-m-d', $current));

            $content .= '
                    <td class="' . ($is_today ? 'to-day' : '') . '" style="max-width: 14.28%; min-width: 14.28%; width: 14.28%;">
                        <ul>
            ';

            $time_length_block = 15;
            $start_h = $end_h = $shh;
            $start_m = $end_m = $shm;
            $prev_id = null;
            for ($lnum = 1; $lnum <= 4; $lnum++) {
                $end_m += $time_length_block;
                if ($end_m >= 60) {
                    $end_m = 0;
                    $end_h += 1;
                }
                $start_h = time_element_to_str($start_h);
                $start_m = time_element_to_str($start_m);
                $end_h = time_element_to_str($end_h);
                $end_m = time_element_to_str($end_m);

                $from_hash = intval($start_h) * 60 + intval($start_m);
                $end_hash = intval($end_h) * 60 + intval($end_m);
                $reserv_data_multiple = find_reserv_multiple($times, $from_hash, $end_hash);
				$reserv_data_multiple = array_unique($reserv_data_multiple, SORT_REGULAR);
				$block_content = '';
				foreach ($reserv_data_multiple as $reserv_data) {
				
					list($start_reserv, $end_reserv, $RESERV_VARIANT, $order) = $reserv_data;
					$order_raw = get_order($order['ID']);

					$block_text = '';
					$count_humans = 1;
					if (!empty($order_raw['ID'])) {
						$class_block = ' day-gray ';
						if ($order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_USER) {
							$class_block = 'table-blue';
							$block_text = 'Без пары';



							if ($order_raw['PROPERTY_TARIFF_VALUE']) {
								$tariff = get_tariff($order_raw['PROPERTY_TARIFF_VALUE']);
								$block_text = strip_tags($tariff['~NAME']);
							}
							//print_R();exit;
						
						
						} else if ($order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_PROF) {

							if ($order_raw['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_DUPLE) {
								$count_humans = get_count_orders($start_h, $start_m, $order['DATE_START']);

								if ($count_humans < $max_truba_humans) {
									$class_block = 'day-yellow';
									$block_text = 'В ожидании пары';
								} else {
									$class_block = 'table-blue';
									$block_text = 'Пары сформированы';
								}
							} else if ($order_raw['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_ONE) {
								$block_text = 'Без пары';
								$class_block = 'table-blue';
							}
						}

						if ($person == PERSONE_TYPE_USER && $order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_PROF) {
							$class_block = 'table-blue';
						} else if ($person == PERSONE_TYPE_PROF && $order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_USER) {
							$class_block = 'table-blue';
						}

						if ($prev_id == $order['ID']) {
							$block_text = '';
						}

						if (is_closed_registration($order['ID'])) {
							$class_block = 'day-gray';
						}
						
						if ($prev_id != $order['ID']) {
						$block_content .= '
							<div ' . (!empty($order_raw['ID']) ? 'data-order_id="' . $order['ID'] . '" 
									class="order_bl order_bl' . $order['ID'] . '"  
									data-class="order_bl' . $order['ID'] . '"
									id="current_bl' . $order['ID'] . '_' . $lnum . '"' : '') . '>
								<p class="' . $class_block . '">' . $block_text . ' <span>' . $start_h . ':' . $start_m . '</span></p>   
							</div>
						';
						}

						if ($length == 2) {
							$trainer = '-';
							if ($order_raw['PROPERTY_TRAINER_VALUE']) {
								$trainer = get_trainer($order_raw['PROPERTY_TRAINER_VALUE']);
							}

							$timelength_block = $order_raw['PROPERTY_TIMELENGTH_BLOCK_VALUE'];

							$block_content .= '
								<div ' . (!empty($order_raw['ID']) ? 'data-order_id="' . $order['ID'] . '" 
									class="order_bl order_bl' . $order['ID'] . '"  
									data-class="order_bl' . $order['ID'] . '"
									id="current_bl' . $order['ID'] . '_' . $lnum . '"' : '') . '>
									<p class="' . $class_block . '">
										' . $trainer['NAME'] . '
										 <span>' . $start_h . ':' . $start_m . '</span>
										 ' . ($count_humans > 1 ? '
											<span class="quantity-men"><i class="icon-men"></i>' . $count_humans . ' человек' . set_end($count_humans, array('', 'а', '')) . '</span>
										 ' : '') . '
										<span class="time-interval"><i class="icon-clock"></i>
											по ' . $timelength_block . ' минут' . set_end($timelength_block, array('е', 'ы', '')) . '</span>
										<span class="info-couple">' . $block_text . '</span>                            
									</p>	
								</div>
							';
							if ($prev_id == $order['ID']) {
								$block_content .= '
								<div ' . (!empty($order_raw['ID']) ? 'data-order_id="' . $order['ID'] . '" 
									class="order_bl order_bl' . $order['ID'] . '"  
									data-class="order_bl' . $order['ID'] . '"
									id="current_bl' . $order['ID'] . '_' . $lnum . '"' : '') . '>
									<p class="' . $class_block . '"><span>' . $start_h . ':' . $start_m . '</span></p>
								</div>
								';
							}

						}

						$prev_id = $order['ID'];
					}
				
				}
				
               $content .= '
                    <li>' . $block_content . '</li>
                ';
                $start_h = (int)$end_h;
                $start_m = (int)$end_m;				
				
            }

            $content .= '
                        </ul>
                    </td>
            ';
        }
    }

    $content .= '
            </tbody>
        </table>
    </div>
    ';

    return $content;
}



function build_week_quick($current_timestamp = null, $params = array())
{

    global $weekdays_small_name, $USER;

    if (!$current_timestamp) {
        $current_timestamp = time();
    }

    $truba = !empty($params['truba']) ? $params['truba'] : TRUBA_12;
    $truba_id = get_truba_id($truba);
    $person = !empty($params['person']) ? $params['person'] : PERSONE_TYPE_USER;
    $type = !empty($params['type']) ? $params['type'] : null;
    $category = !empty($params['category']) ? $params['category'] : null;
    $length = !empty($params['length']) ? intval($params['length']) : 7;


    $truba = get_truba_params($truba_id);
    $max_truba_humans = $truba[3];

    $start_time = explode(':', $truba[0]);
    $end_time = explode(':', $truba[1]);


    $time_length_block = 15;
    if ($length == 7) {
        $monday = get_date_start_week(date('Y-m-d', $current_timestamp), $length);
    } else {
        $monday = $current_timestamp;
    }
    $this_week_sd = date("Y-m-d " . $start_time[0] . ":" . $start_time[1] . ":00", $monday);
    $current = strtotime($this_week_sd);
    $ttl = 0;
    $num = 0;
    $day_rendered = 0;



    ob_start();
    ?><table width="100%" border="1"><?
    do {
        if ($day_rendered == $length) {
            break;
        }

        $ttl++;

        $trainers = get_trainers_str(date('Y-m-d', $current), '<br>');

        $start_time_str = explode(':', date('H:i', $current));
        list($start_h, $start_m) = $start_time_str;
        $end_h = $start_h;
        $end_m = $start_m;

        // get info
        $times = get_orders_blocks($current, array(
            'TRUBA_ID' => $truba_id,
            'PERSON_ID' => $person,
            'TYPE' => $type,
            'CATEGORY' => $category,
        ));

        if (sizeof($times)) {

            $end_m += $time_length_block;
            if ($end_m >= 60) {
                $end_m = 0;
                $end_h += 1;
            }
            $start_h = time_element_to_str($start_h);
            $start_m = time_element_to_str($start_m);
            $end_h = time_element_to_str($end_h);
            $end_m = time_element_to_str($end_m);

            $from_hash = intval($start_h) * 60 + intval($start_m);
            $end_hash = intval($end_h) * 60 + intval($end_m);
            $reserv_data = find_reserv($times, $from_hash, $end_hash);
            list($start_reserv, $end_reserv, $RESERV_VARIANT, $order) = $reserv_data;
            $order_raw = get_order($order['ID']);

            $block_text = '';
            $count_humans = 1;
            if (!empty($order_raw)) {
                $popup_info = array();

                if ($order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_USER) {
                    $block_text = 'Без пары';

                    if ($order_raw['PROPERTY_TARIFF_VALUE']) {
                        $tariff = get_tariff($order_raw['PROPERTY_TARIFF_VALUE']);
                        $block_text = strip_tags($tariff['~NAME']);
                    }

                } else if ($order_raw['PROPERTY_PERSONE_TYPE_ENUM_ID'] == PERSONE_TYPE_PROF) {
                    if ($order_raw['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_DUPLE) {
                        $popup_info[] = 'Парный полет';
                        $count_humans = get_count_orders($start_h, $start_m, $order['DATE_START']);

                        if ($count_humans < $max_truba_humans) {
                            $block_text = 'В ожидании пары';
                        } else {
                            $block_text = 'Пары сформированы';
                        }
                    } else if ($order_raw['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_ONE) {
                        $block_text = 'Без пары';
                        $popup_info[] = 'Одиночный полет';
                    }
                }

                $trainer = '';
                if ($order_raw['PROPERTY_TRAINER_VALUE']) {
                    $trainer = get_trainer($order_raw['PROPERTY_TRAINER_VALUE']);
                }


                if ($trainer) {
                    $popup_info[] = 'Тренер: '.$trainer.'';
                }
                if ($count_humans>1) {
                    $popup_info[] = '' . $count_humans . ' человек' . set_end($count_humans, array('', 'а', '')) . '';
                }

                $timelength_block = $order_raw['PROPERTY_TIMELENGTH_BLOCK_VALUE'];
                $date_start = $order_raw['PROPERTY_DATE_START_VALUE'];
                $time_start = $order_raw['PROPERTY_TIME_START_VALUE'];
                list($h, $m) = explode(':', $time_start);
                $orders_count = get_count_orders($h, $m, $date_start);
                $type = $order_raw['PROPERTY_TYPE_F_ENUM_ID'];
                if ($order_raw['PROPERTY_CLOSED_ENUM_ID'] == ORDER_CLOSED_YES) {
                    $popup_info[] = 'Регистрация закрыта';
                }
                $type_is_one = ($type == TYPE_F_ONE or $type == TYPE_F_CUSTOM);
                if ($type_is_one) {
                    $popup_info[] = ($order_raw['PROPERTY_CATEGORY_F_VALUE'] ? $order_raw['PROPERTY_CATEGORY_F_VALUE'] : $order_raw['PROPERTY_TYPE_F_VALUE']);
                    $popup_info[] = $timelength_block . ' минут' . set_end($timelength_block, array('а', 'ы', ''));
                    $popup_info[] = $orders_count . ' человек' . set_end($orders_count, array('', 'а', ''));
                    $popup_info[] = $order_raw['PROPERTY_PRICE_RESULT_VALUE'] . ' руб.';

                    if ($order_raw['PROPERTY_USER_VALUE']) {
                        $ruser = $USER->GetByID($order_raw['PROPERTY_USER_VALUE']);
                        if ($ruser->SelectedRowsCount()) {
                            $user = $ruser->Fetch();
                            $popup_info[] = $user['NAME'] . ' ' . $user['LAST_NAME'] . ' ' . $user['SECOND_NAME'];
                            if ($user['PERSONAL_MOBILE']) {
                                $popup_info[] = $user['PERSONAL_MOBILE'];
                            }
                            if ($user['EMAIL']) {
                                $popup_info[] = $user['EMAIL'];
                            }
                        }
                    } else if ($order['PROPERTY_CERT_VALUE']) {
                        $cert = get_certificate_by_id($order_raw['PROPERTY_CERT_VALUE']);
                        if ($cert) {
                            $tariff = get_tariff($cert['PROPERTY_TARIFF_VALUE']);
                            $popup_info[] = 'Сертификат:';
                            $popup_info[] = $cert['PROPERTY_FIO_VALUE'];
                            $popup_info[] = $cert['PROPERTY_PHONE_VALUE'];
                            $popup_info[] = $cert['PROPERTY_EMAIL_VALUE'];
                            if ($tariff['ID']) {
                                $popup_info[] = 'Тариф: ' . strip_tags($tariff['~NAME']);
                            } else {
                                $popup_info[] = 'Тариф не указан';
                            }
                        }
                    }
                } else {
                    $popup_info[] = ($order['PROPERTY_CATEGORY_F_VALUE'] ? $order['PROPERTY_CATEGORY_F_VALUE'] : $order['PROPERTY_TYPE_F_VALUE']);
                    $popup_info[] = 'по '.$timelength_block.' минут'.set_end($timelength_block, array('а', 'ы', ''));
                    $popup_info[] = $orders_count.' человек'.set_end($orders_count, array('', 'а', ''));

                    $orders = get_orders($h, $m, $date_start);
                    while ($user_order = $orders->GetNext()) {
                        $ruser = $USER->GetByID($user_order['PROPERTY_USER_VALUE']);
                        if ($ruser->SelectedRowsCount()) {
                            $user = $ruser->Fetch();

                            $is_not_payed = false;
                            if ($user_order['PROPERTY_DATE_PAYMENT_VALUE'] == "" ||
                                $user_order['PROPERTY_STATUS_PAYMENT_VALUE'] != STATUS_PAYED_COMPLETE
                            ) {
                                $is_not_payed = true;
                            }
                            ob_start();
                            ?>
                            <?= $user['NAME']; ?> <?= $user['LAST_NAME']; ?> <?= $user['SECOND_NAME']; ?><br>
                            <?= $user['PERSONAL_MOBILE']; ?><br>
                            <?= $user['EMAIL']; ?><br>
                            <?= ($is_not_payed ? 'Не оплачено!' : 'Оплачено'); ?><br>
                            -----
                            <?
                            $z = ob_get_contents();
                            ob_end_clean();

                            $popup_info[] = trim($z, '-----');
                        }
                    }
                }

                echo '
                    <tr data-block="' . $num . '">
                        <td>' . date('d.m.Y', $current) . '</td>
                        <td>' . ($trainers ? $trainers : 'Нет тренеров на текущий день') . '</td>
                        <td>' . $start_h . ':'.$start_m.' - '.$end_h.':'.$end_m.'</td>
                        <td>'.$block_text.'</td>
                        <td>'.trim(implode('<br>', $popup_info),'<br>').'</td>
                    </tr>
                ';
            }
        }

        $hh = date('H:i', $current);
        if ($hh == '01:00') {
            $this_week_sd = date('d.m.Y', $current) . ' ' . $start_time[0] . ':' . $start_time[1] . ':00';
            $current = strtotime($this_week_sd);
            $num = 0;
            $day_rendered++;
            continue;
        }

        $num++;
        $current = $current + ($time_length_block * 60);

    } while (true);
    ?></table><?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}



function time_element_to_str($time_element)
{
    return ((int)intval($time_element) < 10 ? '0' . (int)$time_element : $time_element);
}

function get_event_params_by_order_id($ORDER_ID)
{
    global $USER;

    $event_params = null;

    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $order = get_order($ORDER_ID);

        $tariff = null;
        if ($order['PROPERTY_TARIFF_VALUE']) {
            $tariff = get_tariff($order['PROPERTY_TARIFF_VALUE']);
        }

        $truba = null;
        if ($order['PROPERTY_TRUBA_VALUE']) {
            $truba = get_truba_params($order['PROPERTY_TRUBA_VALUE']);
            $truba = ($truba[4]);
        }

        $cert = null;
        if ($order['PROPERTY_CERT_VALUE']) {
            $cert = get_certificate_by_id($order['PROPERTY_CERT_VALUE']);
        }

        $user = null;
        if ($order['PROPERTY_USER_VALUE']) {
            $ur = $USER->GetByID($order['PROPERTY_USER_VALUE']);
            $user = $ur->Fetch();
        }

        $trainer = null;
        if ($order['PROPERTY_TRAINER_VALUE']) {
            $trainer = get_trainer($order['PROPERTY_TRAINER_VALUE']);
        }

        $category_trainer = null;
        if ($order['PROPERTY_TRAINER_CATEGORY_VALUE']) {
            $res = CIBlockElement::GetList(false, array('IBLOCK_ID' => 48, 'ID' => $order['PROPERTY_TRAINER_CATEGORY_VALUE']));
            if ($res->SelectedRowsCount()) {
                $cat = $res->getNext();
                $category_trainer = $cat['NAME'];
            }
        }

        $category = null;
        if ($order['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_ONE) {
            $category = $order['PROPERTY_CATEGORY_F_VALUE'];
        } else if ($order['PROPERTY_TYPE_F_ENUM_ID'] == TYPE_F_DUPLE &&
            !empty($order['PROPERTY_CATEGORY_IB_VALUE'])) {
            $id = $order['PROPERTY_CATEGORY_IB_VALUE'];
            $row = get_data_from_iblock(58, $id);
            $category = $row['NAME'];
        }

        $event_params = arraY(
            'ORDER_DATE' => date('d.m.Y H:i'),
            'TYPE_F' => $order['PROPERTY_TYPE_F_VALUE'],
            'CATEGORY_F' => $category,
            'TARIFF' => $tariff ? strip_tags($tariff['~NAME']) : '',
            'TRUBA' => $truba,
            'DATE_START' => $order['PROPERTY_DATE_START_VALUE'],
            'TIME_START' => $order['PROPERTY_TIME_START_VALUE'],
            'TIMELENGTH' => $order['PROPERTY_TIMELENGTH_VALUE'] . ' мин',
            'TIMELENGTH_BLOCK' => $order['PROPERTY_TIMELENGTH_BLOCK_VALUE'] . ' мин',
            'PERSONE_TYPE' => $order['PROPERTY_PERSONE_TYPE_VALUE'],
            'TRAINER_CATEGORY' => $category_trainer,
            'CERT' => $cert ? $cert['NAME'] : '',
            'FIRST_NAME' => $user ? $user['NAME'] : '',
            'LAST_NAME' => $user ? $user['LAST_NAME'] : '',
            'EMAIL' => $user ? $user['EMAIL'] : '',
            'PHONE' => $user ? $user['PERSONAL_MOBILE'] : '',
            'PRICE_RESULT' => $order['PROPERTY_PRICE_RESULT_VALUE'],
            'TRAINER' => $trainer ? $trainer['NAME'] : '',
			'ORDER_ID' => $ORDER_ID,
        );

    }

    return $event_params;
}