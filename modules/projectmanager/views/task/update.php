<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Actualizar petición: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_editform', [
        'model' => $model,
        'project_id'=>$project_id
    ]) ?>

</div>
