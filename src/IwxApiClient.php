<?php

namespace IwxApi;

class IwxApiClient
{
    private $apiUrl = 'http://iwx.com:1020/api';

    public function sendRequest($endpoint, $params = [], $method = 'GET')
    {
        $url = $this->apiUrl . $endpoint;

        $ch = curl_init();

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        } else {
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if (isset($error_msg)) {
            return ['error' => $error_msg];
        }

        return ['status_code' => $httpCode, 'response' => json_decode($response, true)];
    }
}
