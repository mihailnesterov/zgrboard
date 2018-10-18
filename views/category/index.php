<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use app\modules\cabinet\models\CabinetAds;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

// получить типы (type) из объявлений и создать их счетчик
$types_list = CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->select('type')->groupBy('type')->orderby(['type'=>SORT_ASC])->all();
$ads_all_count = CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->count();
?>
	
<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1><?= Html::encode($this->title) ?></h1>
                                <hr>
                                
                                <!-- Swiper slider main container -->
                                <div class="swiper-container">
                                        <!-- Swiper slider wrapper -->
                                        <div class="swiper-wrapper">
                                                <!-- Slides -->
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <img src="images/banners/slide1.jpg" alt="" class="img-responsive">
                                                </div>
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <img src="images/banners/slide2.jpg" alt="" class="img-responsive">
                                                </div>
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <img src="images/banners/slide3.jpg" alt="" class="img-responsive">
                                                </div>
                                        </div>
                                        <!-- Swiper slider pagination -->
                                        <div class="swiper-pagination"></div>
                                </div> <!-- end Swiper slider -->

                                <?php
                                echo Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                                ?>

                                <div style="margin: 1em 0;">
                                    <div class="btn-group pull-left" role="toolbar" aria-label="">
                                        <?= Html::a('Все ('.$ads_all_count.')', Yii::$app->homeUrl.'category', ['class' => 'btn btn-default']) ?>
                                        <?php
                                            foreach ($types_list as $type):
                                                $ads_count = CabinetAds::find()->where(['type' => $type->type])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->count();
                                                echo Html::a($type->type.' ('.$ads_count.')', Yii::$app->homeUrl.'category/index?filter='.$type->type, ['class' => 'btn btn-default']);
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
                            <a href="#"><img src="images/banners/slide3.jpg" alt="" class="img-responsive"></a>
                        </div>
                        
                        <?php
                            // premium category (Все объявления)
                            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'premium', 1])->orderby(['date_begin'=>SORT_DESC]);
                            $countQuery = clone $query;
                            $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
                            $pages->pageSizeParam = false;
                            $model_premium = $query->offset($pages->offset)->limit($pages->limit)->all();
                            echo $this->render('_premium', ['model_premium' => $model_premium]); 
                        ?>

                </article>

                <?php
                    // vip category (Все объявления) 
                    $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'vip', 1])->orderby(['date_begin'=>SORT_DESC]);
                    $countQuery = clone $query;
                    $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
                    $pages->pageSizeParam = false;
                    $model_aside = $query->offset($pages->offset)->limit($pages->limit)->all();
                    echo $this->render('_aside', ['model_aside' => $model_aside]); 
                ?>
        </div> <!-- end row -->
</main>