=== CartRules One Brand in Cart for WooCommerce ===
Contributors: businessbloomer
Tags: woocommerce, cart, product brand, restrict cart, checkout
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin ensures customers can only buy products from one brand at a time.

== Description ==

This plugin stops customers from mixing products from different brands in the same order. If a product is already in the cart, adding a product from a different brand will either be blocked, or the cart will be emptied first, depending on the option you choose.

This is useful for stores that need to keep certain brands separate at checkout, for example because they need different shipping, come from different suppliers, or are fulfilled differently.

Once activated, go to WooCommerce > Settings > CartRules > One Brand in Cart to turn the restriction on and choose what should happen.

Works with both the classic, shortcode-based cart and checkout, and the newer WooCommerce Cart and Checkout blocks.

= Why upgrade to CartRules PRO? =

This plugin only restricts the cart by brand. CartRules One in Cart PRO replaces it, and every other free CartRules plugin, with a single plugin that handles every rule type and gives you more control over how each one behaves.

**Every rule type, in one plugin**

* Category, tag, brand, shipping class, product type, any custom taxonomy, or individual products, instead of installing a separate plugin per rule type.
* Unlimited rules, each with its own settings, managed from one screen: WooCommerce > Settings > CartRules > One in Cart PRO.

**More control per rule**

* Scope a rule to specific groups instead of "any one at a time" (for example, only keep "Gift Cards" separate, and let everything else mix freely).
* Choose what happens when a rule is broken: block the new product with a message, or empty the cart and add it, decided separately for each rule.
* Flags other cart restrictions already running on your store, whether from a free CartRules plugin or your own custom code, so two rules never silently conflict.
* Works with both the classic cart and checkout and the WooCommerce Cart and Checkout blocks.

[Get CartRules One in Cart PRO →](https://cartrules.com/product/cartrules-one-in-cart-pro/)

== Frequently Asked Questions ==

= Is there a version that combines multiple rule types? =

Yes. CartRules One in Cart PRO lets you combine category, tag, brand, shipping class, and product type restrictions in one plugin, with unlimited rules and more advanced conditions.

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

= 1.0.2 =
* New icon
* Added an "Upgrade to CartRules PRO" section to the description and settings page

= 1.0.1 =
* Fixed the deny/replace notice showing up blank when the restriction is enabled without saving the settings screen first (e.g. via WP-CLI)

= 1.0.0 =
* Initial release
