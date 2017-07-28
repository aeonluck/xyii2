# xyii2
一个基于yii2的轻量改造的ＰＨＰ框架


# 1.前言
## 1.1.编写前言


# 2.总体设计
## 2.1.目录结构

## 2.2.类库加载
通过Vendor中的`autoload.php`进行加载。实际指向如下：

`vendor/composer/autoload_real.php` -> `vendor/composer/autoload_files.php`

`autoload_files.php` 中有如下代码：
```php
return array(
    '2cffec82183ee1cea088009cef9a6fc3' => $vendorDir . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
    '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => $vendorDir . '/symfony/polyfill-mbstring/bootstrap.php',
    'ad155f8f1cf0d418fe49e248db8c661b' => $vendorDir . '/react/promise/src/functions_include.php',
    '2c102faa651ef8ea5874edb585946bce' => $vendorDir . '/swiftmailer/swiftmailer/lib/swift_required.php',
    '180092cfc969a12e06f2132a203a3184' => $vendorDir . '/codeception/verify/src/Codeception/function.php',
);
```
当需要加载自定义类库时，只需要上述`array`中，加入自己类库的加载类即可，例如：

==**[!] 小提示：类库必须遵循[PSR-4](s://wowphp.com/post/orjyg2q5dm20.html)规范。**==

1. 在`autoload_files.php`加入类库位置，即：
```php
// ...

return array(
    // ...
    'MyClassLib' => $vendorDir . '/myclasslib/autoload.php',
);
```

2. 将自定义类库放到`vendor`目录之下。==**[!]假设自定义类库的目录结构如下：**==
```
/-myclasslib
| |--components
| | |--MyFirstClass.php
| |--MyClassLib.php
| |--autoload.php
```

3. 在自定义类库中增加以下文件：
- `autoload.php`
```php
namespace myclasslib;


use myclasslib\MyClassLib;


if (class_exists('MyClassLib', false)) {
    return;
}


require dirname(__FILE__) . '/MyClassLib';

// 自动加载扩展类库
MyClassLib::registerAutoload();
```

- 实际加载类  
```php
namespace myclasslib;


class MyClassLib
{
    public static function autoload($className) {
        if (!class_exists($className)) {
            $path = dirname(__FILE__) . '/components/' . $className . '.php';    

            if (file_exists($path)) {
                require dirname(__FILE__) . '/components/' 
                    . $className . '.php';    
            }
        } 
    }    


    /**
     * 注册自动加载函数
     */ 
    public static function registerAutoload() {
        spl_autoload_register(array('myclasslib\MyClassLib', 'autoload'));
    }
}

```

# 3.附录
# 3.1.关于yii2
Yii 发音为 Yee or [ji:]，它是“Yes It Is!”的首字母缩写。 

Yii是一个免费的，开源的，基于PHP5的Web应用程序开发框架，代码简洁，DRY设计并且鼓励快速开发。它的工作可以简化您的应用程序开发，并有助于确保一个非常高效的，可扩展和可维护的终端产品。

- [Yii Framework官网](http://www.yiiframework.com/)
- [Yii中文社区](http://www.yiichina.com/)

# 3.2.关于composer
Composer 是 PHP 的一个依赖管理工具。它允许你申明项目所依赖的代码库，它会在你的项目中为你安装他们。

- [Composer中文文档](http://docs.phpcomposer.com/)
