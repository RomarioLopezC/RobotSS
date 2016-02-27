<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */

$this->title = 'Update Student Evidence: ' . ' ' . $model->task_id;
$this->params['breadcrumbs'][] = ['label' => 'Student Evidences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_id, 'url' => ['view', 'task_id' => $model->task_id, 'project_id' => $model->project_id, 'evidence_id' => $model->evidence_id, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-evidence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
