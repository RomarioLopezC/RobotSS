<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectManager */

$this->title = 'Update Project Manager: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Project Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-manager-update">

    <h1><?= Html::encode ($this->title) ?></h1>

    <?= $this->render ('_form', [
        'model' => $model,
    ]) ?>

</div>
