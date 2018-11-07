<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearchModel;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Login user.
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) 
        {
            //return $this->goHome();
            return $this->redirect('cabinet');
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) 
            && $model->login()) 
        {
            
            Yii::$app->view->registerJs(
            "
                $.gritter.add({
                    title: '".$model->login.",',
                    text: 'Добро пожаловать в личный кабинет!',
                    image: '".Yii::$app->homeUrl."images/logo.png',
                    sticky: 'false',
                    time: '5000'
                });
            "
            );
            
            return $this->redirect('cabinet');
        }
        
        $this->layout = 'login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Signup user.
     * @return mixed
     */
    public function actionSignup()
    {
   
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new Users();
            $user->login = $model->login;
            $user->email = $model->email;
            $user->setPassword($model->password);
            //$user->auth_key = \Yii::$app->security->generateRandomKey($lenght = 255);
            $user->auth_key = \Yii::$app->security->generateRandomString($lenght = 255);

            //echo '<pre>'; print_r($user); die;
            if ($user->save()) {
                
                // Акция для новых пользователей - положить 500 р. на счет
                $payment = new \app\modules\cabinet\models\CabinetPayments();
                $payment->user_id = $user->id;
                $payment->sum = '500';
                $payment->source = 'акция для новых пользователей';
                $payment->comment = 'действует: 10.11.18-10.12.18';
                $payment->save();
                
                // create user images directory in web/images/users/
                $user_img_dir_path = \Yii::$app->basePath.'/web/images/users/'.$user->login;
                FileHelper::createDirectory($user_img_dir_path, $mode = 0775, $recursive = false);
                
                // send registration info on user email
                Yii::$app->mailer->compose([
                'html' => 'test',
                'text' => 'test',
                ])
                ->setFrom(['myzgr@mail.ru' => 'Письмо с сайта "Мой Зеленогорск | Доска объявлений"'])
                ->setTo($user->email)
                ->setSubject('Вы успешно зарегистрировались на сайте "Мой Зеленогорск | Доска объявлений"')
                ->setTextBody('Ваш логин: '.$model->login.', ваш пароль: '.$model->password)
                ->setHtmlBody('<p>Ваш логин: <b>'.$model->login.'</b>,<br> ваш пароль: <b>'.$model->password.'</b></p><p>Войти в личный кабинет: <a href="http://myzgr.ru/cabinet" target="_blank">myzgr.ru/cabinet</a></p>')
                ->send();
                
                $message = new \app\modules\cabinet\models\CabinetMessages();
                $message->sender_id = 1;
                $message->receiver_id = $user->id;
                $message->type = 'registration';
                $message->theme = 'Добро пожаловать на сайт!';
                $message->text = 'Вы успешно зарегистрировались на сайте "Мой Зеленогорск | Доска объявлений". '
                        . '<br>Ваш логин: '.$model->login.'<br> Ваш пароль: '.$model->password
                        . '<br>Письмо с логином и паролем отправлено на адрес: '.$user->email;
                $message->save();
                
                $user->login();
                
                return $this->redirect(['/cabinet', 'id' => $user->id]);
               
            } 
        }
        
        $this->layout = 'login';
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    /**
     * Restore user password.
     * @return mixed
     */
    public function actionRestore()
    {
        $model = new Users();
        $this->layout = 'login';
        
        return $this->render('restore', [
            'model' => $model,
        ]);
    }
    
    
    /*
     * Logout user method
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
