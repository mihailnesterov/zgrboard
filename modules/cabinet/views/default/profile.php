<?php

/* 
 * Profile
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Мой профиль';
$created = new DateTime(Yii::$app->user->identity->created);
?>

<main role="main">
    <article id="content">
        <div class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
                <p>Профиль создан: <?= Html::encode($created->format('d.m.Y (H:i)')) ?></p>
                <br>
            </div>

            <div class="col-sm-8 col-md-8">

                <div class="row1">

                        <p class="bg-warning text-info col-xs-12">Вы можете изменить email и телефон</p>
                        <?php $form = ActiveForm::begin([
                            //'id' => 'userUpdateForm',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                            'template' => '<div class="col-xs-2 col-sm-1" style="color: #e0e0e0;">{label}</div><div class="col-xs-10 col-sm-11">{input}</div><div class="col-xs-12">{error}</div>',
                                ],
                        ]); ?>

                        <?= $form->field($model, 'login')
                                ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'disabled' => 'disabled', 'placeholder' => 'Логин *', 'value' => Yii::$app->user->identity->login])
                                ->label('<i class="fa fa-user fa-2x" aria-hidden="true"></i>')?>

                        <?= $form->field($model, 'email')
                                ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => 'Email *', 'required' => 'required', 'value' => Yii::$app->user->identity->email])
                                ->label('<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>')?>

                        <?= $form->field($model, 'phone')
                                ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => 'Телефон', 'value' => Yii::$app->user->identity->phone])
                                ->label('<i class="fa fa-phone-square fa-2x" aria-hidden="true"></i>')?>
                    <p class="bg-warning text-info">*  Логин и email - обязательные поля</p>

                </div>

            </div>

            <div id="avatar-block" class="hidden col-sm-3 col-md-3">
                <div >
                <p>Аватар:</p>
                <hr>
                <img src="/zgrboard/web/images/image.png" alt="Аватар" width="100" class="img-rounded">
                <hr>
                <?= Html::Button('Загрузить', ['id' => 'btn-avatar-download', 'class' => 'btn btn-default']) ?>
                </div>

            </div>

        </div> <!-- end row -->

        <div class="form-group">
            <div class="row">
                <div class="col-xs-5 col-sm-3 col-md-4 col-lg-5">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn-green']) ?>
                </div>
                <div class="col-xs-7 col-sm-5 col-md-4 col-lg-3">

                    <?= Html::a('Изменить пароль', Yii::$app->homeUrl.'cabinet/change-password', ['class' => 'btn-orange']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </article>
</main>