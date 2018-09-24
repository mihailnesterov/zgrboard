<?php

/* 
 * Add ads
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Подать объявление';
?>

<main role="main">
    <div >
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="col-md-8">
                
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'user_id')
                        ->textInput(['maxlength' => true, 'placeholder' => 'id'])
                        ->label(false)?>

                <?= $form->field($model, 'category_id')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Категория'])
                        ->label(false) ?>

                <?= $form->field($model, 'title')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Заголовок объявления'])
                        ->label(false) ?>

                <?= $form->field($model, 'text')
                        ->textarea(['rows' => 6, 'placeholder' => 'Текст объявления'])
                        ->label(false) ?>

                <?= $form->field($model, 'price')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Цена'])
                        ->label(false) ?>

                <?= $form->field($model, 'photo1')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Фото 1'])
                        ->label(false) ?>

                <?= $form->field($model, 'photo2')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Фото 2'])
                        ->label(false) ?>

                <?= $form->field($model, 'photo3')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Фото 3'])
                        ->label(false) ?>

                <?= $form->field($model, 'photo4')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Фото 4'])
                        ->label(false) ?>

                <?= $form->field($model, 'type')
                        ->textInput(['maxlength' => true, 'placeholder' => 'Тип объявления'])
                        ->label(false) ?>

                <?= $form->field($model, 'date_begin')
                        ->textInput(['placeholder' => 'Дата начала', 'value' => date('Y.m.d H:i:s')])
                        ->label(false) ?>

                <?= $form->field($model, 'date_end')
                        ->textInput(['placeholder' => 'Дата окончания'])
                        ->label(false) ?>

                <?= $form->field($model, 'vip')
                        ->textInput(['placeholder' => 'VIP объявление'])
                        ->label(false) ?>

                <?= $form->field($model, 'premium')
                        ->textInput(['placeholder' => 'premium объявление'])
                        ->label(false) ?>

                <?= $form->field($model, 'created')
                        ->textInput(['placeholder' => 'Дата создания', 'value' => date('Y.m.d H:i:s')])
                        ->label(false) ?>

                <?= $form->field($model, 'visits')
                        ->textInput(['placeholder' => 'Количество визитов', 'value' => '0'])
                        ->label() ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn-green']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </article>
    </div> <!-- end row -->
</main>