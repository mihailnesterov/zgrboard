<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\modules\cabinet\models\CabinetAds;
use yii\data\Pagination;

class SiteController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $this->view->title = 'Доска объявлений';
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'доска объявлений зеленогорск краснояркий край'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Подать бесплатное объявление, продажа, покупка, обмен, аренда в Зеленогорске Краснояркого края'
        ]);
        
        $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->orderby(['date_begin'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    
    public function actionSearch()
    {
        
        $search = \Yii::$app->request->get('searchField');
        
        /*$explode = explode(' ', $search);
        $search2 = '';
        for ($i = 0; $i < count($explode); $i++) {
            $search2 = substr($explode[$i], 0, strlen($explode[$i])-1);
            $search2 = $search2.$explode[$i];
            
        }
        echo $search2.'<br>';*/
        
        $search1 = str_replace(' ', '', $search);
        $query = \app\modules\cabinet\models\CabinetAds::find()
                ->where(['like', 'replace(title, " ", "")', $search1])
                ->orWhere(['like', 'replace(text, " ", "")', $search1])
                ->andWhere(['>', 'date_end', date('Y.m.d H:i:s')]);
        $query_count = $query->count();
        /*$query = CabinetAds::find()
            ->FilterWhere(['like', 'replace(title, " ", "")',  $search1])
            ->andFilterWhere(['like', 'replace(text, " ", "")',  $search1]);*/
        /*$query = CabinetAds::find()
            ->where(['like', 'title',  $search]);*/
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 9]);
        $pages->pageSizeParam = false;
        $search_ads = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'поиск объявлений зеленогорск'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Найденные объявления Зеленогорск Краснояркий край'
        ]);
        $category_url = '..'.\Yii::$app->homeUrl.'category';
        $this->view->title = 'Результаты поиска';
        $this->view->params['breadcrumbs'][] = ['label' => 'Все объявления', 'url' => [$category_url]];
        $this->view->params['breadcrumbs'][] = 'Результаты поиска: "'.$search.'" (найдено: '.$query_count.')' ;
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        
        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'search_ads' => $search_ads,
            'pages' => $pages,
        ]);
    }
    
    /**
     * Displays a single ads model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $category_url = '..'.\Yii::$app->homeUrl.'category';
        $category = \app\models\Category::findOne($model->category_id);

        $this->view->title = $model->title;
        $this->view->params['breadcrumbs'][] = ['label' => 'Все объявления', 'url' => [$category_url]];
        $this->view->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['category/'.$model->category_id]];
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        return $this->render('view', [
            'model' => $model
        ]);
    }
    
    /**
     * Displays a single User model - all users's ads.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAllUserAds($id)
    {
        $user = \app\models\Users::findOne($id);
        $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=','user_id', $id])->orderby(['date_begin'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 9]);
        $pages->pageSizeParam = false;
        $user_ads = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('all-user-ads', [
            'user' => $user,
            'user_ads' => $user_ads,
            'pages' => $pages,
        ]);
    }
    
    /**
     * Displays a place ads page
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPlaceAds()
    {
        $this->view->title = 'Разместить рекламу на сайте';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'реклама зеленогорск красноярский край'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Разместить рекламу на сайте объявлений Мой Зеленогорск, условия размещения, заказать рекламный баннер'
        ]);
        
        $banner_price = \app\modules\cabinet\models\CabinetBannerPositions::find()->all();
        $ads_price = \app\modules\cabinet\models\CabinetAdsPrice::find()->all();
        
        return $this->render('place-ads', [
            'banner_price' => $banner_price,
            'ads_price' => $ads_price
        ]);
    }
    
    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\modules\cabinet\models\CabinetAds::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Build sitemap.xml page
     * http://itelect.ru/post/4/sitemap-dlya-proekta-na-yii2
     */
    public function actionSitemap() {
        $urls = array();
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/']), 'weekly' ]);
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/place-ads']), 'weekly' ]);
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/category']), 'weekly' ]);

        $categories = \app\models\Category::find()->all();
        foreach ($categories as $category) {
            array_push($urls, [ \Yii::$app->urlManager->createUrl(['/category/' . $category->id]), 'weekly' ]);
        }

        $ads_list = \app\modules\cabinet\models\CabinetAds::find()->all();
        foreach ($ads_list as $ads) {
            array_push($urls, [ \Yii::$app->urlManager->createUrl(['/view?id=' . $ads->id]), 'daily' ]);
        }
        
        $xml_sitemap = $this->renderPartial('sitemap', [
            'host' => \Yii::$app->request->hostInfo,
            'urls' => $urls
        ]);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        echo $xml_sitemap;
    }
    
    /*
     * Error page (404...)
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception != null) {
            if ($exception instanceof HttpException) {
                return $this->redirect(['404/'])->send();
            }
        }
        return $this->render('error',['exception' => $exception]);
    }
    
    /*
     * get Yandex.Metrika
     */
    public function getYandexMetrika()
    {
        $metrika = '<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter51001274 = new Ya.Metrika2({ id:51001274, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/51001274" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->';
        return $this->view->params['metrika'] = $metrika;
    }
}
