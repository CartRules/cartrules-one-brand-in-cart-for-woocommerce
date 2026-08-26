<?php

defined( 'ABSPATH' ) || exit;

/**
 * Blocks or replaces cart contents when a product from a different brand is added.
 */
class CartRules_OBIC_Cart_Restriction {

	/**
	 * Cart item keys staged for removal in "replace" mode, keyed by the product id that
	 * triggered the replacement. Populated during validation, consumed by handle_replace().
	 *
	 * @var array<int, array{cart_item_keys: string[], brand_name: string}>
	 */
	private $pending_replacements = array();

	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'validate_add_to_cart' ), 10, 2 );
		add_action( 'woocommerce_add_to_cart', array( $this, 'handle_replace' ), 10, 2 );
	}

	/**
	 * Other plugins may also hook woocommerce_add_to_cart_validation. Removing cart items here
	 * instead of in handle_replace() would mutate the cart mid-filter-chain, so a plugin
	 * validating later would see an already-emptied cart and skip its own check.
	 *
	 * @param bool $passed
	 * @param int  $product_id
	 * @return bool
	 */
	public function validate_add_to_cart( $passed, $product_id ) {
		if ( ! $passed || 'yes' !== get_option( 'cartrules_obic_enabled', 'no' ) || WC()->cart->is_empty() ) {
			return $passed;
		}

		$new_brands = $this->get_product_brand_ids( $product_id );

		if ( empty( $new_brands ) ) {
			return $passed;
		}

		$cart_brands = array();

		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$cart_brands = array_merge( $cart_brands, $this->get_product_brand_ids( $cart_item['product_id'] ) );
		}

		$cart_brands = array_values( array_unique( $cart_brands ) );

		if ( empty( $cart_brands ) || array_intersect( $new_brands, $cart_brands ) ) {
			return $passed;
		}

		$existing_brand_name = $this->get_brand_name( $cart_brands[0] );

		if ( 'replace' === get_option( 'cartrules_obic_mode', 'deny' ) ) {
			$this->pending_replacements[ $product_id ] = array(
				'cart_item_keys' => array_keys( WC()->cart->get_cart() ),
				'brand_name'     => $existing_brand_name,
			);

			return true;
		}

		wc_add_notice( $this->build_deny_message( $existing_brand_name ), 'error' );

		return false;
	}

	/**
	 * Runs once WooCommerce has actually added the new item to the cart, so every plugin
	 * hooked into the validation filter has already had a chance to evaluate the original cart.
	 *
	 * @param string $cart_item_key
	 * @param int    $product_id
	 */
	public function handle_replace( $cart_item_key, $product_id ) {
		if ( ! isset( $this->pending_replacements[ $product_id ] ) ) {
			return;
		}

		$replacement = $this->pending_replacements[ $product_id ];
		unset( $this->pending_replacements[ $product_id ] );

		foreach ( $replacement['cart_item_keys'] as $conflicting_item_key ) {
			WC()->cart->remove_cart_item( $conflicting_item_key );
		}

		wc_add_notice( $this->build_replace_message( $replacement['brand_name'] ), 'notice' );
	}

	/**
	 * The message options are only ever written to the database when the settings screen is
	 * saved, so get_option() needs the same fallback the settings screen shows in the
	 * textarea by default -- otherwise enabling this via wp_cli/wp option update, or a site
	 * migration that drops the option row, silently produces a blank notice.
	 */
	private function build_deny_message( $brand_name ) {
		$default = __( 'You already have products from "{brand}" in your cart. Please remove them first, or complete that order separately.', 'cartrules-one-brand-in-cart-for-woocommerce' );

		return str_replace( '{brand}', $brand_name, get_option( 'cartrules_obic_deny_message', $default ) );
	}

	private function build_replace_message( $brand_name ) {
		$default = __( 'Your cart contained products from "{brand}", so we replaced them with your new selection.', 'cartrules-one-brand-in-cart-for-woocommerce' );

		return str_replace( '{brand}', $brand_name, get_option( 'cartrules_obic_replace_message', $default ) );
	}

	private function get_product_brand_ids( $product_id ) {
		$terms = get_the_terms( $product_id, 'product_brand' );

		if ( ! $terms || is_wp_error( $terms ) ) {
			return array();
		}

		return wp_list_pluck( $terms, 'term_id' );
	}

	private function get_brand_name( $term_id ) {
		$term = get_term( $term_id, 'product_brand' );

		return $term && ! is_wp_error( $term ) ? $term->name : '';
	}
}
