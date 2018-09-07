<?php

namespace app\controllers;

use yii\web\Controller;

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
        return $this->render('index');
    }
}
