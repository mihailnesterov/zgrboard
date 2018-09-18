<?php

use yii\helpers\Html;

$this->title = 'Мои объявления'; //.Yii::$app->user->id
?>
<div class="cabinet-default-index">
    <!--<h1><?= $this->context->action->uniqueId ?></h1>-->
    <h1><?= Html::encode($this->title) ?> <?= $model->id ?></h1>
    
    rememberMe - <?= $model->rememberMe ?>
    <br>
    login - <?= Yii::$app->user->identity->login ?>
    <br>
    password - <?= Yii::$app->user->identity->password ?>
    <br>
    email - <?= Yii::$app->user->identity->email ?>
</div>

<?php //echo '<pre>'; print_r($model); die;  ?>
