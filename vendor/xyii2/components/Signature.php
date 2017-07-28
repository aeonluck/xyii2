<?php
/**
 * 答名器
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 15:20:08
 * @Modified : 2017-07-25 15:20:08
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2\components;


abstract class Signature
{
   // 签名key
    protected $appKey;

    // 签名密钥
    protected $appSecret;


    abstract function sign($params);


    public static function factory($className) {
        if (class_exists($className) {
            throw new Exception('\'' . $className . '\'.class not found.');    
        }

        return new $className();
    } 
}
