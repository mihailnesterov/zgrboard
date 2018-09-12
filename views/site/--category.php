<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'keywords',
            'description',
        ],
    ]) ?>

</div>-->

<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1><?= Html::encode($this->title) ?></h1>
                                <hr>
                        </header>
                        <div class="ads-container">
                                <h2>Новые объявления</h2>
                                <ul class="row">
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="page.html"><img src="images/ads1.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="page.html">Продам двухкомнатную квартиру в поселке Октябрьском</a></h3>
                                                        <p class="ads-price">1200000 р.</p>
                                                        <p class="ads-date">12.08.2018 21:15</p>
                                                </div>
                                        </li>								
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads2.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам телефон Samsung Galaxy 5</a></h3>						
                                                        <p class="ads-price">23500 р.</p>
                                                        <p class="ads-date">12.08.2018 15:05</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads3.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Детский рюкзачок из экокожи</a></h3>
                                                        <p class="ads-price">2500 р.</p>
                                                        <p class="ads-date">12.08.2018 10:27</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads2.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам телефон Samsung Galaxy 5</a></h3>						
                                                        <p class="ads-price">23500 р.</p>
                                                        <p class="ads-date">12.08.2018 15:05</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                                        <p class="ads-price">499000 р.</p>
                                                        <p class="ads-date">12.08.2018 08:45</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                                        <p class="ads-price">499000 р.</p>
                                                        <p class="ads-date">12.08.2018 08:45</p>
                                                </div>
                                        </li>
                                </ul>
                                <br>
                                <div class="row">
                                        <div class="col-sm-7 col-lg-5">
                                                <a href="#" class="btn-green">Все новые объявления (18)</a>
                                        </div>
                                </div>

                        </div>	<!-- end ads-container -->

                        <div class="ads-container">
                                <h2>Премиум объявления</h2>
                                <ul>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads1.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам двухкомнатную квартиру в поселке Октябрьском</a></h3>
                                                        <p class="ads-price">1200000 р.</p>
                                                        <p class="ads-date">12.08.2018 21:15</p>
                                                </div>
                                        </li>								
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads2.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам телефон Samsung Galaxy 5</a></h3>						
                                                        <p class="ads-price">23500 р.</p>
                                                        <p class="ads-date">12.08.2018 15:05</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads3.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Детский рюкзачок из экокожи</a></h3>
                                                        <p class="ads-price">2500 р.</p>
                                                        <p class="ads-date">12.08.2018 10:27</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads2.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам телефон Samsung Galaxy 5</a></h3>						
                                                        <p class="ads-price">23500 р.</p>
                                                        <p class="ads-date">12.08.2018 15:05</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                                        <p class="ads-price">499000 р.</p>
                                                        <p class="ads-date">12.08.2018 08:45</p>
                                                </div>
                                        </li>
                                        <li class="col-sm-6 col-lg-4">
                                                <div class="ads-block">
                                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                                        <p class="ads-price">499000 р.</p>
                                                        <p class="ads-date">12.08.2018 08:45</p>
                                                </div>
                                        </li>
                                </ul>

                        </div>	<!-- end ads-container -->

                </article>

                <aside id="aside-right" class="col-md-3">
                        <div class="ads-container row">
                                <h3>VIP-объявления</h3>
                                <div class="ads-block col-xs-12">
                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                        <p class="ads-price">499000 р.</p>
                                        <p class="ads-date">12.08.2018 08:45</p>
                                </div>
                                <div class="ads-block col-xs-12">
                                        <a href="#"><img src="images/ads4.jpg" alt="" class="img-responsive"></a>
                                        <h3 class="ads-header"><a href="#">Продам Hyundai Solaris, 2012 г/в</a></h3>
                                        <p class="ads-price">499000 р.</p>
                                        <p class="ads-date">12.08.2018 08:45</p>
                                </div>
                        </div>
                        <div class="banners">
                                <a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
                                <a href="#"><img src="images/image.png" style="height: 430px;" alt="" class="img-responsive"></a>
                                <a href="#">Разместить рекламу</a>
                        </div>
                </aside> <!-- end aside-right -->
        </div> <!-- end row -->
</main>