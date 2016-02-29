<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Project;
use app\models\Registration;
use app\models\ProjectManager;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin (['action' => Url::to (['create', 'projectId' => $projectId])]); ?>

    <?= $form->field ($model, 'name')->textInput (['maxlength' => true]) ?>

    <?= $form->field ($model, 'description')->textarea (['rows' => 6]) ?>

    <?= $form->field ($model, 'delivery_date')->widget (\yii\jui\DatePicker::classname (), [

        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <?php

    $user = User::find ()
        ->where ("id=" . Yii::$app->user->id)
        ->one ();
    $userId = $user->id;
    $manager = ProjectManager::find ()
        ->where ("user_id=" . $userId)
        ->one ();
    $managerId = $manager->id;

    $students = Yii::$app->db->createCommand ('Select
        registration.student_id,
        student.id,
        person.name,
        person.lastname
        From
        registration Inner Join
        student
        On registration.student_id = student.id Inner Join
        user
        On student.user_id = user.id Inner Join
        person
        On user.person_id = person.id
        where registration.project_id=' . $projectId)
        ->queryAll ();


    echo $form->field ($model, 'students')->checkboxList (ArrayHelper::map ($students, 'student_id', 'name'));

    ?>


    <div class="form-group">
        <?= Html::submitButton ($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end (); ?>

</div>
