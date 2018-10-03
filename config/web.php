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
                    '' => 'site/index',
                    'category' => 'category/index',
                    'category/<id:\d+>' => 'category/view',
                    'view' => 'site/view',
                    'view/<id:\d+>' => 'site/view',
                    'all-user-ads' => 'site/all-user-ads',
                    'all-user-ads/<id:\d+>' => 'site/all-user-ads',
                    'users' => 'users/index',
                    'users/<id:\d+>' => 'users/view',
                    'login' => 'users/login',
                    'signup' => 'users/signup',
                    'password-restore' => 'users/restore',                    
                    'cabinet/<action>' => 'cabinet/default/<action>',
                    'logout' => 'users/logout',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    /*'<action>' => 'site/<action>',*/
                
                    /*'<module:cabinet>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                    '<module:cabinet>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',*/
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'h6E95Dlc9Lqs78Dmxs6',
            'baseUrl' => '/zgrboard'    // убрать web из url, на хостинге - ''
        ],
        'db' => require(__DIR__.'/db.php'),
        'user' => [ // подключаем текущую логику аутентификации
                //'identityClass' => 'app\models\SignupForm',
                'identityClass' => 'app\models\Users',
                'enableAutoLogin' => true,
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

