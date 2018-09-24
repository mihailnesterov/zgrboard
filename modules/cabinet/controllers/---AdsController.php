<?php

/*namespace app\modules\cabinet\controllers;

class AdsController extends \yii\web\Controller
{
    public function actionAds()
    {
        return $this->render('ads');
    }

}*/

namespace app\modules\cabinet\controllers;

use Yii;
use app\modules\cabinet\models\CabinetAds;
use app\modules\cabinet\models\CabinetAdsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdsController implements the CRUD actions for CabinetAds model.
 */
class AdsController extends Controller
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
     * Lists all CabinetAds models.
     * @return mixed
     */
    /*public function actionIndex1()
    {
        $searchModel = new CabinetAdsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single CabinetAds model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionViewAds($id)
    {
        return $this->render('view-ads', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new CabinetAds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionAdd()
    {
        $model = new CabinetAds();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-ads', 'id' => $model->id]);
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }*/
    /**
     * Updates an existing CabinetAds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdateAds($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-ads', 'id' => $model->id]);
        }

        return $this->render('update-ads', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing CabinetAds model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionDeleteAds($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the CabinetAds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CabinetAds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*protected function findModel($id)
    {
        if (($model = CabinetAds::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}