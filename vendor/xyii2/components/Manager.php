<?php
/**
 * 适配管理器 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 15:13:40
 * @Modified : 2017-07-25 15:13:40
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */


namespace xyii2\components;


abstract class Manager
{
	private $_config;

	private $_adapter;

	private $_adapterType;

    protected $adapterName;

	protected $configFile = '';


	public function setConfig($val) {
		$this->_config = $val;
	}


	public function __construct() {
		$file = $this->configFile . '.ini'; 

		if (!file_exists($file)) {
			throw new Exception('\'' . $file . '\' file not found.');
		}

		$this->setConfig(parse_ini_file($file, true));

		$this->_adapterType = empty($this->_config->common->adapter)
			? $this->_adapterType
			: $this->_config->common->adapter; 
		$type = $this->_adapterType;
		$adapterConfig = $this->_config->$type;

		if (empty($adapterConfig)) {
			throw new Exception($this->adapterName . 'adapter config error.');	
		}

		$adapterName = $this->adapterName . ucfirst($this->_adapterType);

		$this->_adapter = Adapter::factory($adapterName, $adapterConfig);
	}


	public function getConfig() {
		return $this->_config;
	}


	public function setAdapter(Adapter $adapter) {
		$this->_adapter = $adapter;
	}


	public function getAdapter() {
		return $this->_adapter;
	}


	public static function factory($className) {
		$className = ucfirst($className) . 'Manager';

		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');
		}	


		return new $className();
	}


	public function __set($name, $val) {
		$method = 'set' . ucfirst($name);
		method_exists($this, $method) ? $this->$method($val) : null;		
	}


	public function __get($name) {
		$method = 'get' . ucfirst($name);
		return method_exists($this, $method) ? $this->$method($name) : null;
	}


	public function __call($func, $args) {
		return call_user_func_array(array($this, $func), $args);
	}
}
