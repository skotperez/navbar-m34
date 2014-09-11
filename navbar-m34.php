<?php
/*
Plugin Name: Navigation bar m34
Description: This plugin allows you to create a navigation bar for a network of federated websites.
Version: 0.1
Author: montera34
Author URI: http://montera34.com
License: GPLv2+
*/

/* EDIT THIS VARS TO CONFIG THE PLUGIN */
$m34navbar_logo_src = plugins_url( 'images/jusdolive.navbar.png' , __FILE__);
$m34navbar_logo_alt = "jusdolive logo";
$m34navbar_main_url = "http://jusdolive.fr";
/* STOP EDIT */

// plugin main activation function
//register_activation_hook( __FILE__, 'm34glossary_activate' );
//function m34glossary_activate() {

	if (!defined('M34NAVBAR_LOGO_SRC')) define('M34NAVBAR_LOGO_SRC', $m34navbar_logo_src);
	if (!defined('M34NAVBAR_LOGO_ALT')) define('M34NAVBAR_LOGO_ALT', $m34navbar_logo_alt);
	if (!defined('M34NAVBAR_MAIN_URL')) define('M34NAVBAR_MAIN_URL', $m34navbar_main_url);

	/* Load map JavaScript and styles */
	add_action( 'wp_enqueue_scripts', 'm34navbar_scripts_styles' );

	/* Output navbar */
	add_action( 'wp_footer', 'm34navbar_output',999 );
	/* Output extra styles */
	add_action( 'wp_head', 'm34navbar_extra_styles',9999 );
//} // END plugin main activation function

// Register styles and scripts
function m34navbar_scripts_styles() {
	wp_enqueue_style( 'm34navbar-css',plugins_url( 'style/m34navbar.css' , __FILE__) );
	wp_enqueue_style( 'm34navbar-fonts-css',plugins_url( 'fonts/stylesheet.css' , __FILE__) );
	wp_enqueue_script(
		'm34navbar-js',
		plugins_url( 'js/m34navbar.js' , __FILE__),
		array('jquery'),
		'0.1',
		TRUE
	);
} // END register scripts and styles

// Output extra styles
function m34navbar_extra_styles() {

	if ( is_admin_bar_showing() ) { $mtop = "67"; $top = "32"; } else { $mtop = "35"; $top = "0"; }
	$m34navbar_extra_style = "<style media='print' type='text/css'>#m34navbar-galaxy{display:none;}</style>";
	$m34navbar_extra_style .= "<style media='screen' type='text/css'>html,* html body {margin-top: " .$mtop. "px !important;}#m34navbar-galaxy{ top: " .$top. "px;}</style>";
	echo $m34navbar_extra_style;
} // END output extra styles

// Generate navbar output
function m34navbar_output() {

	$navbar_output = "
	<nav id='m34navbar-galaxy'>
		<div class='galaxy-limit'>
			<div class='galaxy-system'>
				<a class='sun' href='" .M34NAVBAR_MAIN_URL. "'><img src='" .M34NAVBAR_LOGO_SRC. "' alt='" .M34NAVBAR_LOGO_ALT. "' /></a>
			</div><!-- .galaxy-system -->
			<a class='system-star' href='#'>&#59236;</a>
			<div class='galaxy-system-dark'>
				<ul id='planet-social' class='system-planet planet-left'>
					<li><a href='http://twitter.com/jusdolive' title='Twitter'>&#62217;</a></li>
					<li><a href='http://www.facebook.com/jusdolivemagazine' title='Facebook'>&#62222;</a></li>
					<li><a href='http://plus.google.com/102425984237162038524' title='Google Plus'>&#62223;</a></li>
					<li><a href='http://fr.linkedin.com/in/cecilelegalliard' title='Linkedin'>&#62232;</a></li>
				</ul><!-- .system-planet -->
				<ul id='planet-1' class='system-planet planet-right'>
					<li class='planet-1-1'><a href='http://guide.jusdolive.fr/pro'>Guide de professionels</a></li>
					<li class='planet-1-2'><a href='http://jusdolive.fr/actualites'>Magazine d'actualites</a></li>
					<li class='planet-1-3' ><a href='http://glossaire.jusdolive.fr'>Glossaire</a></li>
				</ul><!-- .system-planet -->
				<ul id='planet-2' class='system-planet planet-right'>
					<li><a href='http://jusdolive.fr/about'>À propos</a></li>
					<li><a href='http://jusdolive.fr/services'>Services</a></li>
					<li><a href='http://jusdolive.fr/contact'>Contact</a></li>
				</ul><!-- .system-planet -->
			</div><!-- .galaxy-system-dark -->
		</div><!-- .galaxy-limit -->
	</nav>
	";
	echo $navbar_output;
} // END generate navbar output

?>
