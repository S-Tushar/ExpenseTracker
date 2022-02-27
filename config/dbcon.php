<?php
session_start();
include('config.php');



//connection
$conn = mysqli_connect(DB_HOST,DB_USER , DB_PASSWORD , DB_NAME) or die("Database is not connected");

/*==================error function==========================*/
$error_list = array();
function errormessage($error_list, $inputname)
{
    $str = '';
    if (!empty($error_list) && isset($error_list[$inputname])) {
        $str = '<span class="text-danger">' . ucwords($error_list[$inputname]) . '</span>';
    }
    return $str;
}

/*=======================================================*/
$GLOBALS['conn'] = $conn;

if (!$conn) {
    die('database is not connected');
}
/*
$s = "SELECT * FROM site_options LIMIT 1";
$r = mysqli_query($GLOBALS['conn'], $s);
$GLOBALS['site_options'] = mysqli_fetch_assoc($r);
*/
/*======= Date format ========*/
function dateformat($string)
{
    if ($GLOBALS['site_options']) {

        return (!empty($string) && $string != "0000-00-00" && strtotime($string)) ?
            date($GLOBALS['site_options']['date_format'], strtotime($string)) : '';
    } else {
        return '';
    }
}

/*======== Time format =========*/
function datetimeformat($string)
{
    if ($GLOBALS['site_options']) {
        return (!empty($string) && $string != "0000-00-00" && strtotime($string)) ?
            date('' . $GLOBALS['site_options']['date_format'] . 'h:i A', strtotime($string)) : '';
    } else {
        return '';
    }
}

/*========= number formet ==================*/
function numberformet($number)
{
    return '&#8377; ' . number_format($number, 2);
}
/*==========  hasRole ==============*/
function hasRole($role_name = '')
{
    if (is_array($role_name)) {
        return (in_array($_SESSION['role_name'], $role_name)) ? true : false;
    } else {
        return ($_SESSION['role_name'] == $role_name) ? true : false;
    }
}
// ---- blank check

function validateEmpty($text)
{
    if (!empty($text)) {
        return true;
    }
    return false;
}

function old($key){
      
    return (isset($_REQUEST[$key]))?$_REQUEST[$key]:'';
}
