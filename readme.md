# 项目简介

一些常用的功能函数

-----

## 安装
```
composer require dreamcat/utils
```

## 数组相关

- use Components\Utils\Funcs\ArrayFunc

### 获取数组深层的一个值
- 函数原型 `getArrayChild(array $array, string $path, $default = null)`
- 参数列表
	- `$array` 数组值
	- `$path` 各级下标用/分隔
	- `$default` 如果不存在的返回值
- 返回值：如果路径存在则返回元素值，否则返回`$default`
- 示例：

```php
<?php

use Components\Utils\Funcs\ArrayFunc;

$array = [
    "dk1" => [
        "dk2" => "v1",
        "dk4" => [
            "v3",
            "v4",
        ],
    ],
    "dk3" => "v2",
];

var_dump(ArrayFunc::getArrayChild($array, "dk1/dk2")); # 返回 "v1"
var_dump(ArrayFunc::getArrayChild($array, "dk3/dk2", "def")); # 返回 "def"
var_dump(ArrayFunc::getArrayChild($array, "dk1/dk4/1", "def")); # 返回 "v4"
var_dump(ArrayFunc::getArrayChild($array, "", "def")); # 返回 $array 不过应该不会有人这么调用
```