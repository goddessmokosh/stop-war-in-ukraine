<?php
if ( ! isset( $_GET['swiu'] ) ) return;

// Serve up https://www.bbc.com/russian/ to Russian IP addresses in overlay
function swiu_get_page($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7");
    $data = curl_exec($ch);
    curl_close($ch);
    $url_prefix = site_url('/?_wpnonce=' .  wp_create_nonce() . '&swiu=https://');
    $data = str_replace( "https://", $url_prefix, $data );
    $data = str_replace( 'href="/russian/', 'href="' . $url_prefix . 'www.bbc.com/russian/', $data);
    $mtype = mime_content_type2( basename( $url ) );
    ob_end_clean();
    header('Content-Type: ' . $mtype);
    return $data;
}

add_action( 'wp_enqueue_scripts', function() {

    // Check for swiu prefix URLs
    if ( isset( $_GET['swiu'] ) ) {

        if ( $_GET['swiu'] == 'blocked' ) {

            // Get a proxy page of https://bbc.com/russian
            echo swiu_get_page("https://www.bbc.com/russian");
            exit();

        }else{

            // Verify nonce, we don't serve up to just anyone
            if ( ! wp_verify_nonce( $_GET['_wpnonce'] ) ) {
                wp_die( 'Security check failed.' );
            }
            echo swiu_get_page( $_GET['swiu'] );
            exit();
        }
    }
    
} );

// Resolve mime type (used if PHP failed to do so)
function mime_content_type2($filename) {

    $mime_types = array(

        'map' => 'application/json',
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        'webp' => 'image/webp',

        // fonts
        'woff2' => 'font/woff2',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',

        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );
    $ext = explode('.', $filename);
    $ext = strtolower( array_pop( $ext ) );
    if (array_key_exists($ext, $mime_types)) {
        return $mime_types[$ext];
    } else {
        return 'text/html';
    }
}