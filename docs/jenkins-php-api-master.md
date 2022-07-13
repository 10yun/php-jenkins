Jenkins PHP API
===============


Jenkins PHP API 是一组类，旨在使用其API与Jenkins CI进行交互。

## 安装
------------

安装 composer [Composer](http://getcomposer.org).

通过 composer 下载依赖

```bash
composer require shiyun/php-jenkins
```


## 基本用法
-----------


Before anything, you need to instantiate the client :


```php
    $jenkins = new \JenkinsKhan\Jenkins('http://host.org:8080');
```

If your Jenkins needs authentication, you need to pass a URL like this : `'http://user:token@host.org:8080'`.


Here are some examples of how to use it:

## 获取job任务的颜色
------------------------

```php
    $job = $jenkins->getJob("dev2-pull");
    var_dump($job->getColor());
    //string(4) "blue"
```


## 开展工作
------------

```php
    $job = $jenkins->launchJob("clone-deploy");
    var_dump($job);
    // bool(true) if successful or throws a RuntimeException
```


## 获取视图的作业
-----------------------------

```php
    $view = $jenkins->getView('madb_deploy');
    foreach ($view->getJobs() as $job) {
      var_dump($job->getName());
    }
    //string(13) "altlinux-pull"
    //string(8) "dev-pull"
    //string(9) "dev2-pull"
    //string(11) "fedora-pull"
```

## 获取构建及其状态
----------------------------

```php
    $job = $jenkins->getJob('dev2-pull');
    foreach ($job->getBuilds() as $build) {
      var_dump($build->getNumber());
      var_dump($build->getResult());
    }
    //int(122)
    //string(7) "SUCCESS"
    //int(121)
    //string(7) "FAILURE"
```

## 检查jenkins是否空闲

-----------------------------

```php
    var_dump($jenkins->isAvailable());
    //bool(true);
```

For more information, see the [Jenkins API](https://wiki.jenkins-ci.org/display/JENKINS/Remote+access+API).


## 编码标准
----------------

This projects follows PSR-0, PSR-1, PSR-2, PSR-4
