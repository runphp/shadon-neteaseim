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

class Action
{
    private $arguments;

    private $uri;

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function __invoke(ResponseInterface $response)
    {
        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        if (200 != $body['code']) {
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
}
