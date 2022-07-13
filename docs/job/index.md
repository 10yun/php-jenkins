## 任务job 相关

[返回查看更多](../../README.md)

#### 创建job
```php
use shiyunJK\Exceptions\JenkinsException;

$configXml = file_get_contents(__DIR__.'/../data/Job/config.xml');

try {
    $isCreated = $jenkins->createJob('job-name', $configXml);
} catch (JenkinsException $e) {
    // job 已经存在
}
```
#### 复制job
```php
$isCopied = $jenkins->copyJob('from-job-name', 'to-job-name');
if ($isCopied == 404) {
    // from-job-name 不存在
}
```
#### 重命名job
```php
try {
    $isRenamed = $jenkins->copyJob('from-job-name', 'to-job-name');
    if ($isRenamed == 404) {
        // from-job-name 不存在
    }
} catch (JenkinsException $e) {
     // 修改后的job文件夹和原文件夹不一样
}
```
#### 删除job
```php
$isDeleted = $jenkins->deleteJob('job-name');
if ($isDeleted == 404) {
    // job-name 不存在
}

```