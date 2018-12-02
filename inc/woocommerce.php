<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Sector
 */

namespace Sector\Template;

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function woocommerce_scripts() {
	wp_enqueue_style( 'sector-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'sector-woocommerce-style', $inline_font );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 *
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function woocommerce_products_per_page() {
	return 12;
}

add_filter( 'loop_shop_per_page', __NAMESPACE__ . '\woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function woocommerce_thumbnail_columns() {
	return 4;
}

add_filter( 'woocommerce_product_thumbnails_columns', __NAMESPACE__ . '\woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function woocommerce_loop_columns() {
	return 3;
}

add_filter( 'loop_shop_columns', __NAMESPACE__ . '\woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 *
 * @return array $args related products args.
 */
function woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', __NAMESPACE__ . '\woocommerce_related_products_args' );

/**
 * Product columns wrapper.
 *
 * @return  void
 */
function woocommerce_product_columns_wrapper() {
	$columns = woocommerce_loop_columns();
	echo '<div class="columns-' . absint( $columns ) . '">';
}

add_action( 'woocommerce_before_shop_loop', __NAMESPACE__ . '\woocommerce_product_columns_wrapper', 40 );

/**
 * Product columns wrapper close.
 *
 * @return  void
 */
function woocommerce_product_columns_wrapper_close() {
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', __NAMESPACE__ . '\woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', __NAMESPACE__ . '\woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', __NAMESPACE__ . '\woocommerce_output_content_wrapper_end', 10 );

/**
 * Before Content.
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @return void
 */
function woocommerce_wrapper_before() {
	?>
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
	<?php
}

add_action( 'woocommerce_before_main_content', __NAMESPACE__ . '\woocommerce_wrapper_before' );

/**
 * After Content.
 *
 * Closes the wrapping divs.
 *
 * @return void
 */
function woocommerce_wrapper_after() {
	?>
    </main><!-- #main -->
    </div><!-- #primary -->
	<?php
}

add_action( 'woocommerce_after_main_content', __NAMESPACE__ . '\woocommerce_wrapper_after' );

/**
 * Cart Fragments.
 *
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @param array $fragments Fragments to refresh via AJAX.
 *
 * @return array Fragments to refresh via AJAX.
 */
function woocommerce_cart_link_fragment( $fragments ) {
	ob_start();
	woocommerce_cart_link();
	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', __NAMESPACE__ . '\woocommerce_cart_link_fragment' );

/**
 * Cart Link.
 *
 * Displayed a link to the cart including the number of items present and the cart total.
 *
 * @return void
 */
function woocommerce_cart_link() {
	?>
    <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', SECTOR_DOMAIN_NAME ); ?>">
		<?php
		$item_count_text = sprintf(
		/* translators: number of items in the mini cart. */
			_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), SECTOR_DOMAIN_NAME ),
			WC()->cart->get_cart_contents_count()
		);
		?>
        <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
        <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
    </a>
	<?php
}

/**
 * Display Header Cart.
 *
 * @return void
 */
function woocommerce_header_cart() {
	if ( is_cart() ) {
		$class = 'current-menu-item';
	} else {
		$class = '';
	}
	?>
    <ul id="site-header-cart" class="site-header-cart">
        <li class="<?php echo esc_attr( $class ); ?>">
			<?php woocommerce_cart_link(); ?>
        </li>
        <li>
			<?php
			$instance = array(
				'title' => '',
			);

			the_widget( 'WC_Widget_Cart', $instance );
			?>
        </li>
    </ul>
	<?php
}
