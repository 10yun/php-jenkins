# php-jenkins


Jenkins-PHP 是Jenkins REST API 的工具库，旨在提供一种更方便的方式来控制Jenkins服务器。它提供了许多便利的功能、更高级API。

Jenkins-PHP主要实现了以下功能：

**任务job**

- 创建任务 Create new jobs
- 复制已有任务 Copy existing jobs
- 删除任务 Delete jobs
- 更新任务 Update jobs
- 启用/禁用任务 Enable/Disable jobs
- 获取任务信息 Get a job`s build information
- Get Jenkins master version information
- Get Jenkins plugin information
- 在一项工作上开始构建 Start a build on a job
- 创建节点 Create nodes
- 启用/禁用节点 Enable/Disable nodes
- 获取节点信息 Get information on nodes

**视图views**

- Create/Delete/Reconfig views
- Put server in shutdown mode (quiet down/safe exit/exit)
- Cancel server shutdown mode (cancel quiet down)
- List running builds
- Delete Builds
- Wipeout job workspace
- Create/Delete/Update folders
- Install plugins
- Get builded last git version information
- and many more...


## 快速安装
```
composer require shiyun/php-jenkins
```

## 在线文档

- [安装](./docs/guide/installing.md)
- [使用](./docs/guide/using.md)
- [API参考](./docs/guide/api-reference.md)
