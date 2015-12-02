<?php if (!isset($mc_config)) exit;?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php if (mc_is_post() || mc_is_page()) { mc_the_title();?> - <?php mc_site_name();} else { mc_site_name();?> - <?php mc_site_desc();}?></title>
<link type="image/vnd.microsoft.icon" href="<?php mc_theme_url('images/favicon.png');?>" rel="shortcut icon">
<link href="<?php mc_theme_url('style.css');?>" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="g-doc">
<div class="g-sd">
<h1 class="title">
<a href="<?php mc_site_link();?>"><?php mc_site_name();?></a>
<span class="icon"></span>
</h1>
<div class="m-about"><?php mc_site_desc();?></div>
<div class="m-menu">
<div class="nav">
<a href="<?php mc_site_link();?>">首页</a>
<a href="<?php mc_site_link();?>/?about/">关于</a>
<a href="<?php mc_site_link();?>/?archive/">存档</a>
<a target="_blank" href="<?php mc_site_link();?>/?rss/">订阅</a>
</div>
</div>
</div>

<div class="g-mn">
<span class="arrow"></span>
<?php if (mc_is_post()||mc_is_page()) { ?>
        <div class="m-post photo single">
			<h2><?php mc_the_link();?></h2>
            <?php mc_the_content();if(!mc_is_page()){?>
            <div class="info">
                <div class="time"><?php mc_the_date();?></div>
				<div class="tags"><?php mc_the_tags('','','');?></div>
            </div>
			<?php };?>
        </div>
<?php if (mc_can_comment()&&mc_comment_code()){?>
	<div class="box comment">
		<div class="nctitle">评论</div>
		<?php echo mc_comment_code();?>
	</div>
<?php }
 } else if (mc_is_archive()) { // 归档 ?>
<div class="m-post photo archive">
	<div class="date_list">
		<h3>月份</h3>
		<ul>
		<?php mc_date_list();?>
		</ul>
	</div>
	<div class="tag_list">
		<h3>标签</h3>
		<ul>
		<?php mc_tag_list();?>
		</ul>
	</div>
</div>
<div class="clearer"></div>
<?php } else { 
if (mc_is_tag()) { ?>
<div id="page_info"><span><?php mc_tag_name();?></span></div>
<?php } else if (mc_is_date()) { ?>
<div id="page_info"><span><?php mc_date_name();?></span></div>
<?php } 
// 列表
while (mc_next_post()) : ?>
        <div class="m-post photo">
			<h2><?php mc_the_link();?></h2>
            <?php mc_the_thumbnail();mc_the_excerpt('');?>
            <div class="info">
                <div class="time"><?php mc_the_date();?></div>
				<div class="tags"><?php mc_the_tags('','','');?></div>
            </div>
        </div>
<?php endwhile;
// 翻页
if (mc_has_new()) { ?>
<span class="prev"><?php mc_goto_new('上一页');?></span>
<?php }if (mc_has_old()) { ?>
<span class="next"><?php mc_goto_old('下一页');?></span>
<?php } ?>
<div class="clearer"></div>
<?php } ?>
</div><!-- end g-mn -->
<div class="g-ft"><span title="Copyright">&copy; <?php echo date('Y'); ?> </span><a href="https://www.idevs.cn/">设计笔记</a>
</br>鲁ICP备15020067号-1 . Powered by McBlog</div>
</div>
</body>
</html>
