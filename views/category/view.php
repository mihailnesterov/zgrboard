<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use app\modules\cabinet\models\CabinetAds;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

// получить типы (type) объявлений данной категории
$types_list = CabinetAds::find()->where(['category_id' => $model->id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->select('type')->groupBy('type')->orderby(['type'=>SORT_ASC])->all();
$ads_all_count = CabinetAds::find()->where(['category_id' => $model->id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->count();
?>

<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                            <h1><?= Html::encode($model->name) ?></h1>
                            <hr>
                            
                            <?php
                            echo Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]);
                            ?>

                            <div style="margin: 1em 0;">
                                <div class="btn-group pull-left" role="toolbar" aria-label="">
                                    <?= Html::a('Все ('.$ads_all_count.')', Yii::$app->homeUrl.'category/'.$model->id, ['class' => 'btn btn-default']) ?>
                                    <?php
                                        foreach ($types_list as $type):
                                            $ads_count = CabinetAds::find()->where(['category_id' => $model->id])->andWhere(['type' => $type->type])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->count();
                                            echo Html::a($type->type.' ('.$ads_count.')', Yii::$app->homeUrl.'category/'.$model->id.'?filter='.$type->type, ['class' => 'btn btn-default']);
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        </header>                    
                        <div class="ads-container">
                                <ul class="row">
                                        <?php            
                                            // вывод объявлений из БД
                                            // $models выводит из actionCategory

                                            foreach ($models as $ads):
                                                if (!empty($ads->photo1))
                                                    {
                                                        $user = \app\models\Users::find()->where(['id' => $ads->user_id])->one();
                                                        $ads_photo1 = Yii::$app->homeUrl.'images/users/'.$user->login.'/'.$ads->photo1;
                                                    }
                                                    else {
                                                        $ads_photo1 = Yii::$app->homeUrl.'images/ads_default.png';
                                                    }
                                                if (!empty($ads->price))
                                                    {
                                                        $ads_price = $ads->price;
                                                    }
                                                    else {
                                                        $ads_price = '0,00';
                                                    }
                                                $created = new DateTime($ads->created);                           
                                                $current_date =  date('Y.m.d H:i:s');
                                                $date_end = new DateTime($ads->date_end);
                                                $category = \app\models\Category::findOne($ads->category_id);

                                                echo '<li class="col-sm-6 col-lg-4">'
                                                . '<div class="ads-block">'
                                                . '<a href="'.Yii::$app->urlManager->createUrl(['view?id='.$ads->id]).'"><img src="'.$ads_photo1.'" alt="" class="img-responsive"></a>'
                                                . '<h3 class="ads-header"><a href="'.Yii::$app->urlManager->createUrl(['view?id='.$ads->id]).'">'.$ads->title.'</a></h3>'
                                                . '<p class="ads-price">Цена: '.$ads_price.' р.</p>'
                                                . '<p class="ads-date">Дата публикации: '.$created->format('d.m.Y').'</p>'
                                                . '<p class="ads-date">Категория: '.'<a href="'.Yii::$app->urlManager->createUrl(['category/'.$category->id]).'">'.$category->name.'</a></p>'
                                                . '<p class="ads-date">Просмотров: '.$ads->visits.'</p>'
                                                . '</div>'
                                                . '</li>';
                                            endforeach;
                                        ?>

                        </div>	<!-- end ads-container -->
                        
                        <div class="col-xs-12">
                            <?php       
                                echo LinkPager::widget([
                                    'pagination' => $pages,
                                    'registerLinkTags' => true
                                ]);
                            ?>
                        </div>
                        
                        <div class="banners">
                            <a href="#"><img src="images/banners/uspeh.jpg" alt="Баннер в ленте объявлений" width="100%" class="img-responsive"></a>
                        </div>
                        
                        <?php
                            // premium category/id  where category_id = $model->id
                            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'premium', 1])->andWhere(['=', 'category_id', $model->id])->orderby(['rand()'=>SORT_DESC]);
                            $countQuery = clone $query;
                            $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
                            $pages->pageSizeParam = false;
                            $model_premium = $query->offset($pages->offset)->limit($pages->limit)->all();
                            echo $this->render('_premium', ['model_premium' => $model_premium]); 
                        ?>

                </article>
            
                <?php
                    // vip в category/id (категория) 
                    $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'vip', 1])->orderby(['rand()'=>SORT_DESC]);
                    $countQuery = clone $query;
                    $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
                    $pages->pageSizeParam = false;
                    $model_aside = $query->offset($pages->offset)->limit($pages->limit)->all();
                    echo $this->render('_aside', ['model_aside' => $model_aside]); 
                ?>

        </div> <!-- end row -->
</main>