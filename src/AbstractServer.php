<?php
/**
 * Created by PhpStorm.
 * User: heui
 * Date: 2018/5/28
 * Time: 22:19
 */

namespace NimServer;


use GuzzleHttp\Client;

abstract class AbstractServer
{
    protected $appKey;

    protected $appSecret;

    protected $httpClient;

    protected $gateway = 'https://api.netease.im';

    public function __construct(string  $appKey, string $appSecret)
    {
        $this->appKey= $appKey;
        $this->appSecret = $appSecret;
        $this->httpClient = new Client([
            'base_uri'        => $this->gateway,
        ]);
    }

    /**              
     * 随机数(最大长度128个字符)
     * 
     * @return string
     */
    protected function getNonce():string 
    {
        return bin2hex(random_bytes(64));
    }
}