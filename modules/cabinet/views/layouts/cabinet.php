<?php
    use yii\helpers\Html;
    use app\assets\AppAsset;
     
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('zgrboard/web');
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
        <?php $this->beginBody(); ?>
        
        <div id="cabinet-wrapper" class="container-fluid">
            <div class="row">
		<aside id="aside-left" class="col-sm-3 col-lg-3">
			<div id="logoTop">
				<a href="<?= Yii::$app->homeUrl ?>"><img src="<?= Yii::$app->homeUrl ?>images/logo.png" alt="logo" class="img-responsive">
					<span id="slogan"><?= Yii::$app->name ?><br> Доска объявлений</span>
                                        <!--<span id="slogan" class="visible-xs">Личный кабинет<br>пользователя</span>-->
				</a>
			</div>
		
			<div id="catalog-menu-container" style="border: none">
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
						<ul class="nav navbar-nav dropdown">  
                                                    <li class="visible-xs"><?= Html::a('<i class="fa fa-user-o" aria-hidden="true"></i> '.Yii::$app->user->identity->login, Yii::$app->homeUrl.'cabinet/profile') ?></li>
                                                    <li class="visible-xs"><hr></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet']) ?>">Мои объявления<span> (0)</span></a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/messages']) ?>">Мои сообщения<span> (0)</span></a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['cabinet/profile']) ?>">Мой профиль</a></li>
                                                    <li><hr></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/']) ?>">Перейти на сайт</a></li>
                                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/logout']) ?>">Выйти</a></li>
						</ul>
					</div>
                                    
				</nav>

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
                            <?= Html::a('<i class="fa fa-user" aria-hidden="true"></i> '.'<span>'.Yii::$app->user->identity->login.'</span>', Yii::$app->homeUrl.'cabinet/profile', ['id' => 'btn-cabinet-login', 'title' => 'Вы авторизованы как "'.Yii::$app->user->identity->login.'"']) ?>                                     
                            
                        </div>			
                    </header>
                
                    <div style="border-left: 1px #DCEDCC solid !important; margin-left: -1em;">
                        <?= $content ?>
                    </div>
                    
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
        <script type="text/javascript">ActiveLinks('catalog-menu');</script>
        
        <?php $this->endBody(); ?>
        
    </body>
</html>
<?php $this->endPage(); ?>