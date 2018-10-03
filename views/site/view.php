<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

$category_url = '..'.Yii::$app->homeUrl.'category';
$category = \app\models\Category::findOne($model->category_id);
$ads = \app\modules\cabinet\models\CabinetAds::findOne($model->id);
$user = \app\models\Users::findOne($model->user_id);
$created = new DateTime($model->created);

/*
 * add visits +1
 */
$visits = \app\modules\cabinet\models\CabinetAds::findOne($model->id);
$visits_count = $visits->visits;
$visits->visits = $visits_count+1;
$visits->save();


Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $category->name.', '.$ads->type.', '.$ads->title
        ]);
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $model->title.', объявление от '.$created->format('d.m.Y')
]);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Все объявления', 'url' => [$category_url]];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['category/'.$model->category_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<main role="main">
    <div class="row">
        <article id="content" class="col-md-9">
            
            <header id="content-header" class="col-xs-12">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <hr>
                    <div>
                        <?php
                            echo Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

                            ]);
                        ?>
                    </div>
            </header>
            <div class="ads-container row">
                <div class="ads-block col-xs-12">
                    <p class="ads-text"><?= $model->text?></p>
                </div>
            </div>      <!-- end ads-container -->
            <div class="ads-container row">
                        <div class="ads-block col-sm-8">
                            
                            <?php
                                if (!empty($model->photo1))
                                    {
                                        $photo1 = Yii::$app->homeUrl.'images/users/'.$user->login.'/'.$model->photo1;
                                    }
                                    else {
                                        $photo1 = Yii::$app->homeUrl.'images/ads_default.png';
                                    }
                                    
                                if (!empty($model->photo2))
                                    {
                                        $photo2 = Yii::$app->homeUrl.'images/users/'.$user->login.'/'.$model->photo2;
                                    }
                                    else {
                                        $photo2 = Yii::$app->homeUrl.'images/ads_default.png';
                                    }
                                if (!empty($model->photo3))
                                    {
                                        $photo3 = Yii::$app->homeUrl.'images/users/'.$user->login.'/'.$model->photo3;
                                    }
                                    else {
                                        $photo3 = Yii::$app->homeUrl.'images/ads_default.png';
                                    }
                                if (!empty($model->photo4))
                                    {
                                        $photo4 = Yii::$app->homeUrl.'images/users/'.$user->login.'/'.$model->photo4;
                                    }
                                    else {
                                        $photo4 = Yii::$app->homeUrl.'images/ads_default.png';
                                    }
                            ?>
                            
                            <img src="<?= $photo1 ?>" alt="" id="ads-fit-img" class="img-responsive ads-fit-img">
                            
                            
                            <ul class="row">
                                    <li class="col-xs-6 col-md-3 ads-block-inner-img">
                                        <img src="<?= $photo1 ?>" alt="" class="img-responsive" onclick="selectBigImage(this.src)">
                                    </li>
                                    <li class="col-xs-6 col-md-3 ads-block-inner-img">
                                        <img src="<?= $photo2 ?>" alt="" class="img-responsive" onclick="selectBigImage(this.src)">
                                    </li>
                                    <li class="col-xs-6 col-md-3 ads-block-inner-img">
                                       <img src="<?= $photo3 ?>" alt="" class="img-responsive" onclick="selectBigImage(this.src)">
                                    </li>
                                    <li class="col-xs-6 col-md-3 ads-block-inner-img">
                                        <img src="<?= $photo4 ?>" alt="" class="img-responsive" onclick="selectBigImage(this.src)">
                                    </li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="ads-block">
                                <p class="ads-text">Объявление № <?= $model->id?></p>
                                <p class="ads-text">Опубликовано: <?= $created->format('d.m.Y'); ?> </p>
                                <p class="ads-text">Просмотров: <?= $visits->visits ?></p>
                            </div>
                            <div class="ads-block">
                                <h3>Контакты:</h3>
                                <hr>
                                <p class="ads-price ads-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $user->login?></p>
                                <p class="ads-price ads-text"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <?= $user->phone ?> </p>                                    
                            </div>
                            <div class="ads-block">
                                <h3>Цена:</h3>
                                <hr>
                                <p class="ads-price"><span class="glyphicon glyphicon-rub" aria-hidden="true"></span> 
                                    <?php
                                    if (!empty($model->price))
                                        {
                                            echo $model_price = $model->price;
                                        }
                                        else {
                                            echo $model_price = '0,00';
                                        }
                                    ?> р.</p>
                            </div>
                            <div class="ads-block">
                                <p class="text-center ads-text"><a href="<?=Yii::$app->urlManager->createUrl(['all-user-ads?id='.$model->user_id]) ?>">Все объявления пользователя (<?= \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'user_id', $model->user_id])->count() ?>)</a></p>
                                <hr>
                                <p><a href="#" class="btn-orange">Оставить сообщение</a></p>
                            </div>
                        </div>
                    
            </div>	<!-- end ads-container -->
            
            <?php
                // common ads (похожие объявления)
                $vip = \app\modules\cabinet\models\CabinetAds::findOne($model->vip);
                $premium = \app\modules\cabinet\models\CabinetAds::findOne($model->premium);
                
                if ($vip || $premium) { // для vip или premium выводим объявления этого-же продавца, из той-же категории
                    $query = \app\modules\cabinet\models\CabinetAds::find()
                        ->where(['>', 'date_end', date('Y.m.d H:i:s')])
                        ->andWhere(['=', 'category_id', $model->category_id])
                        ->andWhere(['!=', 'id', $model->id])
                        ->orderby(['date_begin'=>SORT_DESC]);
                }  
                else {   // для обычных объявлений выводим похожие, из той-же категории и того-же типа
                $query = \app\modules\cabinet\models\CabinetAds::find()
                        ->where(['>', 'date_end', date('Y.m.d H:i:s')])
                        ->andWhere(['=', 'type', $model->type])
                        ->andWhere(['=', 'category_id', $model->category_id])
                        ->andWhere(['!=', 'id', $model->id])
                        ->orderby(['date_begin'=>SORT_DESC]);
                }
                
                $countQuery = clone $query;
                $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
                $pages->pageSizeParam = false;
                $model_common = $query->offset($pages->offset)->limit($pages->limit)->all();
                echo $this->render('_common', ['model_common' => $model_common]); 
            ?>
            
        </article>
        
        <?php
            // vip в category/id (категория) 
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'vip', 1])->orderby(['date_begin'=>SORT_DESC]);
            $countQuery = clone $query;
            $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
            $pages->pageSizeParam = false;
            $model_aside = $query->offset($pages->offset)->limit($pages->limit)->all();
            echo $this->render('_aside', ['model_aside' => $model_aside]); 
        ?>
    </div> <!-- end row -->
</main>
