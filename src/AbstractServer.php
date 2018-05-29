<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->httpClient = new Client([
            'base_uri'        => $this->gateway,
        ]);
    }

    /**
     * 随机数(最大长度128个字符).
     *
     * @return string
     */
    protected function getNonce(): string
    {
        return bin2hex(random_bytes(64));
    }
}
