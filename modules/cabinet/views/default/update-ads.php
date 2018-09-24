<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\CabinetAds */

$this->title = 'Update Cabinet Ads: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cabinet Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cabinet-ads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>