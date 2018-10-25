<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\cabinet\models\CabinetAds;
use yii\data\Pagination;

class SiteController extends Controller
{
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
                ->orWhere(['like', 'replace(text, " ", "")', $search1]);
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
}
