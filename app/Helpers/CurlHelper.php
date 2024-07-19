<?php

namespace App\Helpers;

class CurlHelper
{
    public static function exec($method, $url, $data = false, array $headers = [], $getStatusCodeOnly = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $return['body'] = curl_exec($curl);
        $return['info'] = curl_getinfo($curl);
        $return['error'] = curl_error($curl);

        curl_close($curl);

        return $return;
    }

    // alternative (for simple use)
    public static function execUsingStream($method, $url, array $data = [], array $header = [])
    {
        $options = [
            'http' => [
                'method' => $method,
                'header' => implode("\r\n", $header),
                'content' => $method == 'GET' ? '' : http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $content = file_get_contents($method == 'GET' ? $url . '/' . http_build_query($data) : $url, false, $context);

        return $content;
    }

}
