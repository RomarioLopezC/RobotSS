<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Project;
use app\models\Registration;
use app\models\ProjectManager;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_date')->widget(\yii\jui\DatePicker::classname(), [

        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <?php
    //$options = \yii\helpers\ArrayHelper::map($model->degrees, 'id', 'name');


    //$form->field($model, 'degrees')->checkboxList($options, ['unselect'=>NULL])




    $user = User::find()
        ->where("id=" . Yii::$app->user->id)
        ->one();
    $user_id = $user->id;
    $manager = ProjectManager::find()
        ->where("user_id=" . $user_id)
        ->one();
    $manager_id = $manager->id;
    $project=Project::find()
        ->where("manager_id=" . $manager_id)
        ->one();
    $project_id = $project->id;

    $students=Registration::find()
        ->where("project_id=" . $project_id);

    ;

    echo $form->field($model, 'students')->checkboxList(ArrayHelper::map(Registration::find()->joinWith('student', true, 'INNER JOIN')->joinWith('project', true, 'INNER JOIN')->where("manager_id=" . $manager_id)->all(), 'student_id', 'student_id'));



    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
