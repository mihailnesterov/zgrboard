<?php

/* 
 * Messages
 */

use yii\helpers\Html;

$this->title = 'Мои сообщения';
?>

<main role="main">
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="col-md-8">

                <?php echo 'Нет сообщений...'; ?>

            </div>

        </article>
</main>