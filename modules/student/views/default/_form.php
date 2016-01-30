<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">
    <div class="col-md-4"></div>
    <div class="col-md-8">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($student, 'enrollment_id')->textInput() ?>

        <?= $form->field($person, 'name')->textInput() ?>

        <?= $form->field($person, 'lastname')->textInput() ?>

        <?= $form->field($user, 'email')->textInput() ?>

        <?= $form->field($person, 'phone')->textInput() ?>

        <?= $form->field($user, 'username')->textInput() ?>

        <?= $form->field($user, 'password')->passwordInput() ?>

        <?= $form->field($student, 'current_semester')->textInput() ?>

        <?= $form->field($student, 'faculty_id')->dropDownList(
            ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
        ) ?>

        <div class="form-group">
            <?= Html::submitButton($student->isNewRecord ? 'Create' : 'Update', ['class' => $student->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>
