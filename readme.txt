=== Members-Only Shop for Patreon + WooCommerce ===
Contributors: killermann
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TAST5BG3L246S
Tags: patreon, woocommerce, members-only
Requires at least: 3.8
Tested up to: 4.9
Stable tag: trunk
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Offer exclusive products in a WooCommerce Shop to your Patreon patrons.

== Description ==

A plugin that bridges the gap between two others -- Patreon and WooCommerce -- to allow you to easily restrict a section of your WooCommerce store for your active Patrons.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Members-Only Shop to add your Patreon details, and configure the plugin
4. Add the products you want to restrict to a "Members Only" category (default, but can be customized)
5. Enjoy providing exclusive items to people supporting your work


== Frequently Asked Questions ==

= Will this work with a different e-commerce plugin than WooCommerce? =

Nope.

= Will this work with a different membership plugin than Patreon? =

Nope.

= Can I use [blank] custom checkout plugin? =

Maybe. It depends on how that checkout plugin integrates with WooCommerce. Test it and find out. The only checkout I'm sure it works with is the standard WooCommerce checkout.

= I want this to do something that it doesn't do. =

First of all, that's not a question. Second of all, it's open source: you can make it do whatever you want. If you make it do something cool, and you want to share with the rest of the class, let me know on [github](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce).

= Do you offer support? =

Nope. You're on your own, friend.

== Screenshots ==

1. Plugin settings (all optional) to configure once you install. The "Product Category Slug" is the category of your shop that's for Patreon members only.
2. If someone adds a members-only product to the shopping cart (and isn't logged in with Patreon), they'll get this warning (output is standard WooCommerce notice, styled by whatever theme you're using).
3. If they try to check out, WooCommerce will show this error instead of the checkout steps, and prevent them from continuing.

== Changelog ==

= 0.2 =
* Options page that includes custom Patreon link
* Choose a different Product Category for the members-only section
