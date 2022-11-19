<?php

if (! function_exists('andreevd_setup')){
	function andreevd_setup() {
		//добавляем кастомный логотип
		add_theme_support( 'custom-logo', [
			'height'      => 50,
			'width'       => 130,
			'flex-width'  => false,
			'flex-height' => false,
			'header-text' => '',
			'unlink-homepage-logo' => false, // WP 5.5
		] );
		// добавляем диднамический <title>
		add_theme_support('title-tag');
	}
	add_action('after_setup_theme', 'andreevd_setup');
}

/* Подкллючение стилей */


// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'andreevd_scripts' );

function andreevd_scripts() {
	wp_enqueue_style( 'main', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array('main'), null);
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array('main'), null);

	wp_enqueue_style( 'animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array('bootstrap'), null);
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array('bootstrap'), null);
  wp_enqueue_style( 'andreevd', get_template_directory_uri() . '/css/style.css', array('icofont'), null);
	//переподключаем JQuery

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'contact', get_template_directory_uri() . '/plugins/jquery/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
}

/**
 * Регистрация новых областей меню
 */
function andreevd_menus() {
// собираем несколько областей меню
	$locations = array(
		'header'  => __( 'Header menu', 'andreevd' ),
		'footer'   => __( 'Footer Menu', 'andreevd' ),
	);
// регистрируем области меню, которые лежат в переменной locations
	register_nav_menus( $locations );
}
// хук событие
add_action( 'init', 'andreevd_menus' );

// добавим класс nav-item ко всем пунктам меню с помощью филтров
add_filter