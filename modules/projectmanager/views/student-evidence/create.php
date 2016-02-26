<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentEvidence */

$this->title = 'Create Student Evidence';
$this->params['breadcrumbs'][] = ['label' => 'Student Evidences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-evidence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
