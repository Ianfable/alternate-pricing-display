<?php

if (!defined('ABSPATH')) {
    exit;
}


function alternate_pricing_admin_menu() {
    add_submenu_page(
        'options-general.php',
        'Alternate Pricing',
        'Alternate Pricing',
        'manage_options',
        'alternate-pricing-display-settings',
        'alternate_pricing_display_settings_page',
        99
    );
}

add_action('admin_menu', 'alternate_pricing_admin_menu');



function alternate_pricing_display_settings_page() {

if (isset($_POST['submit']) && check_admin_referer('exchange_rate_action', 'exchange_rate_nonce')) {
    update_option('exchange_rate_value', sanitize_text_field($_POST['exchange_rate_value']));
    update_option('exchange_rate_text', sanitize_text_field($_POST['exchange_rate_text']));
    echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
}


$exchangeRateValue = get_option('exchange_rate_value', 2); 
$exchangeRateText = get_option('exchange_rate_text', 'Coffee');

?>
<div class="wrap">
    <h2>Exchange Rate Settings</h2>
    <form method="post">
        <?php wp_nonce_field('exchange_rate_action', 'exchange_rate_nonce'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Exchange Rate Value</th>
                <td><input type="text" name="exchange_rate_value" value="<?php echo esc_attr($exchangeRateValue); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Exchange Rate Text</th>
                <td><input type="text" name="exchange_rate_text" value="<?php echo esc_attr($exchangeRateText); ?>" /></td>
            </tr>
        </table>
        <input type="submit" name="submit" class="button-primary" value="Save Settings">
    </form>
</div>

<?php
}