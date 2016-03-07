<?php

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aprobación de proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
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
<div class="student-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>


    <?php if ($dataProvider->totalCount == 0): ?>
        <div class="alert-danger alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            No existen proyectos por aprobar
        </div>
    <?php else: ?>
        <?= GridView::widget ([
            'dataProvider' => $dataProvider,
            'columns' => [
                'name',
                'dependency',
                ['label' => 'Perfiles solicitados', 'attribute' => 'studentProfiles'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{approve-project} {cancel-project}',
                    'buttons' => [
                        'approve-project' => function ($url) {
                            return Html::a (
                                '<span class="glyphicon glyphicon-ok"></span>',
                                $url,
                                [
                                    'title' => 'Aprobar proyecto',
                                    'data-pjax' => '0',
                                    'data-confirm' => Yii::t ('app', '¿Está seguro que desea aprobar el proyecto?'),
                                ]
                            );
                        },
                        'cancel-project' => function ($url) {
                            return Html::a (
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url,
                                [
                                    'title' => 'Cancelar proyecto',
                                    'data-pjax' => '0',
                                    'data-confirm' => Yii::t ('app', '¿Está seguro que desea cancelar el proyecto?'),
                                ]
                            );
                        },
                    ],
                ],
            ],
        ]); ?>

    <?php endif; ?>

</div>
