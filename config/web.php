<?php

return [
    'id' => 'zgrboard',
    'basePath' => realpath(__DIR__.'/../'),
    'name'=>'Мой Зеленогорск',
    'language' => 'ru-RU',
    'bootstrap' => [
        'debug',
        'gii'
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ // правила формирования ссылок
                    /*'' => 'site/index',
                    'category' => 'category/index',
                    'category/<id:\d+>' => 'category/view',
                    'view' => 'site/view',
                    'view/<id:\d+>' => 'site/view',
                    'all-user-ads' => 'site/all-user-ads',
                    'all-user-ads/<id:\d+>' => 'site/all-user-ads',
                    'search' => 'site/search',
                    'place-ads' => 'site/place-ads',
                    'users' => 'users/index',
                    'users/<id:\d+>' => 'users/view',
                    'login' => 'users/login',
                    'signup' => 'users/signup',
                    'password-restore' => 'users/restore',                    
                    'cabinet/<action>' => 'cabinet/default/<action>',
                    'logout' => 'users/logout',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    'sitemap.xml' => 'site/sitemap',
                    'error' => 'site/error',
                    '<action>' => 'site/<action>',*/
                
                    '' => 'site/index',
                    'category' => 'category/index',
                    'category/<id:\d+>' => 'category/view',
                    'view?id=<id:\d+>' => 'site/view',
                    'sitemap.xml' => 'site/sitemap',
                    'login' => 'users/login',
                    'signup' => 'users/signup',
                    'password-restore' => 'users/restore',
                    'logout' => 'users/logout',
                    'cabinet' => 'cabinet/default/index',
                    'cabinet/<action>' => 'cabinet/default/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<action>' => 'site/<action>',
                
                    /*'<module:cabinet>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',*/
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'h6E95Dlc9Lqs78Dmxs6',
            'baseUrl' => '/zgrboard'    // убрать web из url, на хостинге - ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require(__DIR__.'/db.php'),
        'user' => [ // подключаем текущую логику аутентификации
                //'identityClass' => 'app\models\SignupForm',
                'identityClass' => 'app\models\Users',
                'enableAutoLogin' => true,
            ],
        'errorHandler' => [
            'errorAction' => 'site/error'
            ],
        'mailer' => [ // подключаем swiftmailer
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' => true, // send to file in runtime\mail
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.mail.ru',
                    'username' => 'zgrmarket@mail.ru',
                    'password' => 'zgrmarket',
                    'port' => '465', // Port 25 is a very common port too
                    'encryption' => 'ssl', // It is often used, check your provider or mail server specs
                ],
            ],
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => [  // настройки Gii
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        'cabinet' => [
            'class' => 'app\modules\cabinet\Module',
        ]
    ],
    // подключить extensions.php для: Gii
    'extensions' => require(__DIR__.'/../vendor/yiisoft/extensions.php')
];

