<?php
/**
 * 服务基类 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 15:16:30
 * @Modified : 2017-07-25 15:16:30
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2\components;


abstract class Service
{
    public static function factory($className) {
		$className = ucfirst($className) . 'Service';

        if (!class_exists($className)) {
            throw new Exception('\'' . $className . '\' class not found.');
        }

        return new $className();
    } 
}
