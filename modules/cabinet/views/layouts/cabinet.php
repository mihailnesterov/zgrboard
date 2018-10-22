<?php
    use yii\helpers\Html;
    use app\assets\AppAsset;
     
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->homeUrl.'web');   
    
    $this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Личный кабинет</title>
        
        <?php $this->head(); ?>
        
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => $directoryAsset . 'favicon.ico']) ?>
        
        <?php            
            AppAsset::register($this);
        ?>
        
    </head>
    <body style="background-color: #1F4C7C;">
        <?php $this->beginBody();?>
        
        <div id="cabinet-wrapper" class="container-fluid">
            <div class="row">
		<aside id="aside-left" class="col-sm-3 col-lg-3">
			<div id="logoTop">
				<a href="<?= Yii::$app->homeUrl ?>"><img src="<?= Yii::$app->homeUrl ?>images/logo.png" alt="logo" class="img-responsive">
					<span id="slogan"><?= Yii::$app->name ?><br> Доска объявлений</span>
                                        <!--<span id="slogan" class="visible-xs">Личный кабинет<br>пользователя</span>-->
				</a>
			</div>
		
			<div id="catalog-menu-container" style="border: none;">
				<nav id="catalog-menu" class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
                                   
					<div id="navbar" class="navbar-collapse collapse">
                                                <div class="banners visible-xs row">
                                                    <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/image.png" alt="" class="img-responsive col-xs-6"></a>
                                                    <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/image.png" alt="" class="img-responsive col-xs-6"></a>
                                                </div>
						<ul class="nav navbar-nav dropdown">  
                                                    <li class="visible-xs"><?= Html::a('<i class="fa fa-user-o" aria-hidden="true"></i> '.Yii::$app->user->identity->login, Yii::$app->homeUrl.'cabinet/profile') ?></li>
                                                    <li class="visible-xs"><hr></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet']) ?>">Мои объявления<span> (<?= \app\modules\cabinet\models\CabinetAds::find()->where(['user_id' => \Yii::$app->user->identity->id])->count() ?>)</span></a></li>
                                                    <?php
                                                        $msg_count = \app\modules\cabinet\models\CabinetMessages::find()->where(['sender_id' => \Yii::$app->user->identity->id])->orWhere(['receiver_id' => \Yii::$app->user->identity->id])->count();
                                                        $new_msg_count = \app\modules\cabinet\models\CabinetMessages::find()->where(['sender_id' => \Yii::$app->user->identity->id])->orWhere(['receiver_id' => \Yii::$app->user->identity->id])->andWhere(['is_read' => '0'])->andWhere(['!=','sender_id', \Yii::$app->user->identity->id])->count();
                                                        if( $new_msg_count == 0 ) {
                                                            $msg_count_block = ' ('.$msg_count.')';
                                                            $msg_count_top_block = '';
                                                        } else {
                                                            $msg_count_block = '<span class="flash animated not-read"> '.$new_msg_count.' </span>';
                                                            $msg_count_top_block = $msg_count_block;
                                                        }
                                                    ?>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/messages']) ?>">Мои сообщения <?= $msg_count_block ?></a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/account']) ?>">Мой счет (<span id="my-account">0,00</span> руб.)</a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/advert']) ?>">Моя реклама<span> (<?= \app\modules\cabinet\models\CabinetBanners::find()->where(['user_id' => \Yii::$app->user->identity->id])->count() ?>)</span></a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/profile']) ?>">Мой профиль</a></li>
                                                    <li><hr></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/']) ?>">Перейти на сайт</a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/logout']) ?>">Выйти</a></li>
						</ul>
					</div>
                                    
				</nav>
                            
                            <div class="banners hidden-xs">
                                <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/image.png" alt="" class="img-responsive"></a>
                                <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/image.png" alt="" class="img-responsive"></a>
                            </div>

			</div> <!-- end catalog-menu-container -->
                        
                        
                        
		</aside> <!-- end aside-left -->
                <div id="right-container" class="col-sm-9 col-lg-9"> <!-- begin right-container -->
                    <header id="header" class="row hidden-xs">
                        <div class="col-sm-5 col-md-4 col-lg-3">
                            <!--<h2 style="color: #fff; margin-top: 0.5em;"><?= Html::encode($this->title) ?></h2>-->
                            <?= Html::a('<span>Подать объявление</span>', Yii::$app->homeUrl.'cabinet/add', ['class' => 'btn-orange', 'style' => 'margin-top: 0.24em;']) ?>
                        </div>
                        <div id="authTop" class="col-sm-7 col-md-8 col-lg-9">                                            
                            <?= Html::a('<i class="fa fa-sign-out" aria-hidden="true"></i>', Yii::$app->homeUrl.'logout', ['id' => 'btn-cabinet-logout', 'title' => 'Выйти']) ?>
                            <?= Html::a('<i class="fa fa-user" aria-hidden="true"></i> '.'<span>'.Yii::$app->user->identity->login.'</span>'.$msg_count_top_block, Yii::$app->homeUrl.'cabinet/messages', ['id' => 'btn-cabinet-login', 'title' => 'Вы авторизованы как "'.Yii::$app->user->identity->login.'"']) ?>                                     
                            
                        </div>			
                    </header>
                
                    <?= $content ?>
                    
                </div> <!-- end right-container -->
            </div> <!-- end row -->
        <footer>		
		<div class="row">
                    <p id="copyright">&copy <?= date('Y') ?> <?= Html::a(Yii::$app->name.' | Доска объявлений', ['/']) ?></p>
		</div>
	</footer>
        </div> 	<!-- end wrapper-->
        		

    <!-- JS scripts -->	
        <div id="toTop"><span class="glyphicon glyphicon-chevron-up"></span></div>
        <script>ActiveLinks('catalog-menu');</script>
        
        <script>
            
            /*
             * ads add scripts
             */
            
            // download to input
            function imgAdsLoad(id){
                document.getElementById(id).click();
            }

            // preview image
            function previewAdsFile(img_id, file_id, form_field_id) {
                var preview = document.getElementById(img_id);
                var file    = document.getElementById(file_id).files[0];
                var reader  = new FileReader();

               reader.onloadend = function () {
                 preview.src = reader.result;
                 //document.getElementById(form_field_id).value = "<?= Yii::$app->homeUrl ?>web/images/users/<?= Yii::$app->user->identity->login?>/" + document.getElementById(file_id).files[0].name;
                 //document.getElementById(form_field_id).value = document.getElementById(file_id).files[0].name;
                    
                 function RandomString(length) {    // randomize file name
                        var str = '';
                        for ( ; str.length < length; str += Math.random().toString(36).substr(2) );
                        return str.substr(0, length);
                    }(20);
                    
                    var ext = file.name.substring(file.name.lastIndexOf('.'));  // get file extention
                    document.getElementById(form_field_id).value = RandomString(20) + ext;
                    
                    
               }

               if (file) {
                 reader.readAsDataURL(file);

               } else {
                 preview.src = "<?= Yii::$app->homeUrl ?>images/ads_default.png";
               }
            }

            // clear preview image
            function imgAdsDelete(img_id, field_id) {
                document.getElementById(img_id).src = "<?= Yii::$app->homeUrl ?>images/ads_default.png";
                document.getElementById(field_id).value = "";
            }

            // select ads period
            function selectPeriod(id, index) {
                var period_field = document.getElementById(id);
                switch(index){
                    case 0:
                            period_field.value = "<?= date('Y.m.d H:i:s', strtotime('+3 days')) ?>";
                            break;
                    case 1:
                            period_field.value = "<?= date('Y.m.d H:i:s', strtotime('+7 days')) ?>";
                            break;
                    case 2:
                            period_field.value = "<?= date('Y.m.d H:i:s', strtotime('+14 days')) ?>";
                            break;
                    case 3:
                            period_field.value = "<?= date('Y.m.d H:i:s', strtotime('+30 days')) ?>";
                            break;
                    default:
                            period_field.value = "<?= date('Y.m.d H:i:s', strtotime('+5 hours +14 days')) ?>";
                }
            }
        </script>
        
        <?php $this->endBody(); ?>
        
    </body>
</html>
<?php $this->endPage(); ?>