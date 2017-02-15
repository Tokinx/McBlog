<?php require 'head.php';

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
  $mc_config['theme_links'] = get_magic_quotes_gpc() ? stripslashes(trim($_POST['theme_links'])) : trim($_POST['theme_links']);
  $mc_config['theme_post_number'] = $_POST['theme_post_number'];
  
  if ($_POST['user_pass'] != '')
  {
      if($_POST['user_pass'] == $_POST['user_pass_tow'])
          $mc_config['user_pass'] = md5($_POST['user_pass']);
      else
          $error_msg="两次密码输入不一致。";
  }

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
$theme_links = isset($mc_config['theme_links']) ? $mc_config['theme_links'] : '';
$theme_post_number = $mc_config['theme_post_number']; //文章列表数目
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<ul class="tabs">
  <div class="small_form small_form2">
    <li>
    <input type="radio" name="tabs" id="tab1" checked />
    <label for="tab1" class="tab_buttom tab_buttom1">常规</label>
    <div id="tab-content1" class="tab-content">

        <div class="field">
          <div class="label">网站标题</div>
          <input class="textbox" type="text" name="site_name" value="<?php echo htmlspecialchars($site_name); ?>" />
          <div class="info"></div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">网站描述</div>
          <input class="textbox" type="text" name="site_desc" value="<?php echo htmlspecialchars($site_desc); ?>" />
          <div class="info">用简洁的文字描述你的站点</div>
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
    <label for="tab2" class="tab_buttom tab_buttom2">附加</label>
    <div id="tab-content2" class="tab-content">

        <div class="field">
          <div class="label">您的昵称</div>
          <input class="textbox" type="text" name="user_nick" value="<?php echo htmlspecialchars($user_nick); ?>" />
          <div class="info">用于显示个性昵称</div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">您的邮箱</div>
          <input class="textbox" type="text" name="site_email" value="<?php echo htmlspecialchars($site_email); ?>" />
          <div class="info">用于显示头像和获取邮件通知</div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">启用主题</div>
          <input class="textbox" type="text" name="site_theme" value="<?php echo htmlspecialchars($site_theme); ?>" />
          <div class="info">填入主题目录名称（区分大小写）</div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">文章列表数目</div>
          <input class="textbox" type="text" name="theme_post_number" value="<?php echo htmlspecialchars($theme_post_number); ?>" />
          <div class="info">控制文章列表每页显示数量</div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">评论代码</div>
          <textarea rows="5" class="textbox" name="comment_code" style="margin-bottom:-12px;"><?php echo htmlspecialchars($comment_code); ?></textarea>
          <div class="info">第三方评论服务所提供的评论代码。例：<a href="http://disqus.com/" target="_blank">Disqus</a></div>
        </div>
        <div class="clear"></div>
        <div class="field">
          <div class="label">友情链接</div>
          <textarea rows="5" class="textbox" name="theme_links" style="margin-bottom:-12px;"><?php echo htmlspecialchars($theme_links); ?></textarea>
          <div class="info">每行一条，例：<code>&lt;li&gt;&lt;a target="_blank" href="https://biji.io/"&gt;设计笔记&lt;/a&gt;&lt;/li&gt;</code></div>
        </div>
        <div class="clear"></div>
    </div>
    </li>

    <li>
    <input type="radio" name="tabs" id="tab3" />
    <label for="tab3" class="tab_buttom tab_buttom3">安全</label>
    <div id="tab-content3" class="tab-content">

        <div class="field">
          <div class="label">附件CDN</div>
          <input class="textbox" type="text" name="site_cdn" value="<?php echo htmlspecialchars($site_cdn); ?>" />
          <div class="info">不启用请留空 . 镜像地址：<?php echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]).'/upload';?></div>
        </div>
        <div class="clear"></div>
        <hr>
        <div class="field">
          <div class="label">登陆帐号</div>
          <input class="textbox" type="text" name="user_name" value="<?php echo htmlspecialchars($user_name); ?>"/>
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
          <input class="textbox" type="password" name="user_pass_tow"/>
          <div class="info"></div>
        </div>
        <div class="clear"></div>

    </div>
    </li>

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
<?php 
if($display_info && $error_msg=='') echo '<div class="updated">设置保存成功！</div>';
elseif($error_msg!='') echo '<div class="error">'.$error_msg.'</div>';
require 'foot.php';
?>