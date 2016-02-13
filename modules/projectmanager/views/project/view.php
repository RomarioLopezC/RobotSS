<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    foreach(Yii::$app->getSession()->getAllFlashes() as $key => $message) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-'.$key,
            ],
            'body' => $message,
        ]);
    }
    ?>
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
            'name',
            'dependency',
            'objective',
            'goals',
            'actions_by_students',
            'induction',
            'materials_for_students',
            'economic_support',
            'human_resource',
            'infraestructure',
            'ammount',
            'approved',
        ],
    ]) ?>

    <?= Html::a('Pre-registrarse al proyecto', ['preregister', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

</div>
