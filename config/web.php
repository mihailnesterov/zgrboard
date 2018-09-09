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
                    'category' => 'site/category',
                    'category/personal_things' => 'site/category',
                    'users' => 'users/index',
                    'users/view' => 'users/view',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<action>' => 'site/<action>',
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
        ]
    ],
    // подключить extensions.php для: Gii
    'extensions' => require(__DIR__.'/../vendor/yiisoft/extensions.php')
];

