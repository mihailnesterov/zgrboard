<?php

return [
    'id' => 'zgrboard',
    'basePath' => realpath(__DIR__.'/../'),
    'name'=>'Мой Зеленогорск',
    'bootstrap' => [
        'debug'
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ // правила формирования ссылок
                   '' => 'site/index',
                   'category' => 'site/category',
                   'category/personal_things' => 'site/category',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<action>' => 'site/<action>',
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'h6E95Dlc9Lqs78Dmxs6',
            'baseUrl' => '/zgrboard'    // убрать web из url, на хостинге ''
        ],
        'db' => require(__DIR__.'/db.php'),
    ],
    'modules' => [
        'debug' => 'yii\debug\Module'
    ]
];

