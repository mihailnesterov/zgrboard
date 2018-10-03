<?php

/* 
 * Update ads
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetAds */

date_default_timezone_set('Asia/Krasnoyarsk');

$this->title = 'Редактировать объявление: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мои объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main role="main">
    
        <div class="row visible-xs">
            <div id="go-back-pannel" class="col-xs-12">
                <?= Html::a('<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>', Yii::$app->homeUrl.'cabinet', ['class' => 'btn btn-link']) ?>
            </div>
        </div> <!-- end row -->
    
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="col-sm-6 col-md-7 col-lg-8">
                
                <?php $form = ActiveForm::begin([
                'id' => 'adsAddForm',
                'fieldConfig' => [
                'template' => '<div style="margin-bottom:0.5em;">{label}</div><div>{input}</div><div class="col-xs-12">{error}</div>',
                    ],
            ]); ?>

                <?= $form->field($model, 'user_id')
                        ->textInput(['type' => 'hidden', 'maxlength' => true, 'placeholder' => 'id', 'value' => Yii::$app->user->identity->id])
                        ->label(false)?>

                <?= $form->field($model, 'category_id')
                        ->dropDownList(
                         \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
                            [   
                                'class' => 'form-control input-lg',
                                'prompt' => 'Выберите категорию',
                                'options' => [
                                    '0' => ['Selected' => true]
                                    ]
                            ]
                        )
                        ->label(false) ?>
                
                <?= $form->field($model, 'type')
                           ->dropDownList(
                               [
                                   'Продажа' => 'Продажа',
                                   'Покупка' => 'Покупка',
                                   'Обмен' => 'Обмен',
                                   'Аренда' => 'Аренда',
                                   'Услуга' => 'Услуга',
                                   'Требуется' => 'Требуется',
                                   'Ищу' => 'Ищу',
                                   'Отдам' => 'Отдам',
                                   'Разное' => 'Разное',
                               ],
                               [   
                                   'class' => 'form-control input-lg',
                                   'prompt' => 'Выберите тип объявления',
                                   'options' => [
                                       '0' => ['Selected' => true]
                                       ]
                               ]
                           )
                           ->label(false) ?>
                
                <?= $form->field($model, 'title')
                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => 'Заголовок объявления'])
                        ->label(false) ?>

                <?= $form->field($model, 'text')
                        ->textarea(['rows' => 6, 'class' => 'form-control input-lg', 'placeholder' => 'Текст объявления'])
                        ->label(false) ?>

                <?= $form->field($model, 'price')
                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => 'Цена'])
                        ->label(false) ?>
                
                <label for='cabinet-select-ads-period' style='margin: 0.5em 0;'>Выберите срок действия объявления:</label>
                <select id="cabinet-select-ads-period" name="cabinet-select-ads-period" class="form-control input-lg" onchange="selectPeriod('ads-date-end-field', this.selectedIndex)">
                    <option>3 дня</option>
                    <option>7 дней</option>
                    <option selected>14 дней</option>
                    <option>30 дней</option>
                </select>
                
                <div id="cabinet-ads-photos-block" class="row">
                    <!-- загрузка файлов в Yii - https://yiiframework.com.ua/ru/doc/guide/2/input-file-upload/ -->
                    <p class="bg-warning text-info">Добавьте в объявление фотографии (до 4-х штук)</p>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <?php
                            if (!empty($model->photo1))
                                {
                                    $photo1 = Yii::$app->homeUrl.'images/users/'.Yii::$app->user->identity->login.'/'.$model->photo1;
                                }
                                else {
                                    $photo1 = Yii::$app->homeUrl.'images/ads_default.png';
                                }

                            if (!empty($model->photo2))
                                {
                                    $photo2 = Yii::$app->homeUrl.'images/users/'.Yii::$app->user->identity->login.'/'.$model->photo2;
                                }
                                else {
                                    $photo2 = Yii::$app->homeUrl.'images/ads_default.png';
                                }
                            if (!empty($model->photo3))
                                {
                                    $photo3 = Yii::$app->homeUrl.'images/users/'.Yii::$app->user->identity->login.'/'.$model->photo3;
                                }
                                else {
                                    $photo3 = Yii::$app->homeUrl.'images/ads_default.png';
                                }
                            if (!empty($model->photo4))
                                {
                                    $photo4 = Yii::$app->homeUrl.'images/users/'.Yii::$app->user->identity->login.'/'.$model->photo4;
                                }
                                else {
                                    $photo4 = Yii::$app->homeUrl.'images/ads_default.png';
                                }
                        ?>
                        
                        <img src="<?= $photo1 ?>" alt="Файл не выбран" id="img_ads_preview_1" class="img-responsive" onclick="imgAdsLoad('ads_img_field_1')">
                        
                        <?= $form->field($model, 'photo1')->fileInput([
                                'id' => 'ads_img_field_1', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_1", "ads_img_field_1", "form-field-1")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-default', 'onclick' => 'imgAdsLoad("ads_img_field_1")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-default', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_1", "form-field-1")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo1')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'id' => 'form-field-1', 'class' => 'form-control', 'placeholder' => 'Фото 1'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= $photo2 ?>" alt="Файл не выбран" id="img_ads_preview_2" class="img-responsive" onclick="imgAdsLoad('ads_img_field_2')">
                        
                        <?= $form->field($model, 'photo2')->fileInput([
                                'id' => 'ads_img_field_2', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_2", "ads_img_field_2", "form-field-2")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-default', 'onclick' => 'imgAdsLoad("ads_img_field_2")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-default', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_2", "form-field-2")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo2')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'id' => 'form-field-2', 'class' => 'form-control', 'placeholder' => 'Фото 2'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= $photo3 ?>" alt="Файл не выбран" id="img_ads_preview_3" class="img-responsive" onclick="imgAdsLoad('ads_img_field_3')">
                        
                        <?= $form->field($model, 'photo3')->fileInput([
                                'id' => 'ads_img_field_3', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_3", "ads_img_field_3", "form-field-3")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-default', 'onclick' => 'imgAdsLoad("ads_img_field_3")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-default', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_3", "form-field-3")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo3')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'id' => 'form-field-3', 'class' => 'form-control', 'placeholder' => 'Фото 3'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= $photo4 ?>" alt="Файл не выбран" id="img_ads_preview_4" class="img-responsive" onclick="imgAdsLoad('ads_img_field_4')">
                        
                        <?= $form->field($model, 'photo4')->fileInput([
                                'id' => 'ads_img_field_4', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_4", "ads_img_field_4", "form-field-4")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-default', 'onclick' => 'imgAdsLoad("ads_img_field_4")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-default', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_4", "form-field-4")']) ?>
                            </div>
                        </div>

                       <?= $form->field($model, 'photo4')
                            ->textInput(['type' => 'hidden', 'maxlength' => true, 'id' => 'form-field-4', 'class' => 'form-control', 'placeholder' => 'Фото 4'])
                            ->label(false) ?>
                    </div>
                    
                </div> <!-- end cabinet-ads-photos-block / row -->
                
                <div class="hidden">

                    <?= $form->field($model, 'date_end')
                            ->textInput(['type' => 'hidden', 'id' => 'ads-date-end-field', 'class' => 'form-control input-lg', 'placeholder' => 'Дата окончания', 'value' => date('Y.m.d H:i:s', strtotime("+14 days"))])
                            ->label() ?>

                    <?= $form->field($model, 'vip')
                            ->textInput(['type' => 'hidden', 'id' => 'ads-vip-field', 'class' => 'form-control input-lg', 'placeholder' => 'VIP объявление', 'value' => '0'])
                            ->label() ?>

                    <?= $form->field($model, 'premium')
                            ->textInput(['type' => 'hidden', 'id' => 'ads-premium-field', 'class' => 'form-control input-lg', 'placeholder' => 'Premium объявление', 'value' => '0'])
                            ->label() ?>
                </div>

            </div>
            
            <div id="cabinet-ads-vip-premium-block" class="col-sm-5 col-md-4 col-lg-3">
                <h4>Как получить больше просмотров:</h4>
                <hr>
                <!--<?= Html::a('Поднять в поиске', Yii::$app->homeUrl.'cabinet/add', ['id' => 'btn-ads-up', 'class' => 'btn btn-green']) ?>
                <hr>-->
                <p class="bg-warning text-info">Подключить тариф VIP - объявление будет показано в специальном блоке на всех страницах сайта</p>
                <?= $form->field($model, 'vip')
                        ->checkbox([
                            'id' => 'ads-vip-checkbox',
                            'label' => 'Тариф VIP',
                            'labelOptions' => [
                                'class' => 'checkbox input-lg'
                            ],
                            'disabled' => false,
                            'onchange' => 'ifChecked("ads-vip-field")'
                        ]);?>
                
                <p class="bg-success text-info">Стоимость: 10 руб/сутки</p>
                
                <hr>
                
                <p class="bg-warning text-info">Подключить тариф Premium - объявление будет показано в специальном блоке  на главной странице, а также в той категории, в которой оно размещено</p>
                <?= $form->field($model, 'premium')
                        ->checkbox([
                            'id' => 'ads-premium-checkbox',
                            'label' => 'Тариф Premium',
                            'labelOptions' => [
                                'class' => 'checkbox input-lg'
                            ],
                            'disabled' => false,
                            'onchange' => 'ifChecked("ads-premium-field")'
                        ]);?>
                <p class="bg-success text-info">Стоимость: 7 руб/сутки</p>
                <hr>
                <!--<p class="bg-warning text-info">Оплата будет ежедневно списываться с вашего личного счета</p>-->
                <p class="bg-info text-info">На вашем счету: 0 руб.</p>
                
                <?= Html::a('Пополнить счет', Yii::$app->homeUrl.'cabinet/pay', ['id' => 'link-ads-pay', 'class' => 'btn-orange']) ?>

                
            </div>
            
            <div class="cabinet-btn-block form-group col-xs-12" style="">
                <hr>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?> 
                <?= Html::a('Отмена', 'javascript:history.go(-1)', ['class' => 'btn btn-danger']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </article>
</main>