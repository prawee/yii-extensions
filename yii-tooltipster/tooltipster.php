<?php
/*
* create by mr.prawee wongsa 
* www.prawee.com
* reference https://github.com/Dadeniss/yii-tooltipster
* source http://calebjacob.com/tooltipster/
*/
class tooltipster extends CWidget {
    public $identifier = '.tooltipster';
    public $options=array();
    public function init() {
        // this method is called by CController::beginWidget()
        if(!isset($this->id))
            $this->id=$this->getId();
        
        $this->publishAssets();
    }

    public function run() {
        // this method is called by CController::endWidget()   
        
        $options=$this->buildOptions();
        
        Yii::app()->clientScript->registerScript(
                'tooltipster_'.$this->id,
                'jQuery("'.$this->identifier.'").tooltipster('.$options.');',
                CClientScript::POS_READY
        );
    }
    
    public function publishAssets() {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl =Yii::app()->assetManager->publish($assets);
        
        if(is_dir($assets)){   
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/themes/tooltipster-light.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/themes/tooltipster-noir.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/themes/tooltipster-punk.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/themes/tooltipster-shadow.css');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/tooltipster.css');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/jquery.tooltipster.js', CClientScript::POS_HEAD);
        } else {
            throw new Exception('tooltipster - Error: Couldn\'t find assets to publish.');
        }
    }
    public function buildOptions()
    {
        $_build_options=array();
        $_default_options = array(
            'animation' => 'fade',
            'arrow' => true,
            'arrowColor' => '',
            'content' => '',
            'delay' => '200',
            'fixedWidth' => '0',
            'maxWidth' => '0',
            'functionBefore' => 'function(origin, continueTooltip){continueTooltip();}',
            'functionReady' => 'function(origin, tooltip) {}',
            'functionAfter' => 'function(origin) {}',
            'icon' => '(?)',
            'iconDesktop' => false,
            'iconTouch' => false,
            'iconTheme' => '.tooltipster-icon',
            'interactive' => false,
            'interactiveTolerance' => '350',
            'offsetX' => 0,
            'offsetY' => 0,
            'onlyOne' => true,
            'position' => 'top',
            'speed' => 350,
            'timer' => 0,
            'theme' => '.tooltipster-default',
            'touchDevices' => true,
            'trigger' => 'hover',
            'updateAnimation' => true
        );
        
        foreach($this->options as $key=>$value){
            if (!array_key_exists($key,$_default_options)){
                continue;
            }
            if($value!=$_default_options[$key]){
                $_build_options[$key]=$value;
            }
        }
        
        
        $_build_options=  CJavaScript::encode($_build_options);
        $_build_options = preg_replace('#\s+#',' ',$_build_options);
        return $_build_options;
    }
}

?>
