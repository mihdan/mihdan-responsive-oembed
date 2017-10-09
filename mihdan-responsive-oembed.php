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
function mihdan_set_embed_wrapper( $html ) {

	// Работаем только на синглах
	if ( is_singular( ) ) {
		$html = sprintf( '<div class="post-embed-wrapper">%s</div>', $html );
	}

	return $html;
}
add_filter( 'oembed_result', 'mihdan_set_embed_wrapper' );
// eof;
