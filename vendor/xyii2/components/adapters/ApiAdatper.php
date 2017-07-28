<?php
/**
 * API适配器 
 * 
 * @Author : JFZ TEAM, Aeonluck.Yang
 * @Created : 2017-07-25 15:17:55
 * @Modified : 2017-07-25 15:17:55
 * 
 * -------------------------------------
 *   Please keep this mark, thank you!
 */



namespace xyii2\components\adapters;


use xyii2\components\Adapter;


abstract class ApiAdapter extends Adapter
{
    private $_method;

    private $_params;

    protected $config;

    protected $url;

    protected $timeout;

    
    abstract function getData();


    public function setMethod($val) {
        $this->_method = $url;
    }


    public function setParams($val) {
        $this->_params = $val;
    }


    public function getMethod() {
        return $this->_method;
    }
    

    public function getParams() {
        return $this->_params;
    }

    
    public function setUrl($url) {
        $this->url= $url;
    }


    public function setTimeout($timeout) {
        $timeout = is_int($timeout) ? $timeout : DEFAULT_TIMEOUT_LIMIT;
        $this->timeout = $timeout;    
    }


    public function getUrl() {
        return $this->url;
    }


    public function getTimeout() {
        return $this->timeout;
    }


    public function __construct($url, $timeout, $params = array()) {
        $this->setUrl($url);
        $this->setTimeout($timeout);
        $this->params = $params;
    }

    
    public static function factory($className, $params = array()) {
        if (!class_exists($className)) {
           throw new Exception('\'' . $className. '\' class not found.'); 
        }


        return call_user_func_array(array($this, '__construct'), $params);
    }

    
    private function _get() {
       $queryString = '';

       foreach($this->_params as $key => $val) {
           $queryString .= $key . '=' . $val . '&';
       } 
       $queryString = empty($queryString) ? '' : substr($queryString, 0 ,-1);


       return $queryString;
    }


    private function _post() {
        curl_setopt($s,CURLOPT_POST, true); 
        curl_setopt($s,CURLOPT_POSTFIELDS, $this->_params); 
    }

    
    /**
     * TODO : 待完成
     */ 
    private function _put($params) {
        
    }


    /**
     * TODO : 待完成
     */ 
    private function _delete($params) {
        
    }

    
    private function _curlByMethod($handler) {
        


        switch ($this->_method) {
            case 'get' :
                $queryString = $this->_get($this->_params);
                $url = empty($queryString) 
                    ? $this->url 
                    : $this->url . '?' . $queryString;

                curl_setopt($handler, CURLOPT_URL, $this->_get(url); 
                break;

            case 'post' : 
                curl_setopt($handler, CURLOPT_URL, $this->url); 
                $this->_post($this->_params);

                break;

            case 'put' :
                break;

            case 'delete' :
                break;

            default :
                break;
        }
    }


    private function _request() {
        $handler = curl_init;

        $this->_curlByMethod($handler);

        // 设置超时
        curl_setopt($handler, CURLOPT_TIMEOUT, $this->timeout); 
        
        // 不直接输出
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true); 
       
        // 支持重定向
        curl_setopt($handler, CURLOPT_FOLLOWLOCATION, TRUE);

        // 支持https
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
        
        $errorNo = curl_errno($handler);
        $error = curl_error($handler);

        // 发生错误
        if ($errorNo) {
            // 先关闭连接，以防异常后续代码不执行，连接一直被占用。
            curl_close($handler);
            throw new Exception('curl error: ' . $error);
        }


        return $handler;
    }


    private function _response() {
        $handler = $this->_request();
        $response = curl_exec($handler);

        // 关闭连接
        curl_close($handler);


        return $response;
    } 


    public function response() {
        return $this->_response();    
    }
}
