<?php error_reporting(0);
require_once dirname(dirname(__FILE__)).'/mc-files/mc-conf.php';
$update=false;
$handle = fopen("http://hi.idevs.cn/mc-admin/update_json.php","r");
$content ='';
while (!feof($handle))  $content .= fread($handle,500);
fclose($handle);
$content = json_decode($content,true);
if($content!=''&&$content["version"]!=$mc_config['version']) $update=true;
if($_GET['update'] == 'new') { ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="robots" content="none" />
<title>检测更新</title>
<style>
*{font-family:serif;margin:0;font-weight:lighter;text-decoration:none;text-align:center;line-height:2.2em;}
html,body{height:100%;}
h1{font-size:100px;line-height:1em;color: #eee;}
h3{color: #2ae;font-weight: bold;}
a{padding: 10px 20px;border: 1px solid #2ae;border-radius: 100px;color: #2ae;background: #F3FBFF;}
br{line-height:3em;}
table{width:100%;height:100%;border:0;}
</style>
</head>
<body>
<table cellspacing="0" cellpadding="0">
<tr>
<td>
<table cellspacing="0" cellpadding="0">
<tr>
<td>
<?php 
if($content["version"]!='')
{
    echo '<h1>UPDATE</h1>';
    if(!$update)
        echo '<h3>当前版本已是最新！</h3><p>恭喜你，正在使用最新版本的McBlog。<br/><a href="./">返 回</a></p>';
    else
        echo '<h3>有新的版本可以提供给你！</h3><p>当前版本：'.$mc_config['version'].' ｜ 服务器版本：'.$content["version"].'<br/><a href="'.$content["download_url"].'">立即下载</a></p>';
}
else
    echo '<h1>ERROR</h1><h3>服务器错误，检测更新失败！</h3><p>更新服务器出了一些问题，稍后再试一试吧。<br/><a href="http://www.mcblog.org">访问官网</a></p>';
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
<?php }