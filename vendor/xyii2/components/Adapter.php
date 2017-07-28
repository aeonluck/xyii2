<?php
/**
 * 适配器 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 15:14:44
 * @Modified : 2017-07-25 15:14:44
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2\components;


abstract class Adapter
{
    protected $config;


	public function __construct($config) {
		$this->config = $config;
	}


    public static function factory($className, $params = array()) {
		$className = ucfirst($className) . 'Adapter';

        if (!class_exists($className)) {
            throw new Exception('\'' . $className . '\' class not found.');
        }


        return call_user_func_array(
            array(new $className(), '__construct'), 
            $params
        );
    } 

	
	public function __call($func, $args) {
		return call_user_func_array(array($this, $func), $args);
	}
}
