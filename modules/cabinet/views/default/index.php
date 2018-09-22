<?php

use yii\helpers\Html;

$this->title = 'Мои объявления'; //.Yii::$app->user->id
?>

<main role="main">
        <article id="content" class="row">
            <!--<h1><?= $this->context->action->uniqueId ?></h1>-->
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="visible-xs col-xs-offset-1 col-xs-10" style="margin-bottom: 1.5em;">
                <?= Html::a('Подать объявление', Yii::$app->homeUrl.'cabinet/add', ['class' => 'btn-orange']) ?>
            </div>
            
            <div class="ads-container">
                <ul>
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

            </div>	<!-- end ads-container -->

        </article>
</main>

<?php //echo '<pre>'; print_r($model); die;  ?>
