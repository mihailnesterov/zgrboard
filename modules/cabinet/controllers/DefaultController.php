<?php

namespace app\modules\cabinet\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\SignupForm;
use app\modules\cabinet\models\CabinetUsers;
use app\modules\cabinet\models\CabinetAds;
use app\modules\cabinet\models\CabinetAdsSearchModel;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;


/**
 * Default controller for the `cabinet` module
 */
class DefaultController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->status == 0 )
        {
            // if user is guest or disabled (status=0) - logout
            Yii::$app->user->logout();
            //return $this->goHome();
            return $this->redirect('login');
        }
        
        $searchModel = new CabinetAdsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $model = new CabinetUsers();

        $this->layout = 'cabinet';
        
        $query = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->orderby(['created'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models' => $models,
            'pages' => $pages,
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
        
        $model = new CabinetAds();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $model->photoFile1 = UploadedFile::getInstance($model, 'photoFile1');
            $model->photoFile2 = UploadedFile::getInstance($model, 'photoFile2');
            $model->photoFile3 = UploadedFile::getInstance($model, 'photoFile3');
            $model->photoFile4 = UploadedFile::getInstance($model, 'photoFile4');
            
            if ($model->photoFile1 != null) {
                $model->upload($model->photoFile1, $model->photo1);
            }
            if ($model->photoFile2 != null) {
                $model->upload($model->photoFile2, $model->photo2);
            }
            if ($model->photoFile3 != null) {
                $model->upload($model->photoFile3, $model->photo3);
            }
            if ($model->photoFile4 != null) {
                $model->upload($model->photoFile4, $model->photo4);
            }
            
            return $this->redirect(['view-ads', 'id' => $model->id]);
        }
        
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
        
        $model = $this->findUsersModel(Yii::$app->user->identity->id);
        
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                header("Refresh: 0");
                Yii::$app->view->registerJs(
                "
                    $.gritter.add({
                        title: 'Обновление данных.',
                        text: 'Изменения сохранены',
                        image: '".Yii::$app->homeUrl."images/logo.png',
                        sticky: 'false',
                        time: '50000'
                    });
                "
                );
            }
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
        
        $model = $this->findUsersModel(Yii::$app->user->identity->id);
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->password) {
                $model->setPassword($model->password);
            }
       
            if ($model->save()) {    
                header("Refresh: 0");
                Yii::$app->view->registerJs(
                "
                    $.gritter.add({
                            title: 'Обновление данных.',
                            text: 'Новый пароль сохранен',
                            image: '".Yii::$app->homeUrl."images/logo.png',
                            sticky: 'true',
                            time: '50000'
                        });
                    "
                );
            }
        }
        
        $this->layout = 'cabinet';
        
        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the account page
     * @return string
     */
    public function actionAccount()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $this->layout = 'cabinet';
        return $this->render('account');
    }
    
    /**
     * Renders the payment page
     * @return string
     */
    public function actionPay()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $this->layout = 'cabinet';
        return $this->render('pay');
    }
    
    
    /**
     * Displays a single CabinetAds model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAds($id)
    {
        
        $this->layout = 'cabinet';
        
        return $this->render('view-ads', [
            'model' => $this->findAdsModel($id),
        ]);
    }
    
    /**
     * Updates an existing CabinetAds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAds($id)
    {
        $model = $this->findAdsModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $model->photoFile1 = UploadedFile::getInstance($model, 'photoFile1');
            $model->photoFile2 = UploadedFile::getInstance($model, 'photoFile2');
            $model->photoFile3 = UploadedFile::getInstance($model, 'photoFile3');
            $model->photoFile4 = UploadedFile::getInstance($model, 'photoFile4');
            
            if ($model->photoFile1 != null) {
                $model->upload($model->photoFile1, $model->photo1);
            }
            if ($model->photoFile2 != null) {
                $model->upload($model->photoFile2, $model->photo2);
            }
            if ($model->photoFile3 != null) {
                $model->upload($model->photoFile3, $model->photo3);
            }
            if ($model->photoFile4 != null) {
                $model->upload($model->photoFile4, $model->photo4);
            }
            return $this->redirect(['view-ads', 'id' => $model->id]);
        }
        
        $this->layout = 'cabinet';

        return $this->render('update-ads', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing CabinetAds model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteAds($id)
    {
        $this->findAdsModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findUsersModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Finds the CabinetAds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CabinetAds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAdsModel($id)
    {
        if (($model = CabinetAds::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
