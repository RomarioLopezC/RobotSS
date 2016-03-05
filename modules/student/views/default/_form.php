<?php

use app\models\Degree;
use app\models\Faculty;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($student, 'enrollment_id')->textInput() ?>

    <?= $form->field($person, 'name')->textInput() ?>

    <?= $form->field($person, 'lastname')->textInput() ?>

    <?= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($person, 'phone')->textInput() ?>

    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password_hash')->passwordInput()->label("Password") ?>

    <?= $form->field($student, 'current_semester')->textInput() ?>

    <?= $form->field($student, 'faculty_id')->dropDownList(
        ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($student, 'degree_id')->dropDownList(
        ArrayHelper::map(Degree::find()->all(), 'id', 'name')
    ) ?>

    <div class="form-group">
        <div class="pull-right">
            <?= Html::a('Cancelar', '../../user/login', ['class' => 'btn btn-danger']) ?>
            <?= Html::submitButton($student->isNewRecord ? 'Completar solicitud' : 'Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
