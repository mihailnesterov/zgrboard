<?php

/* 
 * Change password
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Изменить пароль';
?>

<main role="main">
    
    <div class="row visible-xs">
            <div id="go-back-pannel" class="col-xs-12">
                <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', Yii::$app->homeUrl.'cabinet/profile', ['class' => 'btn btn-link']) ?>
            </div>
    </div> <!-- end row -->
    
    <article id="content" class="row">
        <div class="col-xs-12" style="margin-top: 1.5em;">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr>
        </div>
        <div class="col-sm-8 col-md-10 col-lg-9">
            <p class="bg-warning text-info col-xs-12">Введите новый пароль:</p>

            <?php $form = ActiveForm::begin([
                //'id' => 'userUpdateForm',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                'template' => '<div class="hidden-xs hidden-sm col-md-3" style="color: #с0с0с0;">{label}</div><div class="col-md-9">{input}</div><div class="col-xs-12">{error}</div>',
                    ],
            ]); ?>

            <?= $form->field($model, 'password')
                    ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => 'Новый пароль *', 'value' => ''])
                    ->label('Новый пароль:')?>

            <p class="bg-warning text-info col-xs-12">*  Длина пароля не менее 8 символов. Используйте буквы английского алфавита и цифры</p>

            <div class="form-group">
                <div class="col-xs-12">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn-green']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </article>
</main>