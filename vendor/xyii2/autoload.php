<?php
/**
 * XYII2 类库自动加载 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 14:32:16
 * @Modified : 2017-07-25 14:32:16
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2;


use xyii2\XYii;


// 定义常量
defined('TIME_NOW') or define('TIME_NOW', time());

// 超时限制
defined('DEFAULT_TIMEOUT_LIMIT') or define('DEFAULT_TIMEOUT_LIMIT', 2);
// 缓存有效期
defined('DEFAULT_CACHE_LIFETIME') or define('DEFAULT_CACHE_LIFETIME', 5);

// 定义状态码
defined('DEFAULT_STATUS_CODE') or define('DEFAULT_STATUS_CODE', 200);
defined('DEFAULT_STATUS_MSG') or define('DEFAULT_STATUS_MSG', 'success.');

// 定义异常
defined('DEFAULT_EXCEPTION_CODE') 
    or define('DEFAULT_EXCEPTION_CODE', 500);
defined('DEFAULT_EXCEPTION_MSG') 
    or define('DEFAULT_EXCEPTION_MSG', 'server error.');


if (class_exists('XYii', false)) {
    return;
}


require dirname(__FILE__) . '/XYii.php';

// 自动加载xyii2扩展类库
XYii::registerAutoload();
