<?php

require 'vendor/autoload.php';

use IwxApi\IwxApiClient;

$client = new IwxApiClient();
$response = $client->sendRequest('/example-endpoint', ['param1' => 'value1'], 'GET');

print_r($response);

?>


