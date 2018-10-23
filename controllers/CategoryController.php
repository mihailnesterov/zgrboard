<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Category;
use app\models\CategorySearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new CategorySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
        
        $this->view->title = 'Все объявления';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'объявления зеленогорск краснояркий край'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Все объявления в Зеленогорске Краснояркого края'
        ]);
        
        $route = explode('filter=', $_SERVER['REQUEST_URI']);
        
        if ( !empty($route[2]) ) {
            $filter = urldecode($route[2]);
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['type' => $filter])->orderby(['date_begin'=>SORT_DESC]);
        } elseif ( !empty($route[1]) ) {
            $explode = explode('&page', $route[1]);
            $filter = urldecode($explode[0]);
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['type' => $filter])->orderby(['date_begin'=>SORT_DESC]);
        } else {
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->orderby(['date_begin'=>SORT_DESC]);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            /*'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,*/
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $category_url = '..'.Yii::$app->homeUrl.'category';
        $this->view->title = $model->title;
        $this->view->params['breadcrumbs'][] = ['label' => 'Все объявления', 'url' => [$category_url]];
        $this->view->params['breadcrumbs'][] = $model->title;
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->keywords
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->description
        ]);
        
        $route = explode('filter=', $_SERVER['REQUEST_URI']);
        
        if ( !empty($route[2]) ) {
            $filter = urldecode($route[2]);
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['category_id' => $id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['type' => $filter])->orderby(['date_begin'=>SORT_DESC]);
        } elseif ( !empty($route[1]) ) {
            $explode = explode('&page', $route[1]);
            $filter = urldecode($explode[0]);
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['category_id' => $id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['type' => $filter])->orderby(['date_begin'=>SORT_DESC]);
        } else {
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['category_id' => $id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->orderby(['date_begin'=>SORT_DESC]);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        return $this->render('view', [
            'model' => $model,
            'models' => $models,
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
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
