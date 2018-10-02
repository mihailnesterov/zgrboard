<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetAds */

$this->title = 'Объявление № '.$model->id.': '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мои объявления', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = $this->title;
?>

<main role="main">
        <article id="content" class="row">

            <header class="col-xs-12" style="margin-top: 1.5em;">
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
                </div>
                <table id="cabinet-view-ads-table" class="table table-bordered table-responsive table-striped">                  
                    <tr>
                        <td width='5%'>1</td>
                        <td width='35%'>Категория</td>
                        <td><?php   // выводим категорию по id
                            $category = \app\models\Category::findOne($model->category_id);
                            echo $category->name;
                        ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><?= $model->getAttributeLabel('type') ?></td>
                        <td><?= $model->type ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><?= $model->getAttributeLabel('title') ?></td>
                        <td><?= $model->title ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><?= $model->getAttributeLabel('text') ?></td>
                        <td><?= $model->text ?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><?= $model->getAttributeLabel('price') ?></td>
                        <td><?= $model->price ?></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Фото</td>
                        <td>
                            <img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo1 ?>" alt='' class="img-responsive">
                            <img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo2 ?>" alt='' class="img-responsive">
                            <img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo3 ?>" alt='' class="img-responsive">
                            <img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo4 ?>" alt='' class="img-responsive">
                        </td>
                    </tr>
                    <!--<tr>
                        <td>7</td>
                        <td><?= $model->getAttributeLabel('photo2') ?></td>
                        <td><img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo2 ?>" alt='нет' class="img-responsive"></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><?= $model->getAttributeLabel('photo3') ?></td>
                        <td><img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo3 ?>" alt='нет' class="img-responsive"></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><?= $model->getAttributeLabel('photo4') ?></td>
                        <td><img src="<?= Yii::$app->homeUrl ?>images/users/<?= Yii::$app->user->identity->login ?>/<?= $model->photo4 ?>" alt='нет' class="img-responsive"></td>
                    </tr>-->
                    <tr>
                        <td>9</td>
                        <td><?= $model->getAttributeLabel('created') ?></td>
                        <td>
                            <?php 
                                $date = new DateTime($model->created);
                                echo $date->format('d.m.Y');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td><?= $model->getAttributeLabel('date_end') ?></td>
                        <td><?php 
                                $date = new DateTime($model->date_end);
                                echo $date->format('d.m.Y');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td><?= $model->getAttributeLabel('visits') ?></td>
                        <td><?= $model->visits ?></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Тариф VIP</td>
                        <td><?php 
                            if ($model->vip == 0)
                            {
                                echo 'нет';
                            } else {
                                echo 'да';
                            }?></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Тариф Premium</td>
                        <td><?php 
                            if ($model->premium == 0)
                            {
                                echo 'нет';
                            } else {
                                echo 'да';
                            }?></td>
                    </tr>
                </table>
            </div>
            
            <div class="col-xs-12" style="margin: 0.5em 0 1.5em 0;">
                <?= Html::a('Редактировать', ['update-ads', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить объявление?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            </article>
</main>