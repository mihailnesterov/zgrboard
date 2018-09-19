<?php

/* 
 * Add ads
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Подать объявление';
?>

<div id="right-container"> <!-- begin right-container -->
    <main role="main">
        <div >
            <article id="content" class="row">
                <div class="col-xs-12" style="margin-top: 1.5em;">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <hr>
                </div>
                <div class="col-md-8">
                    
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'login')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Логин'])
                            ->label(false)?>

                    <?= $form->field($model, 'password')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Пароль'])
                            ->label(false)?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn-green']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                </div>
                
            </article>
        </div> <!-- end row -->
    </main>
</div> 