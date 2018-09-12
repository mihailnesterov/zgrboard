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
        
        <div id="login-wrapper" class="fadeInDown animated">
            <header id="login-header">
                <div id="logoTop" style="margin: -2em -2em 1.5em -2em;">
                        <a href="<?= Yii::$app->homeUrl ?>"><img src="images/logo.png" alt="logo" class="img-responsive">
                                <span id="slogan"><?= Yii::$app->name ?><br> Доска объявлений</span>
                        </a>
                </div>
                <h1><?= $this->title ?></h1>
                <hr>
            </header>
                    <?= $content ?>               

        <!--<footer>		
		<div class="row">
                    <p id="copyright">&copy <?= date('Y') ?> <?= Html::a(Yii::$app->name, ['/']) ?> Все права защищены</p>
		</div>
	</footer>-->
        </div> 	<!-- end wrapper-->

        
        <?php $this->endBody(); ?>
        
    </body>
</html>
<?php $this->endPage(); ?>