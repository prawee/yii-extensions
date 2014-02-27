<?php

/*
 * created by prawee wongsa
 * http://www.prawee.com
 */
require('facebook-php-sdk/src/facebook.php');
class PFacebook extends CWidget{
    public $model;
    public $pageId; 
    public $appId;
    public $appSecret;
    public $facebook; 
    public $permissions;
    public $returnUrl;
    public $action;
    
    public function init(){
        $this->promiseFacebook();
    }
    public function run() {
        //Controller::debug($this->model->attributes);
        $fb=$this->facebook->getUser();
        if(empty($fb)){
            $loginUrl=$this->facebook->getLoginUrl(array(
                'scope'=>$this->permissions,
                'redirect-url'=>$this->returnUrl,
            ));
            echo CHtml::openTag('div');
            echo CHtml::link('Login With Facebook',$loginUrl,array('class'=>'btn btn-primary'));
            echo CHtml::closeTag('div');
        }else{
            echo CHtml::openTag('div');
            
            echo CHtml::ajaxLink('<i class="icon-white icon-user"></i>Post to Facebook',$this->action,array(
                'type'=>'POST',
                'data'=> 'js:{"postid":"'.$this->model->id.'","send":true}',
            ),
                    array('class'=>'btn btn-primary')); 
            echo CHtml::closeTag('div');
            
        }
        //Controller::debug(Yii::app()->request);
    }
    private function promiseFacebook() {
        $this->facebook = new Facebook(array(
            'appId' => $this->appId,
            'secret' => $this->appSecret, 
            'cookie' => true
        ));
    }
}
?>
