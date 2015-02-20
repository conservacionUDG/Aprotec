<?php
    global $conf_host;
    $activate = TRUE;
    
    $data_base = TRUE;
        $type_db = "MySQL"; //MySQL
        define('host', 'localhost');
        define('user', 'root');
        define('pw', 'norman95');
        define('db', 'aprotec');

    $conf_host = [
      'host' => 'http://localhost/Aprotec/',
      'lang' => 'es'
    ];
    $INSTALLED_APPS = [
    "general"
    ];
   if ($data_base) {
     require_once 'db.php';
   }
   login_app($INSTALLED_APPS);
   $objects = [
      "principal"=> new principal()
   ]; 
      if ($activate) {
        require_once 'url.php';
      }else{
        $objects['principal']->system_off('aprotec_off.html');
      }
?>