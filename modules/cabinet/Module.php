<?php

namespace app\modules\cabinet;

/**
 * cabinet module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\cabinet\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    /*
     * Access Control Filter (ACF) - доступ к админке только авторизованным
     * пользователям - @
     */
    public function behaviors(){
        return [
            'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
   }
}
