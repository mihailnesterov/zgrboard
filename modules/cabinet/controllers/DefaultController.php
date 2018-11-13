<?php

namespace app\modules\cabinet\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\SignupForm;
use app\modules\cabinet\models\CabinetUsers;
use app\modules\cabinet\models\CabinetAds;
use app\modules\cabinet\models\CabinetAdsSearchModel;
use app\modules\cabinet\models\CabinetBanners;
use app\modules\cabinet\models\CabinetBannerPositions;
use app\modules\cabinet\models\CabinetAdsPrice;
use app\modules\cabinet\models\CabinetMessages;
use app\modules\cabinet\models\CabinetPayments;
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
        date_default_timezone_set('Asia/Krasnoyarsk');
        $searchModel = new CabinetAdsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //$model = new CabinetUsers();

        $this->layout = 'cabinet';

        $route = explode('=', $_SERVER['REQUEST_URI']);
        
        $query = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->orderby(['created'=>SORT_DESC]);
        
        if( !empty($route[1]) ) {
            if( substr($route[1], 0, 6) === 'active' ) {
                $query = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->orderby(['created'=>SORT_DESC]);
            } elseif ( substr($route[1], 0, 7) === 'expired' ) {
                $query = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->andWhere(['<', 'date_end', date('Y.m.d H:i:s')])->orderby(['created'=>SORT_DESC]);
            }
        }
        
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
        
        $this->layout = 'cabinet';
        
        /*$model = CabinetMessages::find()
                ->where(['sender_id' => \Yii::$app->user->identity->id])
                ->orWhere(['receiver_id' => \Yii::$app->user->identity->id])
                ->orderby(['created'=>SORT_ASC])
                ->all();*/
        //$sender = Users::findOne(\Yii::$app->user->identity->id);
        
        $query = CabinetMessages::find()
                ->where(['sender_id' => \Yii::$app->user->identity->id])
                ->orWhere(['receiver_id' => \Yii::$app->user->identity->id])
                ->orderby(['created'=>SORT_DESC]);      
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15]);
        $pages->pageSizeParam = false;
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('messages', [
            'model' => $model,
            'pages' => $pages
        ]);
    }
    
    /**
     * Displays a single CabinetAds model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewMessage($id)
    {
        
        if (Yii::$app->user->isGuest)
        {
            return $this->GoHome();
        }        
        
        $this->layout = 'cabinet';
        $new_model = new CabinetMessages();
        $model = $this->findMessagesModel($id);
        
        /*if ($model->sender_id <> Yii::$app->user->identity->id || $model->receiver_id <> Yii::$app->user->identity->id )
        {
            echo $model->id.'<br>';
            echo $model->sender_id.'<br>';
            echo Yii::$app->user->identity->id.'<br>';
            return $this->goBack();
        }*/
        
        $sender = Users::findOne($model->sender_id);
        $receiver = Users::findOne($model->receiver_id);
        $message_list = CabinetMessages::find()
                ->where(['sender_id' => Yii::$app->user->identity->id])
                ->orWhere(['receiver_id' => Yii::$app->user->identity->id])
                ->orderby(['created'=>SORT_DESC])->all();
        
        if ($new_model->load(Yii::$app->request->post()) && $new_model->save()) { 
            return $this->redirect(['messages']);
        }
        
        return $this->render('view-message', [
            'model' => $model,
            'new_model' => $new_model,
            'sender' => $sender,
            'receiver' => $receiver,
            'message_list' => $message_list
        ]);
    }
    
    /**
     * Renders the add message page for the module
     * @return string
     */
    public function actionAddMessage()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $this->layout = 'cabinet';
        
        $model = new CabinetMessages();
        
        $route = explode('=', $_SERVER['REQUEST_URI']);
        
        
        if( !empty($route[1]) ) {
            $receiver_id = explode('&', $route[1]);
            $receiver_id = $receiver_id[0];
            $receiver = Users::find()->where(['id' => $receiver_id])->one();
            $sender = Users::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        
        if( !empty($route[2]) ) {
            $ads_id = $route[2];
            $ads = CabinetAds::findOne($ads_id);
        }    
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            
            Yii::$app->mailer->compose([
                'html' => 'test',
                'text' => 'test',
                ])
                ->setFrom(['mhause@mail.ru' => 'Сообщение с сайта "Мой Зеленогорск | Доска объявлений"'])
                ->setTo('zgrmarket@mail.ru')
                ->setSubject('Сообщение от пользователя')
                ->setTextBody('Сообщение от пользователя: <b>'.$sender->login.'</b>, по объявлению: <b>'.$ads->title.'</b>')
                ->setHtmlBody('<p>Сообщение от пользователя: '.$sender->login.', по объявлению: '.$ads->title.'</p><p><a href="http://myzgr.ru/cabinet/view-message?id='.$model->id.'">Ответить</a></p>')
                ->send();
            
            return $this->redirect(['/view?id='.$ads_id]);
        }

        return $this->render('add-message', [
            'model' => $model,
            'sender' => $sender,
            'receiver' => $receiver,
            'ads_id' => $ads_id,
            'ads' => $ads
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
     * Renders the advert page
     * @return string
     */
    public function actionAdvert()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $banners = CabinetBanners::find()->where(['user_id' => \Yii::$app->user->identity->id])->orderby(['created'=>SORT_DESC])->all();       
        $orders = CabinetMessages::find()->where(['sender_id' => \Yii::$app->user->identity->id])->andWhere(['type' => 'advert'])->orderby(['created'=>SORT_DESC])->all();
        
        $banner_price = CabinetBannerPositions::find()->all();
        $ads_price = CabinetAdsPrice::find()->all();       
        
        $this->layout = 'cabinet';
        return $this->render('advert', [
            'banners' => $banners,
            'banner_price' => $banner_price,
            'ads_price' => $ads_price,
            'orders' => $orders
        ]);
    }
    
    /**
     * Renders the advert page
     * @return string
     */
    public function actionAddAdvert()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new CabinetMessages();
        
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                //header("Refresh: 0");
                Yii::$app->view->registerJs(
                "
                    $.gritter.add({
                        title: 'Сообщения.',
                        text: 'Заявка отправлена',
                        image: '".Yii::$app->homeUrl."images/logo.png',
                        sticky: 'false',
                        time: '50000'
                    });
                "
                );
            }
            
            return $this->redirect(['advert']);
        }

        $this->layout = 'cabinet';
        return $this->render('add-advert', [
            'model' => $model
        ]);
    }
    
    /**
     * Renders the advert view page
     * @return string
     */
    public function actionViewAdvert()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $this->layout = 'cabinet';
        return $this->render('view-advert');
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
        date_default_timezone_set('Asia/Krasnoyarsk');
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
     * Stops an existing CabinetAds model.
     * If stopping is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionStopAds($id)
    {
        $model = $this->findAdsModel($id);
        date_default_timezone_set('Asia/Krasnoyarsk');
        $current_date =  date('Y-m-d H:i:s');
        $model->date_end = $current_date; 
        $model->save();
        return $this->redirect(['view-ads', 'id' => $model->id]);
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
    
    /**
     * Finds the CabinetBanners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CabinetBanners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBannersModel($id)
    {
        if (($model = CabinetBanners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Finds the CabinetMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CabinetMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMessagesModel($id)
    {
        if (($model = CabinetMessages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /*
     * send payment's data to layout
     */
    public function getPaymentSum()
    {
        $sum = CabinetPayments::find()->where(['user_id' => Yii::$app->user->identity->id])->sum('sum');
        return $this->view->params['sum'] = $sum;
    }
    
     /*
     * get user data
     */
    public function getUserData($id)
    {
        $user = CabinetUsers::find()->where(['id' => $id])->one();
        return $this->view->params['user'] = $user;
    }

}
