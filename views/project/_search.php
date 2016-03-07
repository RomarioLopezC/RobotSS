<?php

use app\models\Degree;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Parámetros de búsqueda</h4>
        </div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin ([
                'action' => ['index'],
                'method' => 'get',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-4 control-label'],
                ],
            ]); ?>

            <div class="row">

                <div class="col-md-6">
                    <?= $form->field ($model, 'name') ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field ($model, 'id')->label ('ID del proyecto') ?>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <?= $form->field ($model, 'degree_id')->label ('Licenciatura')->dropDownList (
                        ArrayHelper::map (Degree::find ()->all (), 'id', 'name')
                    ) ?>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton ('Buscar', ['class' => 'btn btn-primary pull-right']) ?>
            </div>

            <?php ActiveForm::end (); ?>

        </div>
    </div>

</div>
