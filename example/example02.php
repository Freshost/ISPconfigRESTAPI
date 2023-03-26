<?php

require '../vendor/autoload.php';

use ISPconfigAPI as ISPconfigAPIBase;

class ISPconfigAPI extends ISPconfigAPIBase
{
    /**
     * @param $method
     * @param array $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function call($method, $data = array())
    {
        if (1 == 2)
        {
            return parent::call($method, $data);
        } else {
            throw new Exception('Permission error');
        }
    }
}

include "login.php";
$call = new ISPconfigAPI(['user' => $user, 'pass' => $pass, 'url' => $url]);

try {
    $client = $call->call("client_get", ["client_id" => 1]);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


print_r($client);
