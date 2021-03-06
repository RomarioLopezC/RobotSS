<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SocialServiceManager */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Social Service Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-view">

    <h1><?= Html::encode ($this->title) ?></h1>

    <p>
        <?= Html::a ('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a ('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    foreach (Yii::$app->getSession ()->getAllFlashes () as $key => $message) {
        echo Alert::widget ([
            'options' => [
                'class' => 'alert-' . $key,
            ],
            'body' => $message,
        ]);
    }
    ?>

    <?= DetailView::widget ([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'faculty_id',
        ],
    ]) ?>

</div>
