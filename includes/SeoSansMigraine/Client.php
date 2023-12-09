<?php

namespace Doctor\SeoSansMigraine;

if (!defined("ABSPATH")) {
    exit;
}

class Client
{

    private $client;
    public function __construct()
    {
        $this->client = new BaseClient();
    }

    public function checkCredential(string $token) {
        $response = $this->client->post("/login", [
            "token" => $token,
        ]);
        $this->client->setAuthorization($token);

        return $response["success"];
    }

    public function startTranslation(array $dataToTranslate, string $codeFrom, string $codeTo): array {
        return [
            "success" => true,
            "error" => null,
            "data" => [
                "tokenId" => ""
            ]
        ];
    }

    public function retrieveStatusTranslation(string $tokenId) {
        return [
            "success" => true,
            "error" => null,
            "data" => [
                "tokenId" => $tokenId,
                "status" => "pending|done|error"
            ]
        ];
    }

    public function retrieveTranslation(string $tokenId) {
        return [
            "success" => true,
            "error" => null,
            "data" => [
                "tokenId" => $tokenId,
                "translations" => [
                    "title" => "Title",
                    "content" => "Content",
                    "excerpt" => "Excerpt",
                    "slug" => "slug",
                ]
            ]
        ];
    }
}