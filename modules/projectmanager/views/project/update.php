<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Actualizar proyecto: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mis proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="project-update">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>

    <?= $this->render ('_form', [
        'model' => $model,
    ]) ?>

</div>
