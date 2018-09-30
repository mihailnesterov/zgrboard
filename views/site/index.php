	
<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1>Доска объявлений Зеленогорска</h1>
                                <hr>
                        </header>
                        <div class="ads-container">
                                <div class="row visible-xs">
                                        <div class="col-sm-7 col-lg-5">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['category'])?>" class="btn-green">Все объявления (<?= \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->count() ?>)</a>
                                        <br>
                                        </div>
                                </div>
                                
                                <h2>Новые объявления</h2>
                                <ul class="row">
                                
                                    <?php            
                                            // вывод объявлений из БД
                                            //$ads_list = app\modules\cabinet\models\CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->orderby(['created'=>SORT_DESC])->all();
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
                                                $category = \app\models\Category::findOne($ads->category_id);

                                                echo '<li class="col-sm-6 col-lg-4">'
                                                . '<div class="ads-block">'
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
                                <br>
                                <div class="row">
                                        <div class="col-sm-7 col-lg-5">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['category'])?>" class="btn-green">Все объявления (<?= \app\modules\cabinet\models\CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->count() ?>)</a>
                                        </div>
                                </div>

                        </div>	<!-- end ads-container -->

                        <div class="ads-container">
                                <h2>Премиум объявления</h2>
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
                        </div>	<!-- end ads-container -->

                </article>

                <?= $this->render('_aside') ?>
        </div> <!-- end row -->
</main>