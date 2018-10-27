<?php

/* 
 * Advert
 */

use yii\helpers\Html;

$this->title = 'Моя реклама';
?>

<main role="main">
    
    <div class="row visible-xs">
        <div id="go-back-pannel" class="col-xs-12">
            <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', 'javascript:history.go(-1)', ['class' => 'btn btn-link']) ?>
        </div>
    </div> <!-- end row -->
    
    <article id="content">
        <div class="row">
            <header class="col-xs-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>               
            </header>
            
            <div class="col-xs-12" style="margin-bottom: 2em; padding: 1em 1em 1em 1em;">
                <div class="row">      
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-md-7">
                                    <p class="bg-warning text-info">На вашем счету: 1000,00 руб.</p>
                                </div>
                                <div class="col-xs-8 col-sm-6 col-md-5 col-lg-3">
                                    <?= Html::a('Разместить баннер', Yii::$app->homeUrl.'cabinet/add-advert', ['class' => 'btn-orange']) ?>
                                </div>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                    <div class="col-sm-6">
                        <div style="border: 1px #eee solid; padding: 1em; margin-bottom: 1em;">
                            <h3>Мои баннеры</h3>
                            <hr>
                            <ol style="list-style-type: disk; margin-left: 1em; line-height: 1.5; font-size: 1.2em;">
                                <?php
                                    // вывод списка баннеров из БД
                                    foreach ($banners as $banner):
                                       echo '<li><a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-advert?id='.$banner->id]).'">'.$banner->name.'</a></li>';
                                    endforeach;
                                ?>
                            </ol>
                        </div>
                    </div>   <!-- end col -->
                    
                    <div class="col-sm-6">
                        <div style="border: 1px #eee solid; padding: 1em; margin-bottom: 1em;">
                            <h3>Мои заявки</h3>
                            <hr>
                            <ol style="list-style-type: disk; margin-left: 1em; line-height: 1.5; font-size: 1.2em;">
                                <?php
                                    // вывод списка заявок из БД
                                    foreach ($orders as $order):
                                        $created = new DateTime($order->created);
                                        echo '<li><a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-message?id='.$order->id]).'">'.$order->theme.' от '.$created->format('d.m.Y').'</a></li>';
                                    endforeach;
                                ?>
                            </ol>
                            
                        </div>
                    </div>  <!-- end col -->
                    
                    <div class="col-sm-12">
                        <div class="content-block">
                            <h2>Рекламные баннеры</h2>
                            <p>Рекламный баннер - графическое изображение вашего продукта, услуги, акции, предложения, реклама вашего бренда, бизнеса, коммерческого или некоммерческого объявления и т.д. Баннеры размещаются в специальных блоках на главной странице сайта, на страницах категорий объявлений, в меню каталога объявлений и в личном кабинете пользователя.</p>
                            <p>При клике по баннеру осуществляется переход по ссылке. Ссылка может вести на ваш собственный веб-сайт, профиль или группу в социальной сети или на ваше объявление.</p>
                            <p>Минимальный срок размещения баннера - одна неделя. Стоимость размещения зависит от расположения рекламного блока (см. таблицу ниже). Оплата списывается ежедневно с вашего личного счета. Изготовление баннера в стоимость размещения не входит.</p> 
                            <p>Вы можете предоставить свой макет или заказать изготовление баннера у нас. Чтобы разместить баннер, <?= Html::a('оформите заявку', Yii::$app->homeUrl.'cabinet/add-advert') ?> - ваша заявка будет рассмотрена в течение одного рабочего дня.</p>
                        </div>	<!-- end content-block -->
                        
                        <div class="content-block">
                            <h2>Цены на размещение баннеров</h2>
                            <table class="table table-bordered table-responsive1 table-striped">
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
                    </div>  <!-- end col -->
                    
                    <div class="col-sm-8">
                        <div class="content-block">
                            <h2>Расположение баннеров</h2>
                            <img src="<?= Yii::$app->homeUrl ?>images/banners/banner-positions.png" alt="Расположение баннеров" width="100%" class="img-responsive">
                        </div>	<!-- end content-block -->
                    </div>  <!-- end col -->
                    
                </div>  <!-- end row -->
            </div>  <!-- end col -->
        </div>  <!-- end row -->
    </article>
</main>