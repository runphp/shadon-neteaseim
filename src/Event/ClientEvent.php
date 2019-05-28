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

namespace Shadon\Neteaseim\Event;

use Shadon\Neteaseim\Command\Action;
use Symfony\Contracts\EventDispatcher\Event;

class ClientEvent extends Event
{
    private $action;

    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }
}
