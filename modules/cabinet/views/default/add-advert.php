<?php

/* 
 * Add new advert
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Заявка на размещение баннера';
//$created = new DateTime(Yii::$app->user->identity->created);
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

            <div id="form-banner-order" class="col-sm-8 col-md-8">

                        <p class="bg-warning text-info col-xs-12">Заполните форму, загрузите макет рекламного баннера (jpg, png, gif):</p>
                        <?php $form = ActiveForm::begin([
                            //'id' => 'userUpdateForm',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                            'template' => '<div class="col-xs-2 col-sm-1" style="color: #e0e0e0;">{label}</div><div class="col-xs-10 col-sm-11">{input}</div><div class="col-xs-12">{error}</div>',
                                ],
                        ]); ?>
                        <div class="hidden">
                        <?= $form->field($model, 'sender_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'id пользователя', 'value' => Yii::$app->user->identity->id])
                                ->label(false)?>
                        
                        <?= $form->field($model, 'receiver_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Получатель', 'value' => '1'])
                                ->label(false)?>
                        
                        <?= $form->field($model, 'type')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Тип сообщения', 'value' => 'advert'])
                            ->label(false)?>
                        </div>
                        <?= $form->field($model, 'theme')
                                ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Логин *', 'value' => $this->title])
                                ->label('<i class="fa fa-comment-o fa-2x" aria-hidden="true"></i>')?>

                        <?= $form->field($model, 'text')
                                ->textArea(['maxlength' => true, 'class' => 'form-control input-lg', 'rows' => '7', 'placeholder' => 'Текст сообщения'])
                                ->label('<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>')?>

            </div>

            <div id="avatar-block" class="col-sm-3 col-md-3">
                <div >
                <p>Загрузите баннер:</p>
                <hr>
                <img src="<?= Yii::$app->homeUrl?>web/images/image.png" alt="Баннер" class="img-responsive">
                <hr>
                <?= Html::Button('Загрузить', ['id' => 'btn-avatar-download', 'class' => 'btn btn-default']) ?>
                </div>

            </div>

        </div> <!-- end row -->

        <div class="form-group">
            <div class="row">
                <div class="col-xs-5 col-sm-3 col-md-4 col-lg-5">
                    <?= Html::submitButton('Отправить', ['class' => 'btn-green']) ?>
                </div>
            </div>
        </div>
        <hr>

        <?php ActiveForm::end(); ?>

    </article>
</main>