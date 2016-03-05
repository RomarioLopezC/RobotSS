<?php

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-' . $key,
        ],
        'body' => $message,
    ]);
}
?>
<div class="student-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>


    <?php if ($dataProvider->totalCount == 0): ?>
        <div class="alert-danger alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            No existen alumnos Pre-registrados a proyectos.
        </div>
    <?php else: ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['label' => 'Proyecto', 'attribute' => 'projectName'],
                ['label' => 'Estudiante', 'attribute' => 'studentName'],
                'beginning_date',
                'ending_date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{assign-student} {cancel-preregistration}',
                    'buttons' => [
                        'assign-student' => function ($url) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-ok"></span>',
                                $url,
                                [
                                    'title' => 'Asignar estudiante',
                                    'data-pjax' => '0',
                                    'data-confirm' => Yii::t('app', '¿Está seguro que desea asignar al estudiante?'),
                                ]
                            );
                        },
                        'cancel-preregistration' => function ($url) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url,
                                [
                                    'title' => 'Cancelar preregistro',
                                    'data-pjax' => '0',
                                    'data-confirm' => Yii::t('app', '¿Está seguro que desea cancelar el registro del estudiante?'),
                                ]
                            );
                        },
                    ],
                ],
            ],
        ]); ?>

    <?php endif; ?>

</div>
