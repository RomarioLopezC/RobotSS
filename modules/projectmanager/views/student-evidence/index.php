<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use app\models\Project;
use app\models\ProjectManager;
use app\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentEvidenceSearch */
/* @var $dataProviderNews yii\data\ActiveDataProvider */
/* @var $dataProviderPending yii\data\ActiveDataProvider */
/* @var $dataProviderAccepted yii\data\ActiveDataProvider */

$this->title = 'Avances';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-evidence-index">

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


    <?php
    // ////////////////////////BOTON CREAR/////////////////////7
    $user = User::find ()
        ->where ("id=" . Yii::$app->user->id)
        ->one ();
    $userId = $user->id;
    $manager = ProjectManager::find ()
        ->where ("user_id=" . $userId)
        ->one ();
    $managerId = $manager->id;
    $projects = Project::find ()
        ->where ("manager_id=" . $managerId)
        ->all ();

    Modal::begin ([
        'header' => '<h2>Seleccione el proyecto</h2>',
        'toggleButton' => [
            'label' => 'Crear nueva petición',
            'class' => 'btn btn-success'
        ],
    ]);

    ?>

    <?= Html::beginForm (['task/select-project'], 'post') ?>
    <?= Html::dropDownList ('list', null, ArrayHelper::map ($projects, 'id', 'name'), ['class' => 'form-control']) ?>
    <?= Html::submitButton ('Crear', ['class' => 'btn btn-success']) ?>
    <?= Html::endForm () ?>

    <?php

    Modal::end ();
    ////////////////////////////// BOTON CREAR///////////////////////////////////7
    ?>

    <br><br><br>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Nuevos</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget ([
                'dataProvider' => $dataProviderNews,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'student_asign',
                        'value' => 'student.user_id',
                    ],
                    [
                        'attribute' => 'task_delivery_date',
                        'value' => 'task.delivery_date',
                        'format' => ['date', 'php:d/F/Y'],
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a ('<span class="glyphicon glyphicon-pencil"></span>',
                                    ['task/update', 'id' => $model['task_id']]);
                            }
                        ],
                    ],
                ],
            ]); ?>

        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Pendientes</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget ([
                'dataProvider' => $dataProviderPending,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'student_asign',
                        'value' => 'student.user_id',
                    ],
                    [
                        'attribute' => 'evidence_updated_at',
                        'value' => 'evidence.updated_at',
                        'format' => ['date', 'php:d/F/Y'],
                    ],
                    [
                        'attribute' => 'task_delivery_date',
                        'value' => 'task.delivery_date',
                        'format' => ['date', 'php:d/F/Y'],
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a ('<span class="glyphicon glyphicon-pencil"></span>',
                                    ['task/update', 'id' => $model['task_id']]);
                            }
                        ],
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a ('<span class="glyphicon glyphicon-file"></span>',
                                    ['task/show-feedback-screen', 'taskId' => $model['task_id'],
                                        'evidenceId' => $model['evidence_id']]);
                            }
                        ],
                    ],
                ],
            ]); ?>

        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Completados</h4>
        </div>

        <div class="panel-body">

            <?= GridView::widget ([
                'dataProvider' => $dataProviderAccepted,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'task_name',
                        'value' => 'task.name',
                    ],
                    [
                        'attribute' => 'student_asign',
                        'value' => 'student.user_id',
                    ],
                    [
                        'attribute' => 'evidence_accepted_date',
                        'value' => 'evidence.accepted_date',
                        'format' => ['date', 'php:d/F/Y'],
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>
