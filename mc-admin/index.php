<?php error_reporting(0);
require_once dirname(dirname(__FILE__)).'/mc-files/mc-conf.php';
if (isset($_COOKIE['mc_token'])) {
  $token = $_COOKIE['mc_token'];
  if ($token == md5($mc_config['user_name'].'_'.$mc_config['user_pass'])) {
    Header("Location:post.php");
  }else Header("Location:index.php?error");
}
if($_GET['admin'] == 'logout') {
setcookie('mc_token','',time()-3600); 
Header("Location:index.php");
}
if (isset($_POST['login'])) {
  if (strtoupper($_POST['user']) == strtoupper($mc_config['user_name']) 
  && md5($_POST['pass']) == $mc_config['user_pass']) {
    setcookie('mc_token', md5($mc_config['user_name'].'_'.$mc_config['user_pass']));
    Header("Location:post.php");
  }else Header("Location:index.php?admin=error");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title><?php echo $mc_config['site_name'];?></title>

  <link style="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <div id="login_title"><?php echo $mc_config['site_name'];?></div>
<?php if($_GET['admin'] == 'error') {?>
<span style="text-align:center;display: block;color: #e00;margin: 10px 0 0 0;">账号与密码不匹配！</span>
<?php } ?>
  <div id="login_form">
    <div id="login_form_box">
      <div class="label">帐号</div>
      <div class="textbox"><input name="user" type="text" /></div>
      <div class="label">密码</div>
      <div class="textbox"><input name="pass" type="password" /></div>
      <div class="bottom"><input name="login" type="submit" value="登录" class="button" /></div>
    </div>
  </div>
  </form>
</body>
</html>
