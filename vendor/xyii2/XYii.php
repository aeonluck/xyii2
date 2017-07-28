<?php
/**
 * XYii 扩展类库 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 14:41:40
 * @Modified : 2017-07-25 14:41:40
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2;


class XYii
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
        spl_autoload_register(array('xyii2\XYii', 'autoload'));
    }
}
