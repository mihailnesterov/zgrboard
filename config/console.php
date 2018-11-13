<?php

return [
    'id' => 'zgrboard-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'components' => [
        'db' => require(__DIR__.'/db.php'), // добавить в config/web.php!!!
    ]
];
