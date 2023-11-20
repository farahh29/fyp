<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require './autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'ARBxzSxtNjmyX6MPoIyRvIZ9Y6DNaOug4kuLCAilvkQ5MfGiAuzfH6_C3C_RJ9GaVED5thKhLHe2rhcZ',
    'client_secret' => 'ENd_1spbOIkZDkqz6Q7zORnHiVyrMN6OUIeS8iLP1AkSo9Kef07TDIWAy2pwKTtcdIY9uyhmmQ3yrF2G',
    'return_url' => 'http://localhost/paypal-rest-api/response.php',
    'cancel_url' => 'http://localhost/paypal-rest-api/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost:3308',
    'username' => 'root',
    'password' => '',
    'name' => 'fyp1'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}