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
        
        $search = \Yii::$app->request->get('search');
        $search1 = str_replace(' ', '', $search);
        /*$query = \app\modules\cabinet\models\CabinetAds::find()
                ->where(['like', 'replace(title, " ", "")', $search1])
                ->AndWhere(['like', 'replace(text, " ", "")', $search1]);*/
        $query = CabinetAds::find()
            ->andFilterWhere(['like', 'title',  $search1])
            ->andFilterWhere(['like', 'text',  $search1])
            ->andFilterWhere(['like', 'type',  $search1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 9]);
        $pages->pageSizeParam = false;
        $search_ads = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        //$this->view->title = 'Результаты поиска';
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        
        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'search_ads' => $search_ads,
            'pages' => $pages,
        ]);
        
        /*$this->view->title = 'Результаты поиска';
        
        $searchModel = new \app\modules\cabinet\models\CabinetAdsSearchModel();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $pages = new Pagination(['totalCount' => $searchModel->, 'pageSize' => 9]);
        $pages->pageSizeParam = false;
        $user_ads = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }
    
    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id)
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
}
