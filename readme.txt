=== CartRules One Brand in Cart for WooCommerce ===
Contributors: businessbloomer
Tags: woocommerce, cart, product brand, restrict cart, checkout
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin ensures customers can only buy products from one brand at a time.

== Description ==

This plugin stops customers from mixing products from different brands in the same order. If a product is already in the cart, adding a product from a different brand will either be blocked, or the cart will be emptied first, depending on the option you choose.

This is useful for stores that need to keep certain brands separate at checkout, for example because they need different shipping, come from different suppliers, or are fulfilled differently.

Once activated, go to WooCommerce > Settings > CartRules > One Brand in Cart to turn the restriction on and choose what should happen.

Works with both the classic, shortcode-based cart and checkout, and the newer WooCommerce Cart and Checkout blocks.

== Frequently Asked Questions ==

= Which "brand" does this plugin use? =

WooCommerce's own built-in Product Brands feature (the native `product_brand` taxonomy, part of WooCommerce core since version 9.6). It does not read brand data from third-party brand plugins.

= What happens if a product isn't assigned a brand? =

It's not restricted. Only products that have a brand assigned are checked against what's already in the cart.

= What happens if a product belongs to more than one brand? =

It's allowed, as long as it shares at least one brand with what's already in the cart.

= Does this work with variable products? =

Yes, it works with all product types.

= Does this work with the WooCommerce Cart and Checkout blocks, or only the classic shortcode-based cart? =

Both. The restriction is applied when a product is added to the cart, so it works the same way whether your store uses the classic cart/checkout pages or the block-based versions.

= Does this affect orders created or edited from wp-admin? =

No, the restriction only applies to the storefront cart. Orders added or changed from wp-admin are not affected.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`, or install it through the Plugins menu in WordPress directly.
2. Activate the plugin through the Plugins menu in WordPress.
3. Go to WooCommerce > Settings > CartRules > One Brand in Cart to turn the restriction on and choose what should happen.

== Changelog ==

= 1.0.1 =
* Fixed the deny/replace notice showing up blank when the restriction is enabled without saving the settings screen first (e.g. via WP-CLI)

= 1.0.0 =
* Initial release
