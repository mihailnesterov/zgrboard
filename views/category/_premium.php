<?php

use yii\helpers\Html;

/*
 * premium site/index
 */
?>

<div id="premium-block" class="ads-container">
        <h2>Премиум объявления</h2>
        <ul class="row">
            <?php
                // вывод объявлений из БД
                // $model_premium выводит из category/index.php

                foreach ($model_premium as $ads):
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
                    . '<div class="ads-block ads-premium">'
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
