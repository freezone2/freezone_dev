<?php
if (!defined('MAIN_SECTIONS')) {
    define("MAIN_SECTIONS", 63);
}
/*
if($_REQUEST['new_des'] == "Y") {
    define("NEW_DES", 1);
}
else {
    define("NEW_DES", 2);
}
*/
//define("NEW_DES", 1);
if($_REQUEST['old_des'] == "Y") {
    define("NEW_DES", 2);
}
else {
    define("NEW_DES", 1);
}