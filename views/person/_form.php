<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;
use yii\helpers\Url;
use app\models\Degree;
/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-service-manager-form">

    <div class="row">
        <div class="col-lg-3">
            <?= Html::img(Url::to(['/images/uady-logo.jpg']), ['class' => 'img-responsive']) ?>
        </div>

        <div class="col-lg-7">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4>Datos Generales</h4>
                </div>

                <div class="panel-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'email')->textInput() ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?php
                    if (Yii::$app->user->can('projectManager')) {
                        echo $form->field($rol, 'organization')->textInput();

                    } else if (Yii::$app->user->can('socialServiceManager')) {
                        echo $form->field($rol, 'faculty_id')->dropDownList(
                            ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
                        );

                    } else if (Yii::$app->user->can('student')) {
                        echo $form->field($rol, 'faculty_id')->dropDownList(
                            ArrayHelper::map(Faculty::find()->all(), 'id', 'name')
                        );
                        echo $form->field($rol, 'degree_id')->dropDownList(
                            ArrayHelper::map(Degree::find()->all(), 'id', 'name')
                        );
                        echo $form->field($rol, 'current_semester')->textInput();
                        echo $form->field($rol, 'enrollment_id')->textInput();
                    }
                    ?>

                </div>

            </div>


            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update Account'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
