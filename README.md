# WooCommerce Add to Cart Validation Test

## Overview

This is a debugging plugin for WooCommerce, designed specifically to test and debug the `woocommerce_add_to_cart_validation` filter. The plugin adds two fields ("Fail Validation" and "Add Validation Error as WC Notice") to each product on your site, allowing for flexible configuration of add to cart validation situations.

## Purpose

The purpose of this plugin is to ascertain whether simply returning `false` from the `woocommerce_add_to_cart_validation` filter could cause AJAX "add to cart" features from themes and builders (like Elementor, Astra, SideCart, and others) to fail under certain conditions, specifically when a WooCommerce notice is not added.

## Usage

To use this plugin, install and activate it on your WooCommerce website. Once activated, every product will have two new dropdown fields:

1. **Fail Validation**: Allows you to control whether the `woocommerce_add_to_cart_validation` filter should fail or not.
2. **Add Validation Error as WC Notice**: Allows you to control whether to add a WooCommerce notice when the validation fails.

Both fields default to "No".

In addition, the plugin also shows validation errors directly on the product page if validation fails.

## Warning

This plugin is purely for debugging and testing purposes, and is **NOT** intended for use on production websites. Be sure to deactivate and remove this plugin once you've finished your debugging/testing, to avoid any unexpected behaviors or security vulnerabilities.

## Author

Lucas Stark
