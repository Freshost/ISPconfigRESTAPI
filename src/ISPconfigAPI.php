<?php
/*
 * (c) Adam Biciste <adam@freshost.cz>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

class ISPconfigAPI
{
    private string $url = '/remote/json.php';
    private string $user;
    private string $pass;

    private string $session;
    private \GuzzleHttp\Client $httpClient;

    public function __construct(array $config)
    {
        $this->url = $config['url'].$this->url;
        $this->user = $config['user'];
        $this->pass = $config['pass'];

        if (!isset($config['verifySSL']) && empty($config['verifySSL'])) {$config['verifySSL'] = true;}
        $this->httpClient = new \GuzzleHttp\Client(['base_uri' => $this->url, 'verify' => $config['verifySSL']]);
        $this->login();
    }

    public function call(string $method, array $data = array())
    {
        $data = array_merge(['session_id' => $this->session], $data);
        $res = $this->httpClient->request('PUT', '?'.$method, [
            'json' => $data
        ]);
        $res = json_decode($res->getBody(), true);

        if ($res["code"] != "ok") {
            throw new \Exception($res["message"]);
        }

        return $res["response"];
    }

    public function login(): bool
    {
        $res = $this->httpClient->request('PUT', '?login', [
            'json' => ['username' => $this->user, 'password' => $this->pass]
        ]);
        $res = json_decode($res->getBody(), true);

        if ($res["code"] != "ok") {
            throw new \Exception($res["message"]);
        }

        $this->session = $res["response"];
        return true;
    }

    public function logout(): bool
    {
        $res = $this->httpClient->request('PUT', '?logout', [
            'json' => ['session_id' => $this->session]
        ]);
        $res = json_decode($res->getBody(), true);

        if ($res["code"] != "ok") {
            throw new \Exception($res["message"]);
        }
        return true;
    }

}
