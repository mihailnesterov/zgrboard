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
                    //'users/view' => 'users/view',
                    'users/<id:\d+>' => 'users/view',
                    'login' => 'users/login',
                    'signup' => 'users/signup',
                    'password-restore' => 'users/restore',
                    //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    //'<action>' => 'site/<action>',
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'h6E95Dlc9Lqs78Dmxs6',
            'baseUrl' => '/zgrboard'    // убрать web из url, на хостинге - ''
        ],
        'db' => require(__DIR__.'/db.php'),
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

