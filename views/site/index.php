	
<main role="main">
        <div class="row">			

                <article id="content" class="col-md-9">
                        <header id="content-header">
                                <h1>Доска объявлений Зеленогорска</h1>
                                <hr>
                                <!-- Swiper slider main container -->
                                <div class="swiper-container">
                                        <!-- Swiper slider wrapper -->
                                        <div class="swiper-wrapper ">
                                                <!-- Slides -->
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <a href="http://elfido.ru/" target="_blank"><img src="images/banners/elfido.jpg" alt="" class="img-responsive"></a>
                                                </div>
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <a href="https://vk.com/hogwartszgr" target="_blank"><img src="images/banners/hogvarts.jpg" alt="" class="img-responsive"></a>
                                                </div>
                                                <div class="swiper-slide" data-swiper-autoplay="5000">
                                                    <a href="https://www.invitro.ru/" target="_blank"><img src="images/banners/invitro.jpg" alt="" class="img-responsive"></a>
                                                </div>
                                        </div>
                                        <!-- Swiper slider pagination -->
                                        <div class="swiper-pagination"></div>
                                </div> <!-- end Swiper slider -->
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
                                
                                <div class="banners">
                                    <img src="images/banners/shinniy-dvor.jpg" alt="Баннер в ленте объявлений" width="100%" class="img-responsive">
                                </div>

                        </div>	<!-- end ads-container -->

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