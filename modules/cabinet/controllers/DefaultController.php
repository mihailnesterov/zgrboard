<?php

namespace app\modules\cabinet\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\SignupForm;
use app\models\LoginForm;

/**
 * Default controller for the `cabinet` module
 */
class DefaultController extends Controller
{
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new Users();
        $this->layout = 'cabinet';
        //return $this->render('index');
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
