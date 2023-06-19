<?php
/**
 * Plugin Name: WooCommerce Add to Cart Validation Test
 * Plugin Description: This plugin is for testing the add_to_cart_validation hook.  Activate it and two fields will be added to your product, allowing you to test various add to cart validation situations.
 */

class WC_Add_To_Cart_Validation_Test {

	private $form_submission = [
		'debug_fail_validation' => 'no',
		'debug_wc_notice'       => 'no',
		'errors'                => []
	];

	public function __construct() {
		// Just for testing, add the field on all products.
		$this->add_hooks();
	}

	public function add_hooks() {
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'display_custom_fields' ) );
		add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'on_add_to_cart_validation' ), 10, 3 );
		add_filter( 'woocommerce_add_cart_item_data', array( $this, 'add_cart_item_data' ), 10, 2 );
		add_filter( 'woocommerce_get_item_data', array( $this, 'get_item_data' ), 10, 2 );
		add_action( 'woocommerce_checkout_create_order_line_item', array(
			$this,
			'checkout_create_order_line_item'
		), 10, 4 );
	}

	public function display_custom_fields() {

		$submission_errors = $this->form_submission['errors'] ?? [];

		// Render the Fail Validation field. Use the value from the form submission if it exists.
		$debug_fail_validation = $this->form_submission['debug_fail_validation'] ?? 'no';
		echo '<div class="custom-field-wrapper">';
		echo '<label for="debug_fail_validation">Fail Validation:</label>';
		echo '<select name="debug_fail_validation" id="debug_fail_validation">';
		echo '<option value="no" ' . selected( $debug_fail_validation, 'no', false ) . '>No</option>';
		echo '<option value="yes" ' . selected( $debug_fail_validation, 'yes', false ) . '>Yes</option>';
		echo '</select>';
		echo '</div>';

		// If we have validation errors, display them.
		if ( !empty($submission_errors) ) {

			// Echo a div to wrap the errors.  Add inline styles to make it stand out.
			echo '<div class="custom-field-wrapper" style="border: 1px solid red; padding: 10px; margin-bottom: 10px;">';
			echo '<label for="debug_fail_validation">Validation Errors:</label>';
			echo '<ul>';
			foreach ( $submission_errors as $error ) {
				echo '<li>' . $error . '</li>';
			}
			echo '</ul>';
			echo '</div>';
		}

		// Render the Add Validation Error as WC Notice field. Use the value from the form submission if it exists.
		$debug_wc_notice = $this->form_submission['debug_wc_notice'] ?? 'no';
		echo '<div class="custom-field-wrapper">';
		echo '<label for="debug_wc_notice">Add Validation Error as WC Notice:</label>';
		echo '<select name="debug_wc_notice" id="debug_wc_notice">';
		echo '<option value="no" ' . selected( $debug_wc_notice, 'no', false ) . '>No</option>';
		echo '<option value="yes" ' . selected( $debug_wc_notice, 'yes', false ) . '>Yes</option>';
		echo '</select>';
		echo '</div>';

	}

	public function on_add_to_cart_validation( $passed, $product_id, $quantity ) {
		if ( ! $passed ) {
			return $passed;
		}

		// Get the debug values
		$debug_fail_validation = isset( $_POST['debug_fail_validation'] ) ? sanitize_text_field( $_POST['debug_fail_validation'] ) : 'no';
		$debug_wc_notice       = isset( $_POST['debug_wc_notice'] ) ? sanitize_text_field( $_POST['debug_wc_notice'] ) : 'no';

		// Store the debug values in the form submission array.
		$this->form_submission['debug_fail_validation'] = $debug_fail_validation;
		$this->form_submission['debug_wc_notice']       = $debug_wc_notice;

		// If debug_fail_validation is set to "yes", fail validation
		if ( 'yes' === $debug_fail_validation ) {

			// Add a validation error.
			$this->form_submission['errors'][] = 'Validation failed due to debug setting.  This is how an error could be displayed inlined.';

			// If debug_wc_notice is set to "yes", add a WC notice
			if ( 'yes' === $debug_wc_notice ) {
				wc_add_notice( 'Validation failed.  WC Notice Added.', 'error' );
			}

			return false;
		}

		return $passed;
	}

	public function add_cart_item_data( $cart_item_data, $product_id ) {
		// Get the debug values
		$debug_fail_validation = isset( $_POST['debug_fail_validation'] ) ? sanitize_text_field( $_POST['debug_fail_validation'] ) : 'no';
		$debug_wc_notice       = isset( $_POST['debug_wc_notice'] ) ? sanitize_text_field( $_POST['debug_wc_notice'] ) : 'no';

		// Add cart item data with the debug values.
		$cart_item_data['debug_fail_validation'] = $debug_fail_validation;
		$cart_item_data['debug_wc_notice']       = $debug_wc_notice;

		return $cart_item_data;
	}

	public function get_item_data( $item_data, $cart_item_data ) {
		$added_custom_data = false;
		if ( isset( $cart_item_data['debug_fail_validation'] ) ) {
			$item_data[] = array(
				'key'   => 'Fail Validation',
				'value' => $cart_item_data['debug_fail_validation']
			);

		}

		if ( isset( $cart_item_data['debug_wc_notice'] ) ) {
			$item_data[] = array(
				'key'   => 'Add Validation Error as WC Notice',
				'value' => $cart_item_data['debug_wc_notice']
			);


		}

		return $item_data;
	}

	public function checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
		if ( isset( $values['debug_fail_validation'] ) ) {
			$item->add_meta_data( 'Fail Validation', $values['debug_fail_validation'], true );
		}

		if ( isset( $values['debug_wc_notice'] ) ) {
			$item->add_meta_data( 'Fail Validation', $values['debug_wc_notice'], true );
		}
	}
}

new WC_Add_To_Cart_Validation_Test();
