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
    
    /**
     * Renders the add view for the module
     * @return string
     */
    public function actionAdd()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new Users();
        
        $this->layout = 'cabinet';
        
        return $this->render('add', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the messages view for the module
     * @return string
     */
    public function actionMessages()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new Users();
        
        $this->layout = 'cabinet';
        
        return $this->render('messages', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the profile view for the module
     * @return string
     */
    public function actionProfile()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new Users();
        
        $this->layout = 'cabinet';
        
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    
    
}
