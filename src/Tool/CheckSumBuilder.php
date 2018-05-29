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

namespace Shadon\Neteaseim\Tool;

final class CheckSumBuilder
{
    /**
     * 计算并获取CheckSum.
     *
     * @param string $appSecret 开发者平台分配的appSecret
     * @param string $nonce     随机数（最大长度128个字符）
     * @param int    $curTime   当前UTC时间戳，从1970年1月1日0点0 分0 秒开始到现在的秒数
     */
    public static function getCheckSum(string $appSecret, string $nonce, int $curTime): string
    {
        return sha1($appSecret.$nonce.$curTime);
    }

    /**
     * 随机数(最大长度128个字符).
     *
     * @return string
     */
    public static function getNonce(): string
    {
        return bin2hex(random_bytes(64));
    }
}
