<?php

$thisfile = basename(__FILE__, ".php");

register_plugin(
	$thisfile, 
	'Theme Highlighter', 	
	'0.9.3', 		
	'Martin Vlcek',
	'http://mvlcek.bplaced.net', 
	'Syntax highlighting when editing themes and components',
	'',
	''  
);

add_action('header','theme_highlighter_header');
add_action('footer','theme_highlighter_footer');

function theme_highlighter_header(){
  if (basename($_SERVER['PHP_SELF']) == 'components.php' || basename($_SERVER['PHP_SELF']) == 'theme-edit.php') {
    include(GSPLUGINPATH.'theme_highlighter/header.php');
  }
}

//only displayed at the theme edit page
function theme_highlighter_footer() {
  if (basename($_SERVER['PHP_SELF']) == 'components.php' || basename($_SERVER['PHP_SELF']) == 'theme-edit.php') {
    include(GSPLUGINPATH.'theme_highlighter/footer.php');
  }
}

