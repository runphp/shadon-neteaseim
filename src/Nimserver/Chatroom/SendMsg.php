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

namespace Shadon\Neteaseim\Nimserver\Chatroom;

use Shadon\Neteaseim\Action;

class SendMsg extends Action
{
    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }
}
