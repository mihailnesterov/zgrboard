<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'Войти в личный кабинет';
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'login', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'autofocus' => 'autofocus',
                'tabindex' => '1',
                'placeholder' => 'Логин',
                'class'=>'form-control input-lg',
                //'pattern'=>'\D+([a-zA-Z0-9._@])$'
            ]
        ])->label(false) ?>

        
        <?= $form->field($model, 'password', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'tabindex' => '2',
                'placeholder' => 'Пароль',
                'class'=>'form-control input-lg'
            ]
        ])->passwordInput()->label(false) ?>
    
        <?= $form->field($model, 'rememberMe', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'tabindex' => '3',
                'class'=>'form-control input-lg'
            ]
        ])->checkbox(['value' => 0, 'checked' => false]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-lg btn-orange btn-login']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    
    <div class="login-links">
        У меня нет аккаунта <a href="<?=Yii::$app->urlManager->createUrl(['/signup'])?>" >Регистрация</a>
    </div>

    <div class="login-links">
        <a href="<?=Yii::$app->urlManager->createUrl(['/password-restore'])?>" >Забыли пароль?</a>
    </div>
    
</div><!-- site-login -->
