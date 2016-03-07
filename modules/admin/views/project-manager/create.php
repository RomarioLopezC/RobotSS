<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectManager */

$this->title = 'Create Project Manager';
$this->params['breadcrumbs'][] = ['label' => 'Project Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-manager-create">

    <h1><?= Html::encode ($this->title) ?></h1>

    <?= $this->render ('_form', [
        'model' => $model,
    ]) ?>

</div>
