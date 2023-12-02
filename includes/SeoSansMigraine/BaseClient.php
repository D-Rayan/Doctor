<?php

namespace Doctor\SeoSansMigraine;

if (!defined("ABSPATH")) {
    exit;
}
class BaseClient
{
    const BASE_URL = "https://api.seo-sans-migraine.fr";
    static $Authorization = false;

    public function setAuthorization(string $bearer) {
        self::$Authorization = $bearer;
    }
    public function post(string $url, array $body, array $headers = [], array $params = []): array
    {
        return $this->makeRequest("POST", $url, $headers, $body, $params);
    }

    public function put(string $url, array $body, array $headers = [], array $params = []): array
    {
        return $this->makeRequest("PUT", $url, $headers, $body, $params);
    }

    public function patch(string $url, array $body, array $headers = [], array $params = []): array
    {
        return $this->makeRequest("PATCH", $url, $headers, $body, $params);
    }

    public function get(string $url, array $params = [], array $headers = []): array
    {
        return $this->makeRequest("GET", $url, $headers, [], $params);
    }


    public function delete(string $url, array $params = [], array $headers = []): array
    {
        return $this->makeRequest("DELETE", $url, $headers, [], $params);
    }

    private function makeRequest($method, $url, $headers = [], $body = [], $params = []): array
    {
        $fullUrl = self::BASE_URL . $url[0] === "/" ? $url : "/$url";
        if (!empty($params)) {
            $fullUrl .= '?' . http_build_query($params);
        }

        $curl = curl_init($fullUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if (self::$Authorization) {
            $headers["Authorization"] = "Bearer " . self::$Authorization;
        }
        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if (!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($body));
        }

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($error) {
            $result = [
                'success' => false,
                'error' => $error,
                'status' => $httpCode,
                'data' => null
            ];
        } else {
            $result = [
                'success' => true,
                'error' => null,
                'status' => $httpCode,
                'data' => $response
            ];
        }
        curl_close($curl);

        return $result;
    }
}