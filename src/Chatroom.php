<?php

declare(strict_types=1);

/*
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace NimServer;


use NimServer\Tool\CheckSumBuilder;

class Chatroom extends AbstractServer
{
    /**
     * 发送聊天室消息.
     *
     * @see http://dev.netease.im/docs/product/IM%E5%8D%B3%E6%97%B6%E9%80%9A%E8%AE%AF/%E6%9C%8D%E5%8A%A1%E7%AB%AFAPI%E6%96%87%E6%A1%A3/%E8%81%8A%E5%A4%A9%E5%AE%A4?#%E5%8F%91%E9%80%81%E8%81%8A%E5%A4%A9%E5%AE%A4%E6%B6%88%E6%81%AF
     * 
     * @param int $roomid 聊天室id
     * @param string $msgId  客户端消息id
     * @param string $fromAccid 消息发出者的账号accid
     * @param int $msgType 消息类型
     * @param array $extend  非必须的其他参数(参考文档)
     */
    public function sendMsg(int $roomid, string $msgId, string $fromAccid, int $msgType, array $extend = [])
    {
        $uri = '/nimserver/chatroom/sendMsg.action';

        $nonce = $this->getNonce();
        $curTime = time();
        $headers =  [
            'AppKey' => $this->appKey,
            'Nonce' =>  $nonce,
            'CurTime' => $curTime,
            'CheckSum' =>   CheckSumBuilder::getCheckSum($this->appSecret, $nonce, $curTime),
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $formParms = [
            'roomid' => $roomid,
            'msgId' => $msgId,
            'fromAccid' => $fromAccid,
            'msgType' => $msgType,
        ];
        $response = $this->httpClient->post($uri, [
            'headers' => $headers,
            'form_params' => $formParms,
            'debug' => true,
        ]);
        dd((string)$response->getBody());
    }
}