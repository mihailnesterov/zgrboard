<?php

/* 
 * view advert page in cabinet
 */

use yii\helpers\Html;

$this->title = 'Мой баннер...';
?>

<main role="main">
    
    <div class="row visible-xs">
        <div id="go-back-pannel" class="col-xs-12">
            <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', 'javascript:history.go(-1)', ['class' => 'btn btn-link']) ?>
        </div>
    </div> <!-- end row -->
    
    <article id="content">
        <div class="row">
            <header class="col-xs-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>               
            </header>
            
            
        </div>  <!-- end row -->
    </article>
</main>