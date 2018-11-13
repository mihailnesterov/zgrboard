<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

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
                </div>  <!-- end ads-block -->
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
                        </div>  <!-- end ads-block -->
                        <div class="col-sm-4 col-md-4">
                            <div class="ads-block">
                                <p class="ads-text">Объявление № <?= $model->id?></p>
                                <p class="ads-text">Опубликовано: <?= $created->format('d.m.Y'); ?> </p>
                                <p class="ads-text">Просмотров: <?= $visits->visits ?></p>
                            </div>  <!-- end ads-block -->
                            <div class="ads-block">
                                <h3>Контакты:</h3>
                                <hr>
                                <p class="ads-price ads-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $user->login?></p>
                                <p class="ads-price ads-text"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> <?= $user->phone ?> </p>                                    
                            </div>  <!-- end ads-block -->
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
                            </div>  <!-- end ads-block -->
                            <div class="ads-block">
                                <p class="text-center ads-text"><a href="<?=Yii::$app->urlManager->createUrl(['all-user-ads?id='.$model->user_id]) ?>">Все объявления пользователя (<?= \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'user_id', $model->user_id])->count() ?>)</a></p>
                                <hr>
                                <p>
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <?= Html::a('Оставить сообщение', Yii::$app->homeUrl.'login', ['class' => 'btn-orange']) ?>
                                    <?php else: ?>
                                        <?= Html::a('Оставить сообщение', Yii::$app->homeUrl.'cabinet/add-message?sender='.$model->user_id.'&ads='.$model->id, ['class' => 'btn-orange']) ?>
                                    <?php endif; ?>
                                </p>
                            </div>  <!-- end ads-block -->
                            <div class="ads-block">
                                <div class="social-buttons">
                                    <script type="text/javascript">(function() {
                                    if (window.pluso)if (typeof window.pluso.start == "function") return;
                                    if (window.ifpluso==undefined) { window.ifpluso = 1;
                                        var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                        s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                        s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                        var h=d[g]('body')[0];
                                        h.appendChild(s);
                                    }})();</script>
                                    <div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir"></div>
                                </div>
                            </div>  <!-- end ads-block -->
                            
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
                        ->orderby(['rand()'=>SORT_DESC]);
                }  
                else {   // для обычных объявлений выводим похожие, из той-же категории и того-же типа
                $query = \app\modules\cabinet\models\CabinetAds::find()
                        ->where(['>', 'date_end', date('Y.m.d H:i:s')])
                        ->andWhere(['=', 'type', $model->type])
                        ->andWhere(['=', 'category_id', $model->category_id])
                        ->andWhere(['!=', 'id', $model->id])
                        ->orderby(['rand()'=>SORT_DESC]);
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
            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'vip', 1])->orderby(['rand()'=>SORT_DESC]);
            $countQuery = clone $query;
            $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
            $pages->pageSizeParam = false;
            $model_aside = $query->offset($pages->offset)->limit($pages->limit)->all();
            echo $this->render('_aside', ['model_aside' => $model_aside]); 
        ?>
    </div> <!-- end row -->
</main>
