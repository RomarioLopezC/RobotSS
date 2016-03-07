<?php

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis proyectos';
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
<div class="project-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a ('Registrar nuevo proyecto', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <br><br><br>

    <?= GridView::widget ([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'dependency',
            'objective',
            'goals',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a ('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model['id']], [
                            'title' => Yii::t ('app', 'Delete'), 'data-confirm' => Yii::t ('app', '¿Estas seguro que deseas eliminar el proyecto?'), 'data-method' => 'post']);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
