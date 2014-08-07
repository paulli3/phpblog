<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'中联畅想-CPS',
	'defaultController' => 'Blog',
	'language'=>'zh_cn',
	//'sourceLanguage'=>'en_us',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'components'=>array(  
		       'filecache'=>array(  
		         'class'=>'system.caching.CFileCache',      
		         //我们使用CFileCache实现缓存,缓存文件存放在runtime文件夹中  
		         'directoryLevel'=>'2',   //缓存文件的目录深度  
		       ),  
		),
		//Yii::app()->filecache ->set($key, $value, $expire);  
		//Yii::app()->filecache ->get($key);  
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
//			'loginUrl'=>'',
//			'homeUrl'=>''
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path', 
			'rules'=>array(
				//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<action:\w+>(/<id:\w*>)?'=>'blog/<action>/id/<id>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
//		'db'=>array(
//			'connectionString' => 'mysql:host=10.163.235.148;dbname=cps7433',
//			'emulatePrepare' => true,
//			'username' => 'cps7433',
//			'password' => 'cps7433123456',
//			'charset' => 'utf8',
//		//	'schemaCachingDuration'=>3600,   //表结构缓存。。 不是数据缓存
//			'tablePrefix' => 'tbuserl_',
//			
//		//	'schemaCachingExclude' => array(), //不需要缓存的表名数组
//		//	'schemaCacheID' => 'cache', //使用的缓存组件
//			//此外，CDbConnection中还有关于数据库查询的缓存配置，不过这里只是一个全局的配置
//			//查询缓存配置
//		//	'queryCachingDuration' => 3600,//缓存时间             数据库缓存，要配合下面的cache选项来配合,比如 CFileCache 文件缓存，也可以使用memcache来缓存
//			'queryCachingDependency' => null, //缓存依赖
//			'queryCachingCount' => 12, //第一次使用这条sql语句后同样的多少条sql语句需要缓存
//			'queryCacheID' => 'cache', //使用的缓存组件
//					
//		),
//		'db_7433'=>array(
//			'connectionString' => 'mysql:host=10.163.235.148;dbname=cps7433',
//			'emulatePrepare' => true,
//			'class' => 'CDbConnection',
//			'username' => 'cps7433',
//			'password' => 'cps7433123456',
//			'charset' => 'utf8',
//		//	'schemaCachingDuration'=>3600,   //表结构缓存。。 不是数据缓存
//			'tablePrefix' => 'tbl_',
//			  
//		//	'schemaCachingExclude' => array(), //不需要缓存的表名数组
//		//	'schemaCacheID' => 'cache', //使用的缓存组件
//			//此外，CDbConnection中还有关于数据库查询的缓存配置，不过这里只是一个全局的配置
//			//查询缓存配置
//		//	'queryCachingDuration' => 3600,//缓存时间             数据库缓存，要配合下面的cache选项来配合,比如 CFileCache 文件缓存，也可以使用memcache来缓存
//		//	'queryCachingDependency' => null, //缓存依赖
//		//	'queryCachingCount' => 12, //第一次使用这条sql语句后同样的多少条sql语句需要缓存
//		//	'queryCacheID' => 'cache', //使用的缓存组件
//					
//		),
		
//		'cache' => array(
//            'class' => 'CFileCache',
//        ),

		'cache'=>array(
                        'class'=>'ext.redis.CRedisCache',
                        //if you dont set up the servers options it will use the default one 
                        //"host=>'127.0.0.1',port=>6379"
                        'servers'=>array(
                                array(
                                        'host'=>'192.128.128.96',
                                        'port'=>6379,
                                ),
                                //if you use 2 servers
//                                array(
//                                        'host'=>'server2',
//                                        'port'=>6379,
//                                ),
                        ),
            ),

        
        
//        'CURL' =>array(
//		   'class' => 'application.extensions.curl.Curl',
//		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'blog/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(//Yii::log('xxxx', 'info','pay');
					'class'=>'CFileLogRoute',
					'categories' => 'api.*',
					'logFile'	=>	'api',
					'levels'=>'error, warning,info',
				),
				array(//Yii::log('xxxx', 'info','pay');
					'class'=>'CFileLogRoute',
					'categories' => 'firstpay.*',
					'logFile'	=>	'firstpay',
					'levels'=>'error, warning,info',
				),
				// uncomment the following to show log messages on web pages
				//查看执行的mysql 语句
				array(
					'class'=>'CWebLogRoute',
					'levels' =>'warning',
	     			'categories' => 'system.db*', 
				),
/*
 * CDbLogRoute: 将信息保存到数据库的表中。
CEmailLogRoute: 发送信息到指定的 Email 地址。
CFileLogRoute: 保存信息到应用程序 runtime 目录中的一个文件中。
CWebLogRoute: 将 信息 显示在当前页面的底部。
CProfileLogRoute: 在页面的底部显示概述（profiling）信息。
 */
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'firstPayKey'	=>	'12321',
	),
);
//
//if ($_SERVER['SERVER_ADDR']=='127.0.0.1'){
//	$config['components']['db']	= array(
//			'connectionString' => 'mysql:host=127.0.0.1;dbname=user',
//			'emulatePrepare' => true,
//			'username' => 'root',
//			'password' => '',
//			'charset' => 'utf8',
//		//	'schemaCachingDuration'=>3600,   //表结构缓存。。 不是数据缓存
//			'tablePrefix' => 'tbl_',
//			
//		//	'schemaCachingExclude' => array(), //不需要缓存的表名数组
//		//	'schemaCacheID' => 'cache', //使用的缓存组件
//			//此外，CDbConnection中还有关于数据库查询的缓存配置，不过这里只是一个全局的配置
//			//查询缓存配置
//		//	'queryCachingDuration' => 3600,//缓存时间             数据库缓存，要配合下面的cache选项来配合,比如 CFileCache 文件缓存，也可以使用memcache来缓存
//			'queryCachingDependency' => null, //缓存依赖
//			'queryCachingCount' => 12, //第一次使用这条sql语句后同样的多少条sql语句需要缓存
//			'queryCacheID' => 'cache', //使用的缓存组件
//					
//		);
//	$config['components']['db_7433'] = array(
//			'connectionString' => 'mysql:host=127.0.0.1;dbname=7433datacenter',
//			'emulatePrepare' => true,
//			'class' => 'CDbConnection',
//			'username' => 'root',
//			'password' => '',
//			'charset' => 'utf8',
//		//	'schemaCachingDuration'=>3600,   //表结构缓存。。 不是数据缓存
//			'tablePrefix' => 'tbl_',
//			
//		//	'schemaCachingExclude' => array(), //不需要缓存的表名数组
//		//	'schemaCacheID' => 'cache', //使用的缓存组件
//			//此外，CDbConnection中还有关于数据库查询的缓存配置，不过这里只是一个全局的配置
//			//查询缓存配置
//		//	'queryCachingDuration' => 3600,//缓存时间             数据库缓存，要配合下面的cache选项来配合,比如 CFileCache 文件缓存，也可以使用memcache来缓存
//		//	'queryCachingDependency' => null, //缓存依赖
//		//	'queryCachingCount' => 12, //第一次使用这条sql语句后同样的多少条sql语句需要缓存
//		//	'queryCacheID' => 'cache', //使用的缓存组件
//					
//		);
//}

return $config;