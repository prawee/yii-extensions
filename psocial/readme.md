How to use it.

$this->widget('ext.psocial.PFacebook',array(  
   'model'=>$model,
   'pageId'=>'xxxx',
   'appId'=>'xxxx',
   'appSecret'=>'xxxx',
   'permissions'=>'manage_pages,publish_stream',
   'returnUrl'=>'url of script',
   'action'=>array('/controller/action'),
));
