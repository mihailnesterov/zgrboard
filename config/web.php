<?php

return [
    'id' => 'zgrboard',
    'basePath' => realpath(__DIR__.'/../'),
    'name'=>'Мой Зеленогорск',
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
                    'site/category' => 'category',
                    'category/<id:\d+>' => 'category/view',
                    'users' => 'users/index',
                    'users/<id:\d+>' => 'users/view',
                    'login' => 'users/login',
                    'signup' => 'users/signup',
                    'password-restore' => 'users/restore',                    
                    'cabinet/<id:\d+>' => 'users/cabinet',
                    //'cabinet' => 'users/cabinet',
                    'logout' => 'users/logout',
                    /*'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<action>' => 'site/<action>',*/
                
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
                'identityClass' => 'app\models\SignupForm',
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

