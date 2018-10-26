<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetMessages */

/*
 * is_read = 1
 */
if($model->is_read == 0 && $sender->id != Yii::$app->user->identity->id) {
    $model->is_read = 1;
    $model->save();
}

$this->title = 'Сообщение: '.$model->theme;
$this->params['breadcrumbs'][] = ['label' => 'Мои сообщения', 'url' => ['/cabinet/messages']];
$this->params['breadcrumbs'][] = $this->title;
?>

<main role="main">
    
        <div class="row visible-xs">
            <div id="go-back-pannel" class="col-xs-12">
                <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', Yii::$app->homeUrl.'cabinet/messages', ['class' => 'btn btn-link']) ?>
            </div>
        </div> <!-- end row -->
    
        <article id="content" class="row">

            <header class="col-xs-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>                
            </header>
            
            <div class="col-sm-12 col-md-10 col-lg-9">
                <div class="hidden-xs">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'homeLink' => false,
                    ]);
                    ?>
                </div>  <!-- end Breadcrumbs -->
                
                <div class="row1" style="margin-top: 1em;">
                    <div class="col-sm-3" style="border: 0px #eee solid; padding: 1em; margin: 0.5em 0;">
   
                        
                        <p><?= $sender->login ?> &rArr; <?= $receiver->login ?></p>
                        <hr>
                        <p>
                            <?php
                                $created = new DateTime($model->created);
                                echo $created->format('d.m.Y (H:i)');
                            ?>
                        </p>
                    </div>  <!-- end col -->
                    <div class="col-sm-9" style="border: 1px #eee solid; padding: 1em; margin: 0.5em 0; line-height: 1.5; background-color: #f8f8f8;">
                        <p><?= $model->text ?></p>
                        <hr>
                        <?php
                            if ($model->receiver_id != Yii::$app->user->identity->id) {
                                echo '<div class="hidden">';
                            } else {
                                echo '<div>';
                            }
                        ?>
                        
                        <?php $form = ActiveForm::begin([
                            //'id' => 'userUpdateForm',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                            'template' => '<div>{label}</div><div class="col-xs-12">{input}</div><div class="col-xs-12">{error}</div>',
                                ],
                        ]); ?>
                        
                        <div class="hidden">
                        <?= $form->field($new_model, 'sender_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Отправитель', 'value' => Yii::$app->user->identity->id])
                                ->label(false)?>
                        
                        <?= $form->field($new_model, 'receiver_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Получатель', 'value' => $sender->id])
                                ->label(false)?>
                        
                        <?= $form->field($new_model, 'theme')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Тема сообщения', 'value' => 'RE: '.$model->theme])
                            ->label(false)?>
                            
                        <?= $form->field($new_model, 'type')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Тип сообщения', 'value' => 'message'])
                            ->label(false)?>
                            
                        </div>
                        
                        <?= $form->field($new_model, 'text')
                                ->textArea(['maxlength' => true, 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'Ответ...', 'value' => ''])
                                ->label(false)?>
                        
                            <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
                        
                        <?php ActiveForm::end(); ?>
                        </div>
                    </div>  <!-- end col -->
                    
                </div>
                
            </div>  <!-- end col -->

        </article>
</main>