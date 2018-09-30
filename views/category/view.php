<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$category_url = '..'.Yii::$app->homeUrl.'category';

Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->keywords
        ]);
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $model->description
]);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Все объявления', 'url' => [$category_url]];
$this->params['breadcrumbs'][] = $this->title;
?>

<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1><?= Html::encode($model->name) ?></h1>
                                <hr>
                                <div class="hidden-xs">
                                    <?php
                                    echo Breadcrumbs::widget([
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]);
                                    ?>
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
                                                        $ads_photo1 = Yii::$app->homeUrl.'images/users/'.Yii::$app->user->identity->login.'/'.$ads->photo1;
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

                </article>
            
                <?= $this->render('_aside') ?>

        </div> <!-- end row -->
</main>