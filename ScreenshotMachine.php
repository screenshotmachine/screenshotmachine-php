<?php

class ScreenshotMachine
{
    private $customer_key;
    private $secret_phrase;
    private $api_base_url = "https://api.screenshotmachine.com/?";

    public function __construct($customer_key, $secret_phrase)
    {
        $this->customer_key = $customer_key;
        $this->secret_phrase = $secret_phrase;
    }


    public function generate_api_url($options)
    {
        $result = $this->api_base_url . "key=" . $this->customer_key;
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
