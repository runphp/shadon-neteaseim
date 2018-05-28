<?php
/**
 * Created by PhpStorm.
 * User: heui
 * Date: 2018/5/28
 * Time: 22:07
 */

namespace NimServer\Tool;


class CheckSumBuilder
{
    /**
     * 计算并获取CheckSum.
     *
     * @param string $appSecret  开发者平台分配的appSecret
     * @param string $nonce  随机数（最大长度128个字符）
     * @param int $curTime  当前UTC时间戳，从1970年1月1日0点0 分0 秒开始到现在的秒数
     */
    public static function getCheckSum(string $appSecret, string $nonce, int $curTime): string 
    {
         return sha1($appSecret.$nonce.$curTime);
    }
}