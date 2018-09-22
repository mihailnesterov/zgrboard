<?php

namespace app\modules\cabinet\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
//use app\models\SignupForm;
//use app\models\LoginForm;
use app\modules\cabinet\models\CabinetUsers;
use yii\web\NotFoundHttpException;

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
        
        $model = new CabinetUsers();
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
        
        $model = new CabinetUsers();
        
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
        
        $model = new CabinetUsers();
        
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

        //$model = $this->findModel($this->id);
        $model = new CabinetUsers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
        }
        
        $this->layout = 'cabinet';
        
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the change-password view for the module
     * @return string
     */
    public function actionChangePassword()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new CabinetUsers();
        
        $this->layout = 'cabinet';
        
        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
    
    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CabinetUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
