<?php
/**
 * Created by PhpStorm.
 * User: Vlad-Home
 * Date: 3/17/2016
 * Time: 2:05 PM
 */
require_once("modules/Gluussos/oxd-rp/Get_tokens_by_code.php");
require_once("modules/Gluussos/oxd-rp/Get_user_info.php");
include ('include/MVC/preDispatch.php');
$startTime = microtime(true);
require_once('include/entryPoint.php');
ob_start();
require_once('include/MVC/SugarApplication.php');
$app = new SugarApplication();
$app->startSession();
$db = DBManagerFactory::getInstance();
$oxd_id = $db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'oxd_id'"))["gluu_value"];

$http = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? "https://" : "http://";
$parts = parse_url($http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
parse_str($parts['query'], $query);
$config_option = json_decode($db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'oxd_config'"))["gluu_value"],true);;
$conf = json_decode($db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'oxd_config'"))["gluu_value"],true);;
$get_tokens_by_code = new Get_tokens_by_code();
$get_tokens_by_code->setRequestOxdId($oxd_id);
$get_tokens_by_code->setRequestCode($_REQUEST['code']);
$get_tokens_by_code->setRequestState($_REQUEST['state']);
$get_tokens_by_code->setRequestScopes($config_option["scope"]);
$get_tokens_by_code->request();
$get_tokens_by_code_array = $get_tokens_by_code->getResponseObject()->data->id_token_claims;
$get_user_info = new Get_user_info();
$get_user_info->setRequestOxdId($oxd_id);
$get_user_info->setRequestAccessToken($get_tokens_by_code->getResponseAccessToken());
$get_user_info->request();
$get_user_info_array = $get_user_info->getResponseObject()->data->claims;
$address = $get_user_info_array->address[0];
$address_object = json_decode($address);
/*echo '<pre>';
var_dump($get_user_info_array);
echo '</pre>';
exit;*/
$reg_first_name = '';
$reg_last_name = '';
$reg_email = '';
$reg_avatar = '';
$reg_display_name = '';
$reg_nikname = '';
$reg_website = '';
$reg_middle_name = '';
$reg_country = '';
$reg_city = '';
$reg_region = '';
$reg_gender = '';
$reg_postal_code = '';
$reg_fax = '';
$reg_home_phone_number = '';
$reg_phone_mobile_number = '';
$reg_street_address = '';
$reg_birthdate = '';
if($get_user_info_array->website[0]){
    $reg_website = $get_user_info_array->website[0];
}elseif($get_tokens_by_code_array->website[0]){
    $reg_website = $get_tokens_by_code_array->website[0];
}
if($get_user_info_array->nickname[0]){
    $reg_nikname = $get_user_info_array->nickname[0];
}elseif($get_tokens_by_code_array->nickname[0]){
    $reg_nikname = $get_tokens_by_code_array->nickname[0];
}
if($get_user_info_array->name[0]){
    $reg_display_name = $get_user_info_array->name[0];
}elseif($get_tokens_by_code_array->name[0]){
    $reg_display_name = $get_tokens_by_code_array->name[0];
}
if($get_user_info_array->given_name[0]){
    $reg_first_name = $get_user_info_array->given_name[0];
}elseif($get_tokens_by_code_array->given_name[0]){
    $reg_first_name = $get_tokens_by_code_array->given_name[0];
}
if($get_user_info_array->family_name[0]){
    $reg_last_name = $get_user_info_array->family_name[0];
}elseif($get_tokens_by_code_array->family_name[0]){
    $reg_last_name = $get_tokens_by_code_array->family_name[0];
}
if($get_user_info_array->middle_name[0]){
    $reg_middle_name = $get_user_info_array->middle_name[0];
}elseif($get_tokens_by_code_array->middle_name[0]){
    $reg_middle_name = $get_tokens_by_code_array->middle_name[0];
}
if($get_user_info_array->email[0]){
    $reg_email = $get_user_info_array->email[0];
}elseif($get_tokens_by_code_array->email[0]){
    $reg_email = $get_tokens_by_code_array->email[0];
}
if($get_user_info_array->country[0]){
    $reg_country = $get_user_info_array->country[0];
}elseif($get_tokens_by_code_array->country[0]){
    $reg_country = $get_tokens_by_code_array->country[0];
}
if($get_user_info_array->gender[0]){
    if($get_user_info_array->gender[0] == 'male'){
        $reg_gender = '1';
    }else{
        $reg_gender = '2';
    }

}elseif($get_tokens_by_code_array->gender[0]){
    if($get_tokens_by_code_array->gender[0] == 'male'){
        $reg_gender = '1';
    }else{
        $reg_gender = '2';
    }
}
if($get_user_info_array->locality[0]){
    $reg_city = $get_user_info_array->locality[0];
}elseif($get_tokens_by_code_array->locality[0]){
    $reg_city = $get_tokens_by_code_array->locality[0];
}
if($get_user_info_array->postal_code[0]){
    $reg_postal_code = $get_user_info_array->postal_code[0];
}elseif($get_tokens_by_code_array->postal_code[0]){
    $reg_postal_code = $get_tokens_by_code_array->postal_code[0];
}
if($get_user_info_array->phone_number[0]){
    $reg_home_phone_number = $get_user_info_array->phone_number[0];
}elseif($get_tokens_by_code_array->phone_number[0]){
    $reg_home_phone_number = $get_tokens_by_code_array->phone_number[0];
}
if($get_user_info_array->phone_mobile_number[0]){
    $reg_phone_mobile_number = $get_user_info_array->phone_mobile_number[0];
}elseif($get_tokens_by_code_array->phone_mobile_number[0]){
    $reg_phone_mobile_number = $get_tokens_by_code_array->phone_mobile_number[0];
}
if($get_user_info_array->picture[0]){
    $reg_avatar = $get_user_info_array->picture[0];
}elseif($get_tokens_by_code_array->picture[0]){
    $reg_avatar = $get_tokens_by_code_array->picture[0];
}
if($get_user_info_array->street_address[0]){
    $reg_street_address = $get_user_info_array->street_address[0];
}elseif($get_tokens_by_code_array->street_address[0]){
    $reg_street_address = $get_tokens_by_code_array->street_address[0];
}
if($get_user_info_array->birthdate[0]){
    $reg_birthdate = $get_user_info_array->birthdate[0];
}elseif($get_tokens_by_code_array->birthdate[0]){
    $reg_birthdate = $get_tokens_by_code_array->birthdate[0];
}
if($get_user_info_array->region[0]){
    $reg_region = $get_user_info_array->region[0];
}elseif($get_tokens_by_code_array->region[0]){
    $reg_region = $get_tokens_by_code_array->region[0];
}

$username = '';
if($get_user_info->getResponsePreferredUsername()){
    $username = $get_user_info->getResponsePreferredUsername();
}
else {
    $email_split = explode("@", $reg_email);
    $username = $email_split[0];
}



$username = '';

$email_split = explode("@", $reg_email);
$username = $email_split[0];

$user_hash = User::getPasswordHash($get_user_info_array->sub);
$query = "SELECT user_name from users where user_name='$reg_email' AND user_hash='$user_hash' AND deleted=0";
$result = $db->query($query);
$dup_users = $db->fetchByAssoc($result);

if (empty($dup_users)){
    $user = new User();
    $user->user_name = $reg_email;
    $user->employee_status = 'Active';
    $user->status = 'Active';
    $user->user_hash = $user_hash;
    $user->last_name = $reg_last_name;
    $user->first_name = $reg_first_name;
    $user->is_admin = 0;
    $user->	phone_home = $reg_home_phone_number;
    $user->	phone_mobile = $reg_phone_mobile_number;
    $user->	address_street = $address_object->street_address;
    $user->	address_city = $address_object->region;
    $user->	address_country = $address_object->country;
    $user->	address_postalcode = '0054';
    $user->external_auth_only = 0;
    $user->save();
}
include_once('modules/Users/authentication/AuthenticationController.php');
$login = new AuthenticationController();
$login->login($reg_email, $get_user_info_array->sub, $PARAMS = array());
header("Refresh:0");


