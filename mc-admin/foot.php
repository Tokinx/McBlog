    </div>
</div>
<div id="footer">
    <div id="footer_box">
<?php require 'update.php';
    if(!$update)
        echo '感谢使用 <a href="update.php?update=new" target="_blank">McBlog '.$mc_config['version'].'</a> 进行创作';
    else
        echo '有可供更新的版本 <a href="update.php?update=new" target="_blank" style="color:#2ae;">'.$content["version"].'</a> ';
?>
         . <a href="./?admin=logout">注销</a></div>
</div>
    <script type="text/javascript">
    $(function ()
    {
        $('.updated,.message,.error').delay(5000).fadeOut();
    });
    </script>
</body>
</html>
