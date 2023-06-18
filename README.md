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

## Instructions for Troubleshooting with the WooCommerce Add to Cart Validation Test Plugin
Clone or download the plugin: Visit the plugin's GitHub repository and click on the "Code" button. You can either clone the repository using Git or download the plugin as a ZIP file.

Install the plugin on your WooCommerce site:

If you downloaded the ZIP file, go to your WordPress Admin Dashboard and navigate to Plugins > Add New > Upload Plugin. Choose the downloaded ZIP file and click "Install Now".
If you cloned the repository, upload the plugin folder to the wp-content/plugins/ directory of your WordPress installation.
Activate the plugin: Once installed, you need to activate the plugin. Navigate to Plugins > Installed Plugins from your WordPress Admin Dashboard and find "WooCommerce Add to Cart Validation Test". Click on "Activate".

Configure the plugin on a per-product basis: Go to the edit page of the product that you want to debug. Below the "Add to Cart" button, you will find two new fields: "Fail Validation" and "Add Validation Error as WC Notice". Configure these fields as per your testing needs.

Run your tests: With the plugin activated and configured, proceed to add the product to the cart to initiate the validation test. Check if the AJAX "add to cart" features from your theme or builder fail as expected, based on your configuration.

Check the cart item data: If a product was successfully added to the cart, you can check the cart item data to see the values of "Fail Validation" and "Add Validation Error as WC Notice".

Remember, this plugin is for debugging purposes only and should not be used on a production site. Always deactivate and remove the plugin once you have finished your debugging/testing.

If you run into any issues or have any questions about using this plugin, please create an issue in the GitHub repository.

## Warning

This plugin is purely for debugging and testing purposes, and is **NOT** intended for use on production websites. Be sure to deactivate and remove this plugin once you've finished your debugging/testing, to avoid any unexpected behaviors or security vulnerabilities.

## Author

Lucas Stark
