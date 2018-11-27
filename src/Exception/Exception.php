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

namespace Shadon\Neteaseim\Exception;

use Psr\Http\Message\ResponseInterface;

class Exception extends \Exception
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param string       $message
     * @param int          $code
     * @param ResponseInterface $response
     */
    public function __construct($message, $code, ResponseInterface $response)
    {
        $this->response = $response;

        parent::__construct($message, $code);
    }

    /**
     * Returns the exception's response.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
