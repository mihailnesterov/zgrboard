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
            <header class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>               
            </header>
            
            <div class="col-xs-12" style="margin-bottom: 2em; padding: 1em 1em 1em 1em;">
                <div class="row">
                    <!--<div class="col-sm-12">
                        <p class="bg-success text-info">На вашем счету: 1000,00 руб.</p>
                    </div>-->
                    
                    
                    
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
                                <!--<li><a href="#">Баннер в слайдере (Главная, Все объявления)</a></li>
                                <li><a href="#">Баннер в меню каталога (везде)</a></li>
                                <li><a href="#">Баннер в VIP-блоке (везде)</a></li>
                                <li><a href="#">Баннер в ленте объявлений (везде кроме страницы объявления)</a></li>
                                <li><a href="#">Баннер в кабинете пользователя</a></li>-->
                                <?php
                                    // вывод списка баннеров из БД
                                    foreach ($banners as $banner):
                                       echo '<li><a href="'.Yii::$app->urlManager->createUrl(['advert/'.$banner->id]).'">'.$banner->name.'</a></li>';
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
                                        echo '<li><a href="'.Yii::$app->urlManager->createUrl(['messages/'.$order->id]).'">'.$order->theme.' от '.$created->format('d.m.Y').'</a></li>';
                                    endforeach;
                                ?>
                            </ol>
                            
                        </div>
                    </div>  <!-- end col -->
                    
                </div>  <!-- end row -->
            </div>  <!-- end col -->
        </div>  <!-- end row -->
    </article>
</main>