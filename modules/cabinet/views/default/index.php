<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

date_default_timezone_set('Asia/Krasnoyarsk');
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
            
            <div class="ads-container">
                <ul>
                    
                    <?php
                        // вывод объявлений пользователя из БД
                        //$ads_list = app\modules\cabinet\models\CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->orderby(['created'=>SORT_DESC])->all();
                        
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
                            $current_date =  date('d.m.Y H:i:s');
                            $date_end = new DateTime($ads->date_end);
                            
                            if (date('Y.m.d H:i:s') < $date_end->format('Y.m.d H:i:s'))
                                {
                                    $ads_active = '<span style="color: green;">Опубликовано</span>';
                                }
                                else {
                                    $ads_active = '<span style="color: red;">Неопубликовано</span>';
                                }
                            
                            echo '<li class="col-sm-6 col-lg-4">'
                            . '<div class="ads-block">'
                            . '<a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-ads?id='.$ads->id]).'"><img src="'.$ads_photo1.'" alt="" class="img-responsive"></a>'
                            . '<h3 class="ads-header"><a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-ads?id='.$ads->id]).'">'.$ads->title.'</a></h3>'
                            . '<p class="ads-price">'.$ads_price.' р.</p>'
                            . '<p class="ads-date">Дата публикации: '.$created->format('d.m.Y').'</p>'
                            . '<p class="ads-date">'.date('Y.m.d H:i:s').' > '.$date_end->format('Y.m.d H:i:s').'</p>'
                            . '<p class="ads-date">Просмотров: '.$ads->visits.'</p>'
                            . '<p class="ads-date">Статус: '.$ads_active.'</p>'
                            . '<hr>'
                            . Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', ['view-ads', 'id' => $ads->id], ['class' => 'btn btn-primary', 'title' => 'Просмотр'])
                            . ' '
                            . Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['update-ads', 'id' => $ads->id], ['class' => 'btn btn-success', 'title' => 'Редактировать'])
                            . ' '
                            . Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', ['delete', 'id' => $ads->id], [
                                    'class' => 'btn btn-danger',
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
