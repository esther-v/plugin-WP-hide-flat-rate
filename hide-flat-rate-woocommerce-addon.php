<?php
/*
Plugin Name: hide-flat-rate-woocommerce-addon
Plugin URI: https://wordpress-22165-esther.cloudclusters.net/
Description: Plugin pour frais livraison
Author: Esther 
Version: 1.0
Author URI: https://wordpress-22165-esther.cloudclusters.net/
*/

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
