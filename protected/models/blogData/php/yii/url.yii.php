调用YII框架中 jquery：Yii::app()->clientScript->registerCoreScript('jquery');    
  
framework/web/js/source的js,其中registerCoreScript key调用的文件在framework/web/js/packages.php列表中可以查看

 在view中得到当前controller的ID方法 ：Yii::app()->getController()->id;      

 在view中得到当前action的ID方法 ：Yii::app()->getController()->getAction()->id;     

 yii获取ip地址 ：Yii::app()->request->userHostAddress;   

 yii判断提交方式 ：Yii::app()->request->isPostRequest  

得到当前域名: Yii::app()->request->hostInfo   

 得到proteced目录的物理路径 ：YII::app()->basePath;     

 获得上一页的url以返回 ：Yii::app()->request->urlReferrer;  

 得到当前url ：Yii::app()->request->url;  

 得到当前home url ：Yii::app()->homeUrl  

 得到当前return url ：Yii::app()->user->returnUrl 

 项目路径 ：dirname(Yii::app()->BasePath) 

 项目目录  Yii::app()->request->baseUrl