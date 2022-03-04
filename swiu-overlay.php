<?php
if ( isset( $_GET['swiu'] ) ) return;

// List of default Russian IP addresses (https://www.countryipblocks.net/acl.php)
require_once __DIR__ . '/russian_ip_addresses.php';

/**
 * Check if a given ip is in a network, adapted from https://stackoverflow.com/a/26071962/2167966
 * and prefixed to prevent conflicts with similar named functions.
 * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
 * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
 * @return boolean true if the ip is in this range / false if not.
 */
function swiu_ip_in_range( $ip, $range ) {
    $ab = explode( '.', $ip );
    if ( strpos( $range, $ab[0] . "." . $ab[1]) !== 0 ) {
        return false;
    };
    $range = trim( $range );
    if ( strpos( $range, '/' ) === false ) {
        $range .= '/32';
    }
    // $range is in IP/CIDR format eg 127.0.0.1/24
    list( $range, $netmask ) = explode( '/', $range, 2 );
    $range_decimal = ip2long( $range );
    $ip_decimal = ip2long( $ip );
    $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
}

// Check IP address from list
global $swiu_ip_addresses;
$swiu_ip_addresses = explode("\n", $swiu_ip_addresses);

global $swiu_options;
$swiu_options = get_option( 'swiu_options_page', [] );
if ( isset( $swiu_options['swiu_test_checkbox'] ) ) {
    array_push( $swiu_ip_addresses, $swiu_options['swiu_test_hidden'] );
}

$is_russian_ip = false;
foreach($swiu_ip_addresses as $range) {
    if ( swiu_ip_in_range( $_SERVER['REMOTE_ADDR'], $range ) ) {
        // Check if dismissed
        $is_russian_ip = true;
        break;
    }
}

// If Russian/Belarusian IP address, display overlay
if ( $is_russian_ip ) {
    add_action('wp_footer', function() {
        ?>
        <style>
            #swiu_overlay {
                position:fixed;
                top:50%;
                left:50%;
                transform:translate(-50%, -50%);
                color: white; background: #666666;
                z-index: 1000;
                width: 98%;
                height: 88%;
                text-align: center;
            }
            #swiu_iframe {
                width: 100%;
                <?php 
                global $swiu_options;
                if ( ! isset( $swiu_options['swiu_donate_checkbox'] ) ): ?>
                height: 75%;
                <?php else: ?>
                height: 100%;
                <?php endif; ?>
            }
            #swiu_donate {
                text-align: center;
                width: 100%;
                height: 25%;
                background: center/80% url('<?php echo plugins_url('/images/ukraine-help.jpg', __FILE__); ?>');
            }
            #swiu_donate a {
                color: white;
                text-decoration: none;
            }
        </style>
        <div id="swiu_overlay">
            <?php
            global $swiu_options;
            if ( isset( $swiu_options['swiu_dismiss_checkbox'] ) ):
            ?>
            <div style="cursor: pointer;text-align: right;padding: 3px;" onClick="document.getElementById('swiu_overlay').remove();">закрыть окно ☒ </div>
            <?php else: ?>
                Мировые новости - Этот сайт заблокирован в России
            <?php endif; 
            // => string(2) "on" [""]=> string(2) "on" ["swiu_test_hidden"]=> string(9) "127.0.0.1" ["swiu_test_checkbox"]=> string(2) "on" } 
            if ( ! isset( $swiu_options['swiu_donate_checkbox'] ) ):
            ?>
            <div id="swiu_donate">
                <a href="https://www.icrc.org/ru/where-we-work/europe-central-asia/ukraine" target="_blank">
                    <span style="font-size:1.5em;"><span style="color:red;">✚</span>дарить</span><br/>
                    <h3>Украина</h3>
                    <p>
                        На территории Украины МККК помогает пострадавшим от конфликта на востоке страны, а также поддерживает работу Общества Красного Креста Украины
                    </p>
                </a>
            </div>
            <?php endif; ?>
            <iframe id="swiu_iframe" src="<?php echo site_url('/?swiu=blocked'); ?>">
            </iframe>
        </div>
        <?php
    }); 
}
return;
