<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}


function alternate_get_exchange_rate() {
    $exchangeRateValue = get_option('exchange_rate_value', 2); 

    $exchange_rate = $exchangeRateValue;

    return $exchange_rate;
}

function alternate_price_to_float($s) {

    $s = str_replace(',', '.', $s);

    $s = preg_replace("/[^0-9\.]/", "", $s);

    return (float) $s;
}

function alternate_convert_to_alternate_currency($price) {

    $rate = alternate_get_exchange_rate();

    $new_price = alternate_price_to_float($price) * $rate;

    return $new_price;
}


add_filter('wc_price', 'alternate_add_extra_price_to_price_html', 10, 3);

function alternate_add_extra_price_to_price_html($price_html, $price, $args) {

    $exchangeRateText = get_option('exchange_rate_text', 'Coffee');

    $alternate_price = alternate_convert_to_alternate_currency($price);

    $extra_price_html = "<span class='woocommerce-Price-amount amount'> " . __('or', 'alternate-pricing-display') . " $alternate_price $exchangeRateText</span>";

    $price_html .= $extra_price_html;

    return $price_html;
}




