<?php

class ScreenshotMachine
{
    private $customer_key;
    private $secret_phrase;
    private $screenshot_base_url = "https://api.screenshotmachine.com/?";
    private $pdf_base_url = "https://pdfapi.screenshotmachine.com/?";

    public function __construct($customer_key, $secret_phrase)
    {
        $this->customer_key = $customer_key;
        $this->secret_phrase = $secret_phrase;
    }

    public function generate_screenshot_api_url($options)
    {
        return $this->generate_api_url($this->screenshot_base_url, $options);
    }

    public function generate_pdf_api_url($options)
    {
        return $this->generate_api_url($this->pdf_base_url, $options);
    }

    private function generate_api_url($base_url, $options)
    {
        $result = $base_url . "key=" . $this->customer_key;
        foreach ($options as $param => $value) {
            if (!$this->is_null_or_empty($value)) {
                $result = $result . '&' . $param . '=';
                if (strcmp("url", $param) == 0) {
                    $result = $result . urlencode($value);
                } else {
                    $result = $result . $value;
                }
            }
        }
        if (!$this->is_null_or_empty($this->secret_phrase)) {
            $result = $result . '&hash=' . md5($options['url'] . $this->secret_phrase);
        }
        return $result;
    }

    private function is_null_or_empty($str)
    {
        return (!isset($str) || trim($str) === '');
    }
}
