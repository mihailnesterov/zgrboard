<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(); ?>
        <!--$hash_pass=Yii::$app->getSecurity()->generatePasswordHash('123',10);-->
        <?= $form->field($model, 'login', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'autofocus' => 'autofocus',
                'tabindex' => '1',
                'placeholder' => 'Логин',
                'class'=>'form-control input-lg',
                //'pattern'=>'\D+([a-zA-Z0-9._@])$'
            ]
        ])->textInput(['maxlength' => true])->label(false) ?>
    
    
        <?= $form->field($model, 'email', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'tabindex' => '2',
                'placeholder' => 'Email',
                'class'=>'form-control input-lg',
            ]
        ])->textInput(['maxlength' => true])->label(false) ?>

        
        <?= $form->field($model, 'password', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'tabindex' => '3',
                'placeholder' => 'Пароль',
                'class'=>'form-control input-lg'
            ]
        ])->passwordInput(['maxlength' => true])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-lg btn-orange', 'style' => 'display: block; min-width: 50%; margin: 1.5em auto;']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    
    <div class="login-links">
        У меня уже есть аккаунт <a href="<?=Yii::$app->urlManager->createUrl(['/login'])?>" >Войти</a>
    </div>

    <div class="login-links">
        <a href="<?=Yii::$app->urlManager->createUrl(['/password-restore'])?>" >Забыли пароль?</a>
    </div>

</div><!-- site-login -->
