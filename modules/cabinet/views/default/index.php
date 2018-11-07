<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\cabinet\models\CabinetAds;

// получить типы (type) объявлений данного пользователя
$types_list = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->select('type')->groupBy('type')->orderby(['type'=>SORT_ASC])->all();
// счетчики для кнопок - все/опубликованные/неопубликванные
$ads_all_count = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->count();
$ads_active_count = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->andWhere(['>', 'date_end', date('Y.m.d H:i:s')])->count();
$ads_not_active_count = CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->andWhere(['<', 'date_end', date('Y.m.d H:i:s')])->count();
$this->title = 'Мои объявления'; //.Yii::$app->user->id
?>

<main role="main">
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="visible-xs col-xs-offset-1 col-xs-10" style="margin-bottom: 1.5em;">
                <?= Html::a('Подать объявление', Yii::$app->homeUrl.'cabinet/add', ['class' => 'btn-orange']) ?>
            </div>
            
           
            <div class="col-xs-12">
                <div class="btn-group pull-left" role="toolbar" aria-label="">
                    <?= Html::a('Все ('.$ads_all_count.')', Yii::$app->homeUrl.'cabinet', ['class' => 'btn btn-default']) ?>
                    <?= Html::a('Опубликованные ('.$ads_active_count.')', Yii::$app->homeUrl.'cabinet/index?filter=active', ['class' => 'btn btn-default']) ?>
                    <?= Html::a('Неопубликованные ('.$ads_not_active_count.')', Yii::$app->homeUrl.'cabinet/index?filter=expired', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
            
            <div class="ads-container">
                <ul>
                    
                    <?php
                        // вывод объявлений пользователя из БД
                        // $models выводит из actionIndex
                        
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
                            
                            if (date('Y.m.d H:i:s') < $date_end->format('Y.m.d H:i:s'))
                                {
                                    $ads_active = '<span style="color: green;">Опубликовано</span>';
                                }
                                else {
                                    $ads_active = '<span style="color: red;">Неопубликовано</span>';
                                }
                            $category = \app\models\Category::findOne($ads->category_id);
                            
                            echo '<li class="col-sm-6 col-lg-4">'
                            . '<div class="ads-block">'
                            . '<a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-ads?id='.$ads->id]).'"><img src="'.$ads_photo1.'" alt="" class="img-responsive"></a>'
                            . '<h3 class="ads-header"><a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-ads?id='.$ads->id]).'">'.$ads->title.'</a></h3>'
                            . '<p class="ads-price">Цена: '.$ads_price.' р.</p>'
                            . '<p class="ads-date">Дата публикации: '.$created->format('d.m.Y').'</p>'
                            //. '<p class="ads-date">'.date('Y.m.d H:i:s').' > '.$date_end->format('Y.m.d H:i:s').'</p>'
                            . '<p class="ads-date">Категория: '.$category->name.'</p>'
                            . '<p class="ads-date">Просмотров: '.$ads->visits.'</p>'
                            . '<p class="ads-date">Статус: '.$ads_active.'</p>'
                            . '<hr>'
                            . Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', ['view-ads', 'id' => $ads->id], ['class' => 'btn btn-primary ads-block-btn', 'title' => 'Просмотр'])
                            . ' '
                            . Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['update-ads', 'id' => $ads->id], ['class' => 'btn btn-success ads-block-btn', 'title' => 'Редактировать'])
                            . ' '
                            . Html::a('<i class="fa fa-close" aria-hidden="true"></i>', ['stop-ads', 'id' => $ads->id], [
                                    'class' => 'btn btn-warning ads-block-btn', 
                                    'title' => 'Снять с публикации',
                                    'data' => [
                                        'confirm' => 'Вы действительно хотите снять объявление с публикации?',
                                        'method' => 'post',
                                    ],
                                ])
                            . ' '
                            . Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', ['delete', 'id' => $ads->id], [
                                    'class' => 'btn btn-danger ads-block-btn',
                                    'title' => 'Удалить',
                                    'data' => [
                                        'confirm' => 'Вы действительно хотите удалить объявление?',
                                        'method' => 'post',
                                    ],
                                ])
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
</main>

<?php //echo '<pre>'; print_r($model); die;  ?>
