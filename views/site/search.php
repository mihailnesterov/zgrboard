<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\AdsSearchModel */

?>

<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
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
                        <div class="ads-container">
                                <ul class="row">
                                        <?php            
                                            // вывод объявлений из БД
                                            // $search_ads выводит из actionAllUserAds

                                            foreach ($search_ads as $ads):
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
                                </ul>
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