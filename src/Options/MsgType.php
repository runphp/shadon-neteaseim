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

namespace Shadon\Neteaseim\Options;

/**
 * 消息类型.
 */
class MsgType
{
    /**
     *  文本消息.
     *
     * @var int
     */
    public const TXT = 0;

    /**
     *  图片.
     *
     * @var int
     */
    public const IMAGE = 1;

    /**
     *  语音.
     *
     * @var int
     */
    public const VOICE = 2;

    /**
     *  视频.
     *
     * @var int
     */
    public const VIDEO = 3;

    /**
     *  地理位置信息.
     *
     * @var int
     */
    public const GEO = 4;

    /**
     *  文件.
     *
     * @var int
     */
    public const FILE = 6;

    /**
     *  Tips消息.
     *
     * @var int
     */
    public const TIPS = 10;

    /**
     *  自定义消息类型.
     *
     * @var int
     */
    public const EXT = 100;
}
