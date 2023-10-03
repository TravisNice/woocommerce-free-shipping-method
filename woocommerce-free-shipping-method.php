<?php
/**
 *  Plugin Name:       WooCommerce Free Shipping Method
 *  Description:       Hide shipping rates when "Free Shipping" is available, but keep "Local pickup". Supports WooCommerce 2.6 Shipping Zones.
 *  Version:           1.0.0
 *  Tested up to:      6.1.1
 *  Requires at least: 5.2
 *  Requires PHP:      7.2
 *  Author:            Travis J. Nice
 *  Author URI:        https://design.nice.id.au/
 *  Licence:           GPL v3 or later
 *  Licence URI:       https://www.gnu.org/licences/gpl-3.0.html
 *
 *  @package           woocommerce-free-shipping-method
 *  @author            Travis J. Nice
 */

function hide_shipping_when_free_is_available( $rates, $package ) {
	$new_rates = array();

	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id || 'local_pickup' === $rate->method_id ) {
			$new_rates[ $rate_id ] = $rate;
		}
	}
  
	return ( !empty( $new_rates ) ) ? $new_rates : $rates;
}

add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );
