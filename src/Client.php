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

use GuzzleHttp\Psr7\Request;
use Shadon\Neteaseim\Command\Action;
use Shadon\Neteaseim\Tool\CheckSumBuilder;

class Client
{
    private $appKey;

    private $appSecret;

    private $gateway = 'https://api.netease.im';

    private $httpClient;

    public function __construct(array $options)
    {
        $this->appKey = $options['appKey'];
        $this->appSecret = $options['appSecret'];
        $this->httpClient = new \GuzzleHttp\Client();
    }

    public function executeAction(Action $action)
    {
        $uri = $this->gateway.$action->getUri();
        $nonce = CheckSumBuilder::getNonce();
        $curTime = time();
        $headers = [
            'AppKey'       => $this->appKey,
            'Nonce'        => $nonce,
            'CurTime'      => $curTime,
            'CheckSum'     => CheckSumBuilder::getCheckSum($this->appSecret, $nonce, $curTime),
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $request = new Request('POST', $uri, $headers);
        $response = $this->httpClient->send($request, [
            'form_params' => $action->getArguments(),
        ]);

        return $action($response);
    }
}
