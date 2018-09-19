<?php

/* 
 * Profile
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Мой профиль';
?>

<div id="right-container"> <!-- begin right-container -->
    <main role="main">
        <div >
            <article id="content" class="row">
                <div class="col-xs-12" style="margin-top: 1.5em;">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <br>
                    <p>Создан: <?= Html::encode($model->created) ?> 2018-05-05 12:52:12</p>
                    <hr>
                </div>
                <div class="col-md-8">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'login')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Логин *'])
                            ->label(false)?>

                    <?= $form->field($model, 'password')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Пароль *'])
                            ->label(false)?>
                    
                    <?= $form->field($model, 'email')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Email *'])
                            ->label(false)?>
                    
                    <?= $form->field($model, 'phone')
                            ->textInput(['maxlength' => true, 'placeholder' => 'Телефон'])
                            ->label(false)?>
                    <p class="bg-warning text-info" style="padding: 0.5em; margin-bottom: 1em;">* Обязательное поле</p>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn-green']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                </div>
                
                <div class="col-md-4" style="border: 1px #c0c0c0 solid; padding: 1em; border-radius: 5px; margin-bottom: 2em;">
                    
                    <p>Аватар:</p>
                    <hr>
                    <a href="#"><img src="/zgrboard/web/images/image.png" alt="" class="img-responsive"></a>
                    <hr>
                    <?= Html::Button('Загрузить картинку', ['class' => 'btn btn-default']) ?>
                </div>
                
            </article>
        </div> <!-- end row -->
    </main>
</div> 