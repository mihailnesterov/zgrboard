<?php

/* 
 * Add ads
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Новое объявление...';
?>

<main role="main">
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
                        ->textInput(['maxlength' => true, 'class' => 'hidden', 'placeholder' => 'id', 'value' => Yii::$app->user->identity->id])
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
                                   '1' => 'Продажа',
                                   '2' => 'Покупка',
                                   '3' => 'Обмен',
                                   '4' => 'Аренда',
                                   '5' => 'Услуга',
                                   '6' => 'Отдам',
                                   '7' => 'Разное',
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
                        
                        <img src="<?= Yii::$app->homeUrl ?>images/ads_default1.png" alt="Файл не выбран" id="img_ads_preview_1" class="img-responsive" onclick="imgAdsLoad('ads_img_field_1')">
                        
                        <?= $form->field($model, 'photo1')->fileInput([
                                'id' => 'ads_img_field_1', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_1", "ads_img_field_1", "form-field-1")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-success', 'onclick' => 'imgAdsLoad("ads_img_field_1")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-danger', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_1", "form-field-1")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo1')
                            ->textInput(['maxlength' => true, 'id' => 'form-field-1', 'class' => 'form-control', 'placeholder' => 'Фото 1'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= Yii::$app->homeUrl ?>images/ads_default1.png" alt="Файл не выбран" id="img_ads_preview_2" class="img-responsive" onclick="imgAdsLoad('ads_img_field_2')">
                        
                        <?= $form->field($model, 'photo2')->fileInput([
                                'id' => 'ads_img_field_2', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_2", "ads_img_field_2", "form-field-2")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-success', 'onclick' => 'imgAdsLoad("ads_img_field_2")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-danger', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_2", "form-field-2")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo2')
                            ->textInput(['maxlength' => true, 'id' => 'form-field-2', 'class' => 'form-control', 'placeholder' => 'Фото 2'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= Yii::$app->homeUrl ?>images/ads_default1.png" alt="Файл не выбран" id="img_ads_preview_3" class="img-responsive" onclick="imgAdsLoad('ads_img_field_3')">
                        
                        <?= $form->field($model, 'photo3')->fileInput([
                                'id' => 'ads_img_field_3', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_3", "ads_img_field_3", "form-field-3")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-success', 'onclick' => 'imgAdsLoad("ads_img_field_3")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-danger', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_3", "form-field-3")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo3')
                            ->textInput(['maxlength' => true, 'id' => 'form-field-3', 'class' => 'form-control', 'placeholder' => 'Фото 3'])
                            ->label(false) ?>
                    </div>
                    
                    <div class="col-xs-6 col-lg-3">
                        
                        <img src="<?= Yii::$app->homeUrl ?>images/ads_default1.png" alt="Файл не выбран" id="img_ads_preview_4" class="img-responsive" onclick="imgAdsLoad('ads_img_field_4')">
                        
                        <?= $form->field($model, 'photo4')->fileInput([
                                'id' => 'ads_img_field_4', 
                                'class' => 'hidden', 
                                'onchange' => 'previewAdsFile("img_ads_preview_4", "ads_img_field_4", "form-field-4")'
                            ])->label(false); ?>
                        
                        <div class="row">
                            <div class="col-xs-7 col-sm-7 col-md-5 col-lg-7">
                                <?= Html::button('Загрузить', ['class' => 'btn btn-success', 'onclick' => 'imgAdsLoad("ads_img_field_4")']) ?>
                            </div>
                            <div class=" col-xs-2">
                                <?= Html::button('Х', ['class' => 'btn btn-danger', 'title' => 'Очистить фото', 'onclick' => 'imgAdsDelete("img_ads_preview_4", "form-field-4")']) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'photo4')
                            ->textInput(['maxlength' => true, 'id' => 'form-field-4', 'class' => 'form-control', 'placeholder' => 'Фото 4'])
                            ->label(false) ?>
                    </div>
                    
                </div> <!-- end cabinet-ads-photos-block / row -->
                
                <div class="hidden1">
                    <?= $form->field($model, 'date_begin')
                        ->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Дата начала', 'value' => date('d.m.Y H:i:s', strtotime("+5 hours"))])
                        ->label('Дата начала срока:') ?>

                    <?= $form->field($model, 'date_end')
                            ->textInput(['id' => 'ads-date-end-field', 'class' => 'form-control input-lg', 'placeholder' => 'Дата окончания', 'value' => date('d.m.Y H:i:s', strtotime("+5 hours +14 days"))])
                            ->label('Дата окончания срока:') ?>

                    <?= $form->field($model, 'vip')
                            ->textInput(['id' => 'ads-vip-field', 'class' => 'form-control input-lg', 'placeholder' => 'VIP объявление', 'value' => '0'])
                            ->label(false) ?>

                    <?= $form->field($model, 'premium')
                            ->textInput(['id' => 'ads-premium-field', 'class' => 'form-control input-lg', 'placeholder' => 'Premium объявление', 'value' => '0'])
                            ->label(false) ?>

                    <?= $form->field($model, 'created')
                            ->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Дата подачи объявления', 'value' => date('Y.m.d H:i:s')])
                            ->label('Дата подачи объявления:') ?>

                    <?= $form->field($model, 'visits')
                            ->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Количество просмотров'])
                            ->label() ?>
                </div>

            </div>
            
            <div id="cabinet-ads-vip-premium-block" class="col-sm-5 col-md-4 col-lg-3">
                <h4>Увеличить просмотры:</h4>
                <hr>
                <!--<?= Html::a('Поднять в поиске', Yii::$app->homeUrl.'cabinet/add', ['id' => 'btn-ads-up', 'class' => 'btn btn-green']) ?>
                <hr>-->
                
                <?= $form->field($model, 'vip')
                        ->checkbox([
                            'id' => 'ads-vip-checkbox',
                            'label' => 'VIP',
                            'labelOptions' => [
                                'class' => 'checkbox input-lg'
                            ],
                            'disabled' => false,
                            'onchange' => 'ifChecked("ads-vip-field")'
                        ]);?>
                
                <p class="bg-warning text-info">VIP - объявление будет показано в специальном блоке на всех страницах сайта</p>
                
                <hr>
                
                <?= $form->field($model, 'premium')
                        ->checkbox([
                            'id' => 'ads-premium-checkbox',
                            'label' => 'Premium',
                            'labelOptions' => [
                                'class' => 'checkbox input-lg'
                            ],
                            'disabled' => false,
                            'onchange' => 'ifChecked("ads-premium-field")'
                        ]);?>
                <p class="bg-warning text-info">Premium - объявление будет показано в специальном блоке  на главной странице, а также в категории, в которой размещено объявление</p>
                <hr>
                <p class="bg-warning text-info">На вашем счету: 189,00 руб.</p>
                <?= Html::a('Пополнить счет', Yii::$app->homeUrl.'cabinet/pay', ['id' => 'link-ads-pay', 'class' => 'btn-orange']) ?>

                
            </div>
            
            <div class="form-group col-xs-12">
                <?= Html::submitButton('Опубликовать', ['class' => 'btn-green']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </article>
</main>
