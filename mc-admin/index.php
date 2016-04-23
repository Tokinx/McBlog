<?php error_reporting(0);
require_once dirname(dirname(__FILE__)).'/mc-files/mc-conf.php';
$error_msg='';
$token = $_COOKIE['mc_token'];
if (isset($token))
{
    if ($token == md5($mc_config['user_name'].'_'.$mc_config['user_pass'])) Header("Location:post.php"); //token正确，进后台
    else
    {
        setcookie('mc_token','',time()-3600); //token变化，清空记录
        $error_msg="状态信息异常，请重新登陆。";
    }
}
if($_GET['admin'] == 'logout') setcookie('mc_token','',time()-3600); //login_out后，清空记录并返回登陆页
if (isset($_POST['login']))
{
    if (strtoupper($_POST['user']) == strtoupper($mc_config['user_name']) && md5($_POST['pass']) == $mc_config['user_pass'])
    {
        setcookie('mc_token', md5($mc_config['user_name'].'_'.$mc_config['user_pass'])); //帐号密码匹配则生成token并进入后台
        Header("Location:post.php");
    }
    else $error_msg="帐号密码不匹配！"; //不匹配则抛出错误
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title><?php echo $mc_config['site_name'];?> - 撰写美好</title>
  <link style="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
  <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
  <div id="login_title"><?php echo $mc_config['site_name'];?></div>
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
<?php if($error_msg!='') echo '<div class="error" style="left:0;right:0;width:240px;text-align:center;margin:auto;">'.$error_msg.'</div>';?>
</body>
</html>