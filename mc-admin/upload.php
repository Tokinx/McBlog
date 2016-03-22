<?php
error_reporting(0);
require_once dirname(dirname(__FILE__)).'/mc-files/mc-conf.php';
if (isset($_COOKIE['mc_token'])||isset($_POST['login']));
else Header("Location:{$mc_config['site_link']}/mc-admin/index.php");

function fileext($filename){
    $sTemp = strrchr($filename, ".");
    return substr($sTemp, 1);
}

$type_image = array("jpg", "jpeg", "png");
$type_annex = array("gif", "zip", "rar", "txt", "mp3", "flv");
$rand="hi_".date('Ymd')."_".rand();
$fileext = strtolower(fileext($_FILES['file']['name']));
$export = "http://";
//$uploadfile = $rand . "." . $fileext;
$uploadfile = $rand . ".jpg";
if ((in_array($fileext, $type_image)||in_array($fileext, $type_annex))&&($_FILES["file"]["size"] < 81920000)){
	move_uploaded_file($_FILES["file"]["tmp_name"],'upload/' . $uploadfile);
	if($mc_config['site_cdn']=='')
		$export = dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]) . "/upload/" . $uploadfile;
	else
		$export = $mc_config['site_cdn'] . $uploadfile;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="upload">
<div class="wmd-legend">上传附件</div>
<label class="wmd-fieldlabel" for="jrznbj_input">上传完成后，直接复制下方文本框中的文件链接</label>
<input type="text" value="<?php echo $export; ?>" id="input_type" <?php if($export!='http://') echo 'onfocus="this.select()" onmouseover="this.select()"';?>>
<form action="upload.php" method="post" enctype="multipart/form-data" class="up_form">
<input type="text" class="ipt_text" id="file_text">
<input type="file" name="file" id="file" class="up_file" size="26" onchange="document.getElementById('file_text').value=this.value">
<input type="submit" name="submit" id="submit" value="上传" />
</form>
</div>
</body>
</html>