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

namespace Shadon\Neteaseim\Command\Nimserver\Chatroom;

use Psr\Http\Message\ResponseInterface;
use Shadon\Neteaseim\Command\Action;

/**
 * 排序列出队列中所有元素.
 *
 * @author hehui<runphp@dingtalk.com>
 */
class QueueList extends Action
{
    public function __construct(array $arguments)
    {
        $this->setUri('/nimserver/chatroom/queueList.action');
        parent::__construct($arguments);
    }

    public function __invoke(ResponseInterface $response)
    {
        $return = parent::__invoke($response);

        return $return['desc'];
    }
}
