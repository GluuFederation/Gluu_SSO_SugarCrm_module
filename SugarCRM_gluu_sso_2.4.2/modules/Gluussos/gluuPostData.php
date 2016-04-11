<?php

require_once("modules/Gluussos/oxd-rp/Register_site.php");

$base_url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$db = DBManagerFactory::getInstance();
if( isset( $_REQUEST['form_key'] ) and strpos( $_REQUEST['form_key'], 'general_register_page' ) !== false ) {
    $config_option = json_encode(array(
        "oxd_host_ip" => '127.0.0.1',
        "oxd_host_port" =>$_POST['oxd_port'],
        "admin_email" => $_POST['loginemail'],
        "authorization_redirect_uri" => $base_url.'/gluu.php?gluu_login=Gluussos',
        "logout_redirect_uri" => $base_url.'/gluu.php?gluu_login=Gluussos',
        "scope" => ["openid","profile","email","address","clientinfo","mobile_phone","phone"],
        "grant_types" =>["authorization_code"],
        "response_types" => ["code"],
        "application_type" => "web",
        "redirect_uris" => [ $base_url.'/gluu.php?gluu_login=Gluussos'],
        "acr_values" => [],
    ));
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '$config_option' WHERE `gluu_action` LIKE 'oxd_config';");
    $config_option = array(
        "oxd_host_ip" => '127.0.0.1',
        "oxd_host_port" =>$_POST['oxd_port'],
        "admin_email" => $_POST['loginemail'],
        "authorization_redirect_uri" => $base_url.'/gluu.php?gluu_login=Gluussos',
        "logout_redirect_uri" => $base_url.'/gluu.php?gluu_login=Gluussos',
        "scope" => ["openid","profile","email","address","clientinfo","mobile_phone","phone"],
        "grant_types" =>["authorization_code"],
        "response_types" => ["code"],
        "application_type" => "web",
        "redirect_uris" => [ $base_url.'/gluu.php?gluu_login=Gluussos' ],
        "acr_values" => [],
    );
    $register_site = new Register_site();
    $register_site->setRequestAcrValues($config_option['acr_values']);
    $register_site->setRequestAuthorizationRedirectUri($config_option['authorization_redirect_uri']);
    $register_site->setRequestRedirectUris($config_option['redirect_uris']);
    $register_site->setRequestGrantTypes($config_option['grant_types']);
    $register_site->setRequestResponseTypes(['code']);
    $register_site->setRequestLogoutRedirectUri($config_option['logout_redirect_uri']);
    $register_site->setRequestContacts([$config_option["admin_email"]]);
    $register_site->setRequestApplicationType('web');
    $register_site->setRequestClientLogoutUri($config_option['logout_redirect_uri']);
    $register_site->setRequestScope($config_option['scope']);
    $status = $register_site->request();
    if($register_site->getResponseOxdId()){
        $oxd_id = $register_site->getResponseOxdId();
        if($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'oxd_id'")){
            $db->query("INSERT INTO gluu_table (gluu_action, gluu_value) VALUES ('oxd_id','$oxd_id')");
        }
    }
    SugarApplication::redirect('index.php?module=Gluussos&action=general');
}else if( isset( $_REQUEST['form_key'] ) and strpos( $_REQUEST['form_key'], 'openid_config_delete_scop' ) !== false ) {
    $get_scopes =   json_decode($db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'scopes'"))["gluu_value"],true);
    $up_cust_sc =  array();
    foreach($get_scopes as $custom_scop){
        if($custom_scop !=$_REQUEST['value_scope']){
            array_push($up_cust_sc,$custom_scop);
        }
    }
    $get_scopes = json_encode($up_cust_sc);

    $result = $db->query("UPDATE `sugar`.`gluu_table` SET `gluu_value` = '$get_scopes' WHERE `gluu_action` LIKE 'scopes';");
    SugarApplication::redirect('index.php?module=Gluussos&action=general');
}else if( isset( $_REQUEST['form_key'] ) and strpos( $_REQUEST['form_key'], 'openid_config_delete_custom_scripts' ) !== false ) {
    $get_scopes =   json_decode($db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'custom_scripts'"))["gluu_value"],true);
    $up_cust_sc =  array();
    foreach($get_scopes as $custom_scop){
        if($custom_scop['value'] !=$_REQUEST['value_script']){
            array_push($up_cust_sc,$custom_scop);
        }
    }
    $get_scopes = json_encode($up_cust_sc);

    $db->query("UPDATE `sugar`.`gluu_table` SET `gluu_value` = '$get_scopes' WHERE `gluu_action` LIKE 'custom_scripts';");
    SugarApplication::redirect('index.php?module=Gluussos&action=general');
}else if( isset( $_REQUEST['form_key'] ) and strpos( $_REQUEST['form_key'], 'sugar_crm_config_page' ) !== false ) {

    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuoxd_openid_login_theme']."' WHERE `gluu_action` LIKE 'loginTheme';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuoxd_openid_login_custom_theme']."' WHERE `gluu_action` LIKE 'loginCustomTheme';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuox_login_icon_space']."' WHERE `gluu_action` LIKE 'iconSpace';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuox_login_icon_custom_size']."' WHERE `gluu_action` LIKE 'iconCustomSize';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuox_login_icon_custom_width']."' WHERE `gluu_action` LIKE 'iconCustomWidth';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuox_login_icon_custom_height']."' WHERE `gluu_action` LIKE 'iconCustomHeight';");
    $db->query("UPDATE `gluu_table` SET `gluu_value` = '".$_REQUEST['gluuox_login_icon_custom_color']."' WHERE `gluu_action` LIKE 'iconCustomColor';");
    SugarApplication::redirect('index.php?module=Gluussos&action=general');
}else if( isset( $_REQUEST['form_key'] ) and strpos( $_REQUEST['form_key'], 'openid_config_page' ) !== false ) {
    $params = $_REQUEST;
    $custom_scripts =   json_decode($db->fetchRow($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE 'custom_scripts'"))["gluu_value"],true);
    $message = '';
    foreach($custom_scripts as $custom_script){
        $action = $custom_script['value']."Enable";
        $value = $params['gluuoxd_openid_'.$custom_script['value'].'_enable'];
        if($db->query("SELECT `gluu_value` FROM `gluu_table` WHERE `gluu_action` LIKE '".$custom_script['value']."Enable'")){
            $db->query("INSERT INTO gluu_table (gluu_action, gluu_value) VALUES ('$action','$value')");
        }else{
            $db->query("UPDATE `gluu_table` SET `gluu_value` = '$value' WHERE `gluu_action` LIKE '$action';");
        }
    }
    SugarApplication::redirect('index.php?module=Gluussos&action=general');exit;
    if(isset($params['count_scripts'])){
        $error_array = array();
        $error = true;
        $custom_scripts = unserialize(Mage::getStoreConfig('gluu/oxd/oxd_openid_custom_scripts'));
        for($i=1; $i<=$params['count_scripts']; $i++){
            if(isset($params['name_in_site_'.$i]) && !empty($params['name_in_site_'.$i]) && isset($params['name_in_gluu_'.$i]) && !empty($params['name_in_gluu_'.$i]) && isset($_FILES['images_'.$i]) && !empty($_FILES['images_'.$i])){
                foreach($custom_scripts as $custom_script){
                    if($custom_script['value'] == $params['name_in_gluu_'.$i] || $custom_script['name'] == $params['name_in_site_'.$i]){
                        $error = false;
                        array_push($error_array, $i);
                    }
                }
                if($error){
                    $uploader = new Varien_File_Uploader(array(
                        'name' => $_FILES['images_'.$i]['name'],
                        'type' => $_FILES['images_'.$i]['type'],
                        'tmp_name' => $_FILES['images_'.$i]['tmp_name'],
                        'error' => $_FILES['images_'.$i]['error'],
                        'size' => $_FILES['images_'.$i]['size']
                    ));
                    $uploader->setAllowedExtensions(array('png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('skin') . DS . 'adminhtml' . DS. 'default' . DS. 'default' . DS. 'GluuOxd_Openid' . DS. 'images' . DS. 'icons' . DS;
                    $img = $uploader->save($path, $_FILES['images']['name']);
                    if($img['file']){
                        array_push($custom_scripts, array('name'=>$params['name_in_site_'.$i],'image'=>$this->getAddedImage($img['file']),'value'=>$params['name_in_gluu_'.$i]));
                        $message.= 'New custom scripts name = '.$params['name_in_site_'.$i].' and name in gluu = '.$params['name_in_gluu_'.$i].' added Successful!<br/>';
                    }else{
                        $datahelper->displayMessage('Name = '.$params['name_in_site_'.$i]. ' or value = '. $params['name_in_gluu_'.$i]. ' is exist.',"ERROR");
                        $this->redirect("*/*/index");
                    }
                }else{
                    $datahelper->displayMessage('Name = '.$params['name_in_site_'.$i]. ' or value = '. $params['name_in_gluu_'.$i]. ' is exist.',"ERROR");
                    $this->redirect("*/*/index");
                }
            }else{
                $datahelper->displayMessage('Necessary to fill the hole row.',"ERROR");
                $this->redirect("*/*/index");
            }
        }
        $storeConfig ->saveConfig('gluu/oxd/oxd_openid_custom_scripts',serialize($custom_scripts), 'default', 0);
    }
    if(!empty($params['scope_name']) && isset($params['scope_name'])){
        $get_scopes = unserialize(Mage::getStoreConfig('gluu/oxd/oxd_openid_scops'));
        foreach($params['scope_name'] as $scope){
            if($scope && !in_array($scope,$get_scopes)){
                array_push($get_scopes, $scope);
                $message.= 'New scopes name = '.$scope.' added Successful!<br/>';
            }
        }
        $storeConfig ->saveConfig('gluu/oxd/oxd_openid_scops',serialize($get_scopes), 'default', 0);
    }
    $oxd_config = unserialize(Mage::getStoreConfig('gluu/oxd/oxd_config'));
    if(!empty($params['scope']) && isset($params['scope'])){
        $oxd_config['scope'] = $params['scope'];
        $message.= 'Scopes updated Successful!<br/>';
    }
    else{
        $oxd_config['scope'] =  unserialize(Mage::getStoreConfig ( 'gluu/oxd/oxd_config' ));
    }
    $storeConfig ->saveConfig('gluu/oxd/oxd_config',serialize($oxd_config), 'default', 0);
    SugarApplication::redirect('index.php?module=Gluussos&action=general');
}

?>
