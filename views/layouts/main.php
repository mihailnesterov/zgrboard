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
        
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?= Yii::$app->basePath ?>" />
        <meta property="og:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta property="og:description" content="Подать бесплатное объявление, продажа, покупка, обмен, аренда в Зеленогорске Краснояркого края" />
        <meta property="og:image" content="<?= Yii::$app->homeUrl ?>web/images/logo.png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta name="twitter:image:src" content="<?= Yii::$app->homeUrl ?>web/images/damaster.png" />
        <meta name="twitter:description" content="Подать бесплатное объявление, продажа, покупка, обмен, аренда в Зеленогорске Краснояркого края" />
        <link rel="image_src" href="<?= Yii::$app->homeUrl ?>web/images/damaster.png" />

        <base href="<?= Yii::$app->homeUrl ?>">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | <?= Html::encode(Yii::$app->name) ?></title>
        
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
    <body>
        <?php $this->beginBody(); ?>
        
        <div id="wrapper" class="container-fluid">
            <div class="row">
		<aside id="aside-left" class="col-sm-3 col-lg-2">
			<div id="logoTop">
				<a href="<?= Yii::$app->homeUrl ?>"><img src="images/logo.png" alt="logo" class="img-responsive">
					<span id="slogan"><?= Yii::$app->name ?><br> Доска объявлений</span>
				</a>
			</div>
		
			<div id="catalog-menu-container">
				<nav id="catalog-menu" class="navbar navbar-default">
					<a href="#" id="btn-open-pannel" class="visible-xs" style="display: inline-block; vertica-align: top; float: left; padding: 0.5em 1em; border: 1px #fff solid; margin: 0.5em 1em 0 0; color: #fff; font-size: 1.3em;">^</a>
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
							<div class="banners visible-xs row">
								<a href="#"><img src="images/image.png" alt="" class="img-responsive col-xs-6"></a>
								<a href="#"><img src="images/image.png" alt="" class="img-responsive col-xs-6"></a>
							</div>
							<li><a href="<?= Yii::$app->homeUrl ?>category">Личные вещи<span> (86)</span></a></li>
							<li><a href="<?= Yii::$app->homeUrl ?>category">Хобби, отдых, спорт<span> (46)</span></a></li>
							<li><a href="<?= Yii::$app->homeUrl ?>category">Красота и здоровье<span> (38)</span></a></li>
							<li><a href="#">Детский мир<span> (96)</span></a></li>
							<li><a href="#">Электроника<span> (71)</span></a></li>								
							<li><a href="#">Продукты<span> (46)</span></a></li>
							<li><a href="#">Мобильные телефоны, связь<span> (22)</span></a></li>
							<li><a href="#">Работа<span> (49)</span></a></li>
							<li><a href="#">Недвижимость<span> (59)</span></a></li>
							<li><a href="#">Транспорт<span> (256)</span></a></li>
							<li><a href="#">Бизнес<span> (57)</span></a></li>								
							<li><a href="#">Строительные товары<span> (78)</span></a></li>
							<li><a href="#">Сад и огород<span> (59)</span></a></li>
							<li><a href="#">Животные<span> (128)</span></a></li>
							<li><a href="#">Мебель, бытовое<span> (99)</span></a></li>
							<li><a href="#">Услуги и предложения<span> (36)</span></a></li>								
							<li><a href="#">Знакомства<span> (8)</span></a></li>
							<li><a href="#">Обучение, курсы<span> (10)</span></a></li>
						</ul>
					</div>
				</nav>
				<div class="banners hidden-xs">
					<a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
					<a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
					<a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
				</div>
			</div> <!-- end catalog-menu-container -->
		</aside> <!-- end aside-left -->
		
		<div id="right-container" class="col-sm-9 col-lg-10"> <!-- begin right-container -->
                    <header id="header" class="row">
                                    <div id="searchTop" class="hidden-xs col-sm-5 col-md-6 col-lg-8">
                                            <form id="searchForm" novalidate>
                                                    <div class="form-group">
                                                            <div class="input-group">
                                                                    <input type="text" class="form-control input-lg" placeholder="Поиск по объявлениям..." id="searchField" />
                                                                    <div class="input-group-addon">
                                                                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </form>
                                    </div>

                                    <div id="addTop" class="col-xs-7 col-sm-5 col-sm-offset-0 col-md-offset-0 col-md-4 col-lg-3">
                                            <a href="#" class="btn-orange"><span>Подать объявление</span></a>
                                    </div>
                                    <div id="authTop" class="col-xs-5 col-sm-2 col-md-1">
                                            <a href="#"><i class="fa fa-sign-in" aria-hidden="true" title="Войти в личный кабинет"></i></a>
                                    </div>

                                    <div id="searchTopMobile" class="visible-xs col-xs-12">
                                            <form id="searchForm" novalidate>
                                                    <div class="form-group">
                                                            <div class="input-group">
                                                                    <input type="text" class="form-control input-lg" placeholder="Поиск по объявлениям..." id="searchField" />
                                                                    <div class="input-group-addon">
                                                                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </form>
                                    </div>				
                    </header>
                
                <?= $content ?>
                
                </div> <!-- end right-container -->
            </div> <!-- end row -->
        <footer>		
		<div class="row">
                    <p id="copyright">&copy <?= date('Y') ?> <?= Html::a(Yii::$app->name, ['/']) ?> Все права защищены</p>
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