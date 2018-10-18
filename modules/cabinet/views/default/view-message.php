<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetMessages */

/*
 * is_read = 1
 */
/*$cur_message = \app\modules\cabinet\models\CabinetMessages::findOne($model->id);
$tmp = $cur_message->is_read;
$cur_message->is_read = $tmp+1;
$cur_message->save();*/
if($model->is_read == 0) {
    $model->is_read = 1;
    $model->save();
}

$this->title = 'Сообщение № '.$model->id.': '.$model->theme;
$this->params['breadcrumbs'][] = ['label' => 'Мои сообщения', 'url' => ['/cabinet/messages']];
$this->params['breadcrumbs'][] = $this->title;
?>

<main role="main">
    
        <div class="row visible-xs">
            <div id="go-back-pannel" class="col-xs-12">
                <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', Yii::$app->homeUrl.'cabinet/messages', ['class' => 'btn btn-link']) ?>
            </div>
        </div> <!-- end row -->
    
        <article id="content" class="row">

            <header class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>                
            </header>

            <div class="col-sm-12 col-md-10 col-lg-9">
                <div class="hidden-xs">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'homeLink' => false,
                    ]);
                    ?>
                </div>
                
            </div>

            </article>
</main>