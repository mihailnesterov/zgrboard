<?php

/* 
 * account page
 */

use yii\helpers\Html;

$this->title = 'Мой счет';

?>

<main role="main">    
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
                <h5 class="bg-warning text-info">На вашем счету: 0,00 руб.</h5>
            </div>    
            <div class="col-xs-7 col-sm-5 col-md-4 col-lg-3">
                <?= Html::a('Пополнить счет', Yii::$app->homeUrl.'cabinet/pay', ['id' => 'link-ads-pay', 'class' => 'btn-orange']) ?>
                <br>
            </div>
            
        </article>
</main>
