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

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Shadon\Neteaseim\Command\Action;
use Shadon\Neteaseim\Event\ClientEvent;
use Shadon\Neteaseim\Exception\Exception;
use Shadon\Neteaseim\Tool\CheckSumBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Neteaseim Client.
 */
class Client
{
    /**
     * @var string
     */
    private $appKey;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var string
     */
    private $gateway = 'https://api.netease.im';

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function __construct(array $options)
    {
        $this->appKey = $options['appKey'];
        $this->appSecret = $options['appSecret'];
        $this->httpClient = new \GuzzleHttp\Client();
        $this->eventDispatcher = new EventDispatcher();
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
        // connect times
        $connectTimes = 3;
        while ($connectTimes--) {
            try {
                $event = new ClientEvent($action);
                $this->eventDispatcher->dispatch($event, 'pre.send');
                $response = $this->httpClient->send($request, [
                    'form_params' => $action->getArguments(),
                ]);
                $return = $action($response);
                $this->eventDispatcher->dispatch($event, 'post.send');

                return $return;
            } catch (ServerException $e) {
                break;
            } catch (ConnectException $e) {
                // connect failue retry
                continue;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
        $response = $e->getResponse();
        if (null === $response) {
            throw $e;
        }
        $body = ['code' => 500, 'desc' => (string) $response->getBody(), 'action' => $action];
        $response = $response->withBody(stream_for(\GuzzleHttp\json_encode($body)));
        throw new Exception($e->getMessage(), 500, $response);
    }

    /**
     * @return EventDispatcher
     */
    public function getEventDispatcher(): EventDispatcher
    {
        return $this->eventDispatcher;
    }
}
