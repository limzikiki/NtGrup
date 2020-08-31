<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php get_page_clean_title(); ?> &lt; <?php get_site_name(); ?></title>
<?php get_header(); ?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php get_theme_url(); ?>/style.css" TYPE="text/css" MEDIA=screen>
</head>

<body>
<div id="page">
	<div id="header">
	      <div id="langmenu">
		    <ul>
			<li><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('en')); ?>"><img src="data/uploads/flags/gb.png"  border="0"></a></li>
			<li><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('lv')); ?>"><img src="data/uploads/flags/lv.png"  border="0"></a></li>
			<li><a href="<?php echo htmlspecialchars(return_i18n_setlang_url('ru')); ?>"><img src="data/uploads/flags/ru.png"  border="0"></a></li>
			<li><a href="http://translate.google.lv/translate?hl=ru&sl=en&tl=fr&u=http%3A%2F%2Fwww.ntgrup.lv%2F"><img src="data/uploads/flags/fr.png"  border="0"></a></li>
			<li><a href="http://translate.google.lv/translate?hl=ru&sl=en&tl=de&u=http%3A%2F%2Fwww.ntgrup.lv%2F"><img src="data/uploads/flags/de.png"  border="0"></a></li>
		  </ul>
	       </div>
	  <?php /* ?><h1><a href="<?php  get_site_url();  ?>"><?php get_site_name(); ?></a></h1><?php */ ?> 
	</div>
	
	<div id="mainarea">
	<div id="sidebar">
		<div id="sidebarnav">
		<ul>
		    <?php get_i18n_navigation(return_page_slug(),0,2,I18N_SHOW_MENU); ?>
		</ul>
		<div class="share42init"></div>
<script type="text/javascript" src="share42/share42.js"></script>
		</div>
		
	</div>
	
	<div id="contentarea">
		<h2><?php get_page_title(); ?></h2>
		<?php get_page_content(); ?>
	
	</div>
	
	
	</div>
	
	<div id="footer">
	  <div id="footer-contacts">
	    Email: ntgrupa@gmail.com<br>
	    Mob: +37129792040<br>
	    Tel / Fax: +37167610788<br>
	  </div>
	  <div id="copyright">
	    Ntgrup.lv &copy; Copyright&nbsp;<?php get_site_name(); ?>&nbsp;<?php echo date('Y'); ?>,
	    Design &amp; Development by <a href="http://www.wls.lv" target="_blank">Web line Studio</a>
	  </div>
	</div>


</div>
</body>

</html>