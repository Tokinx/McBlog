<?php 
error_reporting(0);
require 'head.php';

$display_info = false;
  
if (isset($_POST['save'])) {
  $user_name_changed = $_POST['user_name'] != $mc_config['user_name'];
  
  $mc_config['site_name'] = $_POST['site_name'];
  $mc_config['site_desc'] = $_POST['site_desc'];
  $mc_config['site_link'] = $_POST['site_link'];
  $mc_config['site_theme'] = $_POST['site_theme'];
  $mc_config['site_icp'] = $_POST['site_icp'];
  $mc_config['site_cdn'] = $_POST['site_cdn'];
  $mc_config['site_email'] = $_POST['site_email'];
  $mc_config['user_nick'] = $_POST['user_nick'];
  $mc_config['user_name'] = $_POST['user_name'];
  $mc_config['comment_code'] = get_magic_quotes_gpc() ? stripslashes(trim($_POST['comment_code'])) : trim($_POST['comment_code']);
  
  /* 开放参数 */
  $mc_config['theme_post_number'] = $_POST['theme_post_number'];
  $mc_config['theme_image'] = $_POST['theme_image'];
  
  if ($_POST['user_pass'] != '')
    $mc_config['user_pass'] = md5($_POST['user_pass']);

  $code = "<?php\n\$mc_config = ".var_export($mc_config, true)."\n?>";
  
  file_put_contents('../mc-files/mc-conf.php', $code);
  
  if ($_POST['user_pass'] != '' || $user_name_changed) {
    setcookie('mc_token', md5($mc_config['user_name'].'_'.$mc_config['user_pass']));
  }
  
  $display_info = true;
}

$site_name = $mc_config['site_name'];
$site_desc = $mc_config['site_desc'];
$site_link = $mc_config['site_link'];
$site_theme = $mc_config['site_theme'];
$site_icp = $mc_config['site_icp'];
$site_cdn = $mc_config['site_cdn'];
$site_email = $mc_config['site_email'];
$user_nick = $mc_config['user_nick'];
$user_name = $mc_config['user_name'];
$comment_code = isset($mc_config['comment_code']) ? $mc_config['comment_code'] : '';

/* 开放参数 */
$theme_post_number = $mc_config['theme_post_number']; //文章列表数目
$theme_image = $mc_config['theme_image']; //缩略图宽度

?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <?php if ($display_info) { ?>
  <div class="updated">设置保存成功！</div>
  <?php } ?>
<ul class="tabs">
  <div class="small_form small_form2">
<li>
<input type="radio" name="tabs" id="tab1" checked />
<label for="tab1" class="tab_buttom tab_buttom1">基本设置</label>
<div id="tab-content1" class="tab-content">

    <div class="field">
      <div class="label">网站标题</div>
      <input class="textbox" type="text" name="site_name" value="<?php echo htmlspecialchars($site_name); ?>" />
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">网站描述</div>
      <input class="textbox" type="text" name="site_desc" value="<?php echo htmlspecialchars($site_desc); ?>" />
      <div class="info">用简洁的文字没描述本站点。</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">网站地址</div>
      <input class="textbox" type="text" name="site_link" value="<?php echo htmlspecialchars($site_link); ?>" />
      <div class="info">请设置网站地址，结尾不需要加 “/”</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">备案号</div>
      <input class="textbox" type="text" name="site_icp" value="<?php echo htmlspecialchars($site_icp); ?>" />
      <div class="info">如果您网站有备案，可以在此添加备案号码</div>
    </div>
    <div class="clear"></div>

</div>
</li>
 
<li>
<input type="radio" name="tabs" id="tab2" />
<label for="tab2" class="tab_buttom tab_buttom2">附加设置</label>
<div id="tab-content2" class="tab-content">

    <div class="field">
      <div class="label">您的昵称</div>
      <input class="textbox" type="text" name="user_nick" value="<?php echo htmlspecialchars($user_nick); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">您的邮箱</div>
      <input class="textbox" type="text" name="site_email" value="<?php echo htmlspecialchars($site_email); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">启用主题</div>
      <input class="textbox" type="text" name="site_theme" value="<?php echo htmlspecialchars($site_theme); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">附件CDN</div>
      <input class="textbox" type="text" name="site_cdn" value="<?php echo htmlspecialchars($site_cdn); ?>" />
      <div class="info">不启用请留空 . 镜像地址：<?php echo $mc_config['site_link'];?>/mc-admin/upload/</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">评论代码</div>
      <textarea rows="5" class="textbox" name="comment_code"><?php echo htmlspecialchars($comment_code); ?></textarea>
      <div class="info">第三方评论服务所提供的评论代码。<br/>例如：<a href="http://disqus.com/" target="_blank">Disqus</a>。</div>
    </div>
    <div class="clear"></div>
	
</div>
</li>

<li>
<input type="radio" name="tabs" id="tab3" />
<label for="tab3" class="tab_buttom tab_buttom3">安全设置</label>
<div id="tab-content3" class="tab-content">

    <div class="field">
      <div class="label">登陆帐号</div>
      <input class="textbox" type="text" name="user_name" value="<?php echo htmlspecialchars($user_name); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">登陆密码</div>
      <input class="textbox" type="password" name="user_pass" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">确认密码</div>
      <input class="textbox" type="password" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>

</div>
</li>

<?php
	echo '<div class="nones">';
	$panduan = (include_once '../mc-files/theme/' . $mc_config['site_theme'] . '/deploy.php');
	if($panduan != '1') echo '<style>.nones{display:none;}</style>';
	echo '</div>';
?>
    <div class="clear"></div>
    <div class="field">
      <div class="label"></div>
      <div class="field_body"><input class="button" type="submit" name="save" value="保存设置" /></div>
      <div class="info"></div>
    </div>
    <div class="clear"></div>
  </div>
</ul>
</form>
<?php require 'foot.php' ?>
