<?php

use yii\helpers\Html;

$this->title = 'Мои объявления'; //.Yii::$app->user->id
?>

    <div id="right-container" class="col-sm-9 col-lg-10"> <!-- begin right-container -->
    <main role="main">
        <div class="row">
            <article id="content" style="border: 1px red solid;">
    <!--<h1><?= $this->context->action->uniqueId ?></h1>-->
    <h1 class="visible-xs"><?= Html::encode($this->title) ?> <?= $model->id ?></h1>
    <div class="col-sm-5 col-md-4 col-lg-3">
            <a href="<?= Yii::$app->homeUrl ?>cabinet/add" class="btn-orange"><span>Подать объявление</span></a>
    </div>
    rememberMe - <?= $model->rememberMe ?>
    <br>
    login - <?= Yii::$app->user->identity->login ?>
    <br>
    password - <?= Yii::$app->user->identity->password ?>
    <br>
    email - <?= Yii::$app->user->identity->email ?>
            </article>
        </div> <!-- end row -->
    </main>
      </div> 

<?php //echo '<pre>'; print_r($model); die;  ?>
