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

namespace Shadon\Neteaseim;

class Client
{
    protected $appKey;

    protected $appSecret;

    protected $httpClient;

    protected $gateway = 'https://api.netease.im/';

    public function __construct(array $options)
    {
        $this->appKey = $options['appKey'];
        $this->appSecret = $options['appSecret'];
        $this->httpClient = new self([
            'base_uri'        => $this->gateway,
        ]);
    }

    public function executeAction(Action $action): void
    {
        dd($action);
    }
}
