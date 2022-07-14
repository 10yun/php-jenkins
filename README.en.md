# php-jenkins

**简要**  
php-jenkins 是PHP语言编写的 Jenkins REST API 的工具库，旨在提供一种更方便的方式来控制 Jenkins 服务器。它提供了许多便利的功能、更高级 API。  

**编码标准**  
This projects follows PSR-0, PSR-1, PSR-2, PSR-4


## 快速安装

```
composer require shiyun/php-jenkins
```

## 快速使用

```php

use shiyunJK/Jenkins;

$config = [
    'username' => 'jenkins User ID', 
    'password' => 'Jenkins API token'
];

$jenkins = new Jenkins('http://localhost:8080', $config);
```

## api参考

php-jenkins 主要实现了以下功能：

**基础 base**

| 功能         | 英文                                            | 手册                         |
| :----------- | :---------------------------------------------- | :--------------------------- |
| 获取版本信息 | Get Jenkins master version information          | [参考](./docs/base/index.md) |
| 获取插件信息 | Get Jenkins plugin information                  | [参考](./docs/base/index.md) |
| 安装插件     | Install plugins                                 | [参考](./docs/base/index.md) |
| 取消关机     | Cancel server shutdown mode (cancel quiet down) |                              |


**视图 views**

| 功能         | 英文                | 手册                         |
| :----------- | :------------------ | :--------------------------- |
| 创建试图     | Create views        | [参考](./docs/view/index.md) |
| 删除试图     | Delete views        | [参考](./docs/view/index.md) |
| 重配试图     | Reconfig views      | [参考](./docs/view/index.md) |
| 获取工作空间 | wipeoutJobWorkspace | [参考](./docs/job/index.md)  |


**任务 job**

| 功能         | 英文                          | 方法                        | 手册 |
| :----------- | :---------------------------- | :-------------------------- | :--- |
| 创建任务     | Create new jobs               | [参考](./docs/job/index.md) |
| 复制已有任务 | Copy existing jobs            | [参考](./docs/job/index.md) |
| 删除任务     | Delete jobs                   | [参考](./docs/job/index.md) |
| 更新任务     | Update jobs                   | [参考](./docs/job/index.md) |
| 启用任务     | Enable jobs                   | [参考](./docs/job/index.md) |
| 禁用任务     | Disable jobs                  | [参考](./docs/job/index.md) |
| 获取任务信息 | Get a job`s build information | [参考](./docs/job/index.md) |

**构建 build**
| 功能         | 英文                     | 手册                          |
| :----------- | :----------------------- | :---------------------------- |
| 开始任务构建 | Start a build on a job   | [参考](./docs/build/index.md) |
| 删除构建     | Delete Builds            | [参考](./docs/build/index.md) |
| 构建列表     | List running builds      | [参考](./docs/build/index.md) |
| 创建节点     | Create nodes             | [参考](./docs/build/index.md) |
| 启用         | Enable nodes             | [参考](./docs/build/index.md) |
| 禁用节点     | Disable nodes            | [参考](./docs/build/index.md) |
| 获取节点信息 | Get information on nodes | [参考](./docs/build/index.md) |


**其他**
- Put server in shutdown mode (quiet down/safe exit/exit) 
- Create/Delete/Update folders
- Get builded last git version information

## 更新日志

[更新日期](./docs/changelog.md) 


## 加入我们

qq群 - 87208295