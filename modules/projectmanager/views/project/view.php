<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mis proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>

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
    <p class="pull-right">
        <?= Html::a ('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a ('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro que quieres eliminar este proyecto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget ([
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

        ],
    ]) ?>


</div>
