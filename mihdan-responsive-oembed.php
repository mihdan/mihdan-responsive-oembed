<?php
/**
 * Plugin Name: Mihdan: Responsive oEmbed
 * Description: WordPress-плагин, который делает отзывчивые oembed внутри постов
 *
 * GitHub Plugin URI: https://github.com/mihdan/mihdan-responsive-oembed
 *
 * @package mihdan-responsive-oembed
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Добавить обёртку для всех embed внутри поста
 * Нужно для создания отзывчивых видосов
 *
 * @param string $html html с embed
 *
 * @return string
 */
function mihdan_responsive_oembed_set_wrapper( $html ) {

	// Работаем только на синглах
	if ( is_singular( ) ) {
		$html = sprintf( '<div class="mihdan-responsive-oembed-wrapper">%s</div>', $html );
	}

	return $html;
}
add_filter( 'oembed_result', 'mihdan_responsive_oembed_set_wrapper' );

/**
 * Добавляем свои стили в шапку сайта,
 * в которых и заключена вся "магия" решения
 */
function mihdan_responsive_oembed_add_styles() {
	$custom_css = '
		.mihdan-responsive-oembed-wrapper {
			position: relative;
			padding-bottom: 56.25%; /* 16:9 */
			padding-top: 25px;
			margin-bottom: 15px;
			height: 0;
			background-color: #ddd;
		}
		.mihdan-responsive-oembed-wrapper iframe,
		.mihdan-responsive-oembed-wrapper object,
		.mihdan-responsive-oembed-wrapper embed {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	';
	wp_add_inline_style( 'mihdan_responsive_oembed_styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'mihdan_responsive_oembed_add_styles' );
// eof;
