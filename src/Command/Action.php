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

namespace Shadon\Neteaseim\Command;

use Psr\Http\Message\ResponseInterface;
use Shadon\Neteaseim\Exception\Exception;
use Shadon\Neteaseim\Options\ReturnCode;
use function GuzzleHttp\Psr7\stream_for;

abstract class Action implements \JsonSerializable
{
    private $arguments;

    private $uri;

    private $startTime;

    private $endTime;

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
        $this->startTime = microtime(true);
    }

    public function __invoke(ResponseInterface $response)
    {
        $this->endTime = microtime(true);
        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        if (200 != $body['code']) {
            $body['action'] = $this;
            $response = $response->withBody(stream_for(\GuzzleHttp\json_encode($body)));
            throw new Exception(ReturnCode::CODE_INFO[$body['code']], $body['code'], $response);
        }

        return $body;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param mixed $arguments
     */
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'arguments' => $this->arguments,
            'uri'       => $this->uri,
            'startTime' => $this->startTime,
            'endTime'   => $this->endTime,
        ];
    }
}
