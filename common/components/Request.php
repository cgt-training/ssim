<?php
namespace common\components;

class Request extends \yii\web\Request {
    public $web;
    public $adminUrl;

/**
*return base url
*@return string base_url 
*/
    public function getBaseUrl(){
        return str_replace($this->web, "", parent::getBaseUrl()) . $this->adminUrl;
    }

/**
*return resolved path
*@return string 
*/
    public function resolvePathInfo(){
        if($this->getUrl() === $this->adminUrl){
            return "";
        }else{
            return parent::resolvePathInfo();
        }
    }
}