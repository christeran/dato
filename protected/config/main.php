<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//set default language 
//if (!isset(Yii::app()->request->cookies['language']))
//{               $daysExpires = 100;
//    Yii::app()->setLanguage('es');
//    $cookie = new CHttpCookie('language', 'es');
//    $cookie->expire = time() + 60 * 60 * 24 * $daysExpires;
//    Yii::app()->request->cookies['language'] = $cookie;
//}
 
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'language'=>'es',
        'theme'=>"classic",

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

        'timeZone' => 'America/Lima',

	// application components
	'components'=>array(            
                'authManager'=>array(
                    "class"=>"CDbAuthManager",
                    "connectionID"=>"db",
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
                        //'class'=>'applicationcomponents.MyCUrlManager',
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'urlSuffix'=>'',
			'rules'=>array(
                                'categoria/<nombre:\w+>' => 'categorias/VerPorCategoria',
                                'departamento/<nombre:\w+>' => 'provincias/VerPorProvincia',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                
                                
			),
		),
            
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

switch ($_SERVER['SERVER_NAME']) {
    case 'christeran.com':
        $config = CMap::mergeArray(
            $config,
          //  require(dirname(__FILE__) . '/main_prod.php')
            require(dirname(__FILE__) . '/main_prod.php')
        );
        break;
    default:
        $config = CMap::mergeArray(
            $config,
            require(dirname(__FILE__) . '/main_dev.php')
        );
        break;
}

return $config;