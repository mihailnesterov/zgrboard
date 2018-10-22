<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetMessages */


$this->title = 'Новое сообщение...';
$this->params['breadcrumbs'][] = ['label' => 'Мои сообщения', 'url' => ['/cabinet/messages']];
$this->params['breadcrumbs'][] = 'RE: '.$ads->title;
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
                <div class="">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'homeLink' => false,
                    ]);
                    ?>
                </div>  <!-- end Breadcrumbs -->
                
                <div class="row1" style="margin-top: 1em;">

                    <div class="col-sm-12" style="border: 1px #eee solid; padding: 1em; margin: 0.5em 0; line-height: 1.5; background-color: #f8f8f8;">
                        <p>
                            <?php
                                //$receiver = \app\models\Users::find()->where(['id' => $receiver_id])->one();
                                echo $sender->login.' &rArr; '.$receiver->login;
                            ?>
                        </p>
                        <hr>
                        <?php $form = ActiveForm::begin([
                            //'id' => 'userUpdateForm',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                            'template' => '<div>{label}</div><div class="col-xs-12">{input}</div><div class="col-xs-12">{error}</div>',
                                ],
                        ]); ?>
                        
                        <div class="hidden">
                        <?= $form->field($model, 'sender_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Отправитель', 'value' => Yii::$app->user->identity->id])
                                ->label(false)?>
                        
                        <?= $form->field($model, 'receiver_id')
                                ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Получатель', 'value' => $receiver->id])
                                ->label(false)?>
                        
                        <?= $form->field($model, 'theme')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Тема сообщения', 'value' => 'RE: '.$ads->title])
                            ->label(false)?>
                            
                        <?= $form->field($model, 'type')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'class' => 'form-control input-lg', 'required' => 'required', 'placeholder' => 'Тип сообщения', 'value' => 'message'])
                            ->label(false)?>
                            
                        </div>
                        
                        <?= $form->field($model, 'text')
                                ->textArea(['maxlength' => true, 'class' => 'form-control', 'rows' => '3', 'placeholder' => 'Ответ...', 'value' => ''])
                                ->label(false)?>
                        
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                        
                        <?php ActiveForm::end(); ?>
                        
                    </div>
                    
                </div>
                
            </div>  <!-- end col -->

        </article>
</main>