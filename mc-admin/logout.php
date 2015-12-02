<?php
require_once dirname(dirname(__FILE__)).'/mc-files/mc-conf.php';

if (isset($_COOKIE['mc_token'])||isset($_POST['login'])) {
setcookie('mc_token','',time()-3600); 
Header("Location:{$mc_config['site_link']}/mc-admin/index.php");
}
?>