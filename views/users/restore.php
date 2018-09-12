<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'Восстановление пароля';
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(); ?>   
    
        <?= $form->field($model, 'email', [
            'template' => '{input}{error}',
            'inputOptions' => [
                'placeholder' => 'Email',
                'class'=>'form-control input-lg',
            ]
        ])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Восстановить', ['class' => 'btn btn-primary btn-lg btn-orange', 'style' => 'display: block; min-width: 50%; margin: 1.5em auto;']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    
    <div class="login-links">
        У меня нет аккаунта <a href="<?=Yii::$app->urlManager->createUrl(['/signup'])?>" >Регистрация</a>
    </div>

</div><!-- site-login -->
