# neteaseim
云信服务端api

## 安装
```bash
composer require shadon/neteaseim
```

## 使用
```php
// your config information
$options = [
    'appKey'    => 'your app key',
    'appSecret' => 'your app secret',
];

// initial neteaseim client
$client = new \Shadon\Neteaseim\Client($options);

// create new action
$action = new \Shadon\Neteaseim\Command\Nimserver\Chatroom\SendMsg([
    'roomid'    => 21064619,
    'msgId'     => '222',
    'fromAccid' => 'seller_000000148086',
    'msgType'   => 100,
]);

// execute an action
$return = $client->executeAction($action);
```
