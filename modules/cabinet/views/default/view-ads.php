<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetAds */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cabinet Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-ads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'category_id',
            'title',
            'text:ntext',
            'price',
            'photo1',
            'photo2',
            'photo3',
            'photo4',
            'type',
            'date_begin',
            'date_end',
            'vip',
            'premium',
            'created',
            'visits',
        ],
    ]) ?>

</div>