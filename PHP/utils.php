<?php

/**
 * Parse JSON datas
 *
 */
$array = '{"id": 1, "nickname": "manoz", "email": "hello@k-legrand.com", "mojo": ["coffee", "cats"]}';
$obj = json_decode($array);

echo $obj->nickname; //prints manoz
echo $obj->mojo[1];  //prints cats


/**
 * Parse XML datas
 *
 */
//xml string
$string = "<?xml version='1.0'?>
<users>
<user id='1'>
   <name>kevin</name>
   <email>hello@k-legrand.com</name>
</user>
<user id='2'>
   <name>manoz</name>
   <email>manoz@outlook.com</name>
</user>
</users>";

// Load the xml string using simplexml
$xml = simplexml_load_string( $string );

// Loop through the each node of user
foreach ( $xml->user as $user ) {
    //access attribute
    echo $user['id'], '  ';
    //subnodes are accessed by -> operator
    echo $user->name, '  ';
    echo $user->email, '<br />';
}


/**
 * Concat js and css files
 *
 */
function concat_files($files_array, $dest_dir, $dest_file) {

    // Continue only if file doesn't exist
    if ( !is_file( $dest_dir . $dest_file ) ) {
        $content = "";

        // Loop through array list
        foreach ( $files_array as $file) {
            // Read each file
            $content .= file_get_contents( $file );
        }

        // Open file for writing
        $new_file = fopen( $dest_dir . $dest_file, "w");

        // Write to destination
        fwrite( $new_file , $content );
        fclose( $new_file );

        // Output combined file
        return '<script src="'. $dest_dir . $dest_file.'"></script>';
    } else {
        // Use stored file
        // Output combine file
        return '<script src="'. $dest_dir . $dest_file.'"></script>';
    }
}

// Use like this
$files = array(
    'http://www.server.com/js/file-1.js',
    'http://www.server.com/js/file-2.js',
    'http://www.server.com/js/jquery.js',
    'http://www.server.com/js/modernizr.js'
);

echo concat_files( $files, 'minified_files/', md5( "my_mini_file" ) . ".js" );


/**
 * Detect browser language.
 * Perfect to build a simple multilangue website
 *
 */
function get_language( $availableLanguages, $default = 'en' ){
    if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
        $langs = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );

        foreach ( $langs as $value ){
            $choice = substr( $value, 0, 2 );
            if ( in_array( $choice, $availableLanguages ) ) {
                return $choice;
            }
        }
    }

    return $default;
}


/**
 * Shut the f*ck up jQuery migrate console.log in WordPress
 *
 * @return {string} adds a <script> tag with the silencer
 */
function shut_up_jquery_migrate() {
    // create function copy
    $silencer = '<script>window.console.logger = window.console.log; ';
    // modify original function to filter and use function copy
    $silencer .= 'window.console.log = function(tolog) {';
    // bug out if empty to prevent error
    $silencer .= 'if (tolog == null) {return;} ';
    // filter messages containing string
    $silencer .= 'if (tolog.indexOf("Migrate is installed") == -1) {';
    $silencer .= 'console.logger(tolog);} ';
    $silencer .= '}</script>';

    return $silencer;
}

/**
 * Use script_loader_tag filter for the front-end
 * @param  {string} $tag    The <script> tag for the enqueued script.
 * @param  {string} $handle The script's registered handle.
 * @return {string}         Return the new <script> tag
 */
add_filter('script_loader_tag', 'load_shut_up_jquery_migrate', 10, 2);
function load_shut_up_jquery_migrate($tag, $handle) {
    if ($handle == 'jquery-migrate') {
        $silencer = shut_up_jquery_migrate();
        // prepend to jquery migrate loading
        $tag = $silencer.$tag;
    }

    return $tag;
}

/**
 * Hook to admin_print_scripts for the back-end
 *
 */
add_action('admin_print_scripts','jquery_migrate_echo_silencer');
function jquery_migrate_echo_silencer() {
    echo shut_up_jquery_migrate();
}


/**
 * Determine the dominant color of an image.
 * You saw how Google handles his Google Image pictures?
 */
$img = imagecreatefromjpeg( "image.jpg" );

for ( $x = 0; $x < imagesx( $img ); $x++ ) {
    for ( $y = 0; $y < imagesy( $img ); $y++ ) {
        $rgb   = imagecolorat( $img, $x, $y );
        $red   = ( $rgb >> 16 ) & 0xFF;
        $green = ( $rgb >> 8 ) & 0xFF;
        $blue  = $rgb & 0xFF;

        $rTotal += $red;
        $gTotal += $green;
        $bTotal += $blue;
        $total++;
    }
}

$rAverage = round( $rTotal / $total );
$gAverage = round( $gTotal / $total );
$bAverage = round( $bTotal / $total );
