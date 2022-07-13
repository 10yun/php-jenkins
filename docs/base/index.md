## 基础base相关

[返回查看更多](../../README.md)

#### 获取Jenkins的版本

```php
$version = $jenkins->getVersion();

echo $version, "\n"; // 2.121.1
```

#### 获取当前用户信息
```php
$whoAmi = $jenkins->getWhoAmi();

echo "id: ", $whoAmi['id'], "; ", "fullName: ", $whoAmi['fullName'], "\n";
// id: tianpian; fullName: tianpian
```

#### 运行Groovy脚本
```php
$result = $jenkins->runScript('println("Hello, World!");');

echo $result; // Hello, World!
```

#### 静默关闭Jenkins/取消关闭Jenkins
```php
$isSuccess = $jenkins->quietDown();

var_dump($isSuccess); // true

$isCancel = $jenkins->cancelQuietDown();

var_dump($isCancel); // true
```

#### 检查jenkins是否空闲

```php
var_dump($jenkins->isAvailable());
//bool(true);
```
For more information, see the [Jenkins API](https://wiki.jenkins-ci.org/display/JENKINS/Remote+access+API).

