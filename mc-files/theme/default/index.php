<?php if (!isset($mc_config)) exit;?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php if (mc_is_post() || mc_is_page()) { mc_the_title();?> - <?php mc_site_name();} else { mc_site_name();?> - <?php mc_site_desc();}?></title>
<link type="image/vnd.microsoft.icon" href="<?php mc_theme_url('images/favicon.png');?>" rel="shortcut icon">
<link href="<?php mc_theme_url('style.css');?>" type="text/css" rel="stylesheet"/>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<header id="header">
<h1 class="title">
<a href="<?php mc_site_link('');?>"><?php mc_site_name();?></a>
<span class="desc"><?php mc_site_desc();?></span>
</h1>
<ul class="nav">
<li><a href="<?php mc_site_link('');?>">首页</a></li>
<li><a href="<?php mc_site_link('/?about/');?>">关于</a></li>
<li><a href="<?php mc_site_link('/?archive/');?>">存档</a></li>
<li><a target="_blank" href="<?php mc_site_link('/?rss/');?>">订阅</a></li>
</ul>
</header>
<main id="main">
	<section class="post">
		<?php if (mc_is_post()||mc_is_page()) { ?>
				<h2><?php mc_the_link();?></h2>
				<article class="single">
					<?php mc_the_content();if(!mc_is_page());?>
				</article>
		<?php if (mc_can_comment()&&mc_comment_code()){?>
			<div class="comment">
				评论
				<?php echo mc_comment_code();?>
			</div>
		<?php }
		 } else if (mc_is_archive()) { // 归档 ?>
		<div class="archive">
			<div class="list left">
				<h3>月份</h3>
				<ul>
				<?php mc_date_list();?>
				</ul>
			</div>
			<div class="list right">
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
				<div >
					<h2><?php mc_the_link();?></h2>
					<?php mc_the_thumbnail();mc_the_excerpt('200');?>
					<div class="info">
						<div class="time"><?php mc_the_date();?></div>
						<div class="tags"><?php mc_the_tags('','','');?></div>
					</div>
				</div>
		<?php endwhile;?>
		<nav class="navigator">
		<?php if(mc_has_new()){mc_goto_new('上一页');}
			  if(mc_has_old()){mc_goto_old('下一页');}?>
		</nav>
			<div class="clearer"></div>
		<?php } ?>
	</section>
</main>
<div class="clearer"></div>
<footer id="footer">
Theme is NewWord . Powered by McBlog</br>
&copy; <?php echo date('Y'); ?> <a href="https://www.idevs.cn/">设计笔记</a><?php mc_site_icp();?>
</footer>
</body>
</html>
