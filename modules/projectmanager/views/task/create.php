<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Crear nueva petición';
$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['/project_manager/student-evidence/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

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

    <?= $this->render ('form', [
        'model' => $model,
        'projectId' => $projectId,
    ]) ?>


</div>
