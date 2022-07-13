## 配置config相关

[返回查看更多](../README.md)


```php

<?php

/**
 * Jenkins-php 配置信息
 */
return [
    // Jenkins User ID
    'username' => 'tianpian',
    // Jenkins API Token (http://jenkin.domain.com/user/{username}/configure)
    'password' => '2766bcc95aa2df67943e50b8950d65d5',
    // 是否开启CSRF保护 (系统管理/全局安全配置/CSRF Protection)
    'maybe_add_crumb' => false,
    // guzzle 配置
    'guzzle' => [
        // 接口请求超时时间(s)
        'timeout' => 5.0,
        'middleware' => [
            // 日志中间件，记录接口请求和响应，方便调试，线上建议关闭（注释）
            'log' => ['logMiddleware', 'config' => [
                'level'      => 'debug',
                'permission' => 0777,
                'file'       => '../logs/jenkins.log',
            ]],
        ]
    ],
];


```