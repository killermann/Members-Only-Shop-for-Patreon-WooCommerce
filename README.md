# Members-Only Shop for Patreon + WooCommerce

Offer exclusive products in a WooCommerce Shop to your Patreon patrons.

![Plugin Settings](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce/blob/master/assets/screenshot-1.png)

## Description

A plugin that bridges the gap between two others -- Patreon and WooCommerce -- to allow you to easily restrict a section of your WooCommerce store for your active Patrons.

## Installation

Installation is easy.

1. Upload the plugin files to the `/wp-content/plugins/members-only-patreon-woocommerce` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings -> Members-Only Shop to add your Patreon details, and customize the plugin settings
4. Add the products you want to restrict to a "Members Only" category (default, but can be changed)
5. Enjoy providing exclusive items to people supporting your work


## Frequently Asked Questions

### Will this work with a different e-commerce plugin than WooCommerce?

Nope.

### Will this work with a different membership plugin than Patreon?

Nope.

### Can I use [blank] custom checkout plugin?

Maybe. It depends on how that checkout plugin integrates with WooCommerce. Test it and find out. The only checkout I'm sure it works with is the standard WooCommerce checkout.

### I want this to do something that it doesn't do.

First of all, that's not a question. Second of all, it's open source: you can make it do whatever you want. If you make it do something cool, and you want to share with the rest of the class, let me know on [github](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce).

### Do you offer support?

Nope. You're on your own, friend.

## Screenshots

Plugin settings (all optional) to configure once you install. The "Product Category Slug" is the category of your shop that's for Patreon members only.

![Plugin Settings](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce/blob/master/assets/screenshot-1.png)

If someone adds a members-only product to the shopping cart (and isn't logged in with Patreon), they'll get this warning (output is standard WooCommerce notice, styled by whatever theme you're using).

![Cart Error](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce/blob/master/assets/screenshot-2.png)

If they try to check out, WooCommerce will show this error instead of the checkout steps, and prevent them from continuing.

![Checkout Error](https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce/blob/master/assets/screenshot-3.png)

## Changelog

### 0.2
* Options page that includes custom Patreon link
* Choose a different Product Category for the members-only section
