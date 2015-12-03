<?php 
error_reporting(0);
?>
<li>
<input type="radio" name="tabs" id="tab4" />
<label for="tab4" class="tab_buttom tab_buttom4">主题设置</label>
<div id="tab-content4" class="tab-content">

    <div class="field">
      <div class="label">文章列表数目</div>
      <input class="textbox" type="text" name="theme_post_number" value="<?php echo htmlspecialchars($theme_post_number); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">缩略图宽度</div>
      <input class="textbox" type="text" name="theme_image" value="<?php echo htmlspecialchars($theme_image); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>

</div>
</li>