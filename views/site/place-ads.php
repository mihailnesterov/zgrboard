<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $banner_price \app\modules\cabinet\models\CabinetBannerPositions */

?>

<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1><?= $this->title ?></h1>
                                <hr>
                                <div>
                                    <?php
                                    echo Breadcrumbs::widget([
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]);
                                    ?>
                                </div>
                        </header>
                    
                        <div class="content-block">
                            <h2>Платные объявления</h2>
                            <p>Платные объявления размещаются в специальных блоках (VIP, Премиум) и дают возможность увеличить количество просмотров в несколько раз. VIP-объявление будет показано в специальном блоке на всех страницах сайта. Премиум - объявление будет показано в специальном блоке на главной странице, а также в той категории, в которой оно размещено. Стоимость размещения платных объявлений указана в таблице ниже. Минимальный срок размещения - одни сутки. Оплата списывается ежедневно с вашего личного счета. Чтобы подключить платный тариф, войдите в личный кабинет, в разделе "Мои объявления" выберите нужное объявление (или создайте новое), перейдите в редактирование объявления и подключите платный тариф.</p>
                        </div>	<!-- end content-block -->
                        
                        <div class="content-block">
                            <h2>Цены на платные объявления</h2>

                            <table class="table table-bordered table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Тариф</th>
                                        <th>Срок</th>
                                        <th>Цена, руб.</th>
                                        <th>Где отображается</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php            
                                            // вывод цен на платные тарифы из БД
                                            foreach ($ads_price as $price):
                                                echo 
                                                '<tr>'
                                                .'<td>'.$price->id.'</td>'
                                                .'<td>'.$price->name.'</td>'
                                                .'<td>сутки</td>'
                                                .'<td>'.($price->price).'</td>'
                                                .'<td>'.$price->text.'</td>'
                                                .'</tr>';
                                            endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>	<!-- end content-block -->
                        
                        <div class="content-block">
                            <h2>Рекламные баннеры</h2>
                            <p>Рекламный баннер - графическое изображение вашего продукта, услуги, акции, предложения, реклама вашего бренда, бизнеса, коммерческого или некоммерческого объявления и т.д. Баннеры размещаются в специальных блоках на главной странице сайта, на страницах категорий объявлений, в меню каталога объявлений и в личном кабинете пользователя. При клике по баннеру осуществляется переход по ссылке. Ссылка может вести на ваш собственный веб-сайт, профиль или группу в социальной сети или на ваше объявление.</p>
                            <p>Минимальный срок размещения баннера - одна неделя. Стоимость размещения зависит от расположения рекламного блока (см. таблицу ниже). Оплата списывается ежедневно с вашего личного счета. Изготовление баннера в стоимость размещения не входит. Вы можете предоставить свой макет или заказать изготовление баннера у нас. Чтобы разместить баннер, войдите в личный кабинет и оформите заявку в разделе "Моя реклама". Заявка будет рассмотрена в течение одного рабочего дня.</p>
                        </div>	<!-- end content-block -->
                        
                        <div class="content-block">
                            <h2>Цены на размещение баннеров</h2>
                            <table class="table table-bordered table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Позиция</th>
                                        <th>Срок</th>
                                        <th>Цена, руб.</th>
                                        <th>Где отображается</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php            
                                            // вывод цен на баннеры из БД
                                            foreach ($banner_price as $price):
                                                echo 
                                                '<tr>'
                                                .'<td>'.$price->id.'</td>'
                                                .'<td>'.$price->name.'</td>'
                                                .'<td>неделя</td>'
                                                .'<td>'.($price->price*7).'</td>'
                                                .'<td>'.$price->text.'</td>'
                                                .'</tr>';
                                            endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>	<!-- end content-block -->
                        
                        
                        
                        <div class="content-block col-sm-8">
                            <h2>Расположение баннеров</h2>
                            <img src="<?= Yii::$app->homeUrl ?>images/banners/banner-positions.png" alt="Расположение баннеров" width="100%" class="img-responsive">
                        </div>	<!-- end content-block -->
                        
                        <?php
                            // premium site/index  
                            $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'premium', 1])->orderby(['rand()'=>SORT_DESC]);
                            $countQuery = clone $query;
                            $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
                            $pages->pageSizeParam = false;
                            $model_premium = $query->offset($pages->offset)->limit($pages->limit)->all();
                            echo $this->render('_premium', ['model_premium' => $model_premium]); 
                        ?>
                </article>
                
                <?php
                    // vip site/index 
                    $query = \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['=', 'vip', 1])->orderby(['rand()'=>SORT_DESC]);
                    $countQuery = clone $query;
                    $pages = new yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
                    $pages->pageSizeParam = false;
                    $model_aside = $query->offset($pages->offset)->limit($pages->limit)->all();
                    echo $this->render('_aside', ['model_aside' => $model_aside]); 
                ?>
            
        </div> <!-- end row -->
</main>