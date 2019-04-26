# neteaseim
云信服务端api

## 安装
```bash
composer require shadon/neteaseim
```

## 使用示例(发送消息)
```php
// 云信配置信息
$options = [
    'appKey'    => 'your app key',
    'appSecret' => 'your app secret',
];

// 初始化云信客户端
$client = new \Shadon\Neteaseim\Client($options);

// 创建你需要执行的Action(每个Action对应云信一个接口)
$action = new \Shadon\Neteaseim\Command\Nimserver\Chatroom\SendMsg([
    'roomid'    => 21064619,
    'msgId'     => '222',
    'fromAccid' => 'seller_000000148086',
    'msgType'   => 100,
]);

// 执行接口请求
try {
    $return = $client->executeAction($action);
} catch (\Shadon\Neteaseim\Exception\Exception $e) {
    // 捕获相关异常信息
    var_dump($e->getResponse()->getBody());
}
```

## 接口与Action对应关系示例

功能 | 接口 | Action
---- | ---- | -----
往聊天室内添加机器人 | Shadon\Neteaseim\Command\Nimserver\Chatroom\AddRobot | https://api.netease.im/nimserver/chatroom/addRobot.action
创建聊天室 | Shadon\Neteaseim\Command\Nimserver\Chatroom\Create | https://api.netease.im/nimserver/nimserver/chatroom/create.action
查询聊天室信息 | Shadon\Neteaseim\Command\Nimserver\Chatroom\Get | https://api.netease.im/nimserver/nimserver/chatroom/get.action
 