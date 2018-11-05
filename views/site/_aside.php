<?php

use yii\helpers\Html;

/*
 * aside site/index
 */
?>

<aside id="aside-right" class="col-md-3">
        <div id="vip-block" class="ads-container row">
                <h3>VIP-объявления</h3>
                <?php
                    // вывод объявлений из БД
                    // $model_aside выводит из site/index.php

                    foreach ($model_aside as $ads):
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

                        echo '<div class="ads-block ads-vip col-xs-12">'
                        . '<a href="'.Yii::$app->urlManager->createUrl(['view?id='.$ads->id]).'"><img src="'.$ads_photo1.'" alt="" class="img-responsive"></a>'
                        . '<h3 class="ads-header"><a href="'.Yii::$app->urlManager->createUrl(['view?id='.$ads->id]).'">'.$ads->title.'</a></h3>'
                        . '<p class="ads-price">Цена: '.$ads_price.' р.</p>'
                        . '<p class="ads-date">Дата публикации: '.$created->format('d.m.Y').'</p>'
                        . '<p class="ads-date">Категория: '.'<a href="'.Yii::$app->urlManager->createUrl(['category/'.$category->id]).'">'.$category->name.'</a></p>'
                        . '<p class="ads-date">Просмотров: '.$ads->visits.'</p>'
                        . '</div>';
                    endforeach;
                ?>
        </div> 	<!-- end ads-container -->
        <div class="banners">
            <img src="images/banners/genergy.jpg" alt="Баннер в VIP-блоке 1" width="100%" class="img-responsive">
            <img src="images/banners/reanimaciya.jpg" alt="Баннер в VIP-блоке 2" width="100%" class="img-responsive">
            <a href="<?= Yii::$app->urlManager->createUrl(['place-ads']) ?>">Разместить рекламу</a>
        </div>
</aside> <!-- end aside-right -->