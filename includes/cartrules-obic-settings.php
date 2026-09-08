<?php

defined( 'ABSPATH' ) || exit;

/**
 * Adds this module's "One Brand in Cart" section to the shared "CartRules" tab.
 */

add_filter( 'woocommerce_get_sections_cartrules', 'cartrules_obic_add_settings_section' );
add_filter( 'woocommerce_get_settings_cartrules', 'cartrules_obic_settings_fields', 10, 2 );

function cartrules_obic_add_settings_section( $sections ) {
	$sections['obic'] = __( 'One Brand in Cart', 'cartrules-one-brand-in-cart-for-woocommerce' );

	return $sections;
}

function cartrules_obic_settings_fields( $settings, $section_id ) {
	if ( 'obic' !== $section_id ) {
		return $settings;
	}

	return array(
		array(
			'title' => __( 'One Brand in Cart', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'type'  => 'title',
			/* translators: %s: link to the CartRules PRO plugin page. */
			'desc'  => sprintf(
				__( 'Prevent customers from mixing products from different brands in the same cart. Need more control? %1$s puts every cart rule (category, tag, brand, shipping class, product type) in one place. Each rule can target specific brands instead of "any one at a time" (for example, only keep "Gift Cards" separate), and you get unlimited custom rules with full control over when each one applies. It also checks for other cart restrictions already running on your store, whether from another CartRules plugin or your own custom code, so nothing quietly conflicts.', 'cartrules-one-brand-in-cart-for-woocommerce' ),
				'<a href="https://cartrules.com/product/cartrules-one-in-cart-pro/" target="_blank" rel="noopener noreferrer">CartRules One in Cart PRO</a>'
			),
			'id'    => 'cartrules_obic_settings_title',
		),
		array(
			'title'   => __( 'Enable restriction', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'desc'    => __( 'Only allow products from one brand in the cart at a time', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'id'      => 'cartrules_obic_enabled',
			'default' => 'no',
			'type'    => 'checkbox',
		),
		array(
			'title'   => __( 'When a different brand is added', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'desc'    => __( 'Choose what happens when a customer tries to add a product from a different brand', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'id'      => 'cartrules_obic_mode',
			'default' => 'deny',
			'type'    => 'select',
			'class'   => 'wc-enhanced-select',
			'options' => array(
				'deny'    => __( 'Block the new product and show an error', 'cartrules-one-brand-in-cart-for-woocommerce' ),
				'replace' => __( 'Empty the cart first, then add the new product', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			),
		),
		array(
			'title'    => __( 'Blocked message', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'desc_tip' => __( 'Shown when a product is blocked. Use {brand} for the brand already in the cart.', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'id'       => 'cartrules_obic_deny_message',
			'default'  => __( 'You already have products from "{brand}" in your cart. Please remove them first, or complete that order separately.', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'type'     => 'textarea',
			'css'      => 'width:100%; height: 75px;',
		),
		array(
			'title'    => __( 'Replaced message', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'desc_tip' => __( 'Shown when the cart is emptied and replaced. Use {brand} for the brand that was removed.', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'id'       => 'cartrules_obic_replace_message',
			'default'  => __( 'Your cart contained products from "{brand}", so we replaced them with your new selection.', 'cartrules-one-brand-in-cart-for-woocommerce' ),
			'type'     => 'textarea',
			'css'      => 'width:100%; height: 75px;',
		),
		array(
			'type' => 'sectionend',
			'id'   => 'cartrules_obic_settings_end',
		),
	);
}
