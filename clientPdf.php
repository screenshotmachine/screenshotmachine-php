<?php
include('ScreenshotMachine.php');

$customer_key = "PUT_YOUR_CUSTOMER_KEY_HERE";
$secret_phrase = ""; //leave secret phrase empty, if not needed

$machine = new ScreenshotMachine($customer_key, $secret_phrase);

//mandatory parameter
$options['url'] = "https://www.google.com";

// all next parameters are optional, see our website to PDF API guide for more details
$options['paper'] = "letter";
$options['orientation'] = "portrait";
$options['media'] = "print";
$options['bg'] = "nobg";
$options['delay'] = "2000";
$options['scale'] = "50";

$pdf_api_url = $machine->generate_pdf_api_url($options);

//save PDF file
$output_file = 'output.pdf';
file_put_contents($output_file, file_get_contents($pdf_api_url));
echo 'PDF saved as ' . $output_file . PHP_EOL;
