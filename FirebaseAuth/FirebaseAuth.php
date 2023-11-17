<?php

namespace FirebaseAuth;


use GuzzleHttp\Client;

class FirebaseAuthSDK  
{
    private static $baseUrl = 'https://identitytoolkit.googleapis.com/v1/';
    private static $apiKey;


    public static function initialize($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    private static function getClient()
    {
        return new Client();
    }

    public static function register($email, $password)
    {
        $client = self::getClient();
        $response = $client->post(self::$baseUrl . 'accounts:signUp?key=' . self::$apiKey, [
            'json' => [
                'email' => $email,
                'password' => $password,
                // Add other parameters as needed
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public static function login($email, $password)
    {
        $client = self::getClient();
        $response = $client->post(self::$baseUrl . 'accounts:signInWithPassword?key=' . self::$apiKey, [
            'json' => [
                'email' => $email,
                'password' => $password,
                // Add other parameters as needed
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public static function update($idToken, $newData)
    {
        $client = self::getClient();
        $response = $client->post(self::$baseUrl . 'accounts:update?key=' . self::$apiKey, [
            'json' => [
                'idToken' => $idToken,
                'displayName' => $newData['displayName'], // Example: Update display name
                // Add other parameters as needed
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public static function sendResetPasswordEmail($email)
    {
        $client = self::getClient();
        $response = $client->post(self::$baseUrl . 'accounts:sendOobCode?key=' . self::$apiKey, [
            'json' => [
                'email' => $email,
                'requestType' => 'PASSWORD_RESET',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}

