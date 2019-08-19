<?php
include('ScreenshotMachine.php');

$customer_key = "PUT_YOUR_CUSTOMER_KEY_HERE";
$secret_phrase = ""; //leave secret phrase empty, if not needed

$machine = new ScreenshotMachine($customer_key, $secret_phrase);

//mandatory parameter
$options['url'] = "https://www.google.com";

// all next parameters are optional, see our API guide for more details
$options['dimension'] = "1366x768";  // or "1366xfull" for full length screenshot
$options['device'] = "desktop";
$options['format'] = "png";
$options['cacheLimit'] = "0";
$options['delay'] = "200";
$options['zoom'] = "100";

$api_url = $machine->generate_api_url($options);

//put link to your html code
echo '<img src="' . $api_url . '">' . PHP_EOL;

//or save screenshot as an image
$output_file = 'output.png';
file_put_contents($output_file, file_get_contents($api_url));
echo 'Screenshot saved as ' . $output_file . PHP_EOL;
